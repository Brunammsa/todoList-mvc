<?php
require_once __DIR__ . '/../inicio-html.php';
?>

<div class="container mt-5">
    <ul class="list-group">
        <?php foreach ($tasks as $task) : ?>
            <li class="list-group-item list-group-item-action d-flex justify-content-between">
                <span>
                    <?= $task->name; ?>
                </span>
                <button type="button" class="btn btn-danger">Remove</button>
            </li>
        <?php endforeach ?>
    </ul>
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require_once __DIR__ . '/../fim-html.php';
