<form action="<?php echo $action; ?>" class="form section cart__section" method="post">
    <div class="section__header">
        <h1>Bestelladresse</h1>
    </div>
    <div class="order__wrapper">
        <div class="order__wrapper--left">
            <?php if (\App\Models\User::isLoggedIn()): ?>
                <section class="order__card">
                    <h2>Rechnungsadresse</h2>
                    <?php \Core\Form::renderRadioGroup('deliveryAddress', [
                        '1' => 'Adresse 1',
                        '2' => 'Adresse 2',
                    ]); ?>
                    <div class="form__group form__group--radio">
                        <input type='radio' name='deliveryAddress' id='newAddressChecked'
                               class="form__group--radio-form-input">
                        <label for="newAddressChecked" class="form__group--radio-label form__group--radio-label-form">Neue
                            Adresse</label>
                        <div class='form__group--radio-checkmark'>
                            <?php echo \Core\View::getIcon('checkmark'); ?>
                        </div>
                    </div>
                    <div class="form__group--radio-form" id="newAddressForm">
                        <?php \Core\View::renderPartial('address-form', ['action' => 'adresse/create/do']); ?>
                    </div>
                </section>
            <?php else: ?>
                <section class="order__card">
                    <h2>Rechnungsadresse</h2>
                    <?php \Core\View::renderPartial('address-form', ['action' => 'adresse/create/do']); ?>
                    <div class="mt--5">
                        <?php \Core\Form::renderGroup('differentShippingAddress', 'Lieferadresse weicht von Rechnungsadresse ab', 'checkbox'); ?>
                    </div>
                </section>
            <?php endif; ?>

            <section class="order__card order__card--shipping-address">
                <h2>Lieferadresse</h2>

                <?php \Core\View::renderPartial('address-form', ['action' => 'adresse/create/do']); ?>
            </section>

            <section class="order__card">
                <h2>Versandart</h2>
                <?php \Core\Form::renderRadioGroup('deliveryMethod', [
                    '1' => 'Versandart 1 (€ 12,–)',
                    '2' => 'Versandart 2 (€ 5,99)',
                ]); ?>
            </section>

            <section class="order__card">
                <h2>Zahlungsmethode</h2>
                <?php \Core\Form::renderRadioGroup('paymentMethod', [
                    '1' => 'Zahlungsmethode 1',
                    '2' => 'Zahlungsmethode 2',
                ]); ?>
                <div class="form__group form__group--radio">
                    <input type='radio' name='paymentMethod' id='newPaymentChecked'
                           class="form__group--radio-form-input">
                    <label for="newPaymentChecked" class="form__group--radio-label form__group--radio-label-form">Neue
                        Zahlungsmethode</label>
                    <div class='form__group--radio-checkmark'>
                        <?php echo \Core\View::getIcon('checkmark'); ?>
                    </div>
                </div>
                <div class="form__group--radio-form" id="newPaymentForm">
                    <?php \Core\View::renderPartial('address-form', ['action' => 'adresse/create/do']); ?>
                </div>
            </section>
        </div>

        <div class="order__wrapper--right">
            <?php \Core\View::renderPartial('order-summary', [
                'products' => $products,
                'total' => $total,
                'tax' => $tax
            ]); ?>

        </div>


    </div>
</form>