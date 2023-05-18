<?php

namespace App\Presenters;

use App\Forms\BookingFormFactory;
use Jdvorak23\Bootstrap5FormRenderer\Bootstrap5FormRenderer;
use Jdvorak23\Bootstrap5FormRenderer\Designers\Designer;
use Jdvorak23\Bootstrap5FormRenderer\HtmlFactory;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\TextArea;
use Nette\Utils\Html;

class BookingPresenter extends BaseFormPresenter
{
    public function __construct(private BookingFormFactory $bookingFormFactory)
    {
        parent::__construct();
    }
    protected function createComponentBookingForm1() : Form
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
        $design('booking-price booking-deposit')->setDescription($descriptionClearButton)
            ->setInputGroup();
        $design('booking-price')->setGrid();
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

    protected function getTextAreaFactory(): HtmlFactory
    {
        return new HtmlFactory(
            Designer::control()->setGrid(false)
                ->setParentClasses('d-flex flex-column h-100')
                ->setControlClasses('flex-grow-1 textarea-default-height')
                ->setInputGroup(false)
        );
    }
}