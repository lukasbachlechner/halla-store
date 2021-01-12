<section class="section cart__section">
    <h1>Meine Wunschliste</h1>
    <?php if (!empty($products)): ?>
        <header class="cart__head sr-only">
            <div id="productPrice">Stückpreis</div>
        </header>
        <ul class="cart__list">
            <?php foreach ($products as $product): ?>
                <li class="cart__item cart__grid">
                    <a href="produkte/<?php echo $product->slug; ?>" class="cart__image-wrapper">
                        <img src="<?php echo $product->getImages(true)[0]->path; ?>" alt=""></a>
                    <div><?php echo $product->name; ?></div>
                    <div><?php echo \App\Models\Product::formatPrice($product->price); ?></div>
                    <a href="warenkorb/add/<?php echo $product->id; ?>/do/true" class="button button--primary">
                        <?php echo \Core\View::getIcon('cart'); ?></a>
                    <a href="wunschliste/delete/<?php echo $product->id; ?>/do"
                       class="cart__delete"><?php echo \Core\View::getIcon('menu-close'); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="cart__actions">
            <a href="<?php echo \Core\Session::get('referer') ?>"
               class="button button--secondary"><?php echo \Core\View::getIcon('arrow-back') ?>
                <span>Weiter einkaufen</span></a>

        </div>
    <?php else: ?>
        <p class="mb--4">Deine Wunschliste ist leer - vielleicht gefallen dir diese Produkte?</p>
        <?php \Core\View::renderPartial('product-list', [
                'products' => $randomProducts
        ]); ?>
    <?php endif; ?>
</section>