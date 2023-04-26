<?php

namespace App\Forms;

use Nette\Application\UI\Form;

class TestFormFactory
{
    public function create() : Form
    {
        $form = new Form();

        return $form;
    }
}