<?php defined('ISHOP') or die('Access denied'); ?>
<?php // require_once 'inc/mainmenu.php';  ?>
<?php require_once 'inc/index_mainmenu.php'; ?>

<section class="main-content">
    <div class="container">

        <div class="row">
            <div class="col-sm-9">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li><a href="?view=catalog">Каталог товаров</a></li>
                        <li class="active">Поиск</li>
                    </ol>
                </div>          
            </div>
        </div>

        <div class="row"><!-- разделитель поиск -->
            <a name="new"></a>
            <div class="col-xs-12 line-wrap">
                <div class="new-wrap">
                    <div class="hr">
                        <div class="gorizontal"></div>
                        <div class="vertical"></div>
                    </div>
                    <div class="ttl">
                        <h2>поиск</h2>
                    </div>
                </div>
            </div>
        </div><!-- ./разделитель поиск -->

        <?php if ($result_search['notfound']): //если ничего не найдено?>
            <div class="text-center">
                <?php echo $result_search['notfound']; ?>
                <br />
               <img src="<?= TEMPLATE ?>images/noGoods.png" title="Такого товара нет" width="250">
            </div>
        <?php else: //если есть результат поиска ?>
            <?php foreach ($result_search as $key => $item): ?> 
                <div class="row search-row">
                    <div class="onpage onpage-best ongood clearfix">
                        <div class="col-xs-6 col-sm-3">
                            <div class="best-img">
                                <i class="fa fa-search-plus"></i>
                                <a class="a-search" href="?view=product&amp;goods_id=<?= $item['goods_id'] ?>"><img class="img-rounded lupa" src="<?= PRODUCTIMG ?><?= $item['img'] ?>" alt="<?= $item['name'] ?>">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <p class="best-title"><a href="?view=product&amp;goods_id=<?= $item['goods_id'] ?>"><?= $item['name'] ?></a></p>
                            <p class="search-content"><a href="?view=product&amp;goods_id=<?= $item['goods_id'] ?>"><?= $item['anons'] ?></a></p>
                        </div>
                        <div class="clearfix visible-xs-block"></div>
                        <div class="col-xs-6 col-sm-3">
                            <p class="best-caption"><?= $item['price'] ?> <span class="rouble"> c</span></p>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="product-buy">
                                <?php if ($item['available'] == '1'): ?>
                                    <form name="cart">
                                        <input type="hidden" name="view" value="addtocart">
                                        <div class="input-group">
                                            <div>
                                                <span class="minus-span">
                                                    <button class="minus-btn" type="button">-</button>
                                                </span>
                                                <input type="text" class="qnty" name="count" value="1" size="5">
                                                <span class="plus-span">
                                                    <button class="plus-btn" type="button">+</button>
                                                </span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="goods_id" value="<?= $item['goods_id'] ?>">
                                        <button type="submit" class="btn">В корзину"</button>
                                    </form>
                                <?php elseif ($item['available'] == '0'): ?>    
                                    <span class="btn-rose">Нет в наличии</span>
                                    <p class="product-articul">
                                        Артикул: <span class="articul"><?= $item['articul'] ?></span>
                                    </p>
                                <?php endif; ?>    
                            </div>
                        </div>
                    </div>
                </div> 
            <?php endforeach; ?> 
        <?php endif; ?>

        <?php require_once 'inc/socials.php'; ?>

    </div> <!-- ./container -->
</section> <!-- ./main-content -->

</body>
</html>

