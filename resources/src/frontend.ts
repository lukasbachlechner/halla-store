import './scss/frontend.scss';
import Menu from "./js/Menu";
import ImageGallery from "./js/ImageGallery";

new Menu();
new ImageGallery('#imageGallery');

document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen: HTMLElement = document.querySelector('.loading-screen');
    loadingScreen.remove();
})