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
}
