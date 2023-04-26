window.addEventListener('DOMContentLoaded', (event) => {
    roundCorners();
    const tabs = document.querySelector("#pills-tab");
    if(tabs)
        tabs.addEventListener('click', (event) => roundCorners());
    window.addEventListener('resize', (event) => roundCorners());
});
function roundCorners(){
    const getEdgeItems = function (element) {
        const items = { first : null, last : null };
        [...element.querySelectorAll(".rounded-0")].forEach(child => {
            if(window.getComputedStyle(child).getPropertyValue("display") !== 'none'
                && window.getComputedStyle(child).getPropertyValue("visibility") !== 'hidden'){
                items.first = items.first ? items.first : child;
                items.last = child;
            }
        });
        return items;
    };
    [...document.querySelectorAll(".responsive-input-group")].forEach(inputGroup => {
        for (let inputGroupItem of inputGroup.children) {
            const items = getEdgeItems(inputGroupItem);
            if(!items.first)
                continue;
            if (inputGroupItem.offsetLeft <= 0)
                items.first.classList.add("rounded-start");
            else
                items.first.classList.remove("rounded-start");

            if((inputGroupItem.offsetWidth + inputGroupItem.offsetLeft) >= inputGroup.clientWidth)
                items.last.classList.add("rounded-end");
            else
                items.last.classList.remove("rounded-end");
        }
    });
}