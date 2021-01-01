<?php

namespace Core;


/**
 * Class View
 *
 * @package Core
 */
class View
{

    /**
     * Konstante für den Pfad zu allen View-Files.
     */
    const VIEW_BASE_PATH = __DIR__ . "/../resources/views";

    /**
     * Diese Methode erlaubt es uns innerhalb der Controller der App (s. HomeController), einen View in nur einer
     * einzigen Zeile zu laden und auch Parameter an den View zu übergeben. Die View Parameter dienen dazu, dass Werte,
     * die in den Controllern berechnet wurden, an den View zur Darstellung übergeben werden können.
     *
     * Aufruf: View::load('ProductSingle', $productValues)
     *
     * @param string $view
     * @param array $params
     * @param string $layout
     */
    public static function render(string $view, array $params = [], string $layout = '')
    {
        /**
         * Standard-Layout laden, wenn kein $layout angegeben wurde.
         */
        if ($layout === '') {
            $layout = Config::get('app.default-layout');
        }

        /**
         * extract() erstellt aus jedem Wert in einem Array eine eigene Variable. Das brauchen wir aber nur zu tun, wenn
         * überhaupt $params vorhanden sind.
         */
        if (!empty($params)) {
            extract($params);
        }

        /**
         * View Base Path vorbereiten, damit ihn später an mehreren Stellen verwenden können.
         */
        $viewBasePath = self::VIEW_BASE_PATH;

        /**
         * View Path vorbereiten, damit im Layout file der View geladen werden kann
         */
        $viewPath = "$viewBasePath/templates/$view.php";

        /**
         * Hier laden wir das Layout-File anhand des $layout Funktionsparameters. Das Layout lädt dann den $view.
         */
        require_once "$viewBasePath/layouts/$layout.php";
    }

    /**
     * @param string $partialName
     *
     * Lädt ein Partial (Abstraktion für require_once, sodass nur der Dateiname angegeben werden muss).
     */
    public static function renderPartial(string $partialName)
    {
        $partial = self::VIEW_BASE_PATH . "/partials/$partialName.php";
        require $partial;
    }

    /**
     * Rendert eine übergebene CSS-Klasse, wenn der angegebene Link mit der aktuellen URL übereinstimmt.
     *
     * @param string $link Nur der Link-Teil, ohne BASE_URL
     * @param string $activeClass
     * @return void
     */
    public static function renderActiveClass(string $link, string $activeClass)
    {
        $currentUrl = Router::getCurrentUrl();
        $urlToCheck = BASE_URL . "/$link";

        if ($currentUrl === $urlToCheck) {
            echo $activeClass;
        }
    }

    /**
     * @param string $name
     * @param string $labelText
     * @param string $inputType
     * @param array $additionalOptions
     */
    public static function renderFormGroup(string $name, string $labelText, string $inputType = 'text', array $additionalOptions = ['class' => '', 'describedBy' => '', 'selectOptions' => []])
    {

        $checkboxClass = $inputType === 'checkbox' ? 'form__group--checkbox' : '';
        $additionalClasses = isset($additionalOptions['class']) ? $additionalOptions['class'] : '';
        echo "<div class='form__group $checkboxClass $additionalClasses'>";

        $isPassword = $inputType === 'password';
        $oldValue = !$isPassword ? Session::old("$name") : '';
        $ariaDescribedBy = '';

        if (isset($additionalOptions['describedBy']) && strlen($additionalOptions['describedBy']) > 0) {
            $ariaDescribedBy = "aria-describedby='${additionalOptions['describedBy']}'";
        }

        if ($inputType === 'checkbox') {
            $checkedString = $oldValue === 'on' ? 'checked' : '';
            echo "<input type='$inputType' name='$name' id='$name' $checkedString />";
            echo "<label for='$name'>$labelText</label>";
        } elseif ($inputType === 'textarea') {
            echo "<label for='$name'>$labelText</label>";
            echo "<textarea rows='6' name='$name' id='$name' class='form__input' $ariaDescribedBy>$oldValue</textarea>";
        } elseif ($inputType === 'select') {
            echo "<label for='$name'>$labelText</label>";
            echo "<select name='$name' id='$name' class='form__input' $ariaDescribedBy>";
            if(count($additionalOptions['selectOptions'] > 0)) {
                foreach ($additionalOptions['selectOptions'] as $key => $option) {
                    echo "<option value='$key'>$option</option>";
                }
            }
            echo "</select>";
        } else {
            echo "<label for='$name'>$labelText</label>";
            echo "<input type='$inputType' name='$name' id='$name' class='form__input' value='$oldValue' $ariaDescribedBy/>";
        }

        echo "</div>";
    }

    /**
     * @param string $iconName
     * @return string
     */
    public static function getIcon(string $iconName): string
    {

        $icon = file_get_contents("storage/assets/svg/icons/$iconName.svg");
        return "<div class='icon__wrapper'>$icon</div>";
    }


}
