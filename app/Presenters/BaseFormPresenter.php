<?php

namespace App\Presenters;

use App\Components\CodeLines;
use App\Model\Forms\FormPreparator;
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
        //$this->formPreparator->setId($id); //? todo
        $this->template->forms = $this->formPreparator;
        //$this->template->setFile(__DIR__ . '/templates/form.latte');

        /*if($this->formPreparator->isSubmitted())
            $this->template->activeFormIndex = $this->formPreparator->getActiveFormIndex();
        else
            $this->template->activeFormIndex = ($id && array_key_exists($id, $this->template->forms)) ? $id : $this->formPreparator->getActiveFormIndex();*/

    }

    public function actionForm($id = null)
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