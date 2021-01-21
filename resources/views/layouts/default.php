<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>halla – Premium HiFi Headphones</title>

    <!--
    Hier definieren wir eine HTML Base Url. Diese dient dazu, dass alle relativen URLs und includes im HTML relativ zu
    dieser URL berechnet werden.

    s. https://developer.mozilla.org/de/docs/Web/HTML/Element/base
    -->
    <base href="<?php echo \Core\Config::get('app.baseurl') ?>">

    <style>
        .loading-screen {
            z-index: 1000;
            position: fixed;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
<div class="loading-screen"></div>

<?php \Core\View::renderPartial('navbar'); ?>


<main class="container">
    <?php require_once $viewPath; ?>
</main>


<div class="notice__wrapper">
    <div class="notification__wrapper notification--white cookie-consent" style="display: none">
        <p>Diese Seite verwendet technisch notwendige Cookies.</p>
        <button id="cookieConsentClose" class="button button--secondary button--small">Einverstanden</button>
    </div>

    <div class="notification__wrapper notification--error">
        <p>Achtung: Diese Seite dient nur zu Schulungszwecken, es werden keine echten Produkte verkauft!</p>
    </div>
</div>

<?php \Core\View::renderPartial('footer'); ?>

<script src="dist/frontend.bundle.js"></script>
</body>
</html>
