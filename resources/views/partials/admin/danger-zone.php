<fieldset>
    <legend>Danger Zone</legend>
    <p class="mb--2">Achtung: Diese Aktion kann nicht rückgängig gemacht werden!</p>
    <div class="form__row">
        <a href="<?php echo $route; ?>" class="button button--error  button--full-width">
            <?php echo \Core\View::getIcon('trash'); ?>
            <span>Produkt löschen</span></a>
    </div>
</fieldset>