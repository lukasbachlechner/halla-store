<div class="section cart__section">

    <?php \Core\View::renderPartial('errors'); ?>
    <div class="section__header">
        <h1>Bestellung prüfen</h1>
    </div>
    <div class="order__wrapper">
        <div class="order__wrapper--left order__wrapper--half">
            <section class="order__card">
                <h2>Rechnungsadresse</h2>
                <?php echo $orderToReview['billingAddress']->getFormatted(); ?>
            </section>

            <section class="order__card">
                <h2>Lieferadresse</h2>
                <?php echo $orderToReview['shippingAddress']->getFormatted(); ?>
            </section>

            <section class="order__card">
                <h2>Versandart</h2>
                <?php echo $orderToReview['deliveryMethod']->getFormatted(); ?>
            </section>

            <section class="order__card">
                <h2>Zahlungsmethode</h2>
                <?php if ($orderToReview['paymentMethod'] !== 'stripe'): ?>
                    <?php echo $orderToReview['paymentMethod']->getFormatted(); ?>
                <?php else: ?>
                    <p>Kreditkarte (via Stripe)</p>
                <?php endif; ?>
            </section>
        </div>

        <div class="order__wrapper--right">
            <form action="bestellen/create/do" method="post">
                <?php \Core\View::renderPartial('order-summary', [
                    'products' => $products,
                    'total' => $total,
                    'tax' => $tax,
                    'shipping' => $orderToReview['deliveryMethod'],
                    'payment' => $orderToReview['paymentMethod'],
                    'buttonText' => 'Zahlungspflichtig bestellen'
                ]); ?>
            </form>
        </div>
    </div>
</div>