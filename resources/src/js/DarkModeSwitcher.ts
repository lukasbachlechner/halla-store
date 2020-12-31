import {DisplayModes} from "./enums";

export default class DarkModeSwitcher {
    private html: HTMLHtmlElement;
    private readonly modeSwitchButton: HTMLButtonElement;
    private modeIcons: Map<DisplayModes, string>;
    private currentMode: DisplayModes;

    constructor(selector: string) {


        this.html = document.querySelector('html');
        this.modeSwitchButton = document.querySelector(selector);
        this.getIcons([DisplayModes.Dark, DisplayModes.Light])
            .then(() => {
                this.initDisplayMode();
                if (this.modeSwitchButton) {
                    this.modeSwitchButton.addEventListener('click', () => this.toggleDisplayMode());
                }
            });

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

    private getIcons(modes: string[]): Promise<any> {
        this.modeIcons = new Map<DisplayModes, string>();

        const iconPromises: Promise<any>[] = modes.map((mode: DisplayModes) => {
            return fetch(`storage/assets/svg/icons/mode-switch-${mode}.svg`)
                .then((response: Response) => response.text())
                .then((icon: string) => {
                    icon = `<div class='icon__wrapper'>${icon}</div>`;
                    this.modeIcons.set(mode, icon)
                });
        });

        return Promise.all(iconPromises);
    }

    private setIcon() {
        this.modeSwitchButton.innerHTML = this.modeIcons.get(this.currentMode);
    }
}