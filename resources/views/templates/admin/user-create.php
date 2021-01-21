<section>
    <form action="admin/benutzer/add/do" method="post" class="form">

        <div class="page__header">
            <h1>Neuen Benutzer anlegen</h1>
            <div class="button__group button__group--mobile-float">
                <a class="button button--error"
                   href="admin/benutzer"><?php echo \Core\View::getIcon('menu-close') ?>
                    <span>Abbrechen</span>
                </a>
                <button class="button button--success"><?php echo \Core\View::getIcon('save') ?>
                    <span>Speichern</span>
                </button>
            </div>
        </div>

        <?php \Core\View::renderPartial('errors'); ?>
        <div class="form__columns">
            <div class="form__column--left">
                <fieldset>
                    <legend>Benutzerdaten</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('firstName', 'Vorname', 'text'); ?>
                        <?php \Core\Form::renderGroup('lastName', 'Nachname', 'text'); ?>
                    </div>

                    <div class="form__group">
                        <label for="email">E-Mail-Adresse</label>
                        <input type="email" name="email" id="email" class="form__input" autocomplete="new-password"
                               value="<?php echo \Core\Session::old('email', ''); ?>">
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Authentifizierung</legend>

                    <div class="form__group">
                        <label for="password">Passwort</label>
                        <input type="password" name="password" id="password" class="form__input"
                               autocomplete="new-password">
                    </div>

                    <div class="form__group">
                        <label for="passwordRepeat">Passwort wiederholen</label>
                        <input type="password" name="passwordRepeat" id="passwordRepeat" class="form__input"
                               autocomplete="new-password">
                    </div>
                </fieldset>

            </div>

            <div class="form__column--right">
                <fieldset>
                    <legend>Benutzerrechte</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('permission', 'Status', 'select', ['selectOptions' => $permissions]); ?>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Newsletter</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('newsletter', 'Status', 'select', ['selectOptions' => [
                            '0' => 'inaktiv',
                            '1' => 'aktiv'
                        ]]); ?>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</section>