
const Menu = {
    toggleButton : null,
    activeSubMenu : null,
};

Menu.setToggleButton = function (){
    this.toggleButton = document.body.querySelector('#sidebarToggle');
    this.toggleButton?.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
    });
}

Menu.setActiveSubMenu = function (subMenuSelector, activeLinkClass){
    for(let collapsibleMenu of [... document.querySelectorAll(subMenuSelector)]){
        let linkOfMenu = collapsibleMenu.parentElement.querySelector("[data-bs-target='#" + collapsibleMenu.id + "']");
        if(linkOfMenu && linkOfMenu.classList.contains(activeLinkClass)) {
            this.activeSubMenu = collapsibleMenu;
            break;
        }
    }
}

Menu.setSubMenuLinksClick = function (){
    if(!this.activeSubMenu)
        return;
    for(let link of [... this.activeSubMenu.querySelectorAll("a")]){
        link.addEventListener('click', () => {
            if(window.matchMedia("(max-width: 991px)").matches)
                document.body.classList.toggle('sb-sidenav-toggled');
        });
    }
}

Menu.setToggle = function(){
    let isLg = !window.matchMedia("(max-width: 991px)").matches;

    window.addEventListener('resize', () => {
        let breakpointChanged = isLg !== !window.matchMedia("(max-width: 991px)").matches;
        isLg = !window.matchMedia("(max-width: 991px)").matches;
        if (breakpointChanged){
            let toggled = document.body.classList.contains('sb-sidenav-toggled');
            if(isLg && toggled)
                document.body.classList.remove('sb-sidenav-toggled');
            if(!isLg && toggled)
                document.body.classList.remove('sb-sidenav-toggled');
        }

    });

    let content = document.querySelector('#layoutSidenav_content');

    content?.addEventListener("click", () => {
        if(window.matchMedia("(max-width: 991px)").matches)
            document.body.classList.remove('sb-sidenav-toggled');
    })
}

Menu.init = function (){
    this.setToggleButton();
    this.setActiveSubMenu("[id$='SubChapters']", 'active');
    this.setSubMenuLinksClick();
    this.setToggle();
}

const TopNav = {
    topNavSelector : ".sb-topnav",
    breakpoint : "(max-width: 991px)",
    toggleClass : "sb-topnav-hide",
};

TopNav.getTopNav = function (){
    return document.querySelector(this.topNavSelector);
}

TopNav.setToggle = function (){
    this.topNav = this.topNav || this.getTopNav();
    if(!this.topNav)
        return;
    let lastScrollTop = 0;
    window.addEventListener("scroll", () => {
        if(!window.matchMedia(this.breakpoint).matches)
            return;

        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > lastScrollTop) {
            this.topNav.classList.add(this.toggleClass);
        } else if (scrollTop < lastScrollTop) {
            this.topNav.classList.remove(this.toggleClass);
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
    });
    window.addEventListener('resize', () => {
        if(!window.matchMedia(this.breakpoint).matches)
            this.topNav.classList.remove(this.toggleClass);
    });
}

TopNav.init = function (){
    this.setToggle();
}

window.addEventListener('DOMContentLoaded', event => {
    Menu.init();
    TopNav.init();
});
