<?php

namespace App\Presenters;

use App\Forms\PersonFormFactory;
use Jdvorak23\Bootstrap5FormRenderer\Bootstrap5FormRenderer;
use Nette\Application\UI\Form;
use Nette\Utils\Html;

class PersonPresenter extends BaseFormPresenter
{
    public function __construct(private PersonFormFactory $personFormFactory)
    {
        parent::__construct();

    }

    /* protected function createComponentPersonForm0() : Form
       {
           $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
           $formWrapper->setCaption("Můj název");
   //------//------
           $form = $this->personFormFactory->create();
           //------Renderer Setup
           $renderer = new Renderer(false, false, false, false, true);
           $form->setRenderer($renderer);
           //------
           return $form;
       }*/

    protected function createComponentPersonForm1() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Test form - PersonForm');
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
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Grids and options');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $form['save']->setOption('groupCol', 'div class="col-12"');
        $form['account']->setOption('row', true);
        $form['note']->setOption('row', false)
            ->setOption('.parent', 'd-flex flex-column h-100')
            ->setOption('.control', 'flex-grow-1');
        $form['street_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['house_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['zip']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['state']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['gender']->setCaption('Pohlaví')
            ->setOption('parent', false)
            ->setOption('element', 'div class="pt-md-2"')
            ->setOption('.item', 'form-check-inline');
        //------
        return $form;
    }
    protected function createComponentPersonForm2_2() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Grids, wrappers and options');
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
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Grids, wrappers and options');
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
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Grids, wrappers and options');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $form['save']->setOption('groupCol', false);
        $form['account']->setOption('row', true);
        $form['note']->setOption('row', false);
        //------
        return $form;
    }
    protected function createComponentPersonForm2_5() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Some more options');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $form['save']->setOption('groupCol', 'div class="col-12"');
        $form['account']->setOption('row', true);
        $form['note']->setOption('row', false)
            ->setOption('.parent', 'd-flex flex-column h-100')
            ->setOption('.control', 'flex-grow-1');
        //------
        return $form;
    }
    protected function createComponentPersonForm2_6() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Grids, options and label');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $form['save']->setOption('groupCol', 'div class="col-12"');
        $form['account']->setOption('row', true);
        $form['note']->setOption('row', false)
            ->setOption('.parent', 'd-flex flex-column h-100')
            ->setOption('.control', 'flex-grow-1');
        $form['street_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['house_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['zip']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['state']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['gender']->setCaption('Pohlaví');
        //------
        return $form;
    }
    protected function createComponentPersonForm2_7() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('More useful options');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, novalidate: true);
        $form->setRenderer($renderer);
        $form['save']->setOption('groupCol', 'div class="col-12"');
        $form['account']->setOption('row', true);
        $form['note']->setOption('row', false)
            ->setOption('.parent', 'd-flex flex-column h-100')
            ->setOption('.control', 'flex-grow-1');
        $form['street_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['house_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['zip']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['state']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['gender']->setCaption('Pohlaví')
            ->setOption('parent', false)
            ->setOption('element', 'div class="pt-md-2"')
            ->setOption('.item', 'form-check-inline');

        //------
        return $form;
    }
    protected function createComponentPersonForm3_1() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Floating labels');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $form['save']->setOption('groupCol', 'div class="col-12"');
        $form['account']->setOption('row', true);
        $form['note']->setOption('row', false)
            ->setOption('.parent', 'd-flex flex-column h-100')
            ->setOption('.control', 'flex-grow-1');
        $form['street_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['house_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['zip']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['state']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['gender']->setOption("parent", 'div')
            ->setOption('element', 'div class="d-flex gap-2 align-items-center justify-content-center form-control list-element" style="height: calc(3.5rem + 2px);"');
        //------
        return $form;
    }
    protected function createComponentPersonForm3_2() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Floating labels');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $form['save']->setOption('groupCol', 'div class="col-12"');
        $form['account']->setOption('row', true);
        $form['note']->setOption('row', false)
            ->setOption('.parent', 'd-flex flex-column h-100')
            ->setOption('.control', 'flex-grow-1');
        $form['street_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['house_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['zip']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['state']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['gender']->setCaption('Pohlaví')
            ->setOption('parent', false)
            ->setOption('element', 'div class="pt-md-2"')
            ->setOption('.item', 'form-check-inline');
        //------
        return $form;
    }
    protected function createComponentPersonForm3_3() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Floating labels');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $form['save']->setOption('groupCol', 'div class="col-12"');
        $form['account']->setOption('row', true);
        $form['note']->setOption('row', false)
            ->setOption('.parent', 'd-flex flex-column h-100')
            ->setOption('.control', 'flex-grow-1');
        $form['street_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['house_number']->setOption('groupCol', 'div class="col-6 col-md-3"');
        $form['zip']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['state']->setOption('groupCol', 'div class="col-12 col-md-6 col-lg-3"');
        $form['gender']->setOption("parent", false)
            ->setOption('element', 'div class="d-flex gap-2 align-items-center justify-content-center form-control list-element" style="height: calc(3.5rem + 2px);"');
        //------
        return $form;
    }
    protected function createComponentPersonForm4_1() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Input groups');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12 mb-2"';
        $form['first_name']->setOption("inputGroup", true);
        $form['email']->setOption("inputGroup", true);
        $form['phone']->setOption("inputGroup", true);
        $form['street']->setOption("inputGroup", true);
        $form['street_number']->setOption("wrapper", 'div')
            ->setHtmlAttribute("style", "max-width:6em;");
        $form['house_number']->setOption("wrapper", 'div')
            ->setHtmlAttribute("style", "max-width:6em;");
        $form['city']->setOption("inputGroup", true);
        $form['zip']->setHtmlAttribute("style", "max-width:8em;")
            ->setOption("wrapper", 'div');
        $form['account']->setOption("inputGroup", true);
        $form['bank']->setHtmlAttribute("style", "max-width:15em;")
            ->setOption("wrapper", 'div');
        $form['note']->setOption("inputGroup", false)
            ->setHtmlAttribute("style", "height:8em;");
        $form['save']->setOption('groupCol', false);
        //------
        return $form;
    }
    protected function zcreateComponentPersonForm4_2() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Input groups');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"'; //'div class="col-6 p-0" style="margin-left: -1px;"';
        $form['first_name']->setOption("inputGroup", true);
        // ->setOption("wrapper", 'div class="flex-shrink col-6"');;
        $form['email']->setOption("inputGroup", true);
        $form['phone']->setOption("inputGroup", true)
            ->setOption(".parent", "manas-class") ;
        $form['street']->setOption("inputGroup", true);
        $form['street_number']->setOption("wrapper", 'div class=""')
            ->setHtmlAttribute("style", "max-width:100px;");
        $form['city']->setOption("inputGroup", true);
        $form['zip']->setHtmlAttribute("style", "max-width:125px;")
            ->setOption("wrapper", 'div class="w-auto"');//->setOption("inputGroup", true);
        $form['account']->setOption("inputGroup", true);
        $form['note']->setOption("inputGroup", false);
        $form['save']->setOption('groupCol', false);
        //------
        return $form;
    }
    protected function createComponentPersonForm4_2() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Input groups');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12 mb-2"';
        $form['first_name']->setOption("inputGroup", true);
        $form['email']->setOption("inputGroup", true);
        $form['phone']->setOption("inputGroup", true);
        $form['street']->setOption("inputGroup", true);
        $form['city']->setOption("inputGroup", true);
        $form['account']->setOption("inputGroup", true);
        $form['note']->setOption("inputGroup", false);
        $form['save']->setOption('groupCol', false);
        //------
        return $form;
    }
    protected function createComponentPersonForm4_3() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Input groups');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, false);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12 mb-2"';
        $form['first_name']->setOption("inputGroup", true);
        $form['email']->setOption("inputGroup", true);
        $form['phone']->setOption("inputGroup", true);
        $form['street']->setOption("inputGroup", true);
        $form['street_number']->setOption("wrapper", 'div')
            ->setHtmlAttribute("style", "max-width:6em;");
        $form['house_number']->setOption("wrapper", 'div')
            ->setHtmlAttribute("style", "max-width:6em;");
        $form['city']->setOption("inputGroup", true);
        $form['zip']->setHtmlAttribute("style", "max-width:8em;")
            ->setOption("wrapper", 'div');
        $form['account']->setOption("inputGroup", true);
        $form['bank']->setHtmlAttribute("style", "max-width:15em;")
            ->setOption("wrapper", 'div');
        $form['note']->setOption("inputGroup", false)
            ->setHtmlAttribute("style", "height:8em;");
        $form['save']->setOption('groupCol', false);
        //------
        return $form;
    }
    protected function createComponentPersonForm5_1() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Input groups and floating labels.');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $renderer->wrappers['form']['container'] = 'div class="m-auto border border-1 p-3 rounded" style="max-width:575px;"';
        $form['first_name']->setOption("inputGroup", true);
        $form['gender']->setOption("element", 'div class="flex-column flex-sm-row align-items-start align-items-sm-center gap-0 gap-sm-2 input-group-text list-element rounded-0 rounded-end" style="height: calc(3.5rem + 2px);"');
        $descLarge = Html::el('div class="input-group-text rounded-end d-none d-sm-flex"')
            ->addText('jen číslo, nebo + a číslo');
        $descSmall = Html::el('div class="input-group-text rounded-end d-sm-none"')
            ->addText('(+) a číslo');
        $form['phone']->setOption('description', Html::el()->addHtml($descLarge)->addHtml($descSmall));
        $form['email']->setOption("inputGroup", true);
        $form['nick']->setOption('wrapper', 'div style="width:40%"');
        $form['phone']->setOption("inputGroup", true);
        $form['street']->setOption("inputGroup", true);
        $form['street_number']->setOption("wrapper", 'div')
            ->setHtmlAttribute("style", "max-width:7em;");
        $form['house_number']->setOption("wrapper", 'div')
            ->setHtmlAttribute("style", "max-width:7em;");
        $form['city']->setOption("inputGroup", true);
        $form['zip']->setHtmlAttribute("style", "max-width:9em;")
            ->setOption("wrapper", 'div');
        $form['account']->setOption("inputGroup", true);
        $form['bank']->setHtmlAttribute("style", "max-width:10em;")
            ->setOption("wrapper", 'div');
        $form['note']->setOption("inputGroup", false)
            ->setHtmlAttribute("style", "height:6.5em;");
        $form['save']->setOption('groupCol', false);
        $form->getGroup('Others')->setOption('row', 'div class="row mt-0 gy-3"');
        //------
        return $form;
    }

    protected function createComponentPersonForm6_1() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Input groups - fully responsive.');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(false, false, false, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['label'] = 'legend';
        $renderer->wrappers['controls']['inputGroup'] ='div class="input-group responsive-input-group"';
        $renderer->wrappers['inputGroup']['wrapper']['grow'] = 'div class="flex-fill mb-3 col-12 col-sm-6 col-md-6 col-lg-4"';
        $renderer->wrappers['inputGroup']['.firstItem'] = '';
        $renderer->wrappers['inputGroup']['.lastItem'] = '';
        $form['gender']->setOption("wrapper", 'div class="flex-grow-1 flex-sm-grow-0 mb-3"')
            ->setOption('.element', 'flex-fill justify-content-center');
        $form['first_name']->setOption("inputGroup", true);
        $form['nick']->setOption("wrapper", "short");
        $desc = Html::el()->addHtml(Html::el('div class="input-group-text rounded-0 d-none d-sm-flex"')->addText('jen číslo, nebo + a číslo'))
            ->addHtml(Html::el('div class="input-group-text rounded-0 d-sm-none"')->addText('(+) a číslo'));
        $form['phone']->setOption("wrapper", "long")
            ->setOption('description', $desc);
        $form['street']->setOption("inputGroup", true);
        $form['street_number']->setOption("wrapper", "xxshort");
        $form['house_number']->setOption("wrapper", "xxshort");
        $form['zip']->setOption("wrapper", "short");
        $form['account']->setOption("inputGroup", true);
        $form['bank']->setOption("wrapper", "xshort")
            ->setOption("labelClass", "manas");
        $form['note']->setOption("inputGroup", false)
            ->setHtmlAttribute("style", "height:6.5em;")
            ->setOption(".parent", 'mb-3');
        //------
        return $form;
    }
    protected function zcreateComponentPersonForm7() : Form
    {
        $formWrapper = $this->formPreparator->getForm(__FUNCTION__);
        $formWrapper->setCaption('Input groups a floating labels.');
//------//------
        $form = $this->personFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true, true, false, true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"'; //'div class="col-6 p-0" style="margin-left: -1px;"';
        $form['first_name']->setOption("inputGroup", true);
        $form['gender']->setOption("class", "align-items-start flex-column");
        $form['email']->setOption("inputGroup", true);
        // ->setOption("wrapper", 'div class="col-7"');
        $form['nick']->setOption("wrapper", 'div class="col-7"');
        $form['phone']->setOption("inputGroup", true);
        //->setOption("description", Html::el('div class="input-group-text flex-fill justify-content-center align-items-start flex-column"')->addText("jen číslo, nebo + a číslo"));
        $form['street']->setOption("inputGroup", true);
        $form['street_number']->setOption("wrapper", 'div class="col-3 col-md-2"');
        $form['house_number']->setOption("wrapper", 'div class="col-3 col-md-2"'); // ->setHtmlAttribute("style", "max-width:155px;");
        $form['city']->setOption("inputGroup", true);
        $form['zip']->setOption("wrapper", 'div class="col-4 col-md-3"');//->setOption("inputGroup", true);->setHtmlAttribute("style", "max-width:155px;")
        $form['state']->setOption("inputGroup", true);
        $form['account']->setOption("inputGroup", true);
        $form['bank']->setOption("wrapper", 'div class="col-4 col-md-3"');
        $form['note']->setOption("inputGroup", false);
        //------
        return $form;
    }

}