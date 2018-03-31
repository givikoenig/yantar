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
                        <li class="active">Архив новостей</li>
                    </ol>
                </div>          
            </div>
        </div>
        <br /><br />
        <div class="col-sm-4 col-sm-push-4 text-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm paggy">
                            <?php pagination($page, $pages_count); ?>
                        </ul>
                    </nav>
        </div>
        <div class="hr hr-arc">
            <div class="gorizontal"></div>
            <div class="vertical"></div>
        </div>
        <br /><br />
        <div class="row search-row">
            <div class="col-sm-8 col-sm-push-2">
                <div class="content-txt arch clearfix"> 
                    <?php if ($all_news): ?>
                        <?php foreach ($all_news as $item): ?> 
                            <h3 class="text-center"><a href="?view=news&amp;news_id=<?= $item['news_id'] ?>"><?= $item['title'] ?></a></h3>
                            <span class="news_date"><?= $item['data'] ?></span>
                            <br /><br />
                            <?= $item['anons'] ?>
                            <p><a href="?view=news&amp;news_id=<?= $item['news_id'] ?>">Подробнее...</a></p>
                            <br /><br /> 
                        <?php endforeach; ?>
                    <?php else : ?>
                        <h3 class="text-center">Новостей пока нет</h3>
                        <div class="text-center">
                            <img src="<?= TEMPLATE ?>images/noGoods.png" title="Такой новости нет" width="250">
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

