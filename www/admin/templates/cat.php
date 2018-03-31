<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <div class="row">
        <?php include 'cat_leftbar.php'; ?>    

        <div class="col-sm-8">
            <div class="content">
                <?php // print_arr($cat); ?>
                <hr class="hr hr-brand">
                <h4>Редактирование каталога</h4>
                <div class="clearfix"></div>
                <hr class="hr hr-brand">
                <?php
                if (isset($_SESSION['answer'])) {
                    echo $_SESSION['answer'];
                    unset($_SESSION['answer']);
                }
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumbs">
                            <ol class="breadcrumb">
                                <?php if (count($brand_name) > 1): ?>
                                    <li><a href="?view=brands">Категории</a></li>
                                    <?php if( ($brand_name[1]['sub_sub']  == 1) && ($brand_name[0]['has_child']  == 1) ): ?>
                                        <?php $grandmom =  brand_name($brand_name[0]['parent_id']);?>
                                        <?php $grandmom_name = $grandmom[0]['brand_name']; ?>
                                    <li><a href="?view=cat&amp;category=<?= $grandmom[0]['brand_id'] ?>"><?=$grandmom_name?></a></li>
                                    <?php endif; ?>
                                    <li><a href="?view=cat&amp;category=<?= $brand_name[0]['brand_id'] ?>"><?= $brand_name[0]['brand_name'] ?></a></li>
                                    <li class="active"><?= $brand_name[1]['brand_name'] ?></li>
                                <?php elseif (count($brand_name == 1)): ?>
                                    <li><a href="?view=brands">Категории</a></li>
                                    <li class="active"><?= $brand_name[0]['brand_name'] ?></li>
                                <?php endif; ?>
                            </ol>
                        </div>          
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-xs-9">
                        <a href="?view=add_brand" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Добавить категорию</a> 
                    </div> 
                    <div class="col-md-1 col-xs-1">
                        <?php if($category == $brand_name[0]['brand_id']): ?>
                            <a href="?view=edit_brand_image&amp;brand_id=<?= $category ?>" class="chim" title="Сменить картинку категории"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                        <?php endif;?>
                    </div>
                    <div class="col-md-1 col-xs-1">
                        <?php if(!($category == $brand_name[0]['brand_id'])): ?>
                            <a class="edit" href="?view=edit_brand&amp;brand_id=<?= $category ?>&amp;parent_id=<?=$brand_name[0]['brand_id'] ?>"title="Редактировать категорию"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php else:?>    
                            <a class="edit" href="?view=edit_brand&amp;brand_id=<?= $category ?>" title="Редактировать категорию"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        
                        <?php endif;?>
                    </div>
                    <div class="col-md-1 col-xs-1">
                        <a href="?view=del_brand&amp;brand_id=<?= $category ?>" class="del" title="Удалить категорию"><i class="fa fa-times" aria-hidden="true"></i></a>
                    </div>
                </div>
                <hr class="hr hr-brand">
                <br />
                <div class=" text-center">
                    <a href="?view=add_product&amp;brand_id=<?= $category ?>" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Добавить товар</a>
                </div>
                <br />
                <?php if ($products): // если есть товары?>
                    <?php
                    $col = 3; // количество ячеек в строке
                    $row = ceil((count($products) / $col)); // количество рядов
                    $start = 0;
                    ?>
                    <table class="tabl-kat table" cellspacing="1">
                        <?php for ($i = 0; $i < $row; $i++): // цикл вывода рядов ?>
                            <tr>
                                <?php for ($k = 0; $k < $col; $k++): // цикл вывода ячеек ?>
                                <td class="text-center">
                                        <?php if ($products[$start]): // если есть товар ?>
                                            <div class="tovar">
                                            
                                            <div class="row tovarmarks">
                                                <div class="col-xs-6 text-center i-unavailable">
                                                    <?php if($products[$start]['visible'] == '0') echo "<i id='blink' class='fa fa-eye-slash' aria-hidden='true' title='Товар скрыт на сайте!'></i>"?>
                                                </div>    
                                                <div class="col-xs-6 text-center i-unvisible">
                                                    <?php if($products[$start]['available'] == '0') echo "<i  id='blink' class='fa fa-minus-square-o' aria-hidden='true' title='Товара нет в наличии!'></i>"?>
                                                </div>  
                                            </div>
                                            <img src="<?=PRODUCTIMG . $products[$start]['img'] ?>" alt=""/>
                                            <h5><?= $products[$start]['name'] ?></h5>
                                            <div class="tovaract">
                                                <p>
                                                  <a href="?view=edit_product&amp;goods_id=<?= $products[$start]['goods_id'] ?>" class="edit" title="Редактировать товар"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                  <a href="?view=del_product&amp;goods_id=<?= $products[$start]['goods_id'] ?>" class="del" title="Удалить товар"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>  
                                                </p>
                                            </div>
                                            </div>
                                        <?php else: // если нет товара ?>
                                            &nbsp;
                                        <?php endif; // перенос внутрь ячейки ?>
                                        <?php $start++; ?>
                                    </td>
                                <?php endfor; // конец цикла вывода ячеек ?>
                            </tr>
                        <?php endfor; // конец цикла вывода рядов ?>
                    </table>
                <?php else: // если нет товаров ?>
                <p class="text-center">Здесь товаров пока нет</p>
                <?php endif; // конец условия: если есть товары ?>
                    <br />
                    <div class=" text-center">    
                        <a href="?view=add_product&amp;brand_id=<?= $category ?>" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Добавить товар</a>
                    </div>    
            </div> <!--./content-->
            <nav class="adm-pag text-center" aria-label="Page navigation">
                <ul class="pagination pagination-sm paggy">
                    <?php if($pages_count > 1) pagination($page, $pages_count); ?>
                </ul>
            </nav>
            <br 
        </div> <!--./col-sm-8-->
    </div>
</div>

</body>
</html>
