<?php defined('ISHOP') or die('Access denied'); ?>
<?php require_once 'inc/index_mainmenu.php'; ?>

<section class="main-content">
    <div class="container"> 
        <?php require_once 'inc/maincarousel.php'; ?> 
        <?php if ($info_num): ?>
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
            <div class="row">
                <?php $g = 1 ?>
                <?php foreach ($informers as $informer => $value): ?>
                    <?php if( ($g <= $max_informer_num) &&  ($g <= $info_num) ): ?>
                            <div class="col-xs-<?=$col_num?>">
                                <a name="info"></a>
                                <form class="row-item-col" action="#info_<?= $informer ?>">
                                    <input type="hidden" name="view" value="info">
                                    <div class="info-btn-wrap text-center">
                                        <button type="submit" class="btn-rose order" data-toggle="tooltip" data-placement="top" title="<?= $value[0] ?>">
                                            <i class="fa <?=$value[2]?> fa-2x"></i>
                                        </button>
                                        <p class="hidden-xs"><a href="?view=info#info_<?= $informer?>"><?= $value[0] ?></a></p>
                                    </div>
                                </form>
                            </div>
                                <?php $g++ ?>
                            <?php endif;?>
                <?php endforeach; ?>
                
                <?php // endfor;?>
            </div>
        <?php endif; ?>
        <p class="all-new text-right"><a href="?view=info"><br>Вся информация »</a></p>
        <div class="row"><!-- разделитель новинки -->
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
        </div><!-- ./разделитель новинки -->
        
        
        <div class="novinki">
            <?php if ($new_eyestoppers): ?>
                <?php $chunk_eyestoppers = array_chunk($new_eyestoppers, 4, true); ?>
                <?php foreach ($chunk_eyestoppers as $key1 => $item1): ?>
                    <?php if ($key1 == 2) break; ?> 
                    <?php if ($key1 == 0): ?>
                        <div class="new-products-row">
                        <?php elseif ($key1 == 1): ?>
                            <div class="new-products-row2">
                            <?php endif; ?>
                            <?php foreach ($item1 as $key => $item): ?>
                                <div class="col-md-3 col-sm-6 good<?=($key + 1);?>">
                                    <div class="product">
                                        <div class="product-img hidden-xs">
                                            <a href="?view=product&amp;goods_id=<?= $item['goods_id'] ?>">
                                                <img src="<?= PRODUCTIMG ?><?= $item['img'] ?>" alt="<?= $item['name'] ?>">
                                            </a>
                                        </div>
                                        <div class="product-img visible-xs-block">
                                                <img src="<?= PRODUCTIMG ?><?= $item['img'] ?>" alt="<?= $item['name'] ?>">
                                        </div>
                                        <p class="product-title">
                                            <a href="?view=product&amp;goods_id=<?= $item['goods_id'] ?>"><?= $item['name'] ?></a>
                                        </p>
                                        <?= $item['anons']; ?> 
                                        <p class="product-price"><?= $item['price'] ?><span class="rouble"> c</span></p>
                                        <div class="product-buy">
                                            <form name="cart1">
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
                                            <p class="product-articul">
                                                Артикул: <span class="articul"><?= $item['articul'] ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>     
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            
            <p class="all-new text-right"><a href="?view=new">Все новинки »</a></p>
            <div class="row"><!-- разделитель распродажа -->
                <a name="sales"></a>
                <div class="col-xs-12 line-wrap">
                    <div class="sale-wrap">
                        <div class="hr">
                            <div class="gorizontal"></div>
                            <div class="vertical"></div>
                        </div>
                        <div class="ttl">
                            <h2>распродажа</h2>
                        </div>
                    </div>
                </div>
            </div><!-- ./разделитель распродажа -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="sale-slider">
                        <div class="sale-screen">
                            <div id="owl-sale" class="owl-carousel">
                                <?php if ($sale_eyestoppers): ?>
                                    <?php foreach ($sale_eyestoppers as $key => $sales): ?>
                                        <?php if ($key == $max_sale_img) break; ?>
                                        <div class="item">
                                            <div class="sale-product">
                                                <!--<div class="burst-8"></div>-->    
                                                <!--<i class="fa fa-thumbs-o-down fa-2x prcnt" aria-hidden="true"></i>-->
                                            <!--<span class="prcnt">-25%</span>--> 
                                                <div class="product-img">
                                                    <a href="?view=product&amp;goods_id=<?= $sales['goods_id'] ?>"><img src="<?= PRODUCTIMG ?><?= $sales['img'] ?>" alt="<?= $sales['name'] ?>"></a> 
                                                </div> 
                                                <p class="product-title">
                                                    <a href="?view=product&amp;goods_id=<?= $sales['goods_id'] ?>"><?= $sales['name'] ?></a>
                                                </p>
                                                <?= $sales['anons'] ?>
                                                <p class="product-price"><?= $sales['price'] ?>
                                                    <span class="rouble"> c</span>
                                                    <span>&nbsp;&nbsp;&nbsp;</span>
                                                    <span class="product-old-price"><?= $sales['old_price'] ?>
                                                        <span class="rouble"> c</span>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div> <!-- ./#owl-sale" ./owl-carousel -->
                            <div class="customNavigation">
                                <a class="sbtn prev" type="button">
                                    <div class="sale-left-wrap hidden-xs">
                                        <i class="fa fa-square fa-2x" aria-hidden="true"></i>
                                        <span class="fa fa-chevron-left" aria-hidden="true"></span>
                                    </div>
                                </a>
                                <a class="sbtn next">
                                    <div class="sale-right-wrap hidden-xs">
                                        <i class="fa fa-square fa-2x" aria-hidden="true"></i>
                                        <span class="fa fa-chevron-right" aria-hidden="true"></span>
                                    </div>
                                </a>
                            </div><!--./customNavigation -->
                        </div><!--./sale-screen -->
                    </div><!--./sale-slider -->
                </div><!--./col распродажа -->
            </div> <!--./row распродажа -->
            <p class="all-new text-right"><a href="?view=sale"><br>Распродажа »</a></p>
            <div class="row"><!-- разделитель почему мы -->
                <a name="why"></a>
                <div class="col-xs-12 line-wrap">
                    <div class="whywe-wrap">
                        <div class="hr">
                            <div class="gorizontal"></div>
                            <div class="vertical"></div>
                        </div>
                        <div class="ttl">
                            <h2>почему мы</h2>
                        </div>
                    </div>
                </div>
            </div><!-- ./разделитель почему  мы-->
            <div class="row"> <!-- почему мы-->
                <div class="col-md-6">
                    <div class="row why-row-left">
                        <div class="col-sm-6">
                            <img src="<?= TEMPLATE ?>images/girl1.jpg" class="img-rounded img-left" alt="" width="245">
                            <div class="caption caption-left">
                                <p><a href="?view=cart" class="btn-rose" role="button">разместить заказ</a></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Самый крупный производитель фигурок из янтаря и латуни в России</p>
                            </div>
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Производство полного цикла с постоянным усовершенствованием процесса</p>
                            </div>
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Большой ассортимент сувениров, бижутерии, брелоков отличного качества</p>
                            </div>
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Гибкие условия сотрудничества</p>
                            </div>
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Корпоративные подарки</p>
                            </div>
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Приятные цены на нашу продукцию</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row why-row-right">
                        <div class="col-sm-6">
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Эксклюзивные, штучные сувениры</p>
                            </div>
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Вся продукция отличается высочайшей, на уровне ювелирных изделий, степенью детализации</p>
                            </div>
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Наши производства находятся в Калининграде и Костроме,  — там, где живут и творят лучшие в России мастера ювелирной обработки и сувенирного литья</p>
                            </div>
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Металлолитье производится только из латуни и бронзы, без посторонних примесей</p>
                            </div>
                            <div class="we-txt">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                <p>Максимально быстрые сроки доставки</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="caption caption-right">
                                <p><a href="#" class="btn-rose" role="button">обратная связь</a></p>
                            </div>
                            <img src="<?= TEMPLATE ?>images/girl2.jpg" class="img-rounded img-right" alt="" width="245">
                        </div>
                    </div>
                </div>
            </div> <!-- ./почему мы-->
            <div class="row"><!-- разделитель хиты продаж -->
                <a name="best"></a>
                <div class="col-xs-12 line-wrap">
                    <div class="thebest-wrap">
                        <div class="hr">
                            <div class="gorizontal"></div>
                            <div class="vertical"></div>
                        </div>
                        <div class="ttl">
                            <h2>хиты продаж</h2>
                        </div>
                    </div>
                </div>
            </div><!-- ./разделитель хиты продаж -->
            <?php if ($hits_eyestoppers): ?>
                <?php $chunk_eyestoppers = array_chunk($hits_eyestoppers, 4, true); ?>
                <?php foreach ($chunk_eyestoppers as $key1 => $item1): ?>
                    <?php if ($key1 == 2) break; ?> 
                    <div class="row">
                        <?php foreach ($item1 as $key => $item): ?>
                            <div class="col-xs col-sm-4 col-md-3">
                                <div class="thumbnail onpage onpage-best">
                                    <div class="best-img">
                                        <a href="?view=product&amp;goods_id=<?= $item['goods_id'] ?>"><img class="img-rounded" src="<?= PRODUCTIMG ?><?= $item['img'] ?>" alt="<?= $item['name'] ?>"></a>
                                    </div>
                                    <p class="product-title best-title">
                                        <a href="?view=product&amp;goods_id=<?= $item['goods_id'] ?>"><?= $item['name'] ?></a>
                                    </p>
                                    <div class="product-buy">
                                        <p class="best-caption"><?= $item['price'] ?> <span class="rouble"> c</span></p>
                                        <form name="cart3">
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
                                        <p class="product-articul">
                                            Артикул: <span class="articul"><?= $item['articul'] ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>      
                <?php endforeach; ?>
            <?php endif; ?>                    
            <p class="all-new text-right"><a href="?view=hits">Хиты продаж »</a></p>

            <div class="row">
                <a name="news"></a>
                <div class="col-xs-12 line-wrap">
                    <div class="new-wrap">
                        <div class="hr">
                            <div class="gorizontal"></div>
                            <div class="vertical"></div>
                        </div>
                        <div class="ttl">
                            <h2>новости</h2>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-4 col-sm-push-4">
                    <div class="news text-center">
                        <?php if ($news): ?>
                            <?php foreach ($news as $item): ?>
                                <p>
                                    <span><?=$item['data']?></span><br />
                                    <a href="?view=news&amp;news_id=<?=$item['news_id']?>"><?=$item['title']?></a>
                                </p>
                            <?php endforeach; ?>
                                <a href="?view=archive" class="news-arh">Архив новостей</a>
                        <?php else: ?>
                            <p>Новостей пока нет.</p>
                        <?php endif; ?>
                    </div>
                </div>   
            </div>
            <?php require_once 'inc/socials.php'; ?>
        </div> <!--./container-->
</section><!-- ./main-content -->
