<?php

namespace App\Model;

use Nette\Application\UI\Presenter;
use Nette\Forms\Form;
use ReflectionClass;
use ReflectionMethod;

class FormPreparator
{
    const factoryPrefix = 'createComponent';
    const indexDelimiter = '_';

    protected array $forms = [];
    protected string $templatesDir;
    protected string $activeFormIndex;
    protected bool $isSubmitted = false;
    protected ?array $classCodeLines = null;
    protected $id = null;

    protected string $activeChapter;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function __construct(protected string $baseFormName, protected Presenter $presenter)
    {
        $this->baseFormName = lcfirst($this->baseFormName);
        $this->setTemplatesDir();
        // Iterates all methods in given Presenter, proccess those which are connected with $baseFormName.
        $presenterReflection = new ReflectionClass($presenter);
        $this->setClassCodeLines($presenterReflection);
        foreach($presenterReflection->getMethods() as $method){
            $indexes = $this->getFormIndexes($method->name);
            if(!is_null($indexes)){
                if(count($indexes) == 1) {
                    $this->forms[$indexes[0]] = $this->createFormWrapper($indexes, $method);
                }else{ // Může být pouze 1 nebo 2, takže 2
                    if(isset($this->forms[$indexes[0]]) && $this->forms[$indexes[0]] instanceof FormWrapper)
                        continue;
                    if(!isset($this->forms[$indexes[0]]))
                        $this->forms[$indexes[0]] = [];
                    $this->forms[$indexes[0]][$indexes[1]] = $this->createFormWrapper($indexes, $method);
                }
            }
        }
        // Sort by keys
        ksort($this->forms);
        foreach($this->forms as $key => $group)
            if(is_array($group))
                ksort($this->forms[$key]);
        $this->setActiveChapter();
    }
    public function getActiveChapter()
    {
        $index = $this->activeChapter;
        $forms = is_array($this->forms[$index]) ? $this->forms[$index] : array($this->forms[$index]);
        return $forms;
    }
    public function getActiveIndex()
    {
       return $this->activeChapter;
    }

    protected function setActiveChapter() : void
    {
        // Pokud byl odeslán nějaký formulář, zkontroluje jestli to byl "ten náš".
        // Pokud ano, nastaví jeho index jako $activeChapter.
        if($_POST && $_POST['_do']){
            $dashPos = strpos($_POST['_do'],'-');
            $formName = $dashPos === false ? $_POST['_do'] : substr($_POST['_do'], 0, $dashPos);
            $indexes = $this->getFormIndexes(self::factoryPrefix . ucfirst($formName));
            if(!is_null($indexes) && isset($this->forms[$indexes[0]])){
                $this->activeChapter = $indexes[0];
                $this->isSubmitted = true;
                return;
            }
        }
        // Pokud nebyl odeslán náš formulář, pokusí se nastavit $activeChapter podle parametru $id presenteru (musí takový formulář existovat).
        $id = $this->presenter->getParameter('id');
        if(array_key_exists($id, $this->forms)){
            $this->activeChapter = $id;
            return;
        }
        // Pokud nebylo nalezeno, může id být název kapitoly (nebo název první sub-kapitoly)
        foreach ($this->forms as $key => $value){
            $caption = is_array($value) ? reset($this->forms[$key])->getCaption() : $value->getCaption();
            $url = $this->getUrlFromCaption($caption);
            if($url == $id){
                $this->activeChapter = $key;
                return;
            }
        }
        // Pokud stále není nalezeno, $id ukazuje na neexistující formulář. V tom případě přesměruje na první existující.
        reset($this->forms);
        $this->presenter->redirect('this', ['id' => key($this->forms)]);
    }

    protected function getUrlFromCaption($caption)
    {
        $caption = strtolower(trim($caption));
        return str_replace(' ','-', $caption);
    }
    public function getChapters() : array
    {
        $chapters = [];
        foreach ($this->forms as $key => $value){
            $caption = is_array($value) ? reset($this->forms[$key])->getCaption() : $value->getCaption();
            $chapters[$key] = ['caption' => $caption, 'url' => $this->getUrlFromCaption($caption)];
        }
        return $chapters;
    }

    public function getFormName(){
        return $this->baseFormName;
    }


    //todo deprec
    public function getForms() : array
    {
        $forms = [];
        foreach ($this->forms as $key => $value)
            $forms[$key] = is_array($value) ? $value : [$value];
        return $forms;
    }
    // Used in template


    public function getForm($factoryName) : FormWrapper|null
    {
        $indexes = $this->getFormIndexes($factoryName);
        if(!isset($indexes))
            return null;

        if(isset($this->forms[$indexes[0]])){
            if(isset($indexes[1]) && isset($this->forms[$indexes[0]][$indexes[1]]))
                return $this->forms[$indexes[0]][$indexes[1]];
            return $this->forms[$indexes[0]];
        }

        return null;
    }
    public function isSubmitted() : bool
    {
        return $this->isSubmitted;
    }
    protected function setTemplatesDir() : void
    {
        $template = $this->presenter->formatTemplateFiles()[0];
        $this->templatesDir = dirname($template) . 'FormPreparator.php/' . ucfirst($this->baseFormName);
    }

    protected function setClassCodeLines(ReflectionClass $presenterReflection) : void
    {
        $classFile = $presenterReflection->getFileName();
        $this->classCodeLines = file($classFile, 0, null);
    }

    protected function getFormIndexes($factoryName) : array|null
    {
        $factoryNameStartsWith = self::factoryPrefix . ucfirst($this->baseFormName);
        if(str_starts_with($factoryName, $factoryNameStartsWith) && $factoryName !== $factoryNameStartsWith)
        {
            $formIndex = str_replace($factoryNameStartsWith, '', $factoryName);
            return explode(self::indexDelimiter, $formIndex, 2);
        }
        return null;
    }
    protected function createFormWrapper(array $indexes, ReflectionMethod $formFactoryMethod) : FormWrapper
    {
        $caption = isset($formFactoryMethod->getStaticVariables()['caption']) ? (string) $formFactoryMethod->getStaticVariables()['caption']  : null;
        return new FormWrapper($this->baseFormName . implode("_", $indexes),
                                            $this->baseFormName,
                                            $this->getFormTemplateFile($indexes),
                                            $this->getFormFactoryCode($formFactoryMethod),
                                            $caption);
    }
    protected function getFormFactoryCode(ReflectionMethod $formFactoryMethod) : array
    {
        $start = $formFactoryMethod->getStartLine() - 1;
        $end = $formFactoryMethod->getEndLine();
        return array_slice($this->classCodeLines, $start, $end - $start);
    }
    protected function getFormTemplateFile(array $indexes) : string|null
    {
        if(count($indexes) == 1)
            $templateFile = $this->templatesDir . '/' . $indexes[0] . '.latte';
        else
            $templateFile = $this->templatesDir . '/' . $indexes[0] . '/' . $indexes[1] . '.latte';
        if(is_file($templateFile))
            return $templateFile;
        return null;
    }
}