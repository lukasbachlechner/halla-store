import './scss/frontend.scss';
import Menu from "./js/Menu";
import ImageGallery from "./js/ImageGallery";
import CheckoutFormHandler from "./js/CheckoutFormHandler";

new Menu();
new ImageGallery('#imageGallery');
new CheckoutFormHandler();

document.addEventListener('DOMContentLoaded', () => {
    console.log('loaded');
    const loadingScreen: HTMLElement = document.querySelector('.loading-screen');
    loadingScreen.remove();
})