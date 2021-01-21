<section>
    <form action="admin/bestellungen/edit/<?php echo $order->id; ?>/do" method="post" class="form">

        <div class="page__header">
            <h1>Bestellung #<?php echo $order->id; ?> bearbeiten</h1>
            <div class="button__group button__group--mobile-float">
                <a class="button button--error"
                   href="admin/versand"><?php echo \Core\View::getIcon('menu-close') ?>
                    <span>Abbrechen</span>
                </a>
                <button class="button button--success"><?php echo \Core\View::getIcon('save') ?>
                    <span>Aktualisieren</span>
                </button>
            </div>
        </div>

        <?php \Core\View::renderPartial('errors'); ?>

        <div class="form__columns">
            <div class="form__columns--left">

                <fieldset>
                    <legend>Zahlung</legend>

                    <div class="grid">
                        <div>
                            <h2>Adresse</h2>
                            <?php echo $billingAddress->getFormatted(); ?>
                        </div>

                        <div>
                            <h2>Zahlungsart</h2>
                            <p><?php echo $paymentMethod->name; ?> </p>
                        </div>
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Lieferung</legend>
                    <div class="grid">
                        <div>
                            <h2>Adresse</h2>
                            <?php echo $shippingAddress->getFormatted(); ?>
                        </div>

                        <div>
                            <h2>Liefermethode</h2>
                            <p><?php echo $shippingMethod->name; ?></p>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Sendungsverfolgung</legend>
                    <?php \Core\Form::renderGroup('trackingNumber', 'Tracking-Nummer', 'text', ['value' => $order->tracking_number]); ?>
                </fieldset>

                <fieldset>
                    <legend>Kundeninformationen</legend>
                    <?php if ($user->first_name === 'Gastbenutzer'): ?>
                        <p><?php echo $user->first_name; ?></p>
                        <p><?php echo $user->email; ?></p>
                    <?php else: ?>
                        <p>Kundennummer: <?php echo $user->id; ?></p>
                        <p><?php echo $user->getFullName(); ?></p>
                        <p><?php echo $user->email; ?></p>
                    <?php endif; ?>
                </fieldset>

                <fieldset>
                    <legend>Rechnung</legend>
                    <ul class="orders__products">
                        <?php foreach($products as $product): ?>
                            <li class="orders__products-item">
                                <p><?php echo $product->id; ?></p>
                                <p><?php echo $product->name; ?></p>
                                <p class="text--right"><?php echo $product->quantity; ?> Stk.</p>
                                <p class="text--right"><?php echo \App\Models\Product::formatPrice($product->subtotal); ?></p>
                            </li>

                        <?php endforeach; ?>
                        <li class="orders__products-item orders__products-item--last">
                            <span>Versand</span>
                            <span><?php echo \App\Models\Product::formatPrice($shippingMethod->price); ?></span>
                        </li>
                        <li class="orders__products-item orders__products-item--last">
                            <span>Zahlungsspesen</span>
                            <span><?php echo \App\Models\Product::formatPrice($paymentMethod->price); ?></span>
                        </li>
                        <li class="orders__products-item orders__products-item--last">
                            <span>Summe</span>
                            <span><?php echo \App\Models\Product::formatPrice($order->total); ?></span>
                        </li>
                    </ul>
                </fieldset>
            </div>


            <div class="form__columns--right">
                <fieldset>
                    <legend>Bestelldatum</legend>
                    <p><?php echo $order->getFormattedDate(); ?></p>
                </fieldset>

                <fieldset>
                    <legend>Zuletzt bearbeitet</legend>
                    <p><?php echo $order->getFormattedDate(false); ?></p>
                </fieldset>

                <fieldset>
                    <legend>Status</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('orderState', 'Bestellstatus', 'select', ['value' => $order->order_state, 'selectOptions' => [
                            'created' => 'Erstellt',
                            'in_progress' => 'In Bearbeitung',
                            'delivered' => 'Zugestellt',
                            'refunded' => 'Storniert',
                        ]]); ?>
                    </div>

                    <div class="form__row">
                        <?php \Core\Form::renderGroup('paymentState', 'Zahlungsstatus', 'select', ['value' => $order->payment_state, 'selectOptions' => [
                            'open' => 'Offen',
                            'paid' => 'Bezahlt',
                            'refunded' => 'Storniert',
                        ]]); ?>
                    </div>
                </fieldset>
            </div>
        </div>

    </form>
</section>