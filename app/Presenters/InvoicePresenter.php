<?php

namespace App\Presenters;

use App\Forms\InvoiceFormFactory;
use Jdvorak23\Bootstrap5FormRenderer\Bootstrap5FormRenderer;
use Nette\Application\UI\Form;
use Nette\Utils\Html;

class InvoicePresenter extends BaseFormPresenter
{
    public function __construct(private InvoiceFormFactory $invoiceFormFactory)
    {
        parent::__construct();
    }

    protected function createComponentInvoiceForm1_1() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Test form - InvoiceForm');
//------//------
        $form = $this->invoiceFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $renderer->wrappers['description']['inputGroupItem'] = 'div class="input-group-text d-none d-sm-flex col-auto col-sm-4 col-md-3 col-lg-3"';
        $renderer->wrappers['description']['push'] = $this->getActionButton();
        $renderer::setAllControlsInGroup($form->getGroup('Faktury'), '.label', 'col-auto col-sm-5 col-md-4 col-lg-3');
        $form['save']->setOption('inputGroup', false);
        $form->getGroup("Položky na faktuře")->setOption('floatingLabels', true);
        //------
        return $form;
    }
    protected function createComponentInvoiceForm1_2() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Test form - InvoiceForm');
//------//------
        $form = $this->invoiceFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $renderer->wrappers['description']['inputGroupItem'] = 'div class="input-group-text d-none d-sm-flex col-auto col-sm-4 col-md-3 col-lg-3"';
        $renderer->wrappers['description']['push'] = $this->getActionButton();
        $renderer::setAllControlsInGroup($form->getGroup('Faktury'), '.label', 'col-auto col-sm-5 col-md-4 col-lg-3');
        $form['save']->setOption('inputGroup', false);
        $form->getGroup("Položky na faktuře")->setOption('floatingLabels', true);
        //------
        return $form;
    }

    protected function getActionButton() : Html
    {
        return Html::el()->addHtml('
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="d-none d-sm-inline">Action</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                  </ul>
        ');
    }
}