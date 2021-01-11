export default class BackendMenu {
    private navContainer: HTMLElement;
    private navTrigger: HTMLButtonElement;
    private menuIsOpen: boolean;
    private navTriggerIcon: HTMLElement;

    constructor(nav: string) {
        this.navContainer = document.querySelector(nav);
        this.menuIsOpen = localStorage.getItem('backendNavOpen') === 'true';

        if(this.navContainer) {
            this.navTrigger = this.navContainer.querySelector('.nav__trigger');
            this.navTrigger.addEventListener('click', () => this.toggleMenu());
            this.navTriggerIcon = this.navTrigger.querySelector('.icon__wrapper');
        }

       if(!this.menuIsOpen) {
           this.closeMenu();
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
        this.navContainer.classList.add('nav--collapsed');
        this.navTriggerIcon.style.transform = 'rotate(180deg)';
        localStorage.setItem('backendNavOpen', 'false');
    }

    openMenu() {
        this.navContainer.classList.remove('nav--collapsed');
        this.navTriggerIcon.style.transform = 'rotate(0)';
        localStorage.setItem('backendNavOpen', 'true');
    }
}