<?php

namespace App\Forms;

use Nette\Application\UI\Form;

class InvoiceFormFactory
{
    public function create(): Form
    {
        $form = new Form();

        $form->addGroup("Invoices");
        $form->addInteger('deposit_due_date_after', 'Deposit due date')
            ->setRequired()
            ->setOption("description", "days after exposure");
        $form->addInteger('payment_due_date_before', 'Payment due date')
            ->setOption("description", "days before boarding")
            ->setRequired();

        $form->addGroup("Invoice items");
        $form->addText('deposit_description', 'Deposit');
        $form->addText('deposit_withdraw_description', 'Paid deposit');
        $form->addText('payment_description', 'Payment');
        $form->addText('payment_withdraw_description', 'Paid payment');
        $form->addText('penalty_description', 'Penalty');

        $form->setCurrentGroup();
        $form->addSubmit('save', 'Save');
        $form->addButton('cancel', 'Cancel')
            ->setHtmlAttribute("type", "reset");

        $form->onValidate[] = function (Form $form) {
            $form->addError("Some error in whole form");
        };

        $form->onSuccess[] = function (Form $form, array $values) {
        };
        $this->setDefaults($form);
        return $form;
    }

    protected function setDefaults(Form $form)
    {
        $form['deposit_due_date_after']->setDefaultValue(7);
        $form['payment_due_date_before']->setDefaultValue(14);
        $form['deposit_description']->setDefaultValue('Deposit for service');
        $form['deposit_withdraw_description']->setDefaultValue('Paid deposit');
        $form['payment_description']->setDefaultValue('Payment for service');
        $form['payment_withdraw_description']->setDefaultValue('Paid service');
        $form['penalty_description']->setDefaultValue('Penalty for service cancellation');
    }
}