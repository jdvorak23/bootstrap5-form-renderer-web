<?php
namespace App\Forms;
use Nette\Application\UI\Form;

class LoginFormFactory
{
    public function create()
    {
        $form = new Form();
        $form->addGroup('Login');
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
        return $form;
    }
}