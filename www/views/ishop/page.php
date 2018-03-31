<?php defined('ISHOP') or die('Access denied'); ?>
<?php // require_once 'inc/mainmenu.php'; ?>
<?php require_once 'inc/index_mainmenu.php'; ?>

<section class="main-content">
    <div class="container">

        <div class="row">
            <div class="col-sm-9">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="<?=PATH?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="active"><?=$get_page['title']?></li>
                    </ol>
                </div>          
            </div>
        </div>

        <div class="hr">
            <div class="gorizontal"></div>
            <div class="vertical"></div>
        </div>
        <br /><br />
        <div class="row search-row">
            <div class="col-sm-8 col-sm-push-2">
                <div class="content-txt clearfix">
                    <?php if($get_page): ?>
                    <h3 class="text-center"><?=$get_page['title']?></h3>
                    <?=$get_page['text']?>
                    <?php else : ?> 
                        <h3 class="text-center">Такой страницы нет</h3>
                        <div class="text-center">
                            <img src="<?= TEMPLATE ?>images/noGoods.png" title="Такой страницы нет" width="250">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>    

        <?php require_once 'inc/socials.php'; ?>
    </div> <!-- ./container -->
</section> <!-- ./main-content -->

</body>
</html>

