<?php

namespace App\Components;

use App\Model\Forms\FormWrapper;
use Nette\Application\UI\Control;
use Nette\Forms\Controls\HiddenField;

class CodeLines extends Control
{
    const template = __DIR__ . '/../templates/components/codeLines.latte';

    public function render(FormWrapper $form) : void
    {
        $this->prepareTemplate($form);
        $this->template->render();
    }
    public function renderToString(FormWrapper $form) : string
    {
        $this->prepareTemplate($form);
        return $this->template->renderToString();
    }

    protected function prepareTemplate(FormWrapper $form)
    {
        $this->template->setFile(self::template);
        /**
         * @var \Nette\Application\UI\Form $formInstance
         */
        $formInstance = $this->getPresenter()->getComponent($form->getName());
        $controlsCount = 0;
        foreach($formInstance->getControls() as $control){
            if($control instanceof HiddenField)
                continue;
            $controlsCount++;
        }
        $this->template->controls = $controlsCount;
        $this->template->codeLines = $form->getCodeLines();
        $this->template->setupLines = $form->getSetupLines();
        $this->template->wrapperLines = $form->getWrapperLines();
    }
}