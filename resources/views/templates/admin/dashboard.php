<div class="page__header">
    <h1>Dashboard</h1>
</div>

<h2>Umsatzübersicht <?php echo date("Y") ?></h2>
<div class="list">
    <header class="list__head list__grid">
        <div>Monat</div>
        <div>Umsatz</div>
    </header>
    <ul class="list__body">
        <?php foreach ($revenues as $revenue): ?>
            <li class="list__item list__grid">
                <div><?php echo strftime("%B", $revenue['month']); ?></div>
                <div><?php echo \App\Models\Product::formatPrice($revenue['sum']); ?></div>
            </li>
        <?php endforeach; ?>
    </ul>

    <footer class="list__footer list__grid">
        <div>Summe</div>
        <div><?php echo \App\Models\Product::formatPrice($sum); ?></div>
    </footer>
</div>