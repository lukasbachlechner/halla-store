<?php
$successMessages = \Core\Session::getAndForget('success', []);

foreach ($successMessages as $success):?>
    <p class="notification__wrapper notification--success"><?php echo $success; ?></p>
<?php endforeach; ?>
