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
                    <a class="nav__link" href="wunschliste">
                        <div class="nav__icon-wrapper">
                            <?php echo \Core\View::getIcon('heart'); ?>
                            <?php \App\Controllers\WishlistController::displayWishlistBadge(); ?>
                        </div>
                        <span class="sr-only">Wunschliste</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="warenkorb">
                        <div class="nav__icon-wrapper">
                            <?php echo \Core\View::getIcon('cart'); ?>
                            <?php \App\Controllers\CartController::displayCartBadge(); ?>
                        </div>
                        <span class="sr-only">Warenkorb</span>
                    </a>
                </li>

                <li class="nav__item">
                    <?php
                        $profileLink = 'login';
                        if(\App\Models\User::isLoggedIn()) {
                            $loggedInUser = \App\Models\User::getLoggedIn();
                            $permissionLevel =  $loggedInUser->permission_level;

                            if($permissionLevel !== \App\Models\User::USER_NORMAL) {
                                $profileLink = 'admin';
                            } else {
                                $profileLink = 'profil';
                            }
                        }

                    ?>
                    <a class="nav__link" href="<?php echo $profileLink; ?>">
                        <div class="nav__icon-wrapper">
                            <?php echo \Core\View::getIcon('user'); ?>
                        </div>
                        <span class="sr-only">Mein Profil</span>
                    </a>
                    <?php \Core\View::renderPartial('micro-login'); ?>
                </li>

                <li class="nav__item nav__menu-trigger">
                    <button class="nav__link" id="menuTrigger">
                        <div class="nav__icon-wrapper">
                            <?php echo \Core\View::getIcon('menu'); ?>
                        </div>
                        <span class="sr-only">Menü</span>
                    </button>
                </li>
            </ul>
        </div>
    </nav>
</header>
