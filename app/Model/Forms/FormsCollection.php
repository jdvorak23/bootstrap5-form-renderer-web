<?php

namespace App\Model\Forms;

use Nette\SmartObject;

/**
 *
 * @property-read FormWrapper $firstForm
 * @property-read FormWrapper[] $forms
 * @property-read string $caption
 * @property-read string $url
 */
class FormsCollection
{

    use SmartObject;

    /**@var FormWrapper [] */
    protected array $forms;
    protected FormWrapper $firstForm;

    public function addForm(FormWrapper $form, $index = null): void
    {
        $this->firstForm = $this->firstForm ?? $form;
        if($index === null)
            $this->forms[] = $form;
        else
            $this->forms[$index] = $form;
    }

    public function getForm(string $formName): FormWrapper|null
    {
        foreach($this->forms as $form){
            if($form->getName() == $formName)
                return $form;
        }
        return null;
    }

    // Getters for properties
    public function getFirstForm(): FormWrapper
    {
        return $this->firstForm;
    }

    public function getForms(): array
    {
        return $this->forms;
    }

    public function getCaption(): string
    {
        return $this->firstForm->getCaption();
    }

    public function getUrl(): string
    {
        $caption = strtolower(trim($this->caption));
        $caption = str_replace(',', '', $caption);
        return str_replace(' ','-', $caption);
    }

}