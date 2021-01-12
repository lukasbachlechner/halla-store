<section class="section">
    <div class="single-product__wrapper">
        <div class="single-product__images">
            <?php \Core\View::renderPartial('image-gallery', [
                'images' => $product->getImages(true)
            ]); ?>
        </div>

        <div class="single-product__description">
            <h2>Beschreibung</h2>
            <p><?php echo $product->description; ?></p>
        </div>

        <div class="single-product__contents">
            <div class="single-product__contents-inner">
                <div class="single-product__preheader mb--1">
                    <span>Art.-Nr. <?php echo $product->id; ?></span>

                    <?php if (\App\Controllers\WishlistController::hasProduct($product->id)): ?>
                        <a href="wunschliste/delete/<?php echo $product->id; ?>/do/fromProduct"
                           class="single-product__wishlist">
                            <?php echo \Core\View::getIcon('heart-full') ?>
                        </a>
                    <?php else: ?>
                        <a href="wunschliste/add/<?php echo $product->id; ?>/do" class="single-product__wishlist">
                            <?php echo \Core\View::getIcon('heart') ?>
                        </a>
                    <?php endif; ?>

                </div>
                <div class="single-product__header mb--3">
                    <h1 class="single-product__name"><?php echo $product->name; ?></h1>
                    <span class="single-product__price"><?php echo \App\Models\Product::formatPrice($product->price); ?></span>
                </div>


                <form action="warenkorb/add/<?php echo $product->id; ?>/do/false" method="post"
                      class="single-product__form mt--4 form">
                    <div class="form__row">
                        <div class="form__group single-product__quantity">
                            <label for="quantity">Menge</label>
                            <input class="form__input" type="number" name="quantity" id="quantity" min="1" value="1">
                        </div>
                    </div>
                    <div class="form__row">

                        <button type="submit"
                                class="button button--primary form__input form__group"><?php echo \Core\View::getIcon('cart') ?>
                            <span>Warenkorb</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</section>


