<section>
    <form action="admin/benutzer/edit/<?php echo $user->id; ?>/do" method="post" class="form">

        <div class="page__header">
            <h1>"<?php echo $user->getFullName(); ?>" bearbeiten</h1>
            <div class="button__group button__group--mobile-float">
                <a class="button button--error"
                   href="admin/benutzer"><?php echo \Core\View::getIcon('menu-close') ?>
                    <span>Abbrechen</span>
                </a>
                <button class="button button--success"><?php echo \Core\View::getIcon('save') ?>
                    <span>Aktualisieren</span>
                </button>
            </div>
        </div>

        <?php \Core\View::renderPartial('errors'); ?>

        <div class="form__columns">
            <div class="form__column--left">
                <fieldset>
                    <legend>Benutzerdaten</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('firstName', 'Vorname', 'text', ['value' => $user->first_name]); ?>
                        <?php \Core\Form::renderGroup('lastName', 'Nachname', 'text', ['value' => $user->last_name]); ?>
                    </div>

                    <div class="form__group">
                        <label for="email">E-Mail-Adresse</label>
                        <input type="email" name="email" id="email" class="form__input"
                               value="<?php echo $user->email; ?>">
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Authentifizierung</legend>

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
                </fieldset>

            </div>

            <div class="form__column--right">

                <?php if ($user->getPermissionLevel()->level !== \App\Models\User::USER_SUPERADMIN): ?>
                    <fieldset>
                        <legend>Benutzerrechte</legend>
                        <div class="form__row">
                            <?php \Core\Form::renderGroup('permission', 'Status', 'select',
                                [
                                    'selectOptions' => $permissions,
                                    'value' => $user->permission_id
                                ]); ?>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Newsletter</legend>
                        <div class="form__row">
                            <?php \Core\Form::renderGroup('newsletter', 'Status', 'select',
                                [
                                    'selectOptions' => [
                                        '0' => 'inaktiv',
                                        '1' => 'aktiv'
                                    ],
                                    'value' => $user->newsletter
                                ]); ?>
                        </div>
                    </fieldset>

                    <?php \Core\View::renderPartial('admin/danger-zone', ["route" => "admin/benutzer/delete/{$user->id}/do"]); ?>
                <?php endif; ?>
            </div>
        </div>
    </form>
</section>