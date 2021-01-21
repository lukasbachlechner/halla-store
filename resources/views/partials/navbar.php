<header>
    <nav class="nav">
        <div class="container nav__container">
            <a href="<?php echo BASE_URL; ?>" class="nav__logo-wrapper">
                <?php \Core\View::renderPartial('logo'); ?>
            </a>

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
                                $profileLink = 'profil';
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

                <?php if (\App\Models\User::isAdmin()): ?>
                    <li class="nav__item">
                        <a class="nav__link" href="admin">
                            <div class="nav__icon-wrapper">
                                <?php echo \Core\View::getIcon('dashboard'); ?>
                            </div>
                            <span class="sr-only">Warenkorb</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
