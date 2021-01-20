<div class="page__header">
    <h1>Alle Bestellungen (<?php echo count($orders); ?>)</h1>
</div>

<div class="list">
    <header class="list__head list__grid">
        <div>#</div>
        <div>Name</div>
        <div>Preis</div>
    </header>
    <ul class="list__body">
        <?php foreach ($orders as $order): ?>
            <li class="list__item">
                <a href="admin/bestellung/edit/<?php echo $order->id; ?>" class="list__link list__grid">
                    <div><?php echo $order->id; ?></div>
                    <div><?php echo \App\Models\Product::formatPrice($order->total); ?></div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <footer class="list__footer list__grid">

    </footer>
</div>
