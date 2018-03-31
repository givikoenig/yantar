<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'cat_leftbar.php'; ?>
    <div class="col-sm-8">
        <div class="content">
            <?php // echo(in_array('1', $cat[1]['has_child'])); ?>
            <?php // $aa = brand_name(44)[1]['has_child'];?>
            <?php // echo $aa; ?>
            <?php // echo($aa[1]['has_child']); ?>
            <hr class="hr">
            <h4>Добавление категории</h4>
            <hr class="hr">
            <br />
            <?php
            if (isset($_SESSION['add_brand']['res'])) {
                echo $_SESSION['add_brand']['res'];
                unset($_SESSION['add_brand']['res']);
            }
            ?>
            <form enctype="multipart/form-data" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="add-edit-txt">Название категории:</td>
                        <td><input class="head-text" type="text" name="brand_name" /></td>
                    </tr>
                    <tr>
                        <td>Родительская категория:</td>
                        <td>
                             <!--enctype="multipart/form-data"-->
                            <select class="select-inf form-control selectpicker" name="parent_id" >
                                <option value="0">Самостоятельная категория</option>
                                <option data-divider="true"></option>
                                <?php foreach ($cat as $key => $value): ?>
                                    <option value="<?= $key ?>"><?= $value[0] ?></option>
                                    <optgroup label="<?= $value[0] ?>">
                                        <?php if($cat[$key]['sub']): ?>
                                            <?php foreach ($cat[$key]['sub'] as $key1 => $value1): ?><option value="<?= $key1 ?>"><?= $value1 ?></option>
                                            <?php endforeach; ?>
                                        <?php endif;?>
                                    </optgroup>        
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Картинка категории:</td>
                        <td><input type="file" name="brandimg" /></td>
                    </tr>
                    
                    
<!--                    <tr>
                        <td>Базовая картинка:</td>
                        <td>
                            <p class="showimg">Показать</p>
                            <select  class="image-picker select-img form-control" name="brand_img">
                                <option value="">Нет картинки</option>
                                <?php // $dir = '../userfiles/'; ?>
                                <?php // $files = scandir($dir); ?>
                                <?php // for ($i = 0; $i < count($files); $i++): ?>
                                    <?php // if (($files[$i] != ".") && ($files[$i] != "..") && ($files[$i] != "product_img") && ($files[$i] != "upload")): ?>
                                        <option data-img-src="<?= PRODUCTIMG . $files[$i] ?>" value="<?= $files[$i] ?>"><?= $files[$i] ?></option>
                                    <?php // endif; ?>
                                <?php // endfor; ?>
                            </select>
                        </td>
                    </tr>-->
<!--                        <tr>
                        <td colspan="2">
                            <script src="templates/js/workscripts.js"></script>
                            <div id="image" onclick="openKCFinder(this)"><div style="margin:5px">Click here to choose an image</div></div>
                        </td>
                    </tr>-->
                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                </div>    
            </form>   
            <?php unset($_SESSION['add_brand']); ?>
        </div>   
    </div>

</div>
</div>

</body>
</html>


