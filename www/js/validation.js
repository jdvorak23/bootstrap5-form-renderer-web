function getValidationElements(element, form) {
    const feedback = 'invalid-feedback';
    const elements = { element : element, parent : null, error : null, container : null };
    let sibling = element;
    while(!elements.error && sibling !== form) {
        if(sibling.classList.contains(feedback)) {
            elements.error = sibling;
            continue;
        }
        if(!sibling.nextElementSibling){
            sibling = sibling.parentElement;
            elements.parent = sibling;
        }else
            sibling = sibling.nextElementSibling;
    }
    if(element.id){
        let parent = element.parentElement;
        while(parent !== form) {
            if(parent.classList.contains('list-element')){
                elements.container = parent;
                return elements;
            }
            parent = parent.parentElement;
        }
    }
    return elements;
}
function setValidationElements(elements, isValid, message = ''){
    const valid = 'is-valid';
    const invalid = 'is-invalid';
    if(elements.error){
        if(elements.error.firstElementChild)
            elements.error.firstElementChild.innerText = message;
        else
            elements.error.innerText = message;

        if(elements.parent) {
            elements.parent.classList.add(isValid ? valid : invalid);
            elements.parent.classList.remove(isValid ? invalid : valid);
        }
    }
    elements.element.classList.add(isValid ? valid : invalid);
    elements.element.classList.remove(isValid ? invalid : valid);
    if(elements.container){
        elements.container.classList.add(isValid ? valid : invalid);
        elements.container.classList.remove(isValid ? invalid : valid);
    }
}
function resetErrors(form){
    for (let i = 0; i < form.elements.length; i++){
        const elements = getValidationElements(form.elements[i], form);
        setValidationElements(elements, true);
    }
}
Nette.showFormErrors = function(form, errors) {
    resetErrors(form);
    let focusElem;
    for (let i = 0; i < errors.length; i++) {
        const element = errors[i].element;
        const message = errors[i].message;

        const elements = getValidationElements(element, form);
        setValidationElements(elements, false, message);

        if (!focusElem && element.focus)
            focusElem = element;
    }
    if (focusElem)
        focusElem.focus();
};

window.addEventListener('DOMContentLoaded', (event) => {
    const resetButtons = document.querySelectorAll('[type="reset"]');
    [...document.querySelectorAll('[type="reset"]')].forEach(resetButton => {
        const form = resetButton.form;
        if(form){
            resetButton.addEventListener('click', () => {
                [...form.querySelectorAll('.is-valid')].forEach(element => {
                    element.classList.remove('is-valid');
                });
                [...form.querySelectorAll('.is-invalid')].forEach(element => {
                    element.classList.remove('is-invalid');
                });
            });
        }
    });
});

/**
 * Validates whole form.
 */
Nette.validateForm = function(sender, onlyCheck) {
    var form = sender.form || sender,
        scope = false;

    Nette.formErrors = [];

    if (form['nette-submittedBy'] && form['nette-submittedBy'].getAttribute('formnovalidate') !== null) {
        var scopeArr = JSON.parse(form['nette-submittedBy'].getAttribute('data-nette-validation-scope') || '[]');
        if (scopeArr.length) {
            scope = new RegExp('^(' + scopeArr.join('-|') + '-)');
        } else {
            Nette.showFormErrors(form, []);
            return true;
        }
    }

    var radios = {}, i, elem;

    for (i = 0; i < form.elements.length; i++) {
        elem = form.elements[i];

        if (elem.tagName && !(elem.tagName.toLowerCase() in {input: 1, select: 1, textarea: 1, button: 1})) {
            continue;

        }

        if ((scope && !elem.name.replace(/]\[|\[|]|$/g, '-').match(scope)) || Nette.isDisabled(elem)) {
            continue;
        }

        if (!Nette.validateControl(elem, null, onlyCheck) && !Nette.formErrors.length) {
            return false;
        }
    }
    var success = !Nette.formErrors.length;
    Nette.showFormErrors(form, Nette.formErrors);
    return success;
};
