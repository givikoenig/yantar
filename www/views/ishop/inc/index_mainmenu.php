<?php defined('ISHOP') or die('Access denied'); ?>

<div class="main-menu">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainMenuCollapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse mainmenu" id="mainMenuCollapse">
                <hr class="visible-xs-block">
                <ul class="nav navbar-nav">
                    <?php substr(eyenow(),0,3) == 'cat' ? $out="<li class='dropdown main-page cat active'>" : $out="<li class='dropdown main-page cat'>"; ?>
                        <?=$out?><a href="?view=catalog" class="dropdown-toggle" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book" aria-hidden="true"></i> каталог</a>
                        <ul class="dropdown-menu">
                            <div class="container">
                            <?php $chunk_cat = array_chunk($cat, 4, true);  ?>
                                <?php foreach ($chunk_cat as $kle => $itm):  ?>
                                <div class="row">
                                    <?php foreach ($itm as $subkey => $subitem):  ?>
                                    <div class="col-xs-6 col-sm-3">
                                        <div class="thumbnail ddmenu">
                                            <div class="imgwrap">
                                                <a href="?view=cat&amp;category=<?=$subkey?>"><img src="<?=PRODUCTIMG?><?=$subitem[1]?>" alt="<?=$subitem[0]?>"></a>
                                            </div> 
                                            <div class="captionwrap">    
                                                <a href="?view=cat&amp;category=<?=$subkey?>"><p class="caption"><?=$subitem[0]?></p></a>
                                            </div>
                                            
                                        </div>    
                                    </div>
                                    <?php endforeach; ?>                                
                                </div>
                             <?php endforeach; ?>
                            </div> 
                        </ul>
                    </li>
                    <hr class="visible-xs-block">
                    <?php eyenow() == 'info' ? $out="<li class='main-page active'>" : $out="<li class='main-page'>"; ?>
                    <?=$out?><a href="?view=info"><i class="fa fa-info-circle">&nbsp;</i>информация</a></li>
                    <hr class="visible-xs-block">
                    <?php eyenow() == 'new' ? $out="<li class='main-page active'>" : $out="<li class='main-page'>"; ?>
                    <?=$out?><a href="?view=new"><i class="fa fa-exclamation-circle">&nbsp;</i>новинки</a></li>
                    <hr class="visible-xs-block">
                    <?php eyenow() == 'sale' ? $out="<li class='main-page active'>" : $out="<li class='main-page'>"; ?>
                    <?=$out?><a href="?view=sale"><i class="fa fa-percent">&nbsp;</i>распродажа</a></li>
                    <hr class="visible-xs-block">
                    <?php eyenow() == 'hits' ? $out="<li class='main-page active'>" : $out="<li class='main-page'>"; ?>
                    <?=$out?><a href="?view=hits"><i class="fa fa-heart">&nbsp;</i>хиты продаж</a></li>

<!--    второй вариант меню на гл.странице                
                    <li class="main-page"><a href="<?php echo '?view=kat'; ?>#souvenir">сувениры</a></li>
                    <hr class="visible-xs-block">
                    <li class="main-page">
                        <a href="<?php echo '?view=kat'; ?>#brooch">украшения</a>
                    </li>
                    <hr class="visible-xs-block">
                    <li class="twin main-page">
                        <a href="<?php echo '?view=kat'; ?>#casting">художественное<span class="tw1">литье</span></a>
                    </li>
                    <hr class="visible-xs-block">
                    <li class="twin main-page">
                        <a href="<?php echo '?view=kat'; ?>#amulet">обереги, <span class="tw2"> амулеты</span></a>
                    </li>
                    <hr class="visible-xs-block">
                    <li class="main-page"><a href="<?php echo '?view=kat'; ?>#trinket">брелоки</a></li>
                    <hr class="visible-xs-block">
                    <li class="main-page"><a href="<?php echo '?view=kat'; ?>#amulet">монеты</a></li>
                    <hr class="visible-xs-block">
                    <li class="main-page"><a class="gift" href="#">распродажа</a></li>
                    <hr class="visible-xs-block">
                    <li class="main-page"><a href="?view=kat"><i class="fa fa-book" aria-hidden="true"></i> каталог</a></li>
                    <hr class="visible-xs-block">
                    -->
                    
                </ul>
            </div>
        </div>
    </nav>
</div>
