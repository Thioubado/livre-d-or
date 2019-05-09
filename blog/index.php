<?php
//namespace App;
//use PDO;
require_once '../class/Post.php';
$pdo = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', '',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
$error = null;
try {
    
    if(isset($_POST['name'], $_POST['content'])){
        $query = $pdo->prepare('INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created_at)');
        $query-> execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created_at' => time()
        ]);
        header('Location: /livre-d-or/blog/edit.php?id=' . $pdo->lastInsertId());
        exit();

    }
    $query = $pdo -> query('SELECT * FROM posts');
//if($query === false){
    //var_dump($pdo->errorInfo());
    //die('Erreur SQL');
//}
$posts = $query ->FetchAll(PDO::FETCH_CLASS, 'Post');
//var_dump($posts);
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

        
            <?php foreach($posts as $post) : ?>
                <h2><a href="/livre-d-or/blog/edit.php?id=<?= $post->id ?>"><?= $post->name ;?></a></h2>
                <p class="small text-muted">
                    Ecrit le <?= $post->created_at->format('d/m/Y H:i')?>
                </p>
                <p>
                    <?= nl2br(htmlentities($post->getExcerpt()))?>
                </p>
            <?php endforeach ?>
        

        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" value="">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content"></textarea>
            </div>
            <button class="btn btn-primary">Sauvegarder</button>
        </form>


    <?php endif ?>

<?php require_once '../elements/footer.php';