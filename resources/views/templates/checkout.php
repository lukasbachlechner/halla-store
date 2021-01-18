<?php \Core\View::renderPartial('errors'); ?>
<form action="bestellen/create/do" class="form section cart__section" method="post" id="checkoutForm">
    <div class="section__header">
        <h1>Bestellung abschließen</h1>
    </div>
    <div class="order__wrapper">
        <div class="order__wrapper--left">

            <section class="order__card" id="billingAddressSection">
                <h2>Rechnungsadresse</h2>

                <?php if (\App\Models\User::isLoggedIn()): ?>
                    <?php \Core\Form::renderRadioGroup('billingAddress', [
                        '1' => 'Adresse 1',
                        '2' => 'Adresse 2',
                    ]); ?>
                    <div class="form__group form__group--radio">
                        <input type='radio' name='billingAddress' id='newAddressChecked'
                               class="form__group--radio-form-input"
                               value="new" <?php echo \Core\Session::old("billingAddress") === 'new' ? 'checked' : ''; ?>>
                        <label for="newAddressChecked" class="form__group--radio-label form__group--radio-label-form">Neue
                            Adresse</label>
                        <div class='form__group--radio-checkmark'>
                            <?php echo \Core\View::getIcon('checkmark'); ?>
                        </div>
                    </div>
                    <div class="form__group--radio-form" id="newAddressForm">
                        <?php \Core\View::renderPartial('address-form'); ?>
                    </div>

                <?php else: ?>
                    <?php \Core\View::renderPartial('address-form'); ?>

                <?php endif; ?>
                <div class="mt--5">
                    <?php \Core\Form::renderGroup('differentShippingAddressToggle', 'Lieferadresse weicht von Rechnungsadresse ab', 'checkbox'); ?>
                </div>
            </section>

            <template id="differentShippingAddressTemplate">
                <section class="order__card order__card--shipping-address" id="differentShippingAddressSection">
                    <h2>Lieferadresse</h2>
                    <?php \Core\View::renderPartial('address-form', ['prefix' => 'shipping']); ?>
                </section>
            </template>

            <section class="order__card">
                <h2>Versandart</h2>

                <?php foreach ($deliveryMethods as $key => $method): ?>
                    <div class="form__group form__group--radio">
                        <input type="radio" name="deliveryMethod" id="delivery-<?php echo $method->id; ?>"
                               value="<?php echo $method->id; ?>"
                               data-cost="<?php echo $method->price; ?>" <?php echo $key === 0 ? 'checked' : ''; ?>>
                        <div class='form__group--radio-checkmark'>
                            <?php echo \Core\View::getIcon('checkmark'); ?>
                        </div>
                        <label for="delivery-<?php echo $method->id; ?>"
                               class='form__group--radio-label'><span><?php echo $method->name; ?></span><span><?php echo \App\Models\Product::formatPrice($method->price); ?></span></label>
                    </div>
                <?php endforeach; ?>
            </section>

            <section class="order__card">
                <h2>Zahlungsmethode</h2>

                <?php foreach ($paymentMethods as $key => $method): ?>
                    <div class="form__group form__group--radio">
                        <input type="radio" name="paymentMethod" id="payment-<?php echo $method->id; ?>"
                               value="<?php echo $method->id; ?>"
                               data-cost="<?php echo $method->price; ?>" <?php echo $key === 0 ? 'checked' : ''; ?>>
                        <div class='form__group--radio-checkmark'>
                            <?php echo \Core\View::getIcon('checkmark'); ?>
                        </div>
                        <label for="payment-<?php echo $method->id; ?>"
                               class='form__group--radio-label'><span><?php echo $method->name; ?></span><span><?php echo $method->price > 0 ? "+ " . \App\Models\Product::formatPrice($method->price) : ''; ?></span></label>
                    </div>
                <?php endforeach; ?>

                <div class="form__group form__group--radio">
                    <input type='radio' name='paymentMethod' id='newPaymentChecked'
                           class="form__group--radio-form-input" value="stripe">
                    <label for="newPaymentChecked" class="form__group--radio-label form__group--radio-label-form">Kreditkarte</label>
                    <div class='form__group--radio-checkmark'>
                        <?php echo \Core\View::getIcon('checkmark'); ?>
                    </div>
                </div>
                <div class="form__group--radio-form" id="newPaymentForm">
                    <?php \Core\View::renderPartial('credit-card-form'); ?>
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