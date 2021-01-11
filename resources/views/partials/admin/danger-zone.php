<fieldset>
    <legend>Danger Zone</legend>
    <p class="mb--2">Achtung: Diese Aktion kann nicht rückgängig gemacht werden!</p>
    <div class="form__row">
        <a href="admin/produkte/delete/<?php echo $product->id; ?>/do" class="button button--error button--with-icon button--full-width">
            <?php echo \Core\View::getIcon('trash'); ?>
            Produkt löschen</a>
    </div>
</fieldset>