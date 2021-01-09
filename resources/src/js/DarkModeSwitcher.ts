import {DisplayModes} from "./enums";


export default class DarkModeSwitcher {
    private html: HTMLHtmlElement;
    private readonly modeSwitchButton: HTMLButtonElement;
    private modeIcons: Map<DisplayModes, string>;
    private currentMode: DisplayModes;

    constructor(selector: string) {
        this.html = document.querySelector('html');
        this.modeSwitchButton = document.querySelector(selector);

        this.getIcons();
        this.initDisplayMode();
        if (this.modeSwitchButton) {
            this.modeSwitchButton.addEventListener('click', () => this.toggleDisplayMode());
        }

    }

    private initDisplayMode() {
        const systemPrefersDarkMode: boolean = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const savedPreference: string = localStorage.getItem('displayModePreference');

        if (savedPreference === DisplayModes.Dark) {
            this.setDisplayMode(DisplayModes.Dark);
        } else if (savedPreference === DisplayModes.Light) {
            this.setDisplayMode(DisplayModes.Light);
        } else if (systemPrefersDarkMode) {
            this.setDisplayMode(DisplayModes.Dark);
        } else {
            this.setDisplayMode(DisplayModes.Light);
        }
    }

    private setDisplayMode(mode: DisplayModes) {
        if (mode === DisplayModes.Dark) {
            this.enableDarkMode();
        } else if (mode === DisplayModes.Light) {
            this.enableLightMode();
        }
    }

    private enableDarkMode() {
        this.html.classList.add('dark-mode');
        localStorage.setItem('displayModePreference', DisplayModes.Dark);
        this.currentMode = DisplayModes.Dark;
        this.setIcon();
    }

    private enableLightMode() {
        this.html.classList.remove('dark-mode');
        localStorage.setItem('displayModePreference', DisplayModes.Light);
        this.currentMode = DisplayModes.Light;
        this.setIcon();
    }

    private toggleDisplayMode(): void {
        if (this.currentMode === DisplayModes.Dark) {
            this.enableLightMode();
        } else if (this.currentMode === DisplayModes.Light) {
            this.enableDarkMode();
        }
    }

    private getIcons() {
        this.modeIcons = new Map();

        const darkIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="sun"><rect width="24" height="24" transform="rotate(180 12 12)" opacity="0"/><path d="M12 6a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v2a1 1 0 0 0 1 1z"/><path d="M21 11h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2z"/><path d="M6 12a1 1 0 0 0-1-1H3a1 1 0 0 0 0 2h2a1 1 0 0 0 1-1z"/><path d="M6.22 5a1 1 0 0 0-1.39 1.47l1.44 1.39a1 1 0 0 0 .73.28 1 1 0 0 0 .72-.31 1 1 0 0 0 0-1.41z"/><path d="M17 8.14a1 1 0 0 0 .69-.28l1.44-1.39A1 1 0 0 0 17.78 5l-1.44 1.42a1 1 0 0 0 0 1.41 1 1 0 0 0 .66.31z"/><path d="M12 18a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2a1 1 0 0 0-1-1z"/><path d="M17.73 16.14a1 1 0 0 0-1.39 1.44L17.78 19a1 1 0 0 0 .69.28 1 1 0 0 0 .72-.3 1 1 0 0 0 0-1.42z"/><path d="M6.27 16.14l-1.44 1.39a1 1 0 0 0 0 1.42 1 1 0 0 0 .72.3 1 1 0 0 0 .67-.25l1.44-1.39a1 1 0 0 0-1.39-1.44z"/><path d="M12 8a4 4 0 1 0 4 4 4 4 0 0 0-4-4zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2z"/></g></g></svg>';
        const lightIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="moon"><rect width="24" height="24" opacity="0"/><path d="M12.3 22h-.1a10.31 10.31 0 0 1-7.34-3.15 10.46 10.46 0 0 1-.26-14 10.13 10.13 0 0 1 4-2.74 1 1 0 0 1 1.06.22 1 1 0 0 1 .24 1 8.4 8.4 0 0 0 1.94 8.81 8.47 8.47 0 0 0 8.83 1.94 1 1 0 0 1 1.27 1.29A10.16 10.16 0 0 1 19.6 19a10.28 10.28 0 0 1-7.3 3zM7.46 4.92a7.93 7.93 0 0 0-1.37 1.22 8.44 8.44 0 0 0 .2 11.32A8.29 8.29 0 0 0 12.22 20h.08a8.34 8.34 0 0 0 6.78-3.49A10.37 10.37 0 0 1 7.46 4.92z"/></g></g></svg>';

        this.modeIcons.set(DisplayModes.Dark, `<div class='icon__wrapper'>${darkIcon}</div>`);
        this.modeIcons.set(DisplayModes.Light, `<div class='icon__wrapper'>${lightIcon}</div>`);
    }

    private setIcon() {
        this.modeSwitchButton.innerHTML = this.modeIcons.get(this.currentMode);
    }
}