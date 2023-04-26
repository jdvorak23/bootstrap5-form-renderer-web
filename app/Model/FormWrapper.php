<?php

namespace App\Model;

use Nette\Application\UI\Presenter;

class FormWrapper
{
    const bodyStart = '//------Renderer Setup';
    const bodyEnd = '//------';
    const headerEnd = '//------//------';
    const setupLines = [
        'renderer = new',
        'setRenderer'
    ];
    const wrapperLines = [
        'renderer->wrappers',
    ];

    protected string $maxWidth = '992px';
    //protected string $name;
    protected string $caption;

    protected int $codeLines;
    protected int $setupLines;
    protected int $wrapperLines;

    public function __construct(protected string      $name,
                                protected string      $baseName,
                                protected string|null $templateFile,
                                protected array       $formFactoryCode,
                                protected Presenter   $presenter)
    {
        //bdump($this->name);
    }

    public function getFactoryMethod(): string
    {
        $method = [];
        // Method name
        $namePos = strpos($this->formFactoryCode[0], ucfirst($this->baseName));
        $indexesPos = $namePos + strlen($this->baseName);
        $end = strpos($this->formFactoryCode[0], '(');
        $indexes = substr($this->formFactoryCode[0], $indexesPos, $end - $indexesPos);
        $name = str_replace($indexes, '', $this->formFactoryCode[0]);
        $method[] = $name;
        // Add {
        if (!str_contains($name, '{'))
            $method[] = "    {\n";
        //
        $started = false;
        for ($i = 1; $i < count($this->formFactoryCode); $i++) {
            $line = $this->formFactoryCode[$i];
            if ($started)
                $method[] = $line;
            if (str_contains($line, self::headerEnd))
                $started = true;
        }
        return implode($method);
    }

    public function getCaption(): string
    {
        $this->presenter[$this->name];
        return $this->caption ?? $this->name;
    }

    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }

    public function getMaxWidth() : string
    {
        return $this->maxWidth;
    }

    public function setMaxWidth(string $maxWidth) : void
    {
        $this->maxWidth = $maxWidth;
    }

    public function setTemplateFile(string|null $templateFile) : void
    {
        $this->templateFile = $templateFile;
    }
    public function getTemplateFile() : string|null
    {
        return $this->templateFile;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setLines() : void
    {
        $started = false;
        $this->codeLines = 0;
        $this->setupLines = 0;
        $this->wrapperLines = 0;
        foreach($this->formFactoryCode as $line){
            if($started && str_contains($line, self::bodyEnd))
                break;
            if($started){
                if($this->strContainsInArray($line, self::setupLines))
                    $this->setupLines++;
                elseif($this->strContainsInArray($line, self::wrapperLines))
                    $this->wrapperLines++;
                else
                    $this->codeLines++;
            }
            if(str_contains($line, self::bodyStart))
                $started = true;
        }
    }

    public function getCodeLines() : int
    {
        if(!isset($this->codeLines))
            $this->setLines();
        return $this->codeLines;
    }

    public function getSetupLines() : int
    {
        if(!isset($this->setupLines))
            $this->setLines();
        return $this->setupLines;
    }
    public function getWrapperLines() : int
    {
        if(!isset($this->wrapperLines))
            $this->setLines();
        return $this->wrapperLines;
    }

    //------
    protected function strContainsInArray(string $haystack, array $needles) : bool
    {
        foreach($needles as $needle)
            if(str_contains($haystack, $needle))
                return true;
        return false;
    }
}