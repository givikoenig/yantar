<?php defined('ISHOP') or die('Access denied'); ?>
<?php // require_once 'inc/mainmenu.php'; ?>
<?php require_once 'inc/index_mainmenu.php'; ?>

<?php // print_arr($_SESSION) ?>

<?php lostpass(); ?>
<section class="main-content">
    <div class="container">
        
        <div class="row">
            <div class="col-sm-9">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="<?=PATH?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="active">Восстановление пароля</li>
                    </ol>
                </div>          
            </div>
        </div>

        <div class="row"> <!-- разделитель info -->
                <div class="col-xs-12">
                    <div class="info-wrap lostpass-wrap">
                        <div class="hr">
                            <div class="gorizontal"></div>
                            <div class="vertical"></div>
                        </div>
                        <div class="ttl">
                            <h2>восстановление пароля</h2>
                        </div>
                    </div>
                </div>
        </div>
        
        <?php if (isset($_SESSION['lostpass']['success'])):?>
        <div id="lostpass" style="min-height: 500px">
            <div class="col-sm-6 col-sm-push-3 success">
                <p><?=$_SESSION['lostpass']['success']?></p>
            </div>
            <?php unset($_SESSION['lostpass']); ?>
        </div>
        <?php echo '<script>setTimeout(\'location="'.PATH.'"\', 3000)</script>'; ?>
        <?php else : ?>
        <form method="post" style="min-height: 500px">
            <div class="row">
                <div class="col-sm-6 col-sm-push-3">   
                    <div class="regform table-responsive">
                        <?php if (isset($_SESSION['lostpass']['error'])): //если есть ошибка?>
                        <div class='error'><?= $_SESSION['lostpass']['error'] ?></div>
                         <?php unset($_SESSION['lostpass']['error']); ?>    
                        <?php endif; ?>
                        <table class="zakaz-data table" border="0" cellspacing="0" cellpadding="0">
                            <tbody> 
                                <td class="zakaz-txt">* Логин</td>
                                <td class="zakaz-inpt"><input type="text" name="usrname" value="<?= $_SESSION['lostpass']['usrname'] ?>"  /></td>
                            </tr>
                           </tbody> 
                        </table>
                        <p class="zakaz-txt">&nbsp;&nbsp;* Введите цифры с картинки:&nbsp;&nbsp; 
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
                        <input class="btn-rose" type="submit" name="lostpass" value="Отправить" />
                    </div>
                </div>
            </div>
        </form>
        <?php endif;?>

    <?php require_once 'inc/socials.php'; ?>
</div>
</section>