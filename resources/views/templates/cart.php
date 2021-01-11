<section class="section cart__section">
    <h1>Warenkorb</h1>
    <?php if (!empty($products)): ?>
        <form action="warenkorb/update/do" method="post">
            <header class="cart__head cart__grid">
                <div id="productImage"></div>
                <div id="productName"></div>
                <div id="productPrice">Stückpreis</div>
                <div id="productQuantity" class="text--center">Menge</div>
                <div id="productTotal" class="text--right">Summe</div>
            </header>
            <ul class="cart__list">
                <?php foreach ($products as $product): ?>
                    <li class="cart__item cart__grid">
                        <a href="produkte/<?php echo $product->slug; ?>" class="cart__image-wrapper">
                            <img
                                    src="<?php echo $product->getImages(true)[0]->path; ?>" alt=""></a>
                        <div><?php echo $product->name; ?></div>
                        <div><?php echo \App\Models\Product::formatPrice($product->price); ?></div>
                        <div class="text--center cart__quantity">
                            <label for="quantityInput-<?php echo $product->id; ?>" class="sr-only">Menge</label>
                            <a href="warenkorb/removeOne/<?php echo $product->id; ?>/do"><?php echo \Core\View::getIcon('minus') ?></a>
                            <input class="form__input" type="number" min="1" step="1"
                                   id="quantityInput-<?php echo $product->id; ?>" name="<?php echo $product->id; ?>"
                                   value="<?php echo $product->quantity; ?>">
                            <a href="warenkorb/addOne/<?php echo $product->id; ?>/do"><?php echo \Core\View::getIcon('plus') ?></a>
                        </div>
                        <div class="text--right"><?php echo \App\Models\Product::formatPrice($product->subtotal); ?></div>
                        <a href="warenkorb/delete/<?php echo $product->id; ?>/do"
                           class="cart__delete"><?php echo \Core\View::getIcon('trash'); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <footer class="cart__footer cart__grid">
                <div class="cart__total text--right"><?php echo \App\Models\Product::formatPrice($total); ?></div>
            </footer>

            <div class="cart__actions">
                <a href="<?php echo \Core\Session::get('referer') ?>" class="button button--secondary"><?php echo \Core\View::getIcon('arrow-back') ?><span>Weiter einkaufen</span></a>
                <button class="button button--primary" type="submit"><?php echo \Core\View::getIcon('refresh') ?><span>Aktualisieren</span></button>
                <a href="bestellen"
                   class="button button--primary"><span>Zur Kasse</span><?php echo \Core\View::getIcon('arrow-forward') ?>
                </a>
            </div>
        </form>
    <?php else: ?>
        <p>Nichts im Warenkorb.</p>
    <?php endif; ?>
</section>