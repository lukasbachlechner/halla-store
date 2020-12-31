<?php
$errors = \Core\Session::getAndForget('errors', []);

foreach ($errors as $error):?>
    <p class="notification__wrapper notification--error"><?php echo $error; ?></p>
<?php endforeach; ?>
