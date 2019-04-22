<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$error = null;
try {
    $query = $pdo -> query('SELECT * FROM posts');
//if($query === false){
    //var_dump($pdo->errorInfo());
    //die('Erreur SQL');
//}
$posts = $query ->FetchAll(PDO::FETCH_OBJ);
/*echo'<pre>';
print_r($posts);
echo '</pre>';*/
} catch (PDOException $e) {
    $error = $e->getMessage();
}

require_once '../elements/header.php';
?>
    <?php if($error): ?>
        <div class="alert alert-danger">
            <?= $error;?>
        </div>
    <?php else : ?>

        <ul>
            <?php foreach($posts as $post) : ?>
                <li><a href="/livre-d-or/blog/edit.php?id=<?= $post->id ?>"><?= $post->name ;?></a></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>

<?php require_once '../elements/footer.php';