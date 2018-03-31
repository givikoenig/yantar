<?php defined('ISHOP') or die('Access denied'); ?>
<?php // require_once 'inc/mainmenu.php';  ?>
<?php require_once 'inc/index_mainmenu.php'; ?>

<section class="main-content cat-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="active">Каталог товаров</li>
                    </ol>
                </div>          
            </div>
        </div>
        <?php // print_arr($cat); ?>
        <?php $chunk_cat2 = array_chunk($cat, 2, true); ?>
        <?php foreach ($chunk_cat2 as $kle2 => $itm2): ?>
            <div class="hr">
                <div class="gorizontal"></div>
                <div class="vertical"></div>
            </div>
            <div class="row">
                <div class="cols-wrap clearfix">
                    <?php foreach ($itm2 as $subkey2 => $subitem2): ?>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumbnail onpage th-cat">
                                        <?php if (!empty($subitem2[0])): ?>
                                        <div class="imgwrap">
                                            <a href="?view=cat&amp;category=<?= $subkey2 ?>"><img class="img-circle img-responsive" src="<?=PRODUCTIMG?><?= $subitem2[1] ?>" alt="<?= $subitem2[0] ?>"></a>
                                        </div>    
                                        
                                        <a href="?view=cat&amp;category=<?= $subkey2 ?>"><p class="caption"><?= $subitem2[0] ?></p></a>
                                            
                                        <?php else: ?>
                                            <p class="caption">Категория не определена</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="subcat-wrap">
                                        <span>Товаров: </span>
                                        <?php if(count_rows($subkey2)): ?>
                                        <span class="subcat-qnty"><?= count_rows($subkey2) ?>, </span>
                                        <span>от </span>
                                        <span class="subcat-min"><?= min(prices($subkey2)) ?> </span>
                                        <span>до </span>
                                        <span class="subcat-max"><?= max(prices($subkey2)) ?> </span>
                                        <span>руб.</span>
                                        <?php else: ?>
                                        <span>0</span>
                                        <?php endif;?>
                                        <div class="subcat-table table-responsive">
                                            <table class="table hidden-xs">
                                                <tbody>
                                                    <?php if (!empty($subitem2['sub'])): //если это родит.катег-я?>
                                                        <?php $chunk_subcat = array_chunk($subitem2['sub'], 2, true); ?>
                                                        <?php foreach ($chunk_subcat as $subkey3 => $subitem3): ?>    
                                                            <tr >  
                                                                <?php foreach ($subitem3 as $subkey4 => $subitem4): ?>
                                                                    <?php if (empty(submenu($subkey4))): ?>
                                                                        <td><a href="?view=cat&amp;category=<?= $subkey4 ?>"><?= $subitem4 ?></a></td>
                                                                    <?php else: ?>
                                                                        <td>
                                                                            <!-- Split button -->
                                                                            <div class="btn-group action-button ">
                                                                                <a href="?view=cat&amp;category=<?= $subkey4 ?>"><?= $subitem4 ?></a><br />
                                                                                <button type="button" class="btn btn-xs dropdown-toggle mini" data-toggle="dropdown" aria-expanded="false">
                                                                                    <span class="caret"></span>
                                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                                </button>
                                                                                <ul class="dropdown-menu catalog-submenu" role="menu">
                                                                                    <?php $sub_menu = submenu($subkey4); ?>
                                                                                    <?php foreach ($sub_menu as $submenukey => $submenuitem): ?>
                                                                                        <li class="submenu-str"><a href="?view=cat&amp;category=<?= $submenukey ?>"><?= $submenuitem[0] ?></a></li>
                                                                                    <?php endforeach; ?>
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </tr>  
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>     
                                                </tbody>
                                            </table>
                                            <table class="table xstable visible-xs-block">
                                                <tbody>
                                                    <?php if (!empty($subitem2['sub'])): ?>
                                                        <?php foreach ($subitem2['sub'] as $subkey4 => $subitem4): ?>
                                                            <tr>
                                                                <?php if (empty(submenu($subkey4))): ?>
                                                                    <td><a href="?view=cat&amp;category=<?= $subkey4 ?>"><?= $subitem4 ?></a></td>
                                                                <?php else: ?>
                                                                    <td>
                                                                        <!-- Split button -->
                                                                        <div class="btn-group action-button ">
                                                                            <a href="?view=cat&amp;category=<?= $subkey4 ?>"><?= $subitem4 ?></a><br />
                                                                            <button type="button" class="btn btn-xs dropdown-toggle mini" data-toggle="dropdown" aria-expanded="false">
                                                                                <span class="caret"></span>
                                                                                <span class="sr-only">Toggle Dropdown</span>
                                                                            </button>
                                                                            <ul class="dropdown-menu catalog-submenu" role="menu">
                                                                                <?php $sub_menu = submenu($subkey4); ?>
                                                                                <?php foreach ($sub_menu as $submenukey => $submenuitem): ?>
                                                                                    <li class="submenu-str"><a href="?view=cat&amp;category=<?= $submenukey ?>"><?= $submenuitem[0] ?></a></li>
                                                                                    <?php endforeach; ?>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                <?php endif; ?>
                                                            </tr>         
                                                        <?php endforeach; ?>
                                                        <?php // endforeach; ?>
                                                    <?php endif; ?>     
                                                </tbody>
                                            </table>
                                        </div> <!-- ./subcat-table -->
                                    </div> <!-- ./subcat-wrap -->
                                </div>
                            </div> 
                        </div>
                    <?php endforeach; ?>                                
                </div>
            </div> 
        <?php endforeach; ?>

        <?php require_once 'inc/socials.php'; ?>

    </div> <!-- ./container -->
</section> <!-- ./main-content -->


