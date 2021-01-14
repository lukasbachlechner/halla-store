<section class="section cart__section">
    <form action="warenkorb/update/do" method="post">
        <div class="section__header">
            <h1>Mein Warenkorb</h1>
            <?php if (!empty($products)): ?>
                <button class="button button--primary" type="submit">
                    <?php echo \Core\View::getIcon('refresh') ?>
                    <span class="sr-only">Aktualisieren</span>
                </button>
            <?php endif; ?>
        </div>
        <?php if (!empty($products)): ?>

            <div class="cart__wrapper">
                <header class="cart__head cart__grid sr-only">
                    <span id="productImage"></span>
                    <span id="productName"></span>
                    <span id="productPrice">Stückpreis</span>
                    <span id="productQuantity" class="text--center">Menge</span>
                    <span id="productTotal" class="text--right">Gesamtpreis</span>
                </header>
                <ul class="cart__list">
                    <?php foreach ($products as $product): ?>
                        <li class="cart__item">
                            <div class="cart__grid">
                                <a href="produkte/<?php echo $product->slug; ?>" class="cart__image-wrapper">
                                    <img src="<?php echo $product->getImages(true)[0]->path; ?>" alt="">
                                </a>
                                <span class="cart__item-name"><?php echo $product->name; ?></span>
                                <span class="cart__item-single-price"><?php echo \App\Models\Product::formatPrice($product->price); ?></span>
                                <div class="text--center cart__quantity">
                                    <label for="quantityInput-<?php echo $product->id; ?>" class="sr-only">Menge</label>
                                    <a href="warenkorb/removeOne/<?php echo $product->id; ?>/do"><?php echo \Core\View::getIcon('minus') ?></a>
                                    <input class="form__input" type="number" min="1" step="1"
                                           id="quantityInput-<?php echo $product->id; ?>"
                                           name="<?php echo $product->id; ?>"
                                           value="<?php echo $product->quantity; ?>">
                                    <a href="warenkorb/addOne/<?php echo $product->id; ?>/do"><?php echo \Core\View::getIcon('plus') ?></a>
                                </div>
                                <span class="text--right cart__item-subtotal"><?php echo \App\Models\Product::formatPrice($product->subtotal); ?></span>
                            </div>
                            <a href="warenkorb/delete/<?php echo $product->id; ?>/do"
                               class="cart__delete"><?php echo \Core\View::getIcon('menu-close'); ?></a>
                        </li>

                    <?php endforeach; ?>
                </ul>
                <footer class="cart__footer">
                    <div class="cart__total">
                        <div class="cart__total-item">
                            <span>Summe</span>
                            <span class="text--right"><?php echo \App\Models\Product::formatPrice($total); ?></span>
                        </div>
                        <div class="cart__total-item cart__total--tax">
                            <span>USt.</span>
                            <span class="text--right"><?php echo \App\Models\Product::formatPrice($tax); ?></span>
                        </div>
                        <a href="bestellen"
                           class="button button--primary button--full-width"><span>Zur Kassa</span><?php echo \Core\View::getIcon('arrow-forward') ?>
                        </a>
                    </div>
                </footer>
            </div>

            <div class="cart__actions">
                <a href="<?php echo \Core\Session::get('referer') ?>"
                   class="button button--secondary"><?php echo \Core\View::getIcon('arrow-back') ?><span>Weiter einkaufen</span></a>
            </div>
        <?php else: ?>
            <p>Nichts im Warenkorb.</p>
        <?php endif; ?>
    </form>
</section>