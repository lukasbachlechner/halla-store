<div class="page__header">
    <h1>Alle Zahlungsarten (<?php echo count($paymentMethods); ?>)</h1>

    <a class="button button--primary " href="admin/zahlungsart/add"><?php echo \Core\View::getIcon('plus') ?><span>Neue Zahlungsart</span></a>
</div>

<div class="list">
    <header class="list__head list__grid">
        <div>#</div>
        <div>Name</div>
        <div>Preis</div>
    </header>
    <ul class="list__body">
        <?php foreach ($paymentMethods as $method): ?>
            <li class="list__item">
                <a href="admin/zahlungsart/edit/<?php echo $method->id; ?>" class="list__link list__grid">
                    <div><?php echo $method->id; ?></div>
                    <div><?php echo $method->name; ?></div>
                    <div><?php echo \App\Models\Product::formatPrice($method->price); ?></div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <footer class="list__footer list__grid">

    </footer>
</div>