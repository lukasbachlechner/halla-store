<section class="section">
    <?php if(\App\Models\User::isLoggedIn()): ?>
    <h1>Hallo, hoe</h1>
    <?php endif; ?>
    <h2>Neue Produkte</h2>

    <ul class="product__list">
        <?php foreach($products as $product): ?>
            <li class="product__item">
                <a href="produkte/<?php echo $product->slug; ?>" class="product__card">
                        <img src="https://via.placeholder.com/412x290" alt="" class="product__image">
                        <div class="product__text">
                            <h3><?php echo $product->name; ?></h3>
                            <p><?php echo \App\Models\Product::formatPrice($product->price); ?></p>
                        </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>