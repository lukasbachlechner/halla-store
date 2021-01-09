<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>halla – Admin</title>
    <base href="<?php echo \Core\Config::get('app.baseurl') ?>">

    <style>
        .loading-screen {
            z-index: 1000;
            position: fixed;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: #1b1c22;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
<div class="loading-screen"></div>
<?php \Core\View::renderPartial('admin/header'); ?>

<?php \Core\View::renderPartial('admin/nav'); ?>

<main class="main__content">
    <?php require_once $viewPath; ?>
</main>


<script src="dist/backend.bundle.js"></script>
</body>
</html>
