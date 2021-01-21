<div class="page__header">
    <h1>Alle Newsletterempfänger (<?php echo count($recipients); ?>)</h1>

    <a class="button button--primary " href="admin/newsletter/csv" download><?php echo \Core\View::getIcon('save') ?><span>CSV speichern</span></a>
</div>

<div class="list">
    <header class="list__head list__grid">
        <div>Vorname</div>
        <div>Nachame</div>
        <div>E-Mail</div>
    </header>
    <ul class="list__body">
        <?php foreach ($recipients as $recipient): ?>
            <li class="list__item list__grid">
                    <div><?php echo $recipient->first_name; ?></div>
                    <div><?php echo $recipient->last_name; ?></div>
                    <div><?php echo $recipient->email; ?></div>
            </li>
        <?php endforeach; ?>
    </ul>

    <footer class="list__footer list__grid">

    </footer>
</div>