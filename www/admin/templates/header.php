<?php defined('ISHOP') or die('Access denied'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>YS-adm</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Forum&subset=latin,cyrillic" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <link href="<?= ADMIN_TEMPLATE ?>js/bootstrap.min.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?=ADMIN_TEMPLATE ?>js/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=ADMIN_TEMPLATE?>js/jquery-ui.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=ADMIN_TEMPLATE?>js/fontawesome-iconpicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=ADMIN_TEMPLATE?>js/bootstrap-select.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=ADMIN_TEMPLATE?>js/image-picker.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=ADMIN_TEMPLATE?>/style.css" rel="stylesheet">
        <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
         <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="<?=ADMIN_TEMPLATE ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=ADMIN_TEMPLATE?>js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="<?=ADMIN_TEMPLATE?>js/workscripts.js"></script>
        <script type="text/javascript" src="<?=ADMIN_TEMPLATE?>js/jquery-ui.min.js"></script>
        <script type="text/javascript"  src="<?=ADMIN_TEMPLATE ?>js/jquery.cookie.js"></script>
        <script type="text/javascript"  src="<?=ADMIN_TEMPLATE ?>js/jquery.mailto.min.js"></script>
        <script type="text/javascript" src="<?=ADMIN_TEMPLATE?>js/datepicker-ru.js"></script>
        <script type="text/javascript" src="<?=ADMIN_TEMPLATE?>js/fontawesome-iconpicker.min.js"></script>
        <script type="text/javascript" src="<?=ADMIN_TEMPLATE?>js/image-picker.min.js"></script>
        <script type="text/javascript" src="<?=ADMIN_TEMPLATE?>js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?=ADMIN_TEMPLATE?>js/ajaxupload.js"></script>
    </head>

    <body>
       
        <nav class="navbar navbar-default">
            <div class="container-fluide">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=PATH?>admin/">YS-admin</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <?php // echo preg_match( '/brands|cat|edit_brand|add_brand/' , eyenow() ); ?>
                          <!-- <li class="active"><a href="#">Страницы <span class="sr-only">(current)</span></a></li> -->
                            <li <?php // if(  empty(eyenow()) || preg_match( '/pages|_page|info|_info|news/' , eyenow()) )?>
                            <li <?php if( preg_match( '/pages|_page|info|_info|news/' , eyenow()) )        
                                        echo "class='active'"; ?>><a href="?view=pages">Страницы</a></li>
                            <li <?php if( preg_match( '/brands|cat|edit_brand|add_brand|del_brand|product/' , eyenow()) )
                                        echo "class='active'"; ?>><a href="?view=brands">Каталог</a></li>  
                            <li <?php if( preg_match( '/users|custom/' , eyenow()) )
                                        echo "class='active'"; ?>><a href="?view=users">Пользователи</a></li>
                            <li <?php if(  empty(eyenow()) || preg_match( '/order|zakaz/' , eyenow()) )
                                        echo "class='active'"; ?>><a href="<?=PATH?>admin/">Заказы
                                    <!--&amp;status=0-->
                                <?php if($count_new_orders > 0): ?>
                                    <span class="neworders"> ( <?=$count_new_orders?> )</span>
                                <?php endif;?>    
                                </a></li>
                        </ul>
                        <hr class="hr visible-xs">
                       
                        <ul class="nav-top-right navbar-nav navbar-right text-center">
                            <li><a href="?view=edit_user&amp;user_id=<?=$_SESSION['auth']['user_id']?>"><i class="fa fa-user-circle"></i> <?=$_SESSION['auth']['admin']?> </a>|<a href="<?=PATH?>" target="_blank"> На сайт </a>|<a href="?do=logout"> Выход</a></li>
                        </ul>
                        <hr class="hr visible-xs">    
                </div><!-- /.navbar-collapse -->
            </div> <!-- /.container-fluid -->
        </nav>
