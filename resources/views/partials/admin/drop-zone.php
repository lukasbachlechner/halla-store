<div class="form__group" id="dropZoneFormGroup">
    <label for="images[]">Bilder</label>
    <input type="file" multiple accept="image/*" name="images[]" class="form__input drop-zone__input"
           id="newFilesInput"/>

    <?php if (isset($product)): ?>
        <input type="hidden" name="imagesToDelete" id="deletedFilesInput">
    <?php endif; ?>

    <div class="drop-zone" id="dropZone">
        <div class="drop-zone__prompt">
            <button class="button button--primary button--with-icon"
                    id="uploadButton"><?php echo \Core\View::getIcon("upload") ?> Bilder auswählen
            </button>
            <p class="mt--3">oder hierher ziehen</p>
        </div>
    </div>

    <ul class="drop-zone__thumbs-list">
        <?php if (isset($product)): ?>
            <?php foreach ($product->getImages() as $image): ?>
                <li class="drop-zone__thumbs-item" data-image-id="<?php echo $image->id; ?>">
                    <img src="<?php echo $image->path; ?>" alt="" class="drop-zone__thumbs-img">
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

</div>