<section>
    <form action="admin/zahlungsart/edit/<?php echo $paymentMethod->id; ?>/do" method="post" class="form">

        <div class="page__header">
            <h1>"<?php echo $paymentMethod->name; ?>" bearbeiten</h1>
            <div class="button__group button__group--mobile-float">
                <a class="button button--error"
                   href="admin/versand"><?php echo \Core\View::getIcon('menu-close') ?>
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
                        <?php \Core\Form::renderGroup('name', 'Name', 'text', ['value' => $paymentMethod->name]); ?>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Preis</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('price', 'Preis', 'price', ['value' => $paymentMethod->price]); ?>
                    </div>
                </fieldset>

            </div>

            <div class="form__column--right">
                <fieldset>
                    <legend>Optionen</legend>
                    <div class="form__row">
                        <?php \Core\Form::renderGroup('isActive', 'Status', 'select', ['value' => $paymentMethod->is_active, 'selectOptions' => [
                            '1' => 'Aktiv',
                            '0' => 'Inaktiv'
                        ]]); ?>
                    </div>
                </fieldset>
                <?php \Core\View::renderPartial('admin/danger-zone', ['route' => "admin/versand/delete/{$paymentMethod->id}/do"]); ?>
            </div>
        </div>

    </form>
</section>