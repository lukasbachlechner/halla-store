<div class="page__header">
    <h1>Alle Bestellungen (<?php echo count($orders); ?>)</h1>
</div>
<?php foreach ($groupedOrders as $level => $orders): ?>

    <h2><?php echo $level; ?></h2>

    <div class="list">
        <header class="list__head list__grid">
            <div>#</div>
            <div>Kunde</div>
            <div>Summe</div>
            <div>Zahlungsstatus</div>
            <div>Zahlungsart</div>
        </header>
        <ul class="list__body">
            <?php foreach ($orders as $order): ?>
                <li class="list__item <?php echo $order->getOrderBorder(); ?>">
                    <a href="admin/bestellungen/edit/<?php echo $order->id; ?>" class="list__link list__grid">
                        <div><?php echo $order->id; ?></div>
                        <div><?php echo $order->recipient->getFullName(); ?></div>
                        <div><?php echo \App\Models\Product::formatPrice($order->total); ?></div>
                        <div><?php echo $order->getPaymentBadge(); ?></div>
                        <div><?php echo $order->paymentMethod->name; ?></div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <footer class="list__footer list__grid">

        </footer>
    </div>
<?php endforeach; ?>
