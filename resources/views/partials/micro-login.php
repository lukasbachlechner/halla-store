<div class="nav__flyout">
    <?php if(\App\Models\User::isLoggedIn()): ?>
    <?php $user = \App\Models\User::getLoggedIn(); ?>
        <div class="mb--3">
            <h3><?php echo $user->first_name . " " . $user->last_name; ?></h3>
            <p><?php echo $user->email; ?></p>
        </div>

        <nav>
            <ul>
                <li><a href="profil">Mein Profil</a></li>
                <li><a href="profil/bestellungen">Meine Bestellungen</a></li>
                <li><a href="logout/do" class="button button--primary button--full-width mt--3">Ausloggen</a></li>
            </ul>
        </nav>
    <?php else: ?>
    <form action="login/do" class="form" method="post" id="microLoginForm">
        <div class="form__group">
            <label for="emailMicro">E-Mail-Adresse</label>
            <input type="email" name="email" id="emailMicro" class="form__input">
        </div>

        <div class="form__group">
            <label for="passwordMicro">Passwort</label>
            <input type="password" name="password" id="passwordMicro" class="form__input">
        </div>

        <div class="form__group form__group--checkbox">
            <input type="checkbox" name="remember" id="rememberMicro">
            <label for="rememberMicro">Eingeloggt bleiben</label>
        </div>

        <div class="form__row">
            <div class="form__group">
                <a href="registrieren" class="button button--secondary button--full-width">Jetzt registrieren</a>
            </div>

            <div class="form__group ml--2">
                <button type="submit" class="button button--primary button--full-width" value="login">
                    Einloggen
                </button>
            </div>
        </div>
    </form>
    <?php endif; ?>
</div>