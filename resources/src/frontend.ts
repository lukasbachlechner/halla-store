import './scss/frontend.scss';
import Menu from "./js/Menu";
import ImageGallery from "./js/ImageGallery";
import CheckoutFormHandler from "./js/CheckoutFormHandler";

new Menu();
new ImageGallery('#imageGallery');
new CheckoutFormHandler();

document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen: HTMLElement = document.querySelector('.loading-screen');
    loadingScreen.remove();

    const acceptedCookies = Boolean(localStorage.getItem('cookieConsent')) ?? false;

    if (!acceptedCookies) {
        const banner: HTMLElement = document.querySelector('.cookie-consent');
        banner.style.display = 'flex';
        const acceptButton = banner.querySelector('#cookieConsentClose');

        acceptButton.addEventListener('click', () => {
            localStorage.setItem('cookieConsent', 'true');
            banner.remove();
        })
    }
})