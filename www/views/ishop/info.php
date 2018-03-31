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
                        <li class="active">Информация для заказа</li>
                    </ol>
                </div>          
            </div>
        </div>
        
        <div class="row"> <!-- разделитель info -->
            <div class="col-xs-12">
                <div class="info-wrap">
                    <div class="hr">
                        <div class="gorizontal"></div>
                        <div class="vertical"></div>
                    </div>
                    <div class="ttl">
                        <h2>информация для заказа</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($informers): ?>
        <?php foreach ($informers as $infkey => $value): ?>
        <br /><br />
        <a name="info_<?=$infkey?>"></a>
        <div  class="row search-row">
            <div class="col-sm-8 col-sm-push-2">
                <div class="content-txt clearfix">
                    <button class="btn-rose order" data-toggle="tooltip" data-placement="top" title="<?=$value[0]?>">
                    <i class="fa <?=$value[2]?> fa-2x"></i>
                    </button>
                    <h3 class="text-center"><?=$value[0]?></h3>
                    <?php foreach ($value['sub'] as $key => $sub): ?>
                    <h4><?=$sub?>:</h4>
                    <?php $informerarray = get_text_informer($key) ?>
                    <p><?=$informerarray['text']?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
            <div  class="row search-row">
            <div class="col-sm-8 col-sm-push-2">
                <div class="content-txt clearfix">
                    <h3 class="text-center">Такой страницы нет</h3>
                        <div class="text-center">
                            <img src="<?= TEMPLATE ?>images/noGoods.png" title="Такой страницы нет" width="250">
                        </div>
                </div>
            </div>
        </div>    
        <?php endif; ?>
        <?php require_once 'inc/socials.php'; ?>
    </div> <!-- ./container -->
</section> <!-- ./main-content -->

</body>
</html>

