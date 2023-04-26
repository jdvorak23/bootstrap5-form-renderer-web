<?php

namespace App\Presenters;

use App\Components\CodeLines;
use App\Model\FormPreparator;
use Nette\Application\UI\Presenter;

abstract class BaseFormPresenter extends Presenter
{
    protected FormPreparator $formPreparator;
    protected function startup(): void
    {
        parent::startup();

        if('form' !== $this->getAction())
            $this->redirect('form', $this->getParameters());
        $formName = $this->getFormName();
        $id = $this->getParameter('id');
        $this->formPreparator = new FormPreparator($formName, $this);
        $this->formPreparator->setId($id);
        $this->template->forms = $this->formPreparator;
        /*if($this->formPreparator->isSubmitted())
            $this->template->activeFormIndex = $this->formPreparator->getActiveFormIndex();
        else
            $this->template->activeFormIndex = ($id && array_key_exists($id, $this->template->forms)) ? $id : $this->formPreparator->getActiveFormIndex();*/

    }

    protected function actionForm($id = null)
    {

    }
    protected function getFormName() : string
    {
        return lcfirst(str_replace('Presenter', '', $this->getName())) . 'Form';
    }
    protected function createComponentCodeLines()
    {
        return new CodeLines();
    }
}