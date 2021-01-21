<div class="section cart__section">
    <div class="section__header">
        <h1>Mein Profil</h1>
    </div>
    <?php \Core\View::renderPartial('errors'); ?>
    <?php \Core\View::renderPartial('success'); ?>
    <div class="order__wrapper order__wrapper--half">
        <div class="order__wrapper--left">


            <form action="profil/edit/do" method="post">
                <section class="order__card">
                    <h2>Benutzerdaten</h2>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('firstName', 'Vorname', 'text', ['value' => $user->first_name]); ?>
                        <?php \Core\Form::renderGroup('lastName', 'Nachname', 'text', ['value' => $user->last_name]); ?>
                    </div>

                    <div class="form__group">
                        <label for="email">E-Mail-Adresse</label>
                        <input type="email" name="email" id="email" class="form__input"
                               value="<?php echo $user->email; ?>">
                    </div>

                    <button class="button button--primary">
                        <?php echo \Core\View::getIcon('save'); ?>
                        <span>Speichern</span>
                    </button>
                </section>
            </form>

            <form action="profil/passwort/edit/do" method="post">
                <section class="order__card">
                    <h2>Passwort ändern</h2>

                    <div class="form__group">
                        <label for="oldPassword">Altes Passwort</label>
                        <input type="password" name="oldPassword" id="oldPassword" class="form__input"
                               autocomplete="new-password">
                    </div>

                    <div class="form__group">
                        <label for="newPassword">Neues Passwort</label>
                        <input type="password" name="newPassword" id="newPassword" class="form__input"
                               autocomplete="new-password">
                    </div>

                    <div class="form__group">
                        <label for="newPasswordRepeat">Neues Passwort wiederholen</label>
                        <input type="password" name="newPasswordRepeat" id="newPasswordRepeat" class="form__input"
                               autocomplete="new-password">
                    </div>

                    <button class="button button--primary">
                        <?php echo \Core\View::getIcon('save'); ?>
                        <span>Speichern</span>
                    </button>
                </section>
            </form>

        </div>

        <div class="order__wrapper--right">
            <section class="order__card">
                <h2>Meine Bestellungen (<?php echo count($orders); ?>)</h2>
                <ul class="order__list">
                    <?php foreach ($orders as $order): ?>
                        <a href="profil/bestellung/details/<?php echo $order->id; ?>" class="order__link">
                            <li class="order__item">
                                <span><?php echo $order->id; ?></span>
                                <span><?php echo $order->getFormattedDate(true, true); ?></span>
                                <span><?php echo $order->getOrderBadge(); ?></span>
                                <span class="text--right"><?php echo \App\Models\Product::formatPrice($order->total); ?></span>
                            </li>
                        </a>
                    <?php endforeach; ?>

                </ul>
            </section>

            <section class="order__card">
                <h2>Newsletter</h2>
                <a href="profil/newsletter/toggle/do" class="button button--secondary">
                    <?php echo \Core\View::getIcon('newsletter') ?>
                    <span><?php echo $user->newsletter === 0 ? 'Anmelden' : 'Abmelden'; ?></span>
                </a>
            </section>
        </div>


    </div>
</div>