<div class="order__card order__summary">
    <h2>Bestellübersicht</h2>

    <ul class="order__summary-list">
        <?php foreach ($products as $product): ?>
            <li class="order__summary-item">
                <a href="produkte/<?php echo $product->slug; ?>" class="order__summary-img-wrapper">
                    <img src="<?php echo $product->getImages(true)[0]->path; ?>" alt="">
                    <span class="order__summary-quantity"><?php echo $product->quantity; ?></span>
                </a>
                <span><?php echo $product->name; ?></span>
                <span><?php echo \App\Models\Product::formatPrice($product->subtotal); ?></span>
            </li>
        <?php endforeach; ?>

        <li class="order__summary-item order__summary-item--last order__summary-item--total mt--4">
            <span>Warensumme</span>
            <span class="order__summary-total"><?php echo \App\Models\Product::formatPrice($total); ?></span>
        </li>

        <?php if (isset($shipping)): ?>
            <li class="order__summary-item order__summary-item--last">

                <span>Versand</span>
                <span class="order__summary-total">
                <?php echo \App\Models\Product::formatPrice($shipping->price); ?>
            </span>

            </li>
        <?php endif; ?>

        <?php if (isset($payment) && $payment !== 'stripe' && $payment->price > 0): ?>
            <li class="order__summary-item order__summary-item--last">

                <span>Zahlung (<?php echo $payment->name; ?>)</span>
                <span class="order__summary-total">
                <?php echo \App\Models\Product::formatPrice($payment->price); ?>
            </span>

            </li>
        <?php endif; ?>

        <?php if (isset($payment)): ?>
        <?php
            $paymentPrice = $payment !== 'stripe' ? $payment->price : 0;
            $grandTotal = $total + $shipping->price + $paymentPrice; ?>
        <li class="order__summary-item order__summary-item--last order__summary-item--total">
            <span>Gesamt</span>
            <span class="order__summary-total"><?php echo \App\Models\Product::formatPrice($grandTotal); ?></span>
        </li>
        <?php endif; ?>

        <li class="order__summary-item order__summary-item--last order__summary-item--tax">
            <span>inkl. USt.</span>
            <span class="order__summary-total"><?php echo \App\Models\Product::formatPrice($tax); ?></span>
        </li>

        <button class="button button--primary button--full-width mt--4">
            <span><?php echo $buttonText; ?></span> <?php echo \Core\View::getIcon('arrow-forward'); ?>
        </button>
    </ul>
</div>