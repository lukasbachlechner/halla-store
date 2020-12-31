<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>halla – Premium Scandinavian Living</title>

    <!--
    Hier definieren wir eine HTML Base Url. Diese dient dazu, dass alle relativen URLs und includes im HTML relativ zu
    dieser URL berechnet werden.

    s. https://developer.mozilla.org/de/docs/Web/HTML/Element/base
    -->
    <base href="<?php echo \Core\Config::get('app.baseurl') ?>">
</head>

<body>
<?php \Core\View::renderPartial('navbar'); ?>


<main class="container">
    <?php require_once $viewPath; ?>
</main>

<?php \Core\View::renderPartial('footer'); ?>

<script src="dist/frontend.bundle.js"></script>
</body>
</html>
