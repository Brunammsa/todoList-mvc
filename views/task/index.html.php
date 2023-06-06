<?php
require_once __DIR__ . '/../inicio-html.php';
?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="container mt-5">
    <h2>Todo List</h2>

    <form class="mb-3" action="/task" method="post">
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
                <form action="/task" method="post">
                    <span>
                        <input type="checkbox" name="checkbox-task" value="1">
                        <?= $task->name; ?>
                    </span>
                </form>
                <form action="/task/<?= $task->id; ?>" method="post">
                    <input type="hidden" name="_method" value="delete">
                    <input type="submit" class="btn btn-danger" value="Remove">
                </form>
            </li>
        <?php endforeach ?>
        <p>
            Progresso <?= count($taskDone) . '/' . count($tasks) ;?>
        </p>
    </ul>
</div>

<?php require_once __DIR__ . '/../fim-html.php';
