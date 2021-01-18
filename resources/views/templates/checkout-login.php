<section class="section">
    <div class="section__header">
        <h1>Bestellung abschließen</h1>
    </div>
    <p class="mb--6">Bitte logge dich ein, um fortzufahren, oder mach als Gast weiter.</p>
    <div class="order__wrapper order__wrapper--half">
        <div class="order__wrapper--left">
            <div class="order__card">
                <h2>Einloggen</h2>
                <?php \Core\View::renderPartial('login-form', ['redirectAfterLogin' => 'bestellen/adresse']); ?>
            </div>
        </div>

        <div class="order__wrapper--right">
            <div class="order__card">
                <h2>Als Gast fortfahren</h2>
                <a class="button button--secondary"
                   href="bestellen"><span>Weiter</span><?php echo \Core\View::getIcon('arrow-forward'); ?></a>
            </div>
        </div>


    </div>

    <div class="cart__actions">
        <a href="<?php echo \Core\Session::get('referer') ?>"
           class="button button--secondary"><?php echo \Core\View::getIcon('arrow-back') ?><span>Zurück</span></a>
    </div>
</section>