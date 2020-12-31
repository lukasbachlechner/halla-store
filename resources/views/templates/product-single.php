<section class="section">
    <div class="single-product__wrapper">
        <div class="single-product__images">
            <!-- <img src="https://via.placeholder.com/1200x680" alt=""> -->
        </div>

        <div class="single-product__contents">
            <span>Art.-Nr. <?php echo $product->id; ?></span>
            <div class="single-product__header mb--3">
                <h1 class="single-product__name"><?php echo $product->name; ?></h1>
                <span class="single-product__price"><?php echo \App\Models\Product::formatPrice($product->price); ?></span>
            </div>

            <p><?php echo $product->description; ?><?php var_dump($product); ?></p>

            <form action="" class="single-product__form mt--4">
                <div class="single-product__add-to-cart">
                    <label for="quantity" class="sr-only">Anzahl</label>
                    <input class="form__input single-product__quantity" type="number" name="quantity" id="quantity" min="1" value="1">
                    <button type="submit" class="button button--primary ml--2">In den Warenkorb</button>
                </div>
            </form>
        </div>


    </div>
</section>