<section>
    <form action="admin/produkte/add/do" method="post" enctype="multipart/form-data" class="form">
        <div class="page__header">
            <h1>Neues Produkt</h1>

            <button class="button button--success button--with-icon"><?php echo \Core\View::getIcon('plus') ?>
                Speichern
            </button>
        </div>

        <div class="form__columns">
            <div class="form__column--left">

                <fieldset>
                    <legend>Informationen</legend>
                    <div class="form__row">
                        <?php \Core\View::renderFormGroup('name', 'Name', 'text'); ?>
                    </div>
                    <div class="form__row">
                        <?php \Core\View::renderFormGroup('description', 'Beschreibung', 'textarea'); ?>
                    </div>
                </fieldset>

            </div>

            <div class="form__column--right">
                <div class="form__row">
                    <?php \Core\View::renderFormGroup('active', 'Status', 'select', ['selectOptions' => [
                        'active' => 'Aktiv',
                        'disabled' => 'Inaktiv'
                    ]]); ?>
                </div>
            </div>
        </div>
    </form>
</section>