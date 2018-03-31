<?php defined('ISHOP') or die('Access denied'); ?>
<footer>
    <div class="footer-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h1>
                        <a href="./">YANTAR-SHOP</a>
                        <br>
                        <a href="tel:+79165276545">+7 916 527 65 45</a>
                        <br>
                        <a class="email" data-account="baltbereg39"><i class="fa fa-envelope"></i></a>
                    </h1>
                </div>
                
                <div class="col-md-9">
                    <div class="footer-right">
                        <h2 class="">
                           <a href="<?=PATH?>">Главная</a>
                           <a href="?view=catalog">Каталог</a>
                           <?php if($pages): ?>
                              <?php foreach($pages as $item): ?>
                                 <a href="?view=page&amp;page_id=<?=$item['page_id']?>"><?=$item['title']?></a>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        </h2>
                    </div>
                </div>    
                
            </div><!--./row-->
        </div><!--./container-->
    </div><!--/.footer-menu-->
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <p>© 2016 «YANTAR-SHOP». Все права защищены</p>
                </div>
                <div class="col-xs-6 text-right">
                    <span>Designed by: </span><a href="#">GIVik</a>
                    <!--http://givik.ru" target="_blank-->
                </div>
            </div>
        </div>
    </div><!--/.footer-copyright-->
</footer>
