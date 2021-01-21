<?php
$links = [
    ['link' => 'dashboard', 'title' => 'Dashboard', 'icon' => 'dashboard'],
    ['link' => 'bestellungen', 'title' => 'Bestellungen', 'icon' => 'inbox'],
    ['link' => 'produkte', 'title' => 'Produkte', 'icon' => 'products'],
    ['link' => 'benutzer', 'title' => 'Benutzer', 'icon' => 'people'],
    ['link' => 'newsletter', 'title' => 'Newsletter', 'icon' => 'newsletter'],
    ['link' => 'versand', 'title' => 'Versandmethoden', 'icon' => 'delivery'],
    ['link' => 'zahlungsart', 'title' => 'Zahlungsarten', 'icon' => 'credit-card']
];
?>

<nav class="nav">
    <ul class="nav__list">
        <?php foreach ($links as $link): ?>
            <li class="nav__item <?php \Core\View::renderActiveClass("admin/${link['link']}", 'nav__item--active'); ?>">
                <a href="admin/<?php echo $link['link']; ?>" class="nav__link">
                    <?php echo \Core\View::getIcon($link['icon']); ?>
                    <span><?php echo $link['title']; ?></a></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="nav__bottom">
        <?php $profileLink = "admin/benutzer/edit/" . \App\Models\User::getLoggedIn()->id; ?>
        <div class="nav__item <?php \Core\View::renderActiveClass($profileLink, 'nav__item--active'); ?>">
            <a href="<?php echo $profileLink; ?>" class="nav__link">
                <?php echo \Core\View::getIcon('user') ?>
                <span>Mein Profil</span>
            </a>
        </div>
        <button class="nav__trigger"><?php echo \Core\View::getIcon('arrow-back') ?></button>
    </div>
</nav>