<header>
    <nav class="nav">
        <div class="container nav__container">
            <a href="<?php echo BASE_URL; ?>" class="nav__logo-wrapper">
                <?php \Core\View::renderPartial('logo'); ?>
            </a>

            <ul class="nav__list nav__main-list" id="navMainList">
                <?php
                $listItems = [
                    ['link' => 'testroute', 'description' => 'Wohnen'],
                    ['link' => '#', 'description' => 'Schlafen'],
                    ['link' => '#', 'description' => 'Essen']
                ];
                ?>
                <?php foreach ($listItems as $listItem): ?>
                    <li class="nav__item nav__main-item"><a
                                class="nav__link <?php \Core\View::renderActiveClass($listItem['link'], 'nav__link--active') ?>"
                                href="<?php echo $listItem['link']; ?>">

                            <?php echo $listItem['description']; ?></a></li>
                <?php endforeach; ?>
            </ul>

            <ul class="nav__list nav__secondary-list">
                <li class="nav__item">
                    <a class="nav__link" href="#">
                        <div class="nav__icon-wrapper">
                            <img class="nav__icon" src="storage/assets/svg/icons/cart.svg" alt="">
                            <span class="nav__icon-badge">4</span>
                        </div>
                        <span class="sr-only">Warenkorb</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="<?php echo \App\Models\User::isLoggedIn() ? 'profil' : 'login'; ?>">
                        <div class="nav__icon-wrapper">
                            <img class="nav__icon" src="storage/assets/svg/icons/user.svg" alt="">
                        </div>
                        <span class="sr-only">Mein Profil</span>
                    </a>
                    <?php \Core\View::renderPartial('micro-login'); ?>
                </li>

                <li class="nav__item nav__menu-trigger">
                    <button class="nav__link" id="menuTrigger">
                        <div class="nav__icon-wrapper">
                            <img class="nav__icon" src="storage/assets/svg/icons/menu.svg" alt="">
                        </div>
                        <span class="sr-only">Menü</span>
                    </button>
                </li>
            </ul>
        </div>
    </nav>
</header>
