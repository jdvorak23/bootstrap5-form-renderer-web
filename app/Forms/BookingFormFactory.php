<?php

namespace App\Forms;


use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;
use Nette\Utils\Html;

final class BookingFormFactory
{
    use Nette\SmartObject;

    const personItems = [
            'withPerson' => 'Create a person',
            'withoutPerson' => 'No person yet',
            'completed' => 'No person and mark as completed'
        ], invoiceItems = [
            'withInvoice' => 'Continue with the invoice',
            'withoutInvoice' => 'Continue without invoice - mark as completed'
        ];

    protected static $count = 1;

    public function create(): Form
    {
        $form = new Form();

        $form->addGroup('Booking');
        $booking= $form->addContainer('booking');
        $booking->addHidden('id')->setNullable();
        $booking->addText("date_from", "From")
            ->setRequired("Enter the date from")
            ->addRule($form::PATTERN, 'Invalid date format. Enter the date in the format d(d).m(m).yyyy', '^([1-9]|0[1-9]|[12][0-9]|3[01])\.([1-9]|0[1-9]|1[0-2])\.\d{4}$');
        $booking->addText("date_to", "To")
            ->setRequired("Enter the date to")
            ->addRule($form::PATTERN, 'Invalid date format. Enter the date in the format d(d).m(m).yyyy', '^([1-9]|0[1-9]|[12][0-9]|3[01])\.([1-9]|0[1-9]|1[0-2])\.\d{4}$');
        $booking->addInteger("price", 'Price')
            ->setHtmlAttribute("step", "1000")
            ->setNullable();
        $booking->addInteger("deposit", "Deposit")
            ->setHtmlAttribute("step", "1000")
            ->setNullable();
        $booking->addTextArea("note", "Note")
            ->setNullable();
        $form->addRadioList("personSettings", null, self::personItems)
            ->setDefaultValue('withPerson')
            ->addCondition($form::IsIn, ['withPerson'])->toggle("#contactGroup" . self::$count);
        bdump($form->getElementPrototype()->id);
        $form->addGroup('Contact')
            ->setOption("id", "contactGroup" . self::$count);
        $person= $form->addContainer('person');
        $person->addHidden('id')->setNullable();
        $person->addEmail('email', 'Email')
            ->addRule($form::EMAIL)
            ->setNullable();
        $person->addText('phone', 'Phone (number, or + and number)')
            ->addRule($form::PATTERN, 'Invalid phone number format.', '^(\+[0-9]*|[0-9]*)$')
            ->setNullable();;
        $person->addText('first_name', 'First name')
            ->setNullable();;
        $person->addText('last_name', 'Last name')
            ->setNullable();;
        $person->addTextArea("address", "Address")
            ->setNullable();
        $person->addText('company_name', 'Company')
            ->setNullable();

        $form->addRadioList("invoiceSettings", null, self::invoiceItems)
            ->setDefaultValue('withInvoice');

        $form->setCurrentGroup();
        $form->addSubmit("save", 'Save');
        $form->addButton('cancel', 'Cancel')
            ->setHtmlAttribute("type", "reset");
        $form->onValidate[] = function(Form $form)
        {
            $form->addError("Some error in whole form");
        };
        $form->onSuccess[] = function (Form $form, ArrayHash $values)
        {

        };
        self::$count++;
        return $form;
    }

}