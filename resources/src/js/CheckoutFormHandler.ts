import {
    loadStripe,
    Stripe,
    StripeElementChangeEvent,
    Token
} from '@stripe/stripe-js';

export default class CheckoutFormHandler {
    PUBLISHABLE_KEY: string = 'pk_test_51IAyCqLekmfDkPLhIN6B4NrWKs0yhh6MXnxk6b3UOGgGH6h5pOxHCI7n5FvdsxWD7BhFuiN1YhWaHn4cW5XH4Dts00C1Ma0XGg';

    private radioButtonList: NodeListOf<HTMLElement>;
    private readonly form: HTMLFormElement;
    private formRadioButtonId: string;
    private usesCreditCard: boolean = false;
    private differentShippingAddressToggle: HTMLInputElement;
    private differentShippingAddressTemplate: HTMLTemplateElement;
    private allInputs: NodeListOf<HTMLInputElement>;

    constructor() {
        this.form = document.querySelector('#checkoutForm');

        if (this.form) {
            this.radioFormToggle('paymentMethod', '#newPaymentForm', 'newPaymentChecked', true);
            this.radioFormToggle('billingAddress', '#newAddressForm', 'newAddressChecked');
            this.differentShippingAddressToggle = document.querySelector('input#differentShippingAddressToggle');
            this.differentShippingAddressTemplate = document.querySelector('#differentShippingAddressTemplate');

            this.differentShippingAddressToggle.addEventListener('change', (e) => this.handleDifferentShippingAddress(e));
            if(this.differentShippingAddressToggle.checked) {
                this.insertDifferentShippingAddressTemplate();
            }

            this.addInputFocusEventListener();

            /* loadStripe(this.PUBLISHABLE_KEY)
                .then(stripe => this.handleStripeForm(stripe));
             */
        }
    }

    private handleRadioChange(e: Event, form: HTMLElement, formRadioButtonId: string, creditCardForm: boolean) {
        const clickedRadio = e.target as HTMLInputElement;
        if (clickedRadio.getAttribute('id') === formRadioButtonId) {
            form.style.display = 'block';
            if (creditCardForm) {
                this.usesCreditCard = true;
            }
        } else {
            form.style.display = 'none';
            if (creditCardForm) {
                this.usesCreditCard = false;
            }
        }
    }

    private radioFormToggle(radioButtonListSelector: string, formSelector: string, formRadioButtonId: string, creditCardForm: boolean = false) {
        const radioButtonList = document.getElementsByName(radioButtonListSelector);
        const form = document.querySelector(formSelector) as HTMLElement;

        if (radioButtonList) {
            radioButtonList.forEach((radio: HTMLInputElement) => {
                if (radio.checked && radio.getAttribute('id') === formRadioButtonId) {
                    form.style.display = 'block';
                }
                radio.addEventListener('click', (e) => this.handleRadioChange(e, form, formRadioButtonId, creditCardForm));
            })
        }
    }

    private handleStripeForm(stripe: Stripe) {
        const elements = stripe.elements();
        const cardStyles = {
            base: {
                color: '#000',
                fontFamily: 'Poppins, sans-serif',
                fontSize: '16px'
            },
            invalid: {
                color: '#e63946',
                iconColor: '#e63946',
            }
        }
        const cardNumber = elements.create("cardNumber", {style: cardStyles, showIcon: true});
        const cardExpiry = elements.create("cardExpiry", {style: cardStyles});
        const cardCvc = elements.create("cardCvc", {style: cardStyles});
        cardNumber.mount('#stripeCardNumber');
        cardExpiry.mount('#stripeCardExpiry');
        cardCvc.mount('#stripeCardCVC');

        cardNumber.on('change', (e) => this.validateStripe(e));
        cardExpiry.on('change', (e) => this.validateStripe(e));
        cardCvc.on('change', (e) => this.validateStripe(e));


        this.form.addEventListener('submit', (e) => {
            if (this.usesCreditCard) {
                e.preventDefault();
                stripe.createToken(cardNumber, {
                    name: this.form.querySelector('#stripeCardHolder').textContent
                }).then((res) => {
                    if (res.error) {
                        this.form.querySelector('#stripeErrorNumber').textContent = res.error.message;
                    } else {
                        this.appendStripeToken(res.token);
                    }
                })
            }
        });
    }

    private appendStripeToken(token: Token) {
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        this.form.appendChild(hiddenInput);

        this.form.submit();
    }

    private validateStripe(e: StripeElementChangeEvent) {
        let errorContainer: HTMLElement = null;
        if (e.elementType === 'cardNumber') {
            errorContainer = this.form.querySelector('#stripeErrorNumber');
        } else if (e.elementType === 'cardExpiry') {
            errorContainer = this.form.querySelector('#stripeErrorExpiry');
        }

        if (errorContainer && e.error) {
            errorContainer.textContent = e.error.message;
        } else {
            errorContainer.textContent = '';
        }
    }

    private handleDifferentShippingAddress(e: Event) {
        const {checked} = this.differentShippingAddressToggle;
        console.log(this.differentShippingAddressTemplate);
        if (checked) {
            this.insertDifferentShippingAddressTemplate();
        } else {
            this.form.querySelector('#differentShippingAddressSection').remove();
        }
    }

    private insertDifferentShippingAddressTemplate() {
        const cloned = this.differentShippingAddressTemplate.content.cloneNode(true);
        const billingAddressSection = this.form.querySelector('#billingAddressSection');
        billingAddressSection.parentNode.insertBefore(cloned, billingAddressSection.nextElementSibling);
        this.addInputFocusEventListener();
    }

    private addInputFocusEventListener() {
        this.allInputs = this.form.querySelectorAll('input');
        this.allInputs.forEach(input =>{
            input.addEventListener('focus', (e) => this.handleInputFocus(e));
        });
    }

    private handleInputFocus(e: FocusEvent) {
        const clickedInput = e.target as HTMLInputElement;
        clickedInput.required = true;
    }
}