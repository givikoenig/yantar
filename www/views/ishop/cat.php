<?php defined('ISHOP') or die('Access denied'); ?>
<?php // require_once 'inc/mainmenu.php';  ?>
<?php require_once 'inc/index_mainmenu.php'; ?>
<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <?php if (count($brand_name) > 1): //работаем с подкатегорией ?>
                            <li><a href="<?= PATH ?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li><a href="?view=catalog">Каталог товаров</a></li>
                            <li><a href="?view=cat&amp;category=<?= $brand_name[0]['brand_id'] ?>"><?= $brand_name[0]['brand_name'] ?></a></li>
                            <li class="active"><?= $brand_name[1]['brand_name'] ?></li>
                        <?php elseif (count($brand_name == 1)): ?>
                            <li><a href="<?= PATH ?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li><a href="?view=catalog">Каталог товаров</a></li>
                            <li class="active"><?= $brand_name[0]['brand_name'] ?></li>
                        <?php endif; ?>
                    </ol>
                </div>          
            </div>
        </div>
        <?php // print_arr($allproducts);?>
        <?php // echo $category; ?>
        <div class="hr">
            <div class="gorizontal"></div>
            <div class="vertical"></div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <div class="group-list">
                    <p>Перейти:</p>
                </div>
            </div>
            <div class="col-md-11">
                <div class="subcat-table subcat-gr">
                    <?php if ($submenu && !$l_submenu): ?>
                        <?php foreach ($submenu as $submkey => $subm): ?> 
                            <a href="?view=cat&amp;category=<?= $submkey ?>"><?= $subm[0] ?></a><span class="subcat-divider">&bull;</span>
                        <?php endforeach; ?>
                    <?php elseif($subcats): ?>
                        <?php foreach ($subcats as $subkey => $subcat): ?> 
                            <a href="?view=cat&amp;category=<?= $subkey ?>"><?= $subcat[0] ?></a><span  class="subcat-divider">&bull;</span>
                        <?php endforeach; ?>
                    <?php endif; ?>        
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="subcat-wrap cat-wrap clearfix">
                <div class="col-sm-2">
                    <span>Вид: </span>
                    <span class="style-grid fa fa-th icon-grid" aria-hidden="true"></span>
                    <span class="style-list fa fa-th-list icon-list" aria-hidden="true"></span>
                </div>
                <div class="col-sm-4">
                    <?php if ($pages_count > 1) : ?>
                        <div class="vid-sort">
                            <span>Сортировка:&nbsp;</span>
                            <a href="#param_order" class="nav-toggle sort-top"><?= $order ?></a>
                            <div id="param_order" class="sort-wrap">
                                <?php foreach ($order_p as $key => $value): ?>
                                    <?php if ($value[0] == $order) continue; ?>
                                    <a href="?view=cat&amp;category=<?= $category ?>&amp;order=<?= $key ?>&amp;page=<?= $page ?>" class="sort-bot"><?= $value[0] ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-4 hidden-xs">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm paggy">
                            <?php if ($pages_count > 1) pagination($page, $pages_count); ?>
                        </ul>
                    </nav>
                </div>  
                <div class="col-sm-2 hidden-xs">
                    <span>Найдено товаров: </span><span class="subcat-qnty"><?= $count_rows ?></span>
                </div>
            </div>
        </div>
        <div class="hr hr-top">
            <div class="gorizontal"></div>
            <div class="vertical"></div>
        </div>
        <?php if ($products) : // если получены товары категории ?>    
            <?php $chunk_products = array_chunk($products, 6, true); ?>
            <?php foreach ($chunk_products as $key1 => $item1): ?>    
                <div class="row grid-row">
                    <?php foreach ($item1 as $key2 => $item2): ?>
                        <div class="col-xs-6 col-sm-4 col-md-2">
                            <div class="thumbnail onpage onpage-best ongood">
                                <div class="best-img">
                                    <i class="fa fa-search-plus"></i>
                                    <a href="?view=product&amp;goods_id=<?= $item2['goods_id'] ?>"><img class="img-rounded lupa" src="<?= PRODUCTIMG ?><?= $item2['img'] ?>" alt="<?= $item2['name'] ?>">
                                    </a>
                                </div>
                                <p class="best-title"><a href="?view=product&amp;goods_id=<?= $item2['goods_id'] ?>"><?= $item2['name'] ?></a></p>
                                <div class="product-buy">
                                    <?php if ($item2['available'] == '1'): ?>
                                        <p class="best-caption"><?= $item2['price'] ?><span class="rouble">c </span>
                                            <?php if ($item2['old_price']): ?>     
                                                <span class="product-old-price"><?= $item2['old_price'] ?><span class="rouble">c</span></span>
                                            <?php endif; ?>
                                        </p>
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
                                            <button type="submit" class="btn">В корзину</button>
                                        </form>
                                    <?php elseif ($item2['available'] == '0'): ?>
                                        <p class="best-caption n-a"><?= $item2['price'] ?><span class="rouble">c </span>
                                            <?php if ($item2['old_price']): ?>     
                                                <span class="product-old-price"><?= $item2['old_price'] ?><span class="rouble">c</span></span>
                                            <?php endif; ?>
                                        </p>
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
        <?php if ($products) : // если получены товары категории ?>    
            <?php foreach ($products as $key => $item): ?> 
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
                            <p class="best-caption"><?= $item['price'] ?><span class="rouble">c </span>
                                <?php if ($item['old_price']): ?>     
                                    <span class="product-old-price"><?= $item['old_price'] ?><span class="rouble">c</span></span>
                                <?php endif; ?>
                            </p>
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
                                        <button type="submit" class="btn">В корзину</button>
                                    </form>
                                <?php elseif ($item['available'] == '0'): ?>
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
                    <div class="col-sm-2">
                        <span>Вид: </span>
                        <span class="style-grid fa fa-th icon-grid" aria-hidden="true"></span>
                        <span class="style-list fa fa-th-list icon-list" aria-hidden="true"></span>
                    </div>
                    <div class="col-sm-8 hidden-xs">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm paggy">
                                <?php if ($pages_count > 1) pagination($page, $pages_count); ?>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-sm-2 hidden-xs">
                        <span>Найдено товаров: </span><span class="subcat-qnty"><?= $count_rows ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php require_once 'inc/socials.php'; ?>
    </div> <!-- ./container -->
</section> <!-- ./main-content -->
</body>
</html>