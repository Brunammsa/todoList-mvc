<?php
require_once __DIR__ . '/../inicio-html.php';
?>

<div class="container mt-5">
    <ul class="list-group">
        <?php foreach($tasks as $task): ?>
        <li class="list-group-item list-group-item-action d-flex justify-content-between">
            <span>
                <?= $task->name;?>
            </span>
            <button type="button" class="btn btn-danger">Remove</button>
        </li>
        <?php endforeach ?>
    </ul>
</div>

<?php require_once __DIR__ . '/../fim-html.php';