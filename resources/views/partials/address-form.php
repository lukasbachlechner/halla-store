<?php
if (isset($prefix)) {
    $prefix = $prefix . '-';
} else {
    $prefix = '';
} ?>

<?php \Core\Form::renderGroup($prefix . 'first_name', 'Vorname'); ?>
<?php \Core\Form::renderGroup($prefix . 'last_name', 'Nachname'); ?>
<?php \Core\Form::renderGroup($prefix . 'street', 'Straße & Hausnummer'); ?>
<?php \Core\Form::renderGroup($prefix . 'email', 'E-Mail-Adresse', 'email'); ?>
<?php \Core\Form::renderGroup($prefix . 'phone', 'Telefonnummer', 'tel'); ?>

    <div class="form__row">
        <?php \Core\Form::renderGroup($prefix . 'zip', 'PLZ'); ?>
        <?php \Core\Form::renderGroup($prefix . 'city', 'Ort'); ?>
    </div>

    <div class="form__group">
        <label for="<?php echo $prefix; ?>country">Land</label>
        <select name="<?php echo $prefix; ?>country" id="country" class="form__input">
            <?php foreach (\Core\Helpers\StaticData::COUNTRIES as $country): ?>
                <option value="<?php echo $country['alpha2'] ?>" <?php echo $country['alpha2'] === 'at' ? 'selected' : ''; ?>><?php echo $country['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>


<?php if (isset($redirect)): ?>
    <input type="hidden" value="<?php echo $redirect; ?>" name="redirect">
<?php endif; ?>