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

        <li class="order__summary-item order__summary-item--last order__summary-item--shipping">
            <span>Versand</span>
            <span class="order__summary-total"><?php echo \App\Models\Product::formatPrice($tax); ?></span>
        </li>

        <li class="order__summary-item order__summary-item--last order__summary-item--total">
            <span>Summe</span>
            <span class="order__summary-total"><?php echo \App\Models\Product::formatPrice($total); ?></span>
        </li>

        <li class="order__summary-item order__summary-item--last order__summary-item--tax">
            <span>USt.</span>
            <span class="order__summary-total"><?php echo \App\Models\Product::formatPrice($tax); ?></span>
        </li>

        <button class="button button--primary button--full-width mt--4"><span>Zahlungspflichtig bestellen</span> <?php echo \Core\View::getIcon('arrow-forward'); ?>
        </button>
    </ul>
</div>