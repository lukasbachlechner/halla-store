<section class="section form__wrapper">
    <?php \Core\View::renderPartial('errors'); ?>
    <h1>Registrieren</h1>
    <form action="registrieren/do" class="form" method="post">
        <?php \Core\View::renderFormGroup('first_name', 'Vorname'); ?>
        <?php \Core\View::renderFormGroup('last_name', 'Nachname'); ?>
        <?php \Core\View::renderFormGroup('email', 'E-Mail-Adresse', 'email'); ?>
        <div class="form__row">
            <?php \Core\View::renderFormGroup('password', 'Passwort', 'password', '', 'passwordDescription'); ?>
            <?php \Core\View::renderFormGroup('password_repeat', 'Passwort wiederholen', 'password'); ?>
        </div>

        <div class="form__group mb--3">
            <p id="passwordDescription">Ein Passwort muss Groß- und Kleinbuchstaben, Ziffern und Sonderzeichen enthalten und mind. 8 Zeichen lang sein.</p>
        </div>


        <?php \Core\View::renderFormGroup('agb', 'Ich habe die AGB und die Datenschutzerklärung gelesesn und akzeptiere sie.', 'checkbox', 'form__group--checkbox'); ?>
        <?php \Core\View::renderFormGroup('newsletter', 'Ich möchte über aktuelle Angebote auf dem Laufenden gehalten werden.', 'checkbox', 'form__group--checkbox'); ?>


        <div class="form__group mt--3">
            <button type="submit" class="button button--primary">Registrieren</button>
        </div>
    </form>

    <?php echo \Core\Session::old('agb') ?>
</section>