<div class="gallery__container" id="imageGallery">


    <div class="gallery__stage">
        <img src="<?php echo $images[0]->path; ?>" alt="" class="gallery__stage-img">

        <?php if (count($images) > 1): ?>

        <?php endif; ?>
    </div>

    <?php if (count($images) > 1): ?>
        <ul class="gallery__thumbs-list">
            <?php foreach ($images as $key => $image): ?>
                <?php
                $itemAdditionalClass = '';
                if ($key === 4) {
                    $itemAdditionalClass = 'gallery__thumbs-item--last';
                } elseif ($key > 4) {
                    $itemAdditionalClass = 'gallery__thumbs-item--hidden';
                }
                ?>
                <li class="gallery__thumbs-item <?php echo $itemAdditionalClass; ?>" data-index="<?php echo $key; ?>"
                    data-elements-left="<?php echo count($images) - $key; ?>">
                    <img src="<?php echo $image->path; ?>" alt="" class="gallery__thumbs-img">
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="gallery__lightbox-container">
            <img src="" alt="" class="gallery__lightbox-img">
            <button class="button button--primary gallery__lightbox-close" id="lightboxClose"><?php echo \Core\View::getIcon('menu-close'); ?></button>
            <div class="gallery__lightbox-controls">
                <button class="button button--primary gallery__lightbox-button" id="imageGalleryPrev"><?php echo \Core\View::getIcon('arrow-back') ?></button>
                <button class="button button--primary gallery__lightbox-button" id="imageGalleryNext"><?php echo \Core\View::getIcon('arrow-forward') ?></button>
            </div>
        </div>
    <?php endif; ?>
</div>

