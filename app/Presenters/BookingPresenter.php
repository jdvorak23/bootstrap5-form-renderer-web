<?php

namespace App\Presenters;

use App\Forms\BookingFormFactory;
use Jdvorak23\Bootstrap5FormRenderer\Bootstrap5FormRenderer;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\TextArea;
use Nette\Utils\Html;

class BookingPresenter extends BaseFormPresenter
{
    public function __construct(private BookingFormFactory $bookingFormFactory)
    {
        parent::__construct();

    }
    protected function createComponentBookingForm1_1() : Form
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
}