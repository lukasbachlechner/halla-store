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
     * @param string $iconName
     * @return string
     */
    public static function getIcon(string $iconName): string
    {

        $icon = file_get_contents("storage/assets/svg/icons/$iconName.svg");
        return "<div class='icon__wrapper'>$icon</div>";
    }


}
