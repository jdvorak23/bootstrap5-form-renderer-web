
const FragmentLink = {
    activeSubMenu : null,
    fragments : [],
};
FragmentLink.setActiveSubMenu = function (subMenuSelector, activeLinkClass){
    for(let collapsibleMenu of [... document.querySelectorAll(subMenuSelector)]){
        let linkOfMenu = collapsibleMenu.parentElement.querySelector("[data-bs-target='#" + collapsibleMenu.id + "']");
        if(linkOfMenu && linkOfMenu.classList.contains(activeLinkClass)) {
            this.activeSubMenu = collapsibleMenu;
            break;
        }
    }
}

FragmentLink.setFragments = function (){
    if(!this.activeSubMenu)
        return;
    for(let link of [... this.activeSubMenu.querySelectorAll("a")]){
        let poundPos = link.href.search("#");
        if(poundPos === -1)
            continue;
        let id = link.href.substring(poundPos + 1);
        if(!id)
            continue;
        const observed = document.querySelector('#' + id);
        if(!observed)
            continue;
        const fragment = {id : id, link : link, observed : observed, active : false};
        this.fragments.push(fragment);
    }
}
FragmentLink.activateLink = function(fragmentToActivate){
    if(fragmentToActivate.active)
        return;
    for(let fragment of this.fragments){
        fragment.link.classList.remove("active");
        fragment.active = false;
    }
    fragmentToActivate.link.classList.add("active");
    fragmentToActivate.active = true;
}
FragmentLink.getHeightBreakpoint = function (){
    return window.innerHeight / 2;
}
FragmentLink.checkFragments = function(){
    if(!this.fragments.length)
        return;
    for(let fragment of this.fragments){
        fragment.top = fragment.observed.getBoundingClientRect().top - this.getHeightBreakpoint();
    }
    this.fragments = this.fragments.sort(({top: a}, {top: b}) => a - b);

    if(this.fragments[0].top > 0){
        this.activateLink(this.fragments[0]);
    }
    let negative = this.fragments.filter(fragment => fragment.top < 0);
    this.activateLink(negative.pop());
}

FragmentLink.init = function (subMenuSelector, activeLinkClass){
    this.setActiveSubMenu(subMenuSelector, activeLinkClass);
    this.setFragments();
    this.checkFragments();
    document.addEventListener("scroll", this.checkFragments.bind(this));
}
window.addEventListener('DOMContentLoaded', (event) => {
    FragmentLink.init("[id$='SubChapters']", 'active');
});