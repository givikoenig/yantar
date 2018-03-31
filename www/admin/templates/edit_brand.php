<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'cat_leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <?php // print_arr($cat);?>
               <?php // echo $parent_id; ?>
                <hr class="hr">
                <h4>Редактирование категории</h4>
                <hr class="hr">
                <br />
                <?php
                    if(isset($_SESSION['edit_brand']['res'])){
                        echo $_SESSION['edit_brand']['res'];
                        unset($_SESSION['edit_brand']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название категории:</td>
                            <?php if($cat_name): ?>
                                <td><input class="head-text" type="text" name="brand_name" value="<?=$cat_name?>"/></td>
                            <?php else: ?>
                                <td><input class="head-text" type="text" name="brand_name" value="<?=brandname($brand_id);?>"/></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Родительская категория:</td>
                            <?php if(!$cat[$brand_id]['sub']): //если нет подкатегории ?>
                            <td>
                                <select class="select-inf form-control selectpicker show-tick  show-menu-arrow" name="parent_id">
                                    <option value="0">Самостоятельная категория</option>
                                    <?php foreach ($cat as $key => $value): ?>
                                      <option <?php if($parent_id == $key) echo "selected";?> value="<?= $key ?>"><?= $value[0] ?></option>
                                        <optgroup label="<?= $value[0] ?>">
                                            <?php if($cat[$key]['sub']): ?>
                                                <?php foreach ($cat[$key]['sub'] as $key1 => $value1): ?>
                                                    <option  <?php if($parent_id == $key1) echo "selected"; ?> value="<?= $key1 ?>"><?= $value1 ?></option>
                                                <?php endforeach; ?>
                                            <?php endif;?>    
                                        </optgroup>        
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <?php // elseif($aa):?>
                            <?php else:?>
                                <td>Нет</td>
                            <?php endif;?>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button name="edbrand" type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div>    
                </form> 
                <?php if(!$parent_id): ?>
                <a href="?view=edit_brand_image&amp;brand_id=<?=$brand_id?>" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Сменить базовую картинку</a>
                <?php endif; ?>
                <?php unset($_SESSION['edit_brand']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>


