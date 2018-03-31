<?php defined('ISHOP') or die('Access denied'); ?>
<?php // require_once 'inc/mainmenu.php'; ?>
<?php require_once 'inc/index_mainmenu.php'; ?>

<section class="main-content">
    <div class="container">

        <div class="row">
            <div class="col-sm-9">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <?php if(count($brand_name) > 1):  ?>
                            <li><a href="<?=PATH?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li><a href="?view=catalog">Каталог товаров</a></li>
                            <li><a href="?view=cat&amp;category=<?=$brand_name[0]['brand_id']?>"><?=$brand_name[0]['brand_name']?></a></li>
                            <li><a href="?view=cat&amp;category=<?=$brand_name[1]['brand_id']?>"><?=$brand_name[1]['brand_name']?></a></li>
                            <li class="active"><?= $goods['name'] ?></li>
                         <?php elseif(count($brand_name == 1)): ?>
                            <li><a href="<?=PATH?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li><a href="?view=catalog">Каталог товаров</a></li>
                            <li><a href="?view=cat&amp;category=<?=$brand_name[0]['brand_id']?>"><?=$brand_name[0]['brand_name']?></a></li>
                            <li class="active"><?= $goods['name'] ?></li>
                        <?php endif; ?>
                    </ol>
                </div>          
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="hr">
                    <div class="gorizontal"></div>
                    <div class="vertical"></div>
                </div>
            </div>
        </div> 
        <?php if ($goods) : ?>
            <div class="row">
                <div class="col-sm-8 col-sm-push-2">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h4><?= $goods['name'] ?></h4>
                            <?php if ($goods['img_slide']) : ?>    
                                <div class="item_gallery">
                                    <div class="item_img">
                                        <img src=""> 
                                    </div>
                                    <div class="item_thumbs">
                                        <?php foreach ($goods['img_slide'] as $item): ?>
                                            <a href="<?=GALLERYIMG?>photos/<?=$item ?>"><img src="<?=GALLERYIMG?>thumbs/<?=$item?>" /></a>
                                        <?php endforeach; ?>    
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="row search-row">
                <div class="col-sm-10 col-sm-push-1">
                    <div class="onpage onpage-best ongood onprod clearfix">
                        <div class="col-xs-5 col-sm-3">
                            <div class="best-img">
                                <a class="a-search" href="?view=product&amp;goods_id=<?= $goods['goods_id'] ?>"><img class="img-rounded" src="<?= PRODUCTIMG ?><?= $goods['img'] ?>" alt="<?= $goods['name'] ?>">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-7 col-sm-4">
                            <p class="prod-title"><?= $goods['name'] ?></p>
                            <div class="product-content"><?= $goods['anons'] ?></div>
                            <br />
                            <div class="product-txt"><?= $goods['content'] ?></div>
                            <br /><br />
                        </div>
                        <div class="clearfix visible-xs-block"></div>
                        <div class="col-xs-5 col-sm-2">
                            <p class="best-caption"><?= $goods['price'] ?> <span class="rouble">c </span>
                            <?php if($goods['old_price']): ?>     
                            <span class="product-old-price"><?= $goods['old_price'] ?><span class="rouble">c</span></span>
                            <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-xs-7 col-sm-3">
                            <div class="product-buy">
                                <?php if($goods['available'] == '1'): ?>
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
                                    <input type="hidden" name="goods_id" value="<?= $goods['goods_id'] ?>">
                                    <button type="submit" class="btn">В корзину"</button>
                                </form>
                                <?php elseif($goods['available'] == '0'): ?>
                                <span class="btn-rose">Нет в наличии</span>
                                <?php endif; ?>
                                <p class="product-articul">
                                    Артикул: <span class="articul"><?= $goods['articul'] ?></span>
                                </p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div> 
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

        <?php require_once 'inc/socials.php'; ?>
    </div> 
</section> 
</body>
</html>

