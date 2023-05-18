<?php

namespace App\Presenters;

use App\Forms\LoginFormFactory;
use Jdvorak23\Bootstrap5FormRenderer\Bootstrap5FormRenderer;
use Jdvorak23\Bootstrap5FormRenderer\Designers\Designer;
use Nette\Application\UI\Form;

class LoginPresenter extends BaseFormPresenter
{
    public function __construct(private LoginFormFactory $loginFormFactory)
    {
        parent::__construct();
    }

    protected function createComponentLoginForm1() : Form
    {
        static $caption = "Base form";
//------//------
        $form = new Form();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $renderer->wrappers['group']['col'] = 'div class="col-12"';
        $form->addEmail('email', 'Email')
            ->addRule($form::EMAIL)
            ->setRequired('Email is required.');
        $form->addPassword('password', 'Password')
            ->setRequired();
        $form->addSubmit('save', 'Login');
        $form->onValidate[] = function (Form $form) {
            $form->addError("Some error in whole form");
        };
        $form->onSuccess[] = function (Form $form, Array $values) {
        };
        //------
        return $form;
    }

    protected function createComponentLoginForm2() : Form
    {
        static $caption = "Bad practice";
//------//------
        $form = new Form();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer();
        $form->setRenderer($renderer);
        $renderer->wrappers['form']['container'] = 'div class="card mx-auto" style="max-width:400px"';
        $form->addGroup('Login')
            ->setOption('row', 'div class="card-body"')
            ->setOption('col', 'div class="mb-2"')
            ->setOption('labelContainer', 'div class="card-header"')
            ->setOption('container', false);
        $form->addEmail('email', 'Email')
            ->addRule($form::EMAIL)
            ->setRequired('Email is required.');
        $form->addPassword('password', 'Password')
            ->setRequired();
        $form->addSubmit('save', 'Login')
            ->setOption('.buttonGroup', 'mt-3 !p-3 pt-3');
        $form->onValidate[] = function (Form $form) {
            $form->addError("Some error in whole form");
        };
        $form->onSuccess[] = function (Form $form, Array $values) {
        };
        //------
        return $form;
    }

    protected function createComponentLoginForm3() : Form
    {
        static $caption = "Factory";
//------//------
        $form = $this->loginFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $renderer->wrappers['form']['container'] = 'div class="card mx-auto" style="max-width:400px"';
        $form->getGroup('Login')
            ->setOption('row', 'div class="card-body"')
            ->setOption('col', 'div class="mb-2"')
            ->setOption('labelContainer', 'div class="card-header"')
            ->setOption('container', false);
        $form['save']->setOption('.buttonGroup', 'mt-3 !p-3 pt-3');
        //------
        return $form;
    }
    protected function createComponentLoginForm4() : Form
    {
        static $caption = "Designer";
//------//------
        $form = $this->loginFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $renderer->wrappers['form']['container'] = 'div class="card mx-auto" style="max-width:400px"';
        $design = new Designer($form);
        $design->group('Login')
            ->setGrid('div class="card-body"')
            ->setColumn('div class="mb-2"')
            ->setLabelContainer('div class="card-header"')
            ->setContainer(false);
        $design('save')->setButtonGroupClasses('mt-3 !p-3 pt-3');
        //------
        return $form;
    }
    protected function createComponentLoginForm5() : Form
    {
        static $caption = "Another Designer example";
//------//------
        $form = $this->loginFormFactory->create();
        //------Renderer Setup
        $renderer = new Bootstrap5FormRenderer(true);
        $form->setRenderer($renderer);
        $renderer->wrappers['form']['container'] = 'div class="card mx-auto" style="max-width:400px"';
        $design = new Designer($form);
        $design->group('Login')
            ->setGrid('div class="card-body"')
            ->setColumn('div class="mb-2"')
            ->setLabelContainer('div class="card-header"')
            ->setContainer(false);
        $design('save')->setButtonGroupClasses('mt-3 !p-3 pt-3');
        $design('email password')->setControlClasses('form-control-lg');
        // Or button included
        //$design->all()->setControlClasses('form-control-lg');
        //------
        return $form;
    }
}