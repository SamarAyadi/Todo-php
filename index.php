<?php
const ERROR_REQUIRED = '🚩  Veuillez renseigner une todo ';
const ERROR_TOO_SHORT = '🚩  Veuillez entrer au moins 5 caractères ';
$filename = __DIR__ . "/data/todos.json";
$error = '';
$todos = [];

if (file_exists($filename)) {
    $data = file_get_contents($filename);
    $todos = json_decode($data, true) ?? [];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        "todo" => [
            "filter" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            "flags" => FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_BACKTICK
        ]
    ]);
    $todo = $_POST['todo'] ?? '';

    if (!$todo) {
        $error = ERROR_REQUIRED;
    } else if (mb_strlen($todo) < 5) {
        $error = ERROR_TOO_SHORT;
    }


    if (!$error) {
        $todos = [...$todos, [
            'name' => $todo,
            'done' => false,
            'id' => time()
        ]];
        file_put_contents($filename, json_encode($todos));
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'includes/head.php' ?>
    <title>Todo</title>
</head>

<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="todo-container">
                <h1>Ma Todo</h1>
                <form class="todo-form" action="/" method="POST">
                    <input name="todo" type="text">
                    <button class="btn btn-primary-aj">Ajouter</button>
                </form>
                <?php if ($error) : ?>
                <p class="text-danger"><?= $error ?></p>
                <?php endif; ?>
                <ul class="todo-list">
                    <?php foreach ($todos as $t) : ?>
                    <li class="todo-item">
                        <span class="todo-name"><?= $t['name'] ?></span>
                        <button class="btn btn-primary btn-small">Valider</button>
                        <button class="btn btn-danger btn-small">Supprimer</button>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php require_once 'includes/footer.php' ?>

    </div>


</body>

</html>