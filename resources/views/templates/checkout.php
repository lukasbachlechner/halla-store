<form action="bestellen/prepare/do" class="form section cart__section" method="post" id="checkoutForm">
    <div class="section__header">
        <h1>Bestellung abschließen</h1>
    </div>
    <?php \Core\View::renderPartial('errors'); ?>
    <div class="order__wrapper">
        <div class="order__wrapper--left">

            <section class="order__card" id="billingAddressSection">
                <h2>Rechnungsadresse</h2>

                <?php if (\App\Models\User::isLoggedIn()): ?>
                    <?php foreach ($addresses as $key => $address): ?>
                        <div class="form__group form__group--radio">
                            <input type="radio" name="billingAddress" id="billing-<?php echo $address->id; ?>"
                                   value="<?php echo $address->id; ?>" <?php echo $key === 0 ? 'checked' : ''; ?>>
                            <div class='form__group--radio-checkmark'>
                                <?php echo \Core\View::getIcon('checkmark'); ?>
                            </div>
                            <label for="billing-<?php echo $address->id; ?>"
                                   class='form__group--radio-label'><span><?php echo $address->getShortName(); ?></span></label>
                        </div>
                    <?php endforeach; ?>

                    <?php
                    $shouldBeChecked = false;
                    if (\Core\Session::old("billingAddress") === 'new' || count($addresses) === 0) {
                        $shouldBeChecked = true;
                    }
                    ?>
                    <div class="form__group form__group--radio">
                        <input type='radio' name='billingAddress' id='newAddressChecked'
                               class="form__group--radio-form-input"
                               value="new" <?php echo $shouldBeChecked ? 'checked' : ''; ?>>
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
                    <?php if (\App\Models\User::isLoggedIn()): ?>
                        <?php foreach ($addresses as $key => $address): ?>
                            <div class="form__group form__group--radio">
                                <input type="radio" name="shippingAddress" id="shipping-<?php echo $address->id; ?>"
                                       value="<?php echo $address->id; ?>" <?php echo $key === 0 ? 'checked' : ''; ?>>
                                <div class='form__group--radio-checkmark'>
                                    <?php echo \Core\View::getIcon('checkmark'); ?>
                                </div>
                                <label for="shipping-<?php echo $address->id; ?>"
                                       class='form__group--radio-label'><span><?php echo $address->getShortName(); ?></span></label>
                            </div>
                        <?php endforeach; ?>

                        <?php
                        $shouldBeChecked = false;
                        if (\Core\Session::old("shippingAddress") === 'new' || count($addresses) === 0) {
                            $shouldBeChecked = true;
                        }
                        ?>
                        <div class="form__group form__group--radio">
                            <input type='radio' name='shippingAddress' id='newShippingAddressChecked'
                                   class="form__group--radio-form-input"
                                   value="new" <?php echo $shouldBeChecked ? 'checked' : ''; ?>>
                            <label for="newShippingAddressChecked" class="form__group--radio-label form__group--radio-label-form">Neue
                                Adresse</label>
                            <div class='form__group--radio-checkmark'>
                                <?php echo \Core\View::getIcon('checkmark'); ?>
                            </div>
                        </div>
                        <div class="form__group--radio-form" id="newShippingAddressForm">
                            <?php \Core\View::renderPartial('address-form', ['prefix' => 'shipping']); ?>
                        </div>

                    <?php else: ?>
                        <?php \Core\View::renderPartial('address-form', ['prefix' => 'shipping']); ?>
                    <?php endif; ?>
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
                'tax' => $tax,
                'buttonText' => 'Bestellung überprüfen'
            ]); ?>

        </div>


    </div>
</form>