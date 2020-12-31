export default class Menu {
    private readonly mainList: Element;
    private navContainer: Element;
    private trigger: Element;
    private triggerIcon: HTMLImageElement;
    private menuIsOpen: boolean;
    private readonly microLoginForm: Element;
    private wrapper: Element;
    private inputs: NodeList;

    constructor() {
        this.mainList = document.querySelector('#navMainList');
        this.navContainer = document.querySelector('nav.nav');
        this.trigger = document.querySelector('#menuTrigger');
        this.triggerIcon = this.trigger.querySelector('img');
        this.menuIsOpen = false;

        if (this.mainList) {
            this.trigger.addEventListener('click', () => this.toggleMenu());
        }

        this.microLoginForm = document.querySelector('#microLoginForm');

        if (this.microLoginForm) {
            this.wrapper = this.microLoginForm.parentElement;
            this.inputs = this.microLoginForm.querySelectorAll('input');

            this.inputs.forEach((input: HTMLElement) => {
                input.addEventListener('focus', () => this.preventHover());
                input.addEventListener('blur', () => this.allowHover());
            })
        }
    }

    toggleMenu() {
        if(this.menuIsOpen) {
            this.closeMenu();
        } else {
            this.openMenu()
        }
        this.menuIsOpen = !this.menuIsOpen;
    }

    closeMenu() {
        this.mainList.classList.remove('nav--open');
        this.navContainer.classList.remove('nav--open');
        this.triggerIcon.src = this.triggerIcon.src.replace('menu-close.svg', 'menu.svg');
    }

    openMenu() {
        this.mainList.classList.add('nav--open');
        this.navContainer.classList.add('nav--open');
        this.triggerIcon.src = this.triggerIcon.src.replace('menu.svg', 'menu-close.svg');
    }

    preventHover() {
        this.wrapper.classList.add('focused');
    }

    allowHover() {
        this.wrapper.classList.remove('focused');
    }
}