<?php

namespace App\Presenters;

use App\Forms\InvoiceFormFactory;
use App\Model\InputGroupSeparateLabel;
use App\Model\ResponsiveFloating;
use Jdvorak23\Bootstrap5FormRenderer\Bootstrap5FormRenderer;
use Jdvorak23\Bootstrap5FormRenderer\Designers\Designer;
use Jdvorak23\Bootstrap5FormRenderer\HtmlFactory;
use Jdvorak23\Bootstrap5FormRenderer\Wrappers;
use Nette\Application\UI\Form;
use Nette\Utils\Html;

class InvoicePresenter extends BaseFormPresenter
{
    public function __construct(private InvoiceFormFactory $invoiceFormFactory)
    {
        parent::__construct();
    }

    protected function getResponsiveChunk(string $text, string $classes): Html
    {
        return Html::el('div')
            ->class($classes)
            ->setText($text);
    }

    protected function getResponsiveText(string $text, string $smText, ?string $classes = null): Html
    {
        return Html::el()
            ->addHtml($this->getResponsiveChunk($text, 'd-sm-none ' . $classes))
            ->addHtml($this->getResponsiveChunk($smText, 'd-none d-sm-flex col-sm-4 col-md-3 ' . $classes));
    }

    protected function createComponentInvoiceForm1_1() : Form
    {
        static $caption = 'Factory';
//------//------
        $form = $this->invoiceFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $design = new Designer($form);
        $design('deposit_due_date_after')
            ->setDescription($this->getResponsiveText('after exposure', 'days after exposure', 'input-group-text rounded-end'));
        $design('payment_due_date_before')
            ->setDescription($this->getResponsiveText('before boarding', 'days before boarding', 'input-group-text rounded-end'));
        $form['deposit_due_date_after']->setCaption($this->getResponsiveText('Deposit', 'Deposit due date'));
        $form['payment_due_date_before']->setCaption($this->getResponsiveText('Payment', 'Payment due date'));
        $design->all('Invoices')->setLabelClasses('col-sm-4 col-md-3');
        $design->all('Invoice items')->setDescription($this->getActionButton());
        $design->all(null, 'button')->setInputGroup(false);
        $form->getGroup("Invoice items")->setOption('floatingLabels', true);
        //------
        return $form;
    }
    protected function createComponentInvoiceForm1_2() : Form
    {
        static $caption = 'Input group single mode';
//------//------
        $form = $this->invoiceFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $design = new Designer($form);
        $design('deposit_due_date_after')
            ->setDescription($this->getResponsiveText('after exposure', 'days after exposure', 'input-group-text rounded-end'));
        $design('payment_due_date_before')
            ->setDescription($this->getResponsiveText('before boarding', 'days before boarding', 'input-group-text rounded-end'));
        $form['deposit_due_date_after']->setCaption($this->getResponsiveText('Deposit', 'Deposit due date'));
        $form['payment_due_date_before']->setCaption($this->getResponsiveText('Payment', 'Payment due date'));
        $design->all('Invoices')->setLabelClasses('col-sm-4 col-md-3');
        $design->all('Invoice items')->setDescription($this->getActionButton());
        $design->all(null, 'button')->setInputGroup(false);
        $form->getGroup("Invoice items")->setOption('floatingLabels', true);
        //------
        return $form;
    }
    protected function createComponentInvoiceForm1_3() : Form
    {
        static $caption = 'Quick goal';
//------//------
        $form = $this->invoiceFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $renderer->wrappers['label']['.inputGroup'] = 'form-label w-100';
        $renderer->wrappers['inputGroup']['container']['standard'] = 'div class="input-group"';
        $renderer->wrappers['inputGroup']['..height'] = null;
        $renderer->wrappers['inputGroup']['.firstItem'] = 'rounded-start-next';
        $design = new Designer($form);
        $design->all('Invoices')->setDescriptionItemClasses('col-auto col-sm-4 col-md-3 col-lg-3');
        $design->all('Invoice items')->setDescription($this->getActionButton());
        $design->all(null, 'button')->setInputGroup(false);
        //------
        return $form;
    }
    protected function createComponentInvoiceForm2_1() : Form
    {
        static $caption = 'Own renderer';
//------//------
        $form = $this->invoiceFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $renderer->wrappers['label']['.inputGroup'] = 'form-label';
        $design = new Designer($form);
        $design->all(null, null, 'button')->setRenderer(new InputGroupSeparateLabel(new HtmlFactory()));
        $design->all('Invoices')->setDescriptionItemClasses('col-auto col-sm-4 col-md-3 col-lg-3');
        $design->all('Invoice items')->setDescription($this->getActionButton());
        $design->all(null, 'button')->setInputGroup(false);
        //------
        return $form;
    }
    protected function createComponentInvoiceForm2_2() : Form
    {
        static $caption = 'Own renderer basics';
//------//------
        $form = $this->invoiceFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $renderer->wrappers['label']['.inputGroup'] = 'form-label';
        $design = new Designer($form);
        $design->all(null, null, 'button')->setRenderer(new InputGroupSeparateLabel());
        $design->all('Invoices')->setDescriptionItemClasses('col-auto col-sm-4 col-md-3 col-lg-3');
        $design->all('Invoice items')->setDescription($this->getActionButton());
        $design->all(null, 'button')->setInputGroup(false);
        //------
        return $form;
    }
    protected function createComponentInvoiceForm2_3() : Form
    {
        static $caption = 'Own htmlFactory for the renderer';
//------//------
        $form = $this->invoiceFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $myWrappers = new Wrappers();
        $myWrappers['label']['.inputGroup'] = 'form-label';
        $design = new Designer($form);
        $design->all(null, null, 'button')
            ->setRenderer(new InputGroupSeparateLabel(new HtmlFactory(null, $myWrappers)));
        $design->all('Invoices')->setDescriptionItemClasses('col-auto col-sm-4 col-md-3 col-lg-3');
        $design->all('Invoice items')->setDescription($this->getActionButton());
        $design->all(null, 'button')->setInputGroup(false);
        //$form->getGroup("Invoice items")->setOption('floatingLabels', true);
        //------
        return $form;
    }
    protected function createComponentInvoiceForm3_1() : Form
    {
        static $caption = 'Complex layout';
//------//------
        $form = $this->invoiceFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $design = new Designer($form);
        $design->all('Invoices')
            ->setDescriptionItemClasses('col-auto col-sm-6 col-md-4')
            ->setLabelClasses('col-sm-4 col-md-3')
            ->setRenderer(new ResponsiveFloating());
        $design->all('Invoice items')
            ->setDescription($this->getActionButton())
            ->setGroupColumnClasses('mb-2')
            ->setFloatingLabel();
        $design->all(null, 'button')
            ->setInputGroup(false);
        //------
        return $form;
    }

    protected function getActionButton(?string $classes = null) : Html
    {
        return Html::el()->addHtml('
                  <button class="btn btn-outline-secondary dropdown-toggle ' . $classes . '" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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