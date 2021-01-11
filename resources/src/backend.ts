import './scss/backend.scss';
import DarkModeSwitcher from "./js/DarkModeSwitcher";
import ImageDropZone from "./js/ImageDropZone";
import BackendMenu from "./js/BackendMenu";

new DarkModeSwitcher('#darkModeToggle');
new ImageDropZone('#dropZoneFormGroup');
new BackendMenu('.nav');


document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen: HTMLElement = document.querySelector('.loading-screen');
    loadingScreen.remove();
})

