<?php defined('ISHOP') or die('Access denied'); ?>
<div class="main-menu">
    <nav class="navbar navbar-inverse">
        <span class="visible-xs-block text-center xs-cat "><i class="fa fa-book" aria-hidden="true"></i> каталог</span>
        <div class="container">
            <div class="mainmenu inner-pages">
                <ul class="nav navbar-nav">
                    
                    <?php if ($view != 'catalog'): ?>
                    <li class="dropdown inner-page cat">
                        <a href="?view=catalog" class="dropdown-toggle" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book" aria-hidden="true"></i> каталог</a>
                        <ul class="dropdown-menu">
                            <div class="container">
                            <?php $chunk_cat = array_chunk($cat, 4, true);  ?>
                                <?php foreach ($chunk_cat as $kle => $itm):  ?>
                                <div class="row">
                                    <?php foreach ($itm as $subkey => $subitem):  ?>
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="thumbnail">
                                            <a href="?view=cat&amp;category=<?=$subkey?>"><img src="<?=PRODUCTIMG?><?=$subitem[2]?>" alt="<?=$subitem[0]?>">
                                            <p class="caption"><?=$subitem[0]?></p>
                                            </a>
                                        </div>    
                                    </div>
                                    <?php endforeach; ?>                                
                                </div>
                             <?php endforeach; ?>
                            </div>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <?php foreach ($menu as $key => $item):  ?>
                    <li class="inner-page hidden-xs"><a href="?view=cat&amp;category=<?=$key?>"><?=$item[0]?></a></li>
                    <?php endforeach; ?>
                </ul> <!-- /.nav navbar-nav -->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav><!-- ./navbar -->
</div><!-- ./main-menu --> 

