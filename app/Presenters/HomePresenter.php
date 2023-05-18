<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


final class HomePresenter extends Nette\Application\UI\Presenter
{

    public function __construct()
    {
        parent::__construct();
    }
    protected function startup(): void
    {
        parent::startup();
        $this->redirect("Person:form", ['id' => 'factory']);
    }

}
