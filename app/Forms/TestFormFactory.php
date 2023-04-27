<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

class TestFormFactory
{
    public function create() : Form
    {
        $form = new Form();
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
        return $form;
    }
}