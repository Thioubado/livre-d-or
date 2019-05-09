<?php
/*require 'vendor/autoload.php';
use App\Guestbook\{
    GuestBook,
    Message
};*/

$errors = null;
$succes = false;

if (isset($_POST['username'], $_POST['message'])) {
    if ($message->isValid()) {
        $message   = new Message($_POST['username'], $_POST['message']);
        $guestbook = new GuestBook(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'messages');
        $guestbook->addMessage($message);
        $succes = true;
        $_POST  = [];
    } else {
        $errors   = $message->getErrors();
        $messages = $guestbook->getMessages();
    }
}
$title = "Livre d'or";
require 'elements/header.php';
?>

<div class="container">
    <h1>Livre d'or</h1>

    <?php if (!empty($errors)) {
    ?>
        <div class="alert alert-danger">
            Formulaire invalide
        </div>
    <?php
} ?>

    <?php if ($succes) {
        ?>
        <div class="alert alert-succes">
            Merci pour votre message
        </div>
    <?php
    } ?>

    <form action="" method="post">
            <div class="form-group">
                <input value="<?php echo htmlentities($_POST['username'] ?? ''); ?>" type="text" name="username" placeholder="Votre pseudo" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>">
                <?php if (isset($errors['username'])) {
        ?>
                    <div class="invalid-feedback"><?php echo $errors['username']; ?></div>
                <?php
    } ?>
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Votre message" class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : ''; ?>"><?php echo htmlentities($_POST['message'] ?? ''); ?></textarea>
                <?php if (isset($errors['message'])) {
        ?>
                    <div class="invalid-feedback"><?php echo $errors['message']; ?></div>
                <?php
    } ?>
            </div>
            <button class="btn btn-primary">Envoyer</button>
    </form>

    <?php if (!empty($messages)) {
        ?>
    <h1 class="mt-4">Vos messages</h1>

        <?php foreach ($messages as $message) {
            ?>
            <?php echo $message->toHTML(); ?>
        <?php
        } ?>


    <?php
    } ?>
</div>


<?php require 'elements/footer.php'; ?>