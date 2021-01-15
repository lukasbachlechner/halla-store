<section>
    <form action="admin/produkte/edit/<?php echo $product->id; ?>/do" method="post" enctype="multipart/form-data"
          class="form" id="productForm">

        <div class="page__header">
            <h1>"<?php echo $product->name; ?>" bearbeiten</h1>
            <div class="button__group button__group--mobile-float">
                <a class="button button--error"
                   href="admin/produkte"><?php echo \Core\View::getIcon('menu-close') ?>
                    <span>Abbrechen</span>
                </a>
                <button class="button button--success"><?php echo \Core\View::getIcon('save') ?>
                    <span>Aktualisieren</span>
                </button>
            </div>
        </div>

        <?php \Core\View::renderPartial('errors'); ?>

        <div class="form__columns">
            <div class="form__column--left">

                <fieldset>
                    <legend>Informationen</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('name', 'Name', 'text', ['value' => $product->name]); ?>
                    </div>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('description', 'Beschreibung', 'textarea', ['value' => $product->description]); ?>
                    </div>
                    <div class="form__row">

                        <?php \Core\View::renderPartial('admin/drop-zone', ['product' => $product]); ?>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Preis & Inventar</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('price', 'Preis (brutto)', 'price', ['value' => $product->price]); ?>
                        <?php \Core\Form::renderGroup('taxRate', 'Steuersatz', 'select', ['value' => $product->tax_rate, 'selectOptions' => [
                            '20' => '20 %',
                            '10' => '10 %'
                        ]]); ?>
                    </div>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('quantityAvailable', 'Stück verfügbar', 'number', ['value' => $product->quantity_available]); ?>
                        <?php \Core\Form::renderGroup('quantitySold', 'Stück verkauft', 'number', ['value' => $product->quantity_sold]); ?>
                    </div>
                </fieldset>

            </div>

            <div class="form__column--right">
                <fieldset>
                    <legend>Optionen</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('isActive', 'Status', 'select', ['value' => $product->is_active, 'selectOptions' => [
                            '1' => 'Aktiv',
                            '0' => 'Inaktiv'
                        ]]); ?>
                    </div>
                    <div class="form__row">
                        <a href="/produkte/<?php echo $product->slug; ?>" class="button button--primary  button--full-width" target="_blank">
                            <?php echo \Core\View::getIcon('external-link'); ?>
                            <span>Zur Produktseite</span></a>
                    </div>
                </fieldset>

                <?php \Core\View::renderPartial('admin/danger-zone', ['product' => $product]); ?>
            </div>
        </div>
    </form>
</section>