<?php 
require_once 'class/Message.php';
$errors = null;
if(isset($_POST['username'], $_POST['message'])){
    $message = new Message($_POST['username'], $_POST['message']);
    if($message->isValid()){
        
    }else{
        $errors = "Formulaire invalide";
    }
}
$title = "Livre d'or";
require 'elements/header.php';
?>

<div class="container">
    <h1>Livre d'or</h1>

    <?php if($errors): ?>
        <div class="alert alert-danger">
            <?= $errors;?>
        </div>
    <?php endif ?>
    <form action="" method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Votre pseudo" class="form-control">
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Votre message" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary">Envoyer</button>
    </form>
</div>


<?php require 'elements/footer.php' ?>