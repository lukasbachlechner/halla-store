<?php \Core\Form::renderGroup('stripeCardHolder', 'Karteninhaber', 'text', ['required' => false]); ?>

<div class="form__group">
    <label for="stripeCardNumber">Kartennummer</label>
    <div id="stripeCardNumber" class="form__input form__input--stripe"></div>
    <div id="stripeErrorNumber" class="form__input--error"></div>
</div>
<div class="form__row">
    <div class="form__group">
        <label for="stripeCardExpiry">Ablaufdatum</label>
        <div id="stripeCardExpiry" class="form__input form__input--stripe"></div>
        <div id="stripeErrorExpiry" class="form__input--error"></div>
    </div>
    <div class="form__group">
        <label for="stripeCardCVC">Prüfziffer</label>
        <div id="stripeCardCVC" class="form__input form__input--stripe"></div>
    </div>

</div>