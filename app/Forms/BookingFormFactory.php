<?php

namespace App\Forms;


use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

final class BookingFormFactory
{
    use Nette\SmartObject;

    const PERSON_SETTINGS = [
            'withPerson' => 'Vytvořit osobu',
            'withoutPerson' => 'Zatím bez osoby',
            'completed' => 'Bez osoby a označit jako vyřízenou'
        ], INVOICE_SETTINGS = [
            'withInvoice' => 'Pokračovat s fakturou',
            'withoutInvoice' => 'Pokračovat bez faktury - označit jako vyřízenou'
        ];

    /** @var Form */
    private $form;

    public function create(): Form
    {
        $form = new Form();

        //Rezervace
        $form->addGroup('Rezervace');
        $booking= $form->addContainer('booking');

        // Skryté pole pro případné ID rezervace
        $booking->addHidden('id')->setNullable();

        $booking->addText("date_from", "Od")
            ->setRequired("Zadejte datum od")
            ->addRule($form::PATTERN, 'Neplatný formát data. Zadejte datum ve formátu d(d).m(m).yyyy', '^([1-9]|0[1-9]|[12][0-9]|3[01])\.([1-9]|0[1-9]|1[0-2])\.\d{4}$');
        $booking->addText("date_to", "Do")
            ->setRequired("Zadejte datum do")
            ->addRule($form::PATTERN, 'Neplatný formát data. Zadejte datum ve formátu d(d).m(m).yyyy', '^([1-9]|0[1-9]|[12][0-9]|3[01])\.([1-9]|0[1-9]|1[0-2])\.\d{4}$');
        $booking->addInteger("price", "Cena")
            ->setHtmlAttribute("step", "1000")
            ->setNullable();
        $booking->addInteger("deposit", "Záloha")
            ->setHtmlAttribute("step", "1000")
            ->setNullable();
        $booking->addTextArea("note", "Poznámka")
            ->setNullable();
        $form->addRadioList("personSettings", null, self::PERSON_SETTINGS)
            ->setDefaultValue('withPerson')
            ->addCondition($form::IsIn, ['withPerson'])->toggle("#contactGroup");

        //Osoba
        $form->addGroup('Kontakt')
            ->setOption("id", "contactGroup");
        $person= $form->addContainer('person');
        // Skryté pole pro případné ID osoby.
        $person->addHidden('id')->setNullable();

        $person->addEmail('email', 'Email')
            ->addRule($form::EMAIL)
            ->setNullable();
        $person->addText('phone', 'Telefon (jen číslo, nebo + a číslo)')
            ->addRule($form::PATTERN, 'Neplatný formát tel. čísla.', '^(\+[0-9]*|[0-9]*)$')
            ->setNullable();;
        $person->addText('first_name', 'Jméno')
            ->setNullable();;
        $person->addText('last_name', 'Příjmení')
            ->setNullable();;
        $person->addTextArea("address", "Adresa")
            ->setNullable();
        $person->addText('company_name', 'Společnost')
            ->setNullable();

        $form->addRadioList("invoiceSettings", null, self::INVOICE_SETTINGS)
            ->setDefaultValue('withInvoice');

        //Submit
        $form->setCurrentGroup();
        $form->addSubmit("save", "Uložit");
        $form->addButton('cancel', 'Cancel')
            ->setHtmlAttribute("type", "reset");


        $form->onValidate[] = function(Form $form)
        {
            $form->addError("Some error in whole form");
        };

        $form->onSuccess[] = function (Form $form, ArrayHash $values)
        {

        };

        $this->form = $form;
        return $form;
    }

}