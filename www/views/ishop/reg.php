<?php defined('ISHOP') or die('Access denied'); ?>
<?php // require_once 'inc/mainmenu.php'; ?>
<?php require_once 'inc/index_mainmenu.php'; ?>

<?php // print_arr($_SESSION) ?>
<section class="main-content">
    <div class="container">

        <div class="row">
            <div class="col-sm-9">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="active">Регистрация</li>
                    </ol>
                </div>          
            </div>
        </div>

        <div class="row">
            <a name="reg"></a>
            <div class="col-xs-12 line-wrap">
                <div class="thebest-wrap">
                    <div class="hr">
                        <div class="gorizontal"></div>
                        <div class="vertical"></div>
                    </div>
                    <div class="ttl">
                        <h2>регистрация</h2>
                    </div>
                </div>
            </div>
        </div>

        <form method="post" action="#" style="min-height: 500px">
            <div class="row">
                <div class="col-sm-8 col-sm-push-2">   
                    <div class="regform table-responsive">
                        <table class="zakaz-data table" border="0" cellspacing="0" cellpadding="0">
                            <tbody> 
                            <tr>
                                <td class="zakaz-txt">* Логин</td>
                                <td class="zakaz-inpt"><input type="text" name="login" value="<?=htmlspecialchars($_SESSION['reg']['login'])?>" /></td>
                                <td class="zakaz-prim hidden-xs"></td>
                            </tr>
                            <tr>
                                <td class="zakaz-txt">* Пароль</td>
                                <td class="zakaz-inpt"><input type="password" name="pass" /></td>
                                <td class="zakaz-prim hidden-xs"></td>
                            </tr>
                            <tr>
                                <td class="zakaz-txt">* ФИО</td>
                                <td class="zakaz-inpt"><input type="text" name="name" value="<?=htmlspecialchars($_SESSION['reg']['name'])?>" /></td>
                                <td class="zakaz-prim hidden-xs">Пример: Иванов Сергей Александрович</td>
                            </tr>
                            <tr>
                                <td class="zakaz-txt">* Е-маил</td>
                                <td class="zakaz-inpt"><input type="text" name="email" value="<?=htmlspecialchars($_SESSION['reg']['email'])?>" /></td>
                                <td class="zakaz-prim hidden-xs">Пример: test@mail.ru</td>
                            </tr>
                            <tr>
                                <td class="zakaz-txt">* Телефон</td>
                                <td class="zakaz-inpt"><input type="text" name="phone" value="<?=htmlspecialchars($_SESSION['reg']['phone'])?>" /></td>
                                <td class="zakaz-prim hidden-xs">Пример: 8 937 999 99 99</td>
                            </tr>
                            <tr>
                                <td class="zakaz-txt">* Адрес доставки</td>
                                <td class="zakaz-inpt"><input type="text" name="address" value="<?=htmlspecialchars($_SESSION['reg']['address'])?>" /></td>
                                <td class="zakaz-prim hidden-xs">Пример: г. Москва, пр. Мира, ул. Петра Великого д.19, кв 51.</td>
                            </tr>
                           </tbody> 
                        </table>
                        <p class="zakaz-txt">Введите цифры с картинки:&nbsp;&nbsp; 
                        <?php $i=1; do {$num[$i] = mt_rand(0,9);?>
                        <img src="<?=TEMPLATE?>images/captcha/<?=$num[$i]?>.png" width="12">
                        <?php $i++; } while ($i<5); $captcha = $num[1].$num[2].$num[3].$num[4]; ?>
                        &nbsp;&nbsp;
                        <input name="captcha" type="hidden" value="<?=$captcha?>">
                        <input name="pr" type="text" size="6" maxlength="4"></p>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-push-3">   
                    <div class="regbtn text-center">
                        <input class="btn-rose" type="submit" name="reg" value="Зарегистрироваться" />
                    </div>
                </div>
            </div>    

        </form>
        <?php
        if (isset($_SESSION['reg']['res'])) {
            echo $_SESSION['reg']['res'];
            if ($_SESSION['reg']['success'] == "OK"){
                echo '<script>setTimeout(\'location="'.PATH.'"\', 3000)</script>';
            } 
            unset($_SESSION['reg']);
        }
        ?>



    <?php require_once 'inc/socials.php'; ?>
</div>
</section>