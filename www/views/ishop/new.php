<?php defined('ISHOP') or die('Access denied'); ?>
<?php require_once 'inc/index_mainmenu.php'; ?>

<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="<?=PATH?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="active">Новинки</li>
                    </ol>
                </div>          
            </div>
        </div>
        <div class="row">
            <a name="new"></a>
            <div class="col-xs-12 line-wrap">
                <div class="new-wrap">
                    <div class="hr">
                        <div class="gorizontal"></div>
                        <div class="vertical"></div>
                    </div>
                    <div class="ttl">
                        <h2>новинки</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="subcat-wrap cat-wrap clearfix">
                <div class="col-sm-2 col-xs-5">
                    <span>Вид: </span>
                    <span class="style-grid fa fa-th icon-grid" aria-hidden="true"></span>
                    <span class="style-list fa fa-th-list icon-list" aria-hidden="true"></span>
                </div>
                <div class="col-sm-8 col-xs-7">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm paggy">
                            <?php if($eye_pages_count > 1) pagination($page, $eye_pages_count); ?>
                        </ul>
                    </nav>
                </div>
                <div class="col-sm-2 hidden-xs">
                    <span>Найдено товаров: </span><span class="subcat-qnty"><?= $eye_count_rows ?></span>
                </div>
            </div>
        </div>
        <div class="hr hr-top">
            <div class="gorizontal"></div>
            <div class="vertical"></div>
        </div>
        <?php if ($eye_products) : // если получены товары-новинки?>    
            <?php $chunk_products = array_chunk($eye_products, 6, true); ?>
            <?php foreach ($chunk_products as $key1 => $item1): ?>    
                <div class="row grid-row">
                    <?php foreach ($item1 as $key2 => $item2): ?>
                        <div class="col-xs-12 col-sm-4 col-md-2">
                            <div class="thumbnail onpage onpage-best ongood">
                                <div class="best-img">
                                    <i class="fa fa-search-plus"></i>
                                    <a href="?view=product&amp;goods_id=<?= $item2['goods_id'] ?>"><img class="img-rounded lupa" src="<?= PRODUCTIMG ?><?= $item2['img'] ?>" alt="<?= $item2['name'] ?>">
                                    </a>
                                </div>
                                <p class="best-title"><a href="?view=product&amp;goods_id=<?= $item2['goods_id'] ?>"><?= $item2['name'] ?></a></p>
                                <div class="product-buy">
                                    <?php if($item2['available'] == '1'): ?>
                                    <p class="best-caption"><?= $item2['price'] ?><span class="rouble"> c</span></p>
                                    <form name="cart5">
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
                                        <input type="hidden" name="goods_id" value="<?= $item2['goods_id'] ?>">
                                        <button type="submit" class="btn">В корзину"</button>
                                    </form>
                                    <?php elseif($item2['available'] == '0'):?>
                                    <p class="best-caption n-a"><?= $item2['price'] ?><span class="rouble"> c</span></p>
                                    <span class="btn-rose">Нет в наличии</span>
                                    <?php endif; ?>
                                    <p class="product-articul">
                                        Артикул: <span class="articul"><?= $item2['articul'] ?></span>
                                    </p>
                                </div> 
                            </div>
                        </div>
                    <?php endforeach; ?>  
                </div>
            <?php endforeach; ?>
        <?php else: ?> 
            <div class="row">
                <div class="col-md-4 col-md-push-4"> 
                    <div class="error text-center">
                        <p>Здесь товаров пока нет</p>
                    </div>
                    <br />
                    <div class="text-center">
                        <img src="<?= TEMPLATE ?>images/noGoods.png" title="Такого товара нет" width="250">
                    </div>
                </div>    
            </div>    
        <?php endif; ?>
        <?php if ($eye_products) : // если получены товары-новинки ?>    
            <?php foreach ($eye_products as $key => $item): ?> 
                <div class="row list-row">
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
                        </div>
                        <div class="clearfix visible-xs-block"></div>
                        <div class="col-xs-6 col-sm-3">
                            <p class="best-caption"><?= $item['price'] ?> <span class="rouble"> c</span></p>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="product-buy">
                                <?php if($item['available'] == '1'): ?>
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
                                <?php elseif($item['available'] == '0'):?>
                                <span class="btn-rose">Нет в наличии</span>
                                <?php endif; ?>
                                <p class="product-articul">
                                    Артикул: <span class="articul"><?= $item['articul'] ?></span>
                                </p>
                            </div>
                        </div> 
                    </div>
                </div> 
            <?php endforeach; ?>
            <div class="hr hr-bottom">
                <div class="gorizontal"></div>
                <div class="vertical"></div>
            </div>
            <div class="row">
                <div class="subcat-wrap cat-wrap clearfix">
                    <div class="col-sm-2 col-xs-5">
                        <span>Вид: </span>
                        <span class="style-grid fa fa-th icon-grid" aria-hidden="true"></span>
                        <span class="style-list fa fa-th-list icon-list" aria-hidden="true"></span>
                    </div>
                    <div class="col-sm-8 col-xs-7">
                       <nav aria-label="Page navigation">
                         <ul class="pagination pagination-sm paggy">
                            <?php if($eye_pages_count > 1) pagination($page, $eye_pages_count); ?>
                          </ul>
                       </nav>
                    </div>
                    <div class="col-sm-2 hidden-xs">
                        <span>Найдено товаров: </span><span class="subcat-qnty"><?= $eye_count_rows ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php require_once 'inc/socials.php'; ?>
    </div> <!-- ./container -->
</section> <!-- ./main-content -->
</body>
</html>