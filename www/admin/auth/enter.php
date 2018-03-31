<?php
define('ISHOP', TRUE);
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';

if ($_SESSION['auth']['admin']) {
    header("Location: ../");
    exit;
}

if ($_POST) {
    $login = trim(mysqli_real_escape_string($_POST['user']));
    $pass = trim($_POST['pass']);
    $query = "SELECT customer_id, name, password FROM customers WHERE login = '$login' AND id_role = 2 LIMIT 1";
    $res = mysqli_query($dblink,$query);
    $row = mysqli_fetch_assoc($res);
    if ($row['password'] == md5($pass)) {
        $_SESSION['auth']['admin'] = htmlspecialchars($row['name']);
        $_SESSION['auth']['user_id'] = $row['customer_id'];
        header("Location: ../");
        exit;
    } else {
        $_SESSION['res'] = '<div class="error">Логин или пароль не совпадает!</div>';
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="../<?= ADMIN_TEMPLATE ?>js/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../<?= ADMIN_TEMPLATE ?>style.css" />
        <title>Вход в админку</title>
    </head>
    <body>
        <div class="authwrap text-center">
            <div class="container maincont">
                <div class="row">
                    <div class="col-sm-6 col-sm-push-3 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Авторизация</h3>
                            </div>
                            <div class="panel-body">
                                <div class="login-box">
                                    <?php
                                    if (isset($_SESSION['res'])) {
                                        echo $_SESSION['res'];
                                        unset($_SESSION['res']);
                                    }
                                    ?>
                                    <form  method="post" action="">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                            <input type="text" class="form-control"  name="user" placeholder="Имя пользователя" required autofocus />
                                        </div>
                                        <br />
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                            <input type="password" class="form-control" name="pass" placeholder="Пароль" required />
                                        </div>
                                        <br />
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Войти</button>
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>    
    </body>
</html>
