import './scss/frontend.scss';
import Menu from "./js/Menu";
import ImageGallery from "./js/ImageGallery";
import RadioFormHandler from "./js/RadioFormHandler";

new Menu();
new ImageGallery('#imageGallery');
new RadioFormHandler('paymentMethod', '#newPaymentForm', 'newPaymentChecked');
new RadioFormHandler('deliveryAddress', '#newAddressForm', 'newAddressChecked');

document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen: HTMLElement = document.querySelector('.loading-screen');
    loadingScreen.remove();
})