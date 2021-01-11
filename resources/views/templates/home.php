<section class="section">
    <h2>Neue Produkte</h2>

    <?php \Core\View::renderPartial('product-list', [
        'products' => $products
    ]); ?>
    </ul>
</section>