<?php

namespace App\Model;

use Jdvorak23\Bootstrap5FormRenderer\Wrappers;

class InputGroupWrappers extends Wrappers
{
    protected array $wrappers = [
        'form' => [
            'container' => null,
            'errorContainer' => 'div class="form-errors"',
            'errorItem' => 'div class="alert alert-danger"',
        ],

        'group' => [
            'container' => 'fieldset',
            'label' => 'legend',
            'description' => 'p',
            'row' => 'div class="row g-3"',
            'col' => 'div class="col-md-6"',
            '.col' =>''
        ],

        'controls' => [
            'row' => 'div class="row gy-3"',
            'col' => 'div class="col-12"',
            'inputGroup' => 'div class="input-group responsive-input-group"',
            'buttons' => 'div class="d-flex justify-content-center align-items-end p-3"',
        ],

        'inputGroup' => [
            'wrapper' => [
                'shrink' => 'div class=""',
                'grow' => 'div class="flex-fill col-12 col-sm-6 col-md-6 col-lg-4"',
                // Own specific wrappers:
                'xxshort' => 'div class="col-6 col-sm-3 col-md-3 col-lg-2"',
                'xshort' => 'div class="col-6 col-sm-4 col-md-3 col-lg-2"',
                'short' => 'div class="col-12 col-sm-5 col-md-4 col-lg-3"',
                'medium' => 'div class="col-12 col-sm-6 col-md-6 col-lg-4"',
                'long' => 'div class="col-12 col-sm-12 col-md-8 col-lg-6"',
                'xlong' => '',
                // Class appended to all OWN wrappers:
                '.own' =>  'mb-4 flex-fill',
            ],
            // Added only to 'shrink' and 'grow':
            '.wrapper' => 'mb-4',
            'container' => [
                'standard' => 'div class="input-group flex-nowrap"',
                'floating' => 'div class="form-floating input-group flex-nowrap"',
            ],
            '.item' => 'rounded-0',
            '.firstItem' => '',
            '.lastItem' => '',
            //'..height' => 'height: calc(1.5em + 0.75rem + 2px);',
            //'..floatingLabelHeight' => 'height: calc(3.5rem + 2px);',
            '.height' => 'input-group-height',
            '.floatingLabelHeight' => 'input-group-floating-height',
        ],

        'container' =>[
            'list' => 'div class="d-flex flex-column justify-content-center h-100"',
            'floatingLabel' => 'div class="form-floating"',
            'button' => 'div class="me-2"',
            'default' => 'div',
        ],

        'control' => [
            'list' => null,
            'listItem' => 'div class="form-check"',
            'listInputGroup' => 'div class="input-group-text gap-2 form-control list-element"',
            'listInputGroupItem' => 'div',
            '.inputGroupButton' => 'btn btn-outline-secondary',
            '.submit' => 'btn btn-primary',
            '.reset' => 'btn btn-secondary',
            '.button' => 'btn btn-secondary',
            '.image' => '',
            '.all' => '',
            '.required' => '',
            '.optional' => '',
            '.checkbox' => 'form-check-input',
            '.radio' => 'form-check-input',
            '.select' => 'form-select',
            '.textarea' => 'form-control',
            '.text' => 'form-control',
            '.password' => 'form-control',
            '.email' => 'form-control',
            '.file' => 'form-control',
            '.number' => 'form-control text-end',
            '.search' => 'form-control',
            '.color' => 'form-control form-control-color',
            '.range' => 'form-range',
            '.date' => 'form-control',
            '.datetime-local' => 'form-control',
            '.month' => 'form-control',
            '.week' => 'form-control',
            '.time' => 'form-control',
            '.tel' => 'form-control',
            '.url' => 'form-control',
        ],

        'label' => [
            '.inputGroupFloating' => 'form-label input-group-floating-label',
            '.inputGroup' => 'input-group-text',
            '.floatingLabel' => 'form-label',
            '.checkbox' => 'form-check-label',
            '.item' => 'form-check-label',
            '.class' => 'form-label',
            //'..inputGroupFloatingStyle' => 'z-index: 5;',
            '.required' => '',
            'prefix' => '',
            'requiredprefix' => '',
            'suffix' => '',
            'requiredsuffix' => '',
        ],

        'description' => [
            'inputGroupItem' => 'div class="input-group-text"',
            'item' => 'small class="ms-1 d-inline-block"',
            'container' => null,
            'prefix' => '',
            'suffix' => '',
            'requiredprefix' => '',
            'requiredsuffix' => '',
            'push' => '',
            'requiredpush' => '',
        ],

        'error' => [
            '.control' => 'is-invalid',
            '.list' => 'is-invalid',
            '.parent' => 'is-invalid',
            'inputGroup' => 'div class="invalid-feedback mx-1"',
            'floatingLabel' => 'div class="invalid-feedback mx-1"',
            'container' => 'div class="invalid-feedback mx-1"', //wrapper error na controlu
            'inputGroupItem' => 'span class="me-1"',
            'floatingLabelItem' => 'span class="me-1"',
            'item' => 'span class="me-1"',
        ],

        'valid' => [
            '.control' => 'is-valid',
            '.list' => 'is-valid',
            '.parent' => 'is-valid',
            'inputGroup' => 'div class="valid-feedback mx-1"',
            'floatingLabel' => 'div class="valid-feedback mx-1"',
            'container' => 'div class="valid-feedback mx-1"',
            'inputGroupItem' => 'span class="me-1"',
            'floatingLabelItem' => 'span class="me-1"',
            'item' => 'span class="me-1"',
            'message' => 'It looks good.',
        ],

        'hidden' => [
            'container' => null,
        ],
    ];
}