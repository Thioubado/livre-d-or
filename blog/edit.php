<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
$error = null;
$success = null;
try {
    if(isset($_POST['name'], $_POST['content'])){
        $query = $pdo->prepare('UPDATE posts SET name = :name, content = :content WHERE id = :id');
        $query-> execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'id' => $_GET['id']
        ]);
        $succes = 'Votre article a bien été modifié';
    }
    $query = $pdo -> prepare('SELECT * FROM posts WHERE id= :id');
    $query->execute([
        'id' => $_GET['id']
    ]);

$post = $query ->Fetch();

} catch (PDOException $e) {
    $error = $e->getMessage();
}

require_once '../elements/header.php';
?>
    <div class="container">
    <p>
        <a href= "/livre-d-or/blog/index.php">Revenir au listing</a>
    </p>
    <?php if($success) : ?>

        <div class="alert alert-success">
            <?= $succes ?>
        </div>

    <?php endif ?>
    <?php if($error): ?>
        <div class="alert alert-danger">
            <?= $error;?>
        </div>
    <?php else : ?>

        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" value="<?= htmlentities($post->name) ?>">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" value=""><?= htmlentities($post->content) ?></textarea>
            </div>
            <button class="btn btn-primary">Sauvegarder</button>
        </form>
        
    <?php endif ?>
    </div>

<?php require_once '../elements/footer.php';