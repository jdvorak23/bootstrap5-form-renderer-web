<?php

declare(strict_types=1);

namespace App\Presenters;

use Jdvorak23\Bootstrap5FormRenderer\Bootstrap5FormRenderer;
use App\Forms\TestFormFactory;
use Nette;
use Nette\Application\UI\Form;
use Nette\Utils\Html;


final class HomePresenter extends Nette\Application\UI\Presenter
{

    public function __construct(private TestFormFactory $testFormFactory)
    {
        parent::__construct();

    }
    protected function startup(): void
    {
        parent::startup();
        $this->redirect("Person:form", ['id' => 1]);
    }

    protected function createComponentTestForm() : Form
    {
        return $this->testFormFactory->create();
    }
    protected function createComponentPokusForm(): Form {
        $form = new Form();
        bdump($form->isValid());
        //$form->isSubmitted()
        $form->setRenderer(new Bootstrap5FormRenderer(novalidate: true));
        $hh = $form->addGroup("prih")
            ->setOption('visual', false)
            ->setOption("description", "Manasaaa");

        //$form->setHtmlAttribute("class", "g-4");
        $form->addEmail("email", "Ten email")
            // ->setOption('row', "col-6")
            ->setOption("floatingLabel", "true")
            ->setOption('row', true)
            ->setOption("inputGroup", true)
            ->setRequired("Zadejte email");
        $form->addPassword("password", "Heslo")
            ->setOption("description", "manas")
            //->setOption("error", "small")
            ->setOption("floatingLabel", "true")
            ->setRequired("Zadejte heslo");
        $form->addGroup("person")
            ->setOption("description", "manas");
        //->setOption('row', false);
        $pokus = Html::el('div')->addHtml("<strong>wtf:</strong>");
        $form->addText("what22", $pokus)
        //    ->setOption('row', "col-6")
            ->setRequired("Zadejte email");
        $pokus->addHtml("<strong>V pici</strong>");


        $form->addText("what22u")
            ->setOption('label', Html::el('div')->addHtml('<strong>manas</strong>'))
            ->setRequired("Zadejte heslo")
            ->setOption("inputGroup", true)
            ->setOption("description", "Zadejte pořádné heslo");

        $form->addText("first_name", Html::el('div')->addHtml('<strong>manas</strong>'))
            ->setOption("labelClass", "d-flex")
            ->setOption('groupCol', 'div class="col-12"')
            ->setOption("error", false)
            ->setOption("errorContainer", false)
            ->setOption("floatingLabel", true)
            ->setOption("description", "manas")
            ->setRequired();
        $form->addText("koko", "nec");
            //->setRequired()
            //->setOption("inputGroup", "g1");
        $form->addText("koko2", "Koko");

        $form->addCheckboxList("shits2", "Vyber:", [
            'r' => 'červená',
            'g' => 'zelená',
            'b' => 'modrá',
        ])->setOption("description", "blalalal")
            ->setOption('inputGroup', false)
            ->setRequired();
        $form->addRadioList("gayfff", "Gay", [
            'withPerson' => 'Vytvořit osobu',
            'withoutPerson' => 'Zatím bez osoby',
        ])->setOption("description", Html::el('div class="text-danger input-group-text" style="cursor: pointer;height:38px;"')
                ->addHtml('<i class="fas fa-times-circle"></i>'))
            ->setRequired();
        $form->addText("second_name_2")
            ->setOption('row', true)
            ->setOption("inputGroup", false)
            ->setHtmlAttribute("class", "form-control-wlb")
            ->setRequired();
        $form->addText("whaty", "Něco")
            ->setOption("inputGroup", true)
            ->setOption('row', false)
            ->setOption("description", "descrip");
        $form->addSelect("select2", "Vyber", ['first' => 'první', 'second' => 'druhý', 'third' => 'třetí'])
            ->setOption("description", "Sele")
            ->setOption("col", true)
            ->setOption("floatingLabel", true)
            ->setOption("inputGroup", true)
            ->setOption("parentClass", "manas-class")
            ->setRequired();
        //->setOption("floatingLabel", false);
        $form->addMultiUpload("files", "Nahrát soubory")
            ->setOption("description", "duu");
            //->setOption("inputGroup", false);
            //->setOption('row', "col-8");
        $form->addTextArea("address", "Adresa");
           // ->setOption("inputGroup", true)
            //->setOption("floatingLabel", true);

        $form->addCheckbox("stay2", "hjj")
            ->setOption('row', true)
            ->setOption("description", "hovno")
            ;

        $form->addText("second_name")
            //->setOption('row', true)
           // ->setOption("inputGroup", true)
            ->setOption("inputGroup", true)
            ->setHtmlAttribute("class", "form-control-wlb")
            ->setRequired();
        $form->addButton("tlac", "Nečum")

            ->setOption("description", "To nemačkej")
            ->setRequired("wtf");
        ;

        $form->addButton("reset", "Zresetovat")
            ->setOption("description", "hovno")
            ->setOption("floatingLabel", true)
            //->setOption('row', "col-3")
            ->setOption("col", 'div class="col-12"');

        $form->addButton("res2", "zres")
            ->setHtmlAttribute("type", "reset")
            ->setOption("inputGroup", false);

        $form->addCheckbox("stay", "Zůstat přihlášen")
           // ->setOption("inputGroup", true)
               //->setOption('item', 'div class="my-item"')
            ->setOption('row', false)
            ->setRequired();
        $form->addGroup("files");
        // $form->addMultiUpload("files", "Nahrát soubory");
        $form->addImageButton("pokButton", "/images/button.jpg");
        //$form->addGroup("other", "Ostatní");
        $form->addGroup("other")////////////////////
        ->setOption("embedNext", true)
        ->setOption('row', true)
            ->setOption("col", false);
        $form->addInteger("price", "cena")
            ->setOption("nextTo", "what");

        $form->addInteger("other_price", "Jiná cena");
        $form->addTextArea("note", "Poznámka");
        //$form->addGroup("fancy", "Fancy")
        $form->addGroup("fancy")
            ->setOption('row', false);
        $form->addMultiSelect("select", "Vyber", ['first' => 'první hhh', 'second' => 'druhý', 'third' => 'třetí'])
            ->setOption("inputGroup", false)
            ->setOption("floatingLabel", true)
            ->setOption("description", "fdfre");
        $form->addCheckbox("agree", "Souhlas")
            ->setOption("description", "manas")
            ->setOption("inputGroup", false)
            ->setRequired();
        $form->addCheckbox("another", "Souhlas2")
            ->setRequired();
        $form->addText("what", "Něco")
            ->setOption("inputGroup", true);
        $form->addCheckboxList("shits", "Hovna:", [
            'r' => 'červená',
            'g' => 'zelená',
            'b' => 'modrá',
        ])->setOption("inputGroup", false)
            ->setRequired()
            ->setOption("description", "blalalal");
        $form->addText("what2", "Něco2")
            ->setOption("floatingLabel", true)
            ->setOption("class", "mb-3");
        $form->addRadioList("gay", "Gay", [
            'withPerson' => 'Vytvořit osobu',
            'withoutPerson' => 'Zatím bez osoby',
            'completed' => 'Bez osoby a označit jako vyřízenou'
        ])->setOption("inputGroup", true)
            //->setOption("inputGroup", "a")
            ->setOption("floatingLabel", false)
            ->setRequired()
            ->setOption("description", "manas")
            ->generateId = true;
        //bdump($pok);
        //$pok->setHtmlAttribute("type", "date");
        $form->setCurrentGroup();
        $form->addSubmit('save', 'Uložit kontakt')
            ->setOption("floatingLabel", true);
        $form->addButton('save_ne', 'Něco jiného');


        $form->onValidate[] = function (Form $form)
        {
            $form['password']->addError("A nečumte");
            $form['password']->addError("wtf");
            $form->addError("error v celem formu");
            $form['gay']->addError("smrdíš");
            $form['select2']->addError("smrdíš");
        };

        $form->onSuccess[] = function (Form $form, Array $values) {
            bdump($values);
        };
        return $form;
    }
}
