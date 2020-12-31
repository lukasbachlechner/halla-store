<footer class="footer">
    <div class="container footer__container">
        <div class="footer__branding">
            <a href="<?php echo BASE_URL; ?>" class="footer__logo-wrapper">
                <?php \Core\View::renderPartial('logo'); ?>
            </a>

            <ul class="footer__social-list">
                <?php
                $socialLinks = [
                    ['icon' => 'instagram', 'link' => '#'],
                    ['icon' => 'facebook', 'link' => '#'],
                    ['icon' => 'pinterest', 'link' => '#'],
                ];
                ?>
                <?php foreach ($socialLinks as $socialLink): ?>
                    <li class="footer__social-item">
                        <a class="footer__social-link" href="<?php echo $socialLink['link']; ?>">
                            <img class="footer__icon"
                                 src="storage/assets/svg/icons/<?php echo $socialLink['icon']; ?>.svg" alt="">
                            <span class="sr-only"><?php echo $socialLink['icon']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p class="footer__copyright">&copy; halla GmbH, <?php echo date('Y') ?></p>
        </div>

        <nav>
            <ul class="footer__links-list">
                <?php
                $footerLinks = [
                    ['description' => 'Impressum', 'link' => 'impressum'],
                    ['description' => 'Datenschutz', 'link' => '#'],
                    ['description' => 'Allgemeine Geschäftsbedingungen', 'link' => '#'],
                    ['description' => 'Lieferung und Rücksendung', 'link' => '#'],
                ];
                ?>

                <?php foreach ($footerLinks as $footerLink): ?>
                    <li class="footer__links-item">
                        <a href="<?php echo $footerLink['link'] ?>"
                           class="footer__links-link"><?php echo $footerLink['description'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</footer>