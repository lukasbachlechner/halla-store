<div class="page__header">
    <h1>Alle Benutzer</h1>

    <?php if (\App\Models\User::hasPermission()): ?>
        <a class="button button--primary " href="admin/benutzer/add"><?php echo \Core\View::getIcon('plus') ?>
            <span>Neuer Benutzer</span></a>
    <?php endif; ?>
</div>

<?php foreach ($groupedUsers as $level => $userGroup): ?>
    <h2><?php echo $level; ?></h2>

    <div class="list">
        <header class="list__head list__grid">
            <div>#</div>
            <div>Vorname</div>
            <div>Nachname</div>
            <div>E-Mail</div>
            <div>Registriert</div>
        </header>
        <ul class="list__body">
            <?php foreach ($userGroup as $user): ?>
                <li class="list__item">
                    <a href="admin/benutzer/edit/<?php echo $user->id; ?>" class="list__link list__grid">
                        <div><?php echo $user->id; ?></div>
                        <div><?php echo $user->first_name; ?></div>
                        <div><?php echo $user->last_name; ?></div>
                        <div><?php echo $user->email; ?></div>
                        <div><?php echo $user->datetime_registered; ?></div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <footer class="list__footer list__grid">

        </footer>
    </div>
<?php endforeach; ?>



