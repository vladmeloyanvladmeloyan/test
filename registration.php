<?php require_once(__DIR__ . '/autoload.php'); ?>
<?php

$error = null;
if (isset($_POST['submit'])) {
    $modelIp = new Ip();
    $model = new User();
    $user = $model->findByMail($_POST['email']);
    if ($modelIp->checkIp()) {
        if ($model->checkEmpty($_POST)) {
            if ($user) {
                $error = 'Логин уже существует';
            } else {

                if ($_POST['password'] == $_POST['password_confirmation']) {
                    $model->setPassword($_POST['password']);
                    if ($model->save($_POST['firstname'], $_POST['lastname'], $_POST['email'])) {
                        if($modelIp->isNewRecord){
                            $modelIp->save();
                        } else {
                            $modelIp->updateDateTimeForIp();
                        }
                        header('location:index.php');
                        die;
                    }

                } else {
                    $error = 'Пароли не совпадают';
                }
            }
        } else {
            $error = 'заполните все поля ';
        }
    } else {
        $error = 'попробуйте через 5 минут';
    }
}
?>
<?php require_once(__DIR__ . '/head.php'); ?>
    <div class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please sign up for Bootsnipp
                            <small>It's free!</small>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="firstname" id="first_name" class="form-control input-sm" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="lastname" id="last_name" class="form-control input-sm" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Register" name="submit" class="btn btn-info btn-block">
                            <?php if ($error): ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong><?= $error ?></strong>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once(__DIR__ . '/footer.php'); ?>