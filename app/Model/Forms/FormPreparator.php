<?php

namespace App\Model\Forms;

use Nette\Application\UI\Presenter;
use Nette\SmartObject;
use ReflectionClass;
use ReflectionMethod;

/**
 * @property-read string $formName
 * @property-read FormsCollection[] $chapters
 * @property-read FormsCollection $activeChapter
 * @property-read FormsCollection $firstChapter
 */
class FormPreparator
{
    use SmartObject;
    const factoryPrefix = 'createComponent';
    const indexDelimiter = '_';

    /**@var FormsCollection[]*/
    protected array $chapters = [];

    protected FormsCollection $activeChapter;

    protected FormsCollection $firstChapter;

    protected string $templatesDir;
    protected ?array $classCodeLines = null;

    public function __construct(protected string $baseFormName, protected Presenter $presenter)
    {
        $this->baseFormName = lcfirst($this->baseFormName);
        $this->setTemplatesDir();
        $presenterReflection = new ReflectionClass($presenter);
        $this->setClassCodeLines($presenterReflection);
        // Iterates all methods in given Presenter, process those which are connected with $baseFormName.
        $forms = [];
        foreach($presenterReflection->getMethods() as $method){
            $indexes = $this->getFormIndexes($method->name);
            if(!is_null($indexes)){
                if(count($indexes) == 1) {
                    $forms[$indexes[0]] = $this->createFormWrapper($indexes, $method);
                }else{ // Může být pouze 1 nebo 2, takže 2
                    if(isset($forms[$indexes[0]]) && $forms[$indexes[0]] instanceof FormWrapper)
                        continue;
                    if(!isset($forms[$indexes[0]]))
                        $forms[$indexes[0]] = [];
                    $forms[$indexes[0]][$indexes[1]] = $this->createFormWrapper($indexes, $method);
                }
            }
        }
        // Sort by keys
        ksort($forms);
        foreach($forms as $key => $group)
            if(is_array($group))
                ksort($forms[$key]);
        // Create chapters
        foreach($forms as $key => $group){
            $chapter = new  FormsCollection();
            $this->firstChapter = $this->firstChapter ?? $chapter;
            if(is_array($group))
                foreach($group as $skey => $form)
                    $chapter->addForm($form, $skey);
            else
                $chapter->addForm($group);

            $this->chapters[$key] = $chapter;
        }

        // Pokud není nalezeno, $id ukazuje na neexistující formulář. V tom případě přesměruje na první existující.
        if(!$this->setActiveChapter())
            $this->presenter->redirect('this', ['id' => $this->firstChapter->url]);
    }
    protected function setActiveChapter() : bool
    {
        // Pokud byl odeslán nějaký formulář, zkontroluje jestli to byl "ten náš".
        // Pokud ano, nastaví jeho index jako $activeChapter.
        if($_POST && $_POST['_do']){
            $dashPos = strpos($_POST['_do'],'-');
            $formName = $dashPos === false ? $_POST['_do'] : substr($_POST['_do'], 0, $dashPos);
            $indexes = $this->getFormIndexes(self::factoryPrefix . ucfirst($formName));
            if($indexes !== null && isset($this->chapters[$indexes[0]])){
                $this->activeChapter = $this->chapters[$indexes[0]];
                return true;
            }
        }
        // Pokud nebyl odeslán náš formulář, pokusí se nastavit $activeChapter podle parametru $id presenteru (musí takový formulář existovat).
        $id = $this->presenter->getParameter('id');
        if(array_key_exists($id, $this->chapters)){
            $this->activeChapter = $this->chapters[$id];
            return true;
        }
        // Pokud nebylo nalezeno, může id být název kapitoly (nebo název první sub-kapitoly)
        foreach ($this->chapters as $chapter){
            if($chapter->url == $id){
                $this->activeChapter = $chapter;
                return true;
            }
        }
        // Nenalezeno
        return false;
    }
    //------
    public function getFormName(): string
    {
        return $this->baseFormName;
    }
    public function getChapters(): array
    {
        return $this->chapters;
    }
    public function getActiveChapter(): FormsCollection
    {
        return $this->activeChapter;
    }
    public function getFirstChapter(): FormsCollection
    {
        return $this->firstChapter;
    }
    //------
    public function getForm($factoryName) : FormWrapper|null
    {
        $indexes = $this->getFormIndexes($factoryName);
        if($indexes === null)
            return null;
        $formName = lcfirst(str_replace(self::factoryPrefix, '', $factoryName));

        return isset($this->chapters[$indexes[0]]) ? $this->chapters[$indexes[0]]->getForm($formName) : null;
    }
    //------
    protected function setTemplatesDir() : void
    {
        $template = $this->presenter->formatTemplateFiles()[0];
        $this->templatesDir = dirname($template) . '/' . ucfirst($this->baseFormName);
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
        $templateFile = $this->templatesDir . '/' . implode('/', $indexes). '.latte';
        if(is_file($templateFile))
            return $templateFile;
        return null;
    }
}