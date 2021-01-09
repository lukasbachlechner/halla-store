<form action="login/do" class="form" method="post">
    <div class="form__group">
        <label for="email">E-Mail-Adresse</label>
        <input type="email" name="email" id="email" class="form__input" autofocus>
    </div>

    <div class="form__group">
        <label for="password">Passwort</label>
        <input type="password" name="password" id="password" class="form__input">
    </div>



    <div class="form__row mt--3">
        <div class="form__group form__group--checkbox">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Eingeloggt bleiben</label>
        </div>

        <div class="form__group">
            <button type="submit" class="button button--primary button--full-width" value="login">
                Einloggen
            </button>
        </div>
    </div>
</form>

<p class="mt--3">
    Du hast noch kein Konto? <a href="registrieren">Jetzt registrieren</a>
</p>