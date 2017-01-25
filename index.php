<?php require_once(__DIR__ . '/autoload.php'); ?>
<?php
session_start();
$error = null;
if (isset($_POST['submit'])) {
    $model = new User();
    $user = $model->findByMail($_POST['email']);
    if ($user) {

        if ($model->checkPassword($_POST['email'], $_POST['password'])) {
            $_SESSION['email'] = $_POST['email'];
            header('location:maine.php');
            die;
        } else {
            $error = 'логин или пароль неверны ';
        }
    } else {
        $error = 'логин или пароль неверны ';
    }
}

?>
<?php require_once(__DIR__ . '/head.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-offset-5 col-md-3">
                <div class="form-login">
                    <form method="post">
                        <h4>Welcome back.</h4>
                        <input type="text" id="userName" name="email" class="form-control input-sm chat-input" placeholder="username"/></br>
                        <input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="password"/></br>
                        <div class="wrapper">
            <span class="group-btn">
                <input type="submit" class="btn btn-primary btn-md" name="submit" value="login">
                <a href="registration.php" class="btn btn-primary btn-md">registration</a>
            </span>
                    </form>
                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert">
                            <strong><?= $error ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php require_once(__DIR__ . '/footer.php'); ?>