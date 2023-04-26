<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

class InvoiceFormFactory
{

    protected Form $form;

    public function create(): Form
    {
        $form = new Form();
        $form->addGroup("Faktury");
        $form->addInteger('deposit_due_date_after', 'Datum splatnosti zálohy')
            ->setRequired()
            ->setOption("description", "dní po vystavení");
        $form->addInteger('payment_due_date_before', 'Datum splatnosti platby')
            ->setOption("description", "dní před nástupem")
            ->setRequired();
        $form->addGroup("Položky na faktuře");
        $form->addText('deposit_description', 'Záloha');
        $form->addText('deposit_withdraw_description', 'Zaplacená záloha');
        $form->addText('payment_description', 'Platba');
        $form->addText('payment_withdraw_description', 'Zaplacená platba');
        $form->addText('penalty_description', 'Penále');

        $form->setCurrentGroup();
        $form->addSubmit('save', 'Uložit položky');


        $form->onValidate[] = function (Form $form) {
            $form->addError("Some error in whole form");
        };

        $form->onSuccess[] = function (Form $form, ArrayHash $values) {
            bdump($values);
        };
        return $form;
    }

    protected function setDefaults()
    {

    }
}