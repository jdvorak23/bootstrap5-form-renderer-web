<?php

namespace App\Model;

use Jdvorak23\Bootstrap5FormRenderer\Renderers\ControlRenderers\FloatingControlRenderer;
use Nette\Utils\Html;

class InputGroupSeparateLabel extends FloatingControlRenderer
{
    protected function renderToGroup(Html $container): void
    {

        $this->renderInputGroupWrapper();
        if($this->floatingLabel) {
            $this->renderParent($this->inputGroupWrapper);
            $this->renderLabel($this->parent);
        }else{
            $this->renderLabel($this->inputGroupWrapper);
            $this->renderParent($this->inputGroupWrapper);
        }
        $this->renderDescription($this->parent);
        $this->renderFeedback($this->inputGroupWrapper);
    }
}