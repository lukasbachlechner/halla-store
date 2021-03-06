<div class="page__header">
    <h1>Alle Produkte (<?php echo count($products); ?>)</h1>

    <a class="button button--primary " href="admin/produkte/add"><?php echo \Core\View::getIcon('plus') ?>Neues Produkt</a>
</div>

<div class="list">
    <div class="list__head list__grid list__grid--products">
        <div id="productId">#</div>
        <div id="productImage"></div>
        <div id="productName">Name</div>
        <div id="productPrice">Preis</div>
        <div id="productInventory">Inventar</div>
        <div id="productStatus">Status</div>
    </div>
    <ul class="list__body">
        <?php foreach ($products as $product): ?>
            <li class="list__item">
                <a href="admin/produkte/edit/<?php echo $product->id; ?>" class="list__link list__grid list__grid--products">
                    <div><?php echo $product->id; ?></div>
                    <div class="list__image-wrapper"><img src="<?php echo $product->getImages()[0]->path; ?>" alt=""></div>
                    <div><?php echo $product->name; ?></div>
                    <div><?php echo \App\Models\Product::formatPrice($product->price); ?></div>
                    <div><?php echo $product->quantity_available; ?></div>
                    <div><?php echo \App\Models\Product::getActiveBadge($product->is_active); ?></div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="list__footer list__grid">
        Footer
    </div>
</div>