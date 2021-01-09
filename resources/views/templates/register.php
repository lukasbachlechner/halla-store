<section class="section form__wrapper">
    <?php \Core\View::renderPartial('errors'); ?>
    <h1>Registrieren</h1>
    <form action="registrieren/do" class="form" method="post">
        <?php \Core\Form::renderGroup('first_name', 'Vorname'); ?>
        <?php \Core\Form::renderGroup('last_name', 'Nachname'); ?>
        <?php \Core\Form::renderGroup('email', 'E-Mail-Adresse', 'email'); ?>
        <div class="form__row">
            <?php \Core\Form::renderGroup('password', 'Passwort', 'password',  ['describedBy' => 'passwordDescription']); ?>
            <?php \Core\Form::renderGroup('password_repeat', 'Passwort wiederholen', 'password'); ?>
        </div>

        <div class="form__group mb--3">
            <p id="passwordDescription">Ein Passwort muss Groß- und Kleinbuchstaben, Ziffern und Sonderzeichen enthalten und mind. 8 Zeichen lang sein.</p>
        </div>


        <?php \Core\Form::renderGroup('agb', 'Ich habe die AGB und die Datenschutzerklärung gelesesn und akzeptiere sie.', 'checkbox'); ?>
        <?php \Core\Form::renderGroup('newsletter', 'Ich möchte über aktuelle Angebote auf dem Laufenden gehalten werden.', 'checkbox'); ?>


        <div class="form__group mt--3">
            <button type="submit" class="button button--primary">Registrieren</button>
        </div>
    </form>

    <?php echo \Core\Session::old('agb') ?>
</section>