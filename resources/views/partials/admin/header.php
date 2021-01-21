<header class="header__wrapper">
    <div class="header__left">
        <a href="admin" class="header__logo-wrapper">
            <?php \Core\View::renderPartial('logo'); ?>
        </a>
        <a href="/">
            <?php echo \Core\View::getIcon('external-link'); ?>
        </a>
    </div>


    <div class="header__right">
        <a href="logout/do">Logout</a>
        <button id="darkModeToggle">
            Dark-Mode ein/aus
        </button>
    </div>
</header>