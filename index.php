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
                <form class="todo-form" action="/" method="post">
                    <input type="text">
                    <button class="btn btn-primary">Ajouter</button>
                </form>
                <div class="todo-list"></div>
            </div>
        </div>
        <?php require_once 'includes/footer.php' ?>

    </div>


</body>

</html>