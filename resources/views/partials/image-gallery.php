<div class="gallery__container" id="imageGallery">


    <div class="gallery__stage">
        <img src="<?php echo $images[0]->path; ?>" alt="" class="gallery__stage-img">

        <?php if (count($images) > 1): ?>
            <div class="gallery__controls">
                <button class="button" id="imageGalleryPrev"><?php echo \Core\View::getIcon('arrow-back') ?></button>
                <button class="button" id="imageGalleryNext"><?php echo \Core\View::getIcon('arrow-forward') ?></button>
            </div>
        <?php endif; ?>
    </div>

    <?php if (count($images) > 1): ?>
        <ul class="gallery__thumbs-list">
            <?php foreach ($images as $key => $image): ?>
                <?php if ($key === 4): ?>
                    <li class="gallery__thumbs-item gallery__thumbs-item--last"
                        data-elements-left="<?php echo count($images) - $key; ?>">
                        <img src="<?php echo $image->path; ?>" alt="" class="gallery__thumbs-img">
                    </li>
                <?php elseif($key > 4): ?>
                    <li class="gallery__thumbs-item gallery__thumbs-item--hidden">
                        <img src="<?php echo $image->path; ?>" alt="" class="gallery__thumbs-img">
                    </li>
                <?php else: ?>
                    <li class="gallery__thumbs-item">
                        <img src="<?php echo $image->path; ?>" alt="" class="gallery__thumbs-img">
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

    <div class="gallery__lightbox-container">
        
    </div>
    <?php endif; ?>
</div>

