<?php

namespace App\Presenters;

use App\Forms\BookingFormFactory;
use Jdvorak23\Bootstrap5FormRenderer\Bootstrap5FormRenderer;
use Jdvorak23\Bootstrap5FormRenderer\Designers\ControlDesigner;
use Jdvorak23\Bootstrap5FormRenderer\Designers\Designer;
use Jdvorak23\Bootstrap5FormRenderer\HtmlFactory;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\TextArea;
use Nette\Forms\Controls\TextInput;
use Nette\Utils\Html;

class BookingPresenter extends BaseFormPresenter
{
    public function __construct(private BookingFormFactory $bookingFormFactory)
    {
        parent::__construct();

    }
    protected function createComponentBookingForm1_1() : Form
    {
        static $caption = "Booking Form";
//------//------
        $form = $this->bookingFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['label']['requiredsuffix'] = '(<span class="text-danger">*</span>)';
        $design = new Designer($form);
        $descriptionClearButton = Html::el('div class="text-danger input-group-text" style="cursor: pointer;"')
            ->addHtml('<i class="fas fa-times-circle"></i>');
        $design('booking-price booking-deposit')->setOption('description', $descriptionClearButton)
            ->setOption('inputGroup', true);
        $design('booking-price')->setOption('row', true);
        $design('personSettings')->setGroupColumn('div class="col-12"')
            ->setElement('div class="pt-md-2"')
            ->setItemClasses('form-check-inline');
        $design('person-company_name')->setGrid();
        $design('save')->setGroupColumn('div class="col-12"');
        $design->all(null, TextArea::class)
            ->setHtmlFactory($this->getTextAreaFactory());
        //------
        return $form;
    }

    protected function zcreateComponentBookingForm1_2() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption("Booking Form");
//------//------
        $form = new Form();
        //------Renderer Setup
        $form->addEmail('email', 'Your email');
        $form->addCheckbox('send_me')
            ->addCondition($form::Equal, true)
            ->toggle('#frm-testForm-address');
        $form->addTextArea('address');
        $form->addSubmit("save", "Save");
        $form->addButton('cancel', 'Cancel')
            ->setHtmlAttribute("type", "reset");
        $form->onValidate[] = function(Form $form)
        {
            $form->addError("Some error in whole form");
        };
        $form->onSuccess[] = function (Form $form, ArrayHash $values)
        {

        };
        //------
        return $form;
    }
    protected function createComponentBookingForm1_2() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption("Booking Form");
//------//------
        $form = $this->bookingFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['label']['requiredsuffix'] = '(<span class="text-danger">*</span>)';
        $descriptionClearButton = Html::el('div class="text-danger input-group-text" style="cursor: pointer;"')
            ->addHtml('<i class="fas fa-times-circle"></i>');
        $booking = $form->getComponent('booking');
        $booking['price']->setOption('description', $descriptionClearButton)
            ->setOption('inputGroup', true)
            ->setOption('row', true);
        $booking['deposit']->setOption('description', $descriptionClearButton)
            ->setOption('inputGroup', true);
        $form['personSettings']->setOption('groupCol', 'col-12')
            ->setOption('element', 'div class="pt-md-2"')
            ->setOption('.item', 'form-check-inline');
        $person = $form->getComponent('person');
        $person['company_name']->setOption('row', true);
        $form['save']->setOption('groupCol', 'div class="col-12"');
        $this->setTextareas($form);
        //------
        return $form;
    }
    protected function createComponentBookingForm1_3() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption("Booking Form");
//------//------
        $form = $this->bookingFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $renderer->wrappers['label']['.inputGroup'] = 'form-label w-100';
        $renderer->wrappers['inputGroup']['container']['standard'] = 'div class="input-group"';
        $renderer->wrappers['inputGroup']['..height'] = null;
        $renderer->wrappers['inputGroup']['.firstItem'] = 'rounded-start-next';
        //$renderer->wrappers['inputGroup']['.item'] = 'rounded-start';
        $renderer->wrappers['label']['requiredsuffix'] = '(<span class="text-danger">*</span>)';
        $descriptionClearButton = Html::el('div class="text-danger input-group-text" style="cursor: pointer;"')
            ->addHtml('<i class="fas fa-times-circle"></i>');
        $booking = $form->getComponent('booking');
        $booking['price']->setOption('description', $descriptionClearButton)
            ->setOption('inputGroup', true)
            ->setOption('row', true);
        $booking['deposit']->setOption('description', $descriptionClearButton);
            //->setOption('inputGroup', true);
        $form['personSettings']->setOption('groupCol', 'col-12')
            ->setOption('element', 'div class="pt-md-2"')
            ->setOption('.item', 'form-check-inline');
        $person = $form->getComponent('person');
        $person['company_name']->setOption('row', true);
        $form['save']->setOption('groupCol', 'div class="col-12"');
        $this->setTextareas($form);
        //------
        return $form;
    }
    protected function setTextareas(Form $form)
    {
        foreach($form->getControls() as $control)
        {
            if($control instanceof TextArea)
                $control->setOption('inputGroup', false)
                    ->setOption('.parent', 'd-flex flex-column h-100')
                    ->setOption('.control', 'flex-grow-1')
                    ->setOption('row', false);
        }
    }
    protected function getTextAreaFactory(): HtmlFactory
    {
        return new HtmlFactory(
            Designer::control()->setGrid(false)
                ->setParentClasses('d-flex flex-column h-100')
                ->setControlClasses('flex-grow-1 textarea-default-height')
                ->setInputGroup(false)
        );
        return new HtmlFactory(
            (new ControlDesigner())->setGrid(false)
                ->setParentClasses('d-flex flex-column h-100')
                ->setControlClasses('flex-grow-1 textarea-default-height')
                ->setInputGroup(false)
        );
    }
}