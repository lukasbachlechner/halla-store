<div class="order__card order__discount">
    <h2>Rabattcode</h2>
    <form action="bestellen/voucher/add/do" class="form">
        <div class="form__row">
            <label for="voucher" class="sr-only">Gutscheincode</label>
            <input type="text" name="voucher" id="voucher" class="form__input">

            <button class="button button--secondary form__input">Hinzufügen</button>
        </div>
    </form>
</div>

<?php

/**
 * <?php \Core\View::renderPartial('order-summary', [
 * 'products' => $products,
 * 'total' => $total,
 * 'tax' => $tax
 * ]); ?>
 */
?>