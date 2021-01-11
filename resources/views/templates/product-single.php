<section class="section">
    <div class="single-product__wrapper">
        <div class="single-product__images" id="imageSliderContainer">
            <div class="single-product__images-container">
                <ul class="single-product__images-list">
                    <?php foreach ($product->getImages(true) as $image): ?>
                        <li class="single-product__images-item">
                            <img src="<?php echo $image->path; ?>" alt="" class="single-product__image">
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="single-product__image-controls">
                <button class="button" id="imageSliderPrev"><?php echo \Core\View::getIcon('arrow-back') ?></button>
                <button class="button" id="imageSliderNext"><?php echo \Core\View::getIcon('arrow-back') ?></button>
            </div>
        </div>

        <div class="single-product__contents">
            <span>Art.-Nr. <?php echo $product->id; ?></span>
            <div class="single-product__header mb--3">
                <h1 class="single-product__name"><?php echo $product->name; ?></h1>
                <span class="single-product__price"><?php echo \App\Models\Product::formatPrice($product->price); ?></span>
            </div>


            <form action="warenkorb/add/<?php echo $product->id; ?>/do/false" method="post" class="single-product__form mt--4 form">
                <div class="form__row">
                    <div class="form__group single-product__quantity">
                        <label for="quantity">Menge</label>
                        <input class="form__input" type="number" name="quantity" id="quantity" min="1" value="1">
                    </div>
                </div>
                <div class="form__row">
                    <a href="wunschliste/add/<?php echo $product->id; ?>/do"
                            class="button button--secondary form__group single-product__wishlist"><?php echo \Core\View::getIcon('heart') ?>
                    </a>

                    <button type="submit"
                            class="button button--primary form__input form__group"><?php echo \Core\View::getIcon('cart') ?><span>Warenkorb</span>
                    </button>
                </div>
            </form>

            <p><?php echo $product->description; ?></p>
        </div>


    </div>
</section>