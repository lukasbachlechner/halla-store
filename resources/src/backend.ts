import './scss/backend.scss';
import DarkModeSwitcher from "./js/DarkModeSwitcher";
import ImageDropZone from "./js/ImageDropZone";

new DarkModeSwitcher('#darkModeToggle');
new ImageDropZone('#dropZoneFormGroup');


document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen: HTMLElement = document.querySelector('.loading-screen');
    loadingScreen.remove();
})

