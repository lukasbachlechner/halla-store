<section>
    <form action="admin/produkte/add/do" method="post" enctype="multipart/form-data" class="form" id="productForm">
        <div class="page__header">
            <h1>Neues Produkt</h1>

            <button class="button button--success button--with-icon"><?php echo \Core\View::getIcon('save') ?>
                Speichern
            </button>
        </div>

        <?php \Core\View::renderPartial('errors'); ?>

        <div class="form__columns">
            <div class="form__column--left">

                <fieldset>
                    <legend>Informationen</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('name', 'Name', 'text'); ?>
                    </div>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('description', 'Beschreibung', 'textarea'); ?>
                    </div>
                    <div class="form__row">
                            <?php \Core\View::renderPartial('admin/drop-zone'); ?>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Preis & Inventar</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('price', 'Preis (brutto)', 'price'); ?>
                        <?php \Core\Form::renderGroup('taxRate', 'Steuersatz', 'select', ['selectOptions' => [
                            '20' => '20 %',
                            '10' => '10 %'
                        ]]); ?>
                    </div>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('quantityAvailable', 'Stück verfügbar', 'number'); ?>
                        <?php \Core\Form::renderGroup('quantitySold', 'Stück verkauft', 'number'); ?>
                    </div>
                </fieldset>

            </div>

            <div class="form__column--right">
                <fieldset>
                    <legend>Optionen</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('isActive', 'Status', 'select', ['selectOptions' => [
                            '1' => 'Aktiv',
                            '0' => 'Inaktiv'
                        ]]); ?>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</section>