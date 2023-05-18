<?php

namespace App\Presenters;

use App\Forms\PersonFormFactory;
use App\Model\InputGroupWrappers;
use App\Model\MyTranslator;
use Jdvorak23\Bootstrap5FormRenderer\Bootstrap5FormRenderer;
use Jdvorak23\Bootstrap5FormRenderer\Designers\ControlDesigner;
use Jdvorak23\Bootstrap5FormRenderer\Designers\Designer;
use Jdvorak23\Bootstrap5FormRenderer\Designers\GroupDesigner;
use Jdvorak23\Bootstrap5FormRenderer\Designers\Multi\MultiControlDesigner;
use Jdvorak23\Bootstrap5FormRenderer\Designers\PseudoDesigner;
use Jdvorak23\Bootstrap5FormRenderer\Options;
use Jdvorak23\Bootstrap5FormRenderer\HtmlFactory;
use Nette\Application\UI\Form;
use Nette\Utils\Html;

class PersonPresenter extends BaseFormPresenter
{
    public function __construct(private PersonFormFactory $personFormFactory)
    {
        parent::__construct();

    }
    protected function createComponentPersonForm1() : Form
    {
        static $caption = "Factory";
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer();
        $form->setRenderer($renderer);
        //------
        return $form;
    }
    protected function createComponentPersonForm2_1() : Form
    {
        static $caption = 'Grids and options';
//------//------
        $form = $this->personFormFactory->create();
        $form['gender']->setCaption('Gender');
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('save')->setGroupColumn('div class="col-12"');
        $design('account')->setGrid(true);
        $design('note')->setGrid(false)
            ->setControlClasses('flex-grow-1')
            ->setParentClasses('d-flex flex-column h-100');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('gender')->setParent(false)
            ->setElement('div class="pt-md-2"')
            ->setItemClasses('form-check-inline');
        //------
        return $form;
    }
    protected function createComponentPersonForm2_2() : Form
    {
        static $caption = 'Grids and wrappers';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        //------
        return $form;
    }
    protected function createComponentPersonForm2_3() : Form
    {
        static $caption = 'Grids, wrappers and options';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $form->getGroup('Person')
            ->setOption('row', false);
        $form->getGroup('Address')
            ->setOption('col', 'div class="col-md-4"');
        //------
        return $form;
    }
    protected function createComponentPersonForm2_4() : Form
    {
        static $caption = 'Designer';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('save')->setGroupColumn('div class="col-12"');
        // Similar effect we could reach by just omitting column:
        //$design('save')->setGroupColumn(false);
        //------
        return $form;
    }
    protected function createComponentPersonForm2_5() : Form
    {
        static $caption = 'Grids';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('save')->setGroupColumn('div class="col-12"');
        $design('account')->setGrid(true);
        $design('note')->setGrid(false);
        //------
        return $form;
    }
    protected function createComponentPersonForm2_6() : Form
    {
        static $caption = 'More options';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('save')->setGroupColumn('div class="col-12"');
        $design('account')->setGrid(true);
        $design('note')->setGrid(false)
            ->setControlClasses('flex-grow-1')
            ->setParentClasses('d-flex flex-column h-100');
        //------
        return $form;
    }
    protected function createComponentPersonForm2_7() : Form
    {
        static $caption = 'Label';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('save')->setGroupColumn('div class="col-12"');
        $design('account')->setGrid(true);
        $design('note')->setGrid(false)
            ->setControlClasses('flex-grow-1')
            ->setParentClasses('d-flex flex-column h-100');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $form['gender']->setCaption('Gender');
        // Or for own label:
        //$design('gender')->setLabel(Html::el('div class="text-primary"')->setText('Gender'));
        //------
        return $form;
    }
    protected function createComponentPersonForm2_8() : Form
    {
        static $caption = 'Checkboxes and radios';
//------//------
        $form = $this->personFormFactory->create();
        $form['gender']->setCaption('Gender');
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('save')->setGroupColumn('div class="col-12"');
        $design('account')->setGrid(true);
        $design('note')->setGrid(false)
            ->setControlClasses('flex-grow-1')
            ->setParentClasses('d-flex flex-column h-100');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('gender')->setParent(false)
            ->setElement('div class="pt-md-2"')
            ->setItemClasses('form-check-inline');
        //------
        return $form;
    }
    protected function createComponentPersonForm3_1() : Form
    {
        static $caption = 'Floating labels';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true); 
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control" style="height: calc(3.5rem + 2px);"');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('account')->setGrid();
        $design('note')->setGrid(false)
            ->setParentClasses('d-flex flex-column h-100')
            ->setControlClasses('flex-grow-1 textarea-default-height');
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        //------
        return $form;
    }
    protected function createComponentPersonForm3_2() : Form
    {
        static $caption = 'Setup floating labels';
//------//------
        $form = $this->personFormFactory->create();
        $form['gender']->setCaption('Gender');
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('save')->setGroupColumn('div class="col-12"');
        $design('account')->setGrid(true);
        $design('note')->setGrid(false)
            ->setControlClasses('flex-grow-1')
            ->setParentClasses('d-flex flex-column h-100');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('gender')->setParent(false)
            ->setElement('div class="pt-md-2"')
            ->setItemClasses('form-check-inline');
        //------
        return $form;
    }
    protected function createComponentPersonForm3_3() : Form
    {
        static $caption = 'Floating labels basics';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control" style="height: calc(3.5rem + 2px);"');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('account')->setGrid();
        $design('note')->setGrid(false)
            ->setParentClasses('d-flex flex-column h-100')
            ->setControlClasses('flex-grow-1');
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        //------
        return $form;
    }
    protected function createComponentPersonForm3_4() : Form
    {
        static $caption = 'Floating labels and height';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control" style="height: calc(3.5rem + 2px);"');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('account')->setGrid();
        $design('note')->setGrid(false)
            ->setParentClasses('d-flex flex-column h-100')
            ->setControlClasses('flex-grow-1 textarea-default-height');
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        //------
        return $form;
    }
    protected function createComponentPersonForm4_1() : Form
    {
        static $caption = 'Input group basics';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $design('first_name email phone street city account')->setInputGroup(true);
        $design('note')->setInputGroup(false);
        $design('street_number house_number zip bank')->setInputGroupWrapper('xshort');
        //------
        return $form;
    }
    protected function createComponentPersonForm4_2() : Form
    {
        static $caption = 'Input group validation problem';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        // Every control we need start input group on:
        $design('first_name email phone street city account')->setInputGroup(true);
        // Textarea we won't add, we end input group:
        $design('note')->setInputGroup(false);
        //------
        return $form;
    }
    protected function createComponentPersonForm4_3() : Form
    {
        static $caption = 'Input group and option wrapper';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $design('first_name email phone street city account')->setInputGroup(true);
        $design('note')->setInputGroup(false);
        $design('street_number house_number zip bank')->setInputGroupWrapper('xshort');
        //------
        return $form;
    }
    protected function createComponentPersonForm5_1() : Form
    {
        static $caption = 'Responsive input group';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer();
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['label'] = 'legend';
        $renderer->wrappers['inputGroup']['.wrapper'] = 'mb-4';
        $renderer->wrappers['inputGroup']['wrapper']['.own'] = 'mb-4 flex-fill';
        $renderer->wrappers['inputGroup']['wrapper']['grow'] = 'div class="flex-fill col-12 col-sm-6 col-md-6 col-lg-4"';
        $renderer->wrappers['group']['container'] = 'fieldset';
        $renderer->wrappers['controls']['inputGroup'] ='div class="input-group responsive-input-group"';
        $renderer->wrappers['inputGroup']['.firstItem'] = $renderer->wrappers['inputGroup']['.lastItem'] = '';
        $design = new Designer($form);
        $design('first_name street account')->setInputGroup();
        $design('note')->setInputGroup(false);
        $design('nick')->setInputGroupWrapper('short');
        $design('street_number house_number zip')->setInputGroupWrapper('xxshort');
        $design('bank')->setInputGroupWrapper('xshort');
        $design('gender')->setInputGroupWrapper( 'div class="flex-grow-1 flex-sm-grow-0 mb-4"')
            ->setOption('.element', 'flex-fill justify-content-center');
        $desc = Html::el()->addHtml(Html::el('div class="input-group-text rounded-0 d-none d-sm-flex"')->addText('number, or + and number'))
            ->addHtml(Html::el('div class="input-group-text rounded-0 d-sm-none"')->addText('(+) and number'));
        $design('phone')->setInputGroupWrapper('long')
            ->setDescription($desc);
        $design('agree')->setParentClasses('mt-3');
        //------
        return $form;
    }
    protected function createComponentPersonForm5_2() : Form
    {
        static $caption = 'Javascript to round corners';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer();
        $form->setRenderer($renderer);
        // Normally there are classes to void spaces around legend because of grid gutters.
        // We do not use grid, so let it its space around:
        $renderer->wrappers['group']['label'] = 'legend';
        // This class is automatically added to default 'shrink' and 'grow' wrapper
        // We will adjust spacing this way, although Bootstrap v 5.3 have better solution:
        $renderer->wrappers['inputGroup']['.wrapper'] = 'mb-4';
        // '.own' class is automatically added to every OWN wrapper in wrappers['inputGroup']['wrapper']
        // we use it to add classes needed in all cases:
        $renderer->wrappers['inputGroup']['wrapper']['.own'] = 'mb-4 flex-fill';
        // Default 'grow' set to same width as own 'medium'
        $renderer->wrappers['inputGroup']['wrapper']['grow'] = 'div class="flex-fill col-12 col-sm-6 col-md-6 col-lg-4"';
        // Fieldset by default have 'mb-3' class, we have margins already on bottom of columns, so we need remove it:
        $renderer->wrappers['group']['container'] = 'fieldset';
        // We add class 'responsive-input-group' as a SELECTOR for further javascript
        // also remove 'flex-nowrap' class, because, well, we need wrap to allow responsiveness:
        $renderer->wrappers['controls']['inputGroup'] ='div class="input-group responsive-input-group"';
        // As mentioned, cancel auto-rounding, javascript will do:
        $renderer->wrappers['inputGroup']['.firstItem'] = $renderer->wrappers['inputGroup']['.lastItem'] = '';
        $design = new Designer($form);
        $design('first_name street account')->setInputGroup();
        $design('note')->setInputGroup(false);
        //------
        return $form;
    }
    protected function createComponentPersonForm5_3() : Form
    {
        static $caption = 'Adjustment of input group controls';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer();
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['label'] = 'legend';
        $renderer->wrappers['inputGroup']['.wrapper'] = 'mb-4';
        $renderer->wrappers['inputGroup']['wrapper']['.own'] = 'mb-4 flex-fill';
        $renderer->wrappers['inputGroup']['wrapper']['grow'] = 'div class="flex-fill col-12 col-sm-6 col-md-6 col-lg-4"';
        $renderer->wrappers['group']['container'] = 'fieldset';
        $renderer->wrappers['controls']['inputGroup'] ='div class="input-group responsive-input-group"';
        $renderer->wrappers['inputGroup']['.firstItem'] = $renderer->wrappers['inputGroup']['.lastItem'] = '';
        $design = new Designer($form);
        $design('first_name street account')->setInputGroup();
        $design('note')->setInputGroup(false)
            ->setParentClasses('mb-3');
        $design('street_number house_number zip')->setInputGroupWrapper('xxshort');
        $design('bank')->setInputGroupWrapper('xshort');
        $design('nick')->setInputGroupWrapper('short');
        $design('gender')->setInputGroupWrapper( 'div class="flex-grow-1 flex-sm-grow-0 mb-4"')
            ->setElementClasses('flex-fill justify-content-center');

        $desc = Html::el()
            ->addHtml(Html::el('div class="input-group-text rounded-0 d-none d-sm-flex"')->addText('number, or + and number'))
            ->addHtml(Html::el('div class="input-group-text rounded-0 d-sm-none"')->addText('(+) and number'));
        $design('phone')->setInputGroupWrapper('long')
            ->setDescription($desc);
        //------
        return $form;
    }
    protected function createComponentPersonForm6_1() : Form
    {
        static $caption = 'Own wrappers';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers = new InputGroupWrappers();
        $renderer->wrappers['form']['container'] = 'div class="m-auto p-sm-3" style="max-width:625px;"';
        $design = new Designer($form);
        $design('first_name street account')->setInputGroup();
        $design('note')->setInputGroup(false)
            ->setControlClasses('textarea-default-height');
        $design('nick')->setInputGroupWrapper('short');
        $design('street_number house_number zip')->setInputGroupWrapper('xxshort');
        $design('bank')->setInputGroupWrapper('xshort');
        $design('gender')->setInputGroupWrapper( 'div class="flex-grow-1 flex-sm-grow-0 mb-4"')
            ->setOption('.element', 'flex-fill justify-content-center bg-white');
        $design('phone')->setInputGroupWrapper('long')
            ->setDescription(Html::el()->addHtml(Html::el('div class="input-group-text rounded-0 d-none d-sm-flex d-md-none d-lg-flex"')->addText('number, or + and number'))
                ->addHtml(Html::el('div class="input-group-text rounded-0 d-sm-none d-md-flex d-lg-none"')->addText('(+) and number')));
        $design('agree save')->setParentClasses('mt-3');
        //------
        return $form;
    }
    protected function createComponentPersonForm6_2() : Form
    {
        static $caption = 'Responsive input group Wrappers';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers = new InputGroupWrappers();
        $renderer->wrappers['form']['container'] = 'div class="m-auto p-sm-3" style="max-width:625px;"';
        $design = new Designer($form);
        $design('first_name street account')->setInputGroup();
        $design('note')->setInputGroup(false)
            ->setControlClasses('textarea-default-height');
        $design('nick')->setInputGroupWrapper('short');
        $design('street_number house_number zip')->setInputGroupWrapper('xxshort');
        $design('bank')->setInputGroupWrapper('xshort');
        $design('gender')->setInputGroupWrapper( 'div class="flex-grow-1 flex-sm-grow-0 mb-4"')
            ->setOption('.element', 'flex-fill justify-content-center bg-white');
        $design('phone')->setInputGroupWrapper('long')
            ->setDescription(Html::el()->addHtml(Html::el('div class="input-group-text rounded-0 d-none d-sm-flex d-md-none d-lg-flex"')->addText('number, or + and number'))
                ->addHtml(Html::el('div class="input-group-text rounded-0 d-none d-md-flex d-lg-none"')->addText('(+) and number')));
        $design('agree save')->setParentClasses('mt-3');
        //------
        return $form;
    }

    protected function createComponentPersonForm7_1() : Form
    {
        static $caption = "Validation";
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $renderer->wrappers['valid']['message'] = '';
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control input-group-floating-height"');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('account')->setGrid();
        $design('note')->setGrid(false)
            ->setParentClasses('d-flex flex-column h-100')
            ->setControlClasses('flex-grow-1 textarea-default-height')
            ->setFeedbackMessage("It's OK, it's optional.");
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        //------
        return $form;
    }
    protected function createComponentPersonForm7_2() : Form
    {
        static $caption = "Minor validation settings";
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $renderer->wrappers['valid']['message'] = '';
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control input-group-floating-height"');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('account')->setGrid();
        $design('note')->setGrid(false)
            ->setParentClasses('d-flex flex-column h-100')
            ->setControlClasses('flex-grow-1 textarea-default-height')
            ->setFeedbackMessage("It's OK, it's optional.");
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        $design('phone')->setValidContainerClasses('d-inline')
            ->setErrorContainerClasses('d-inline');
        //------
        return $form;
    }
    protected function createComponentPersonForm7_3() : Form
    {
        static $caption = 'List selector';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $renderer->wrappers['valid']['message'] = '';
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('account')->setGrid();
        $design('note')->setGrid(false)
            ->setParentClasses('d-flex flex-column h-100')
            ->setControlClasses('flex-grow-1 textarea-default-height')
            ->setFeedbackMessage("It's OK, it's optional.");
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        $design('phone')->setValidContainerClasses('d-inline')
            ->setErrorContainerClasses('d-inline');
        $design('gender')->setInputGroup(true)
            ->setInputGroupWrapperClasses( 'flex-grow-1')
            ->setElement('div class="input-group-text gap-2 form-control flex-fill justify-content-center bg-white input-group-floating-height"');
        $design('email')->setInputGroup(false);
        //------
        return $form;
    }

    protected function createComponentPersonForm8_1() : Form
    {
        static $caption = 'Predefined Options';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control input-group-floating-height"');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('account')->setGrid();
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');

        $myTextareaSetup = new HtmlFactory(
             $design()->setGrid(false)
                 ->setParentClasses('d-flex flex-column h-100')
                 ->setControlClasses('flex-grow-1 textarea-default-height')
                 ->setInputGroup(false)
         );
         $design('note')->setHtmlFactory($myTextareaSetup);

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
    protected function createComponentPersonForm8_2() : Form
    {
        static $caption = 'Predefined Wrappers';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control input-group-floating-height"');
        $design('account')->setGrid();
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        $design('note')->setHtmlFactory($this->getTextAreaFactory());
        $inputGroupSetup = new HtmlFactory(null, new InputGroupWrappers());
        $design->group('Address')->setHtmlFactory($inputGroupSetup)
            ->setGrid(false);
        $design->all('Address')->setHtmlFactory($inputGroupSetup);
        $design('street')->setInputGroup();
        $design('street_number house_number zip')->setInputGroupWrapper('xxshort');
        //------
        return $form;
    }
    protected function createComponentPersonForm9_1() : Form
    {
        static $caption = 'Inserting HTML';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control input-group-floating-height"');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('account')->setGrid();
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        $design('note')->setHtmlFactory($this->getTextAreaFactory());

        $banner = Html::el('div class="alert alert-warning mb-0 text-center"')
            ->setText("Some very important information for the client");
        $bannerFactory = new HtmlFactory(
            Designer::pseudo()->setGroupColumn('div class="col-12"')
                ->setContent($banner)
        );
        $design('gender')->insertHtmlBefore($bannerFactory);
        //------
        return $form;
    }
    protected function createComponentPersonForm9_2() : Form
    {
        static $caption = 'Pseudo-elements';
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control input-group-floating-height"');
        $design('account')->setGrid();
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        $design('note')->setHtmlFactory($this->getTextAreaFactory());
        // Banner
        $banner = Html::el('div class="alert alert-warning mb-0 text-center"')
            ->setText("Some very important information for the client");
        $bannerFactory = new HtmlFactory(
            Designer::pseudo()->setGroupColumn('div class="col-12"')
                ->setContent($banner)
        );
        $design('gender')->insertHtmlBefore($bannerFactory);
        // Group pseudo-element with other banner
        $groupBanner = Html::el('div class="alert alert-info text-center"')
            ->setText("Your address will be used for delivery.");
        $groupBannerFactory = new HtmlFactory(
            Designer::pseudo()->setContent($groupBanner)
        );
        $design->group('Address')->insertHtmlBefore($groupBannerFactory);
        // Responsive input group settings for 'Address' ControlGroup
        $inputGroupSetup = new HtmlFactory(null, new InputGroupWrappers());
        $design->group('Address')->setHtmlFactory($inputGroupSetup)
            ->setGrid(false);
        $design->all('Address')->setHtmlFactory($inputGroupSetup);
        $design('street')->setInputGroup();
        $design('street_number house_number zip')->setInputGroupWrapper('xxshort');
        // Banner inserted to the input group
        $inputGroupContent = Html::el('div class="mb-4 flex-grow-1 flex-sm-grow-0 flex-nowrap"')
            ->addHtml(Html::el('div class="alert alert-danger mb-0 text-center text-nowrap rounded-0"')
            ->setText("Something"));
        $design('city')->insertHtmlBefore(new HtmlFactory(
            Designer::pseudo()->setContent($inputGroupContent)
        ));
        //------
        return $form;
    }
    protected function createComponentPersonForm10_1() : Form
    {
        static $caption = 'Translations';
//------//------
        $form = $this->personFormFactory->create();
        $translator = new MyTranslator();
        $form->setTranslator($translator);
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $design = new Designer($form);
        $design('gender')->setParent('div')
            ->setElement('div class="d-flex gap-2 align-items-center justify-content-center form-control" style="height: calc(3.5rem + 2px);"');
        $design('phone')->setErrorContainerClasses('d-inline');
        $design('street_number house_number')->setGroupColumn('div class="col-6 col-md-3"');
        $design('zip state')->setGroupColumn('div class="col-12 col-md-6 col-lg-3"');
        $design('account')->setGrid();
        $design('note')->setGrid(false)
            ->setParentClasses('d-flex flex-column h-100')
            ->setControlClasses('flex-grow-1 textarea-default-height');
        $design('save')->setGroupColumnClasses('col-12 !col-md-6');
        //------
        return $form;
    }
    protected function createComponentPersonForm10_2() : Form
    {
        static $caption = 'Own elements';
//------//------
        $form = $this->personFormFactory->create();
        $translator = new MyTranslator();
        $form->setTranslator($translator);
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers = new InputGroupWrappers();
        $renderer->wrappers['form']['container'] = 'div class="m-auto p-sm-3" style="max-width:625px;"';
        $design = new Designer($form);
        $design('first_name street account')->setInputGroup();
        $design('note')->setInputGroup(false)
            ->setControlClasses('textarea-default-height');
        $design('nick')->setInputGroupWrapper('short');
        $design('street_number house_number zip')->setInputGroupWrapper('xxshort');
        $design('bank')->setInputGroupWrapper('xshort');
        $design('gender')->setInputGroupWrapper( 'div class="flex-grow-1 flex-sm-grow-0 mb-4"')
            ->setOption('.element', 'flex-fill justify-content-center bg-white');

        $descLarge = Html::el('div class="input-group-text rounded-0 d-none d-sm-flex"')
            ->addText($translator->translate('number, or + and number'));
        $descSmall = Html::el('div class="input-group-text rounded-0 d-sm-none"')
            ->addText('(+) ' . $translator->translate('and number'));
        $design('phone')->setInputGroupWrapper('long')
            ->setDescription(Html::el()->addHtml($descLarge)
                                       ->addHtml($descSmall));

        $design('agree save')->setParentClasses('mt-3');
        //------
        return $form;
    }
}