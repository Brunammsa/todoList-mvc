<?php
require_once __DIR__ . '/../inicio-html.php';
?>

<div class="container mt-5">
    <h2>Todo List</h2>

    <form class="mb-3" action="/new-task" method="post">
        <div class="form-group row">
            <div class="col-11">
                <input class="form-control" type="text" name="task-name" placeholder="Qual a próxima tarefa?">
            </div>
            <div class="col-1">
                <input class="btn btn-success w-100" type="submit" value="Criar">
            </div>
        </div>
    </form>
    <hr>

    <ul class="list-group">
        <?php foreach ($tasks as $task) : ?>
            <li class="list-group-item list-group-item-action d-flex justify-content-between">
                <span>
                    <input type="checkbox">
                    <?= $task->name; ?>
                </span>
                <button type="button" class="btn btn-danger">Remove</button>
            </li>
        <?php endforeach ?>
    </ul>
</div>

<?php require_once __DIR__ . '/../fim-html.php';
