<?php
$links = [
    ['link' => 'dashboard', 'title' => 'Dashboard', 'icon' => 'dashboard'],
    ['link' => 'bestellungen', 'title' => 'Bestellungen', 'icon' => 'orders'],
    ['link' => 'produkte', 'title' => 'Produkte', 'icon' => 'products'],
    ['link' => 'benutzer', 'title' => 'Benutzer', 'icon' => 'user'],
    ['link' => 'newsletter', 'title' => 'Newsletter', 'icon' => 'newsletter']
];
?>

<nav class="nav">
    <ul class="nav__list">
        <?php foreach($links as $link): ?>
            <li class="nav__item <?php \Core\View::renderActiveClass("admin/${link['link']}", 'nav__item--active'); ?>">
                <a href="admin/<?php echo $link['link']; ?>" class="nav__link">
                    <?php echo \Core\View::getIcon($link['icon']); ?>
                    <span><?php echo $link['title']; ?></a></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="nav__bottom">
        <button class="nav__trigger"><?php echo \Core\View::getIcon('arrow-back') ?></button>
    </div>
</nav>