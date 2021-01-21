<div class="section cart__section">
    <div class="section__header">
        <h1>Deine Bestellung #<?php echo $order->id ?> vom <?php echo $order->getFormattedDate(true, true); ?></h1>
        <span><?php echo $order->getOrderBadge(); ?></span>
    </div>
    <?php \Core\View::renderPartial('errors'); ?>
    <?php \Core\View::renderPartial('success'); ?>
    <div class="order__wrapper order__wrapper--half">
        <div class="order__wrapper--left">
            <section class="order__card">
                <h2>Rechnungsadresse</h2>
                <?php echo $billingAddress->getFormatted(); ?>
            </section>

            <section class="order__card">
                <h2>Lieferadresse</h2>
                <?php echo $shippingAddress->getFormatted(); ?>
            </section>

            <section class="order__card">
                <h2>Versandstatus</h2>
                <?php if ($order->order_state !== 'shipped'): ?>
                    <p>Deine Bestellung wurde noch nicht versandt.</p>
                <?php else: ?>
                    <p>Deine Bestellung ist auf dem Weg zu dir!</p>
                    <p>
                        Sendungsnummer: <?php echo empty($order->tracking_number) ? 'nicht verfügbar' : $order->tracking_number; ?>
                    </p>
                <?php endif; ?>
            </section>

        </div>

        <div class="order__wrapper--right">
            <section class="order__card">
                <h2>Produkte</h2>
                <ul class="order__list">
                    <?php foreach ($products as $product): ?>
                        <a href="produkte/<?php echo $product->slug; ?>" class="order__link">
                            <li class="order__item">
                                <span><?php echo $product->id; ?></span>
                                <span>
                                    <span class="order__img-wrapper">
                                        <img src="<?php echo $product->getThumbnail(); ?>" alt="">
                                    </span>
                                </span>
                                <span><?php echo $product->quantity; ?> Stk.</span>
                                <span class="text--right"><?php echo \App\Models\Product::formatPrice($product->subtotal); ?></span>
                            </li>
                        </a>
                    <?php endforeach; ?>

                    <li class="order__item order__item--last">
                        <span class="text--right">Versand</span>
                        <span class="text--right"><?php echo \App\Models\Product::formatPrice($shippingMethod->price); ?></span>
                    </li>

                    <?php if ($paymentMethod->price > 0): ?>
                        <li class="order__item order__item--last">
                            <span class="text--right"><?php echo $paymentMethod->name; ?></span>
                            <span class="text--right"><?php echo \App\Models\Product::formatPrice($paymentMethod->price); ?></span>
                        </li>
                    <?php endif; ?>

                    <li class="order__item order__item--last">
                        <span class="text--right font--bold">Gesamt</span>
                        <span class="text--right font--bold"><?php echo \App\Models\Product::formatPrice($order->total); ?></span>
                    </li>

                </ul>
            </section>

            <?php if ($order->order_state === 'created'): ?>

                <section class="order__card">
                    <h2>Versehentlich bestellt?</h2>
                    <a href="profil/bestellung/storno/<?php echo $order->id; ?>/do" class="button button--error">
                        <?php echo \Core\View::getIcon('trash') ?>
                        <span>Bestellung stornieren</span>
                    </a>
                </section>

            <?php endif; ?>
        </div>


    </div>
</div>