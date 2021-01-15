<?php \Core\Form::renderGroup('first_name', 'Vorname'); ?>
<?php \Core\Form::renderGroup('last_name', 'Nachname'); ?>
<?php \Core\Form::renderGroup('street', 'Straße & Hausnummer'); ?>

<div class="form__row">
    <?php \Core\Form::renderGroup('zip', 'PLZ'); ?>
    <?php \Core\Form::renderGroup('city', 'Ort'); ?>
</div>

<div class="form__group">
    <label for="country">Land</label>
    <select name="country" id="country" class="form__input">
        <?php foreach (\Core\Helpers\StaticData::COUNTRIES as $country): ?>
            <option value="<?php echo $country['alpha2'] ?>" <?php echo $country['alpha2'] === 'at' ? 'selected' : ''; ?>><?php echo $country['name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>


<?php if (isset($redirect)): ?>
    <input type="hidden" value="<?php echo $redirect; ?>" name="redirect">
<?php endif; ?>