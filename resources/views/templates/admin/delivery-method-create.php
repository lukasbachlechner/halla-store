<section>
    <form action="admin/versand/add/do" method="post" class="form">
        <div class="page__header">
            <h1>Neue Versandart</h1>

            <button class="button button--success "><?php echo \Core\View::getIcon('save') ?>
                <span>Speichern</span>
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
                </fieldset>

                <fieldset>
                    <legend>Preis</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('price', 'Preis', 'price'); ?>
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