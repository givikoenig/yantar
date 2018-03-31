<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'cat_leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Смена картинки категории</h4>
                <hr class="hr">
                <br />
                <?php
                    if(isset($_SESSION['edit_brand_image']['res'])){
                        echo $_SESSION['edit_brand_image']['res'];
                        unset($_SESSION['edit_brand_image']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название категории:</td>
                            <?php if($cat_name): ?>
                            <td><input class="head-text form-control" type="text" name="brand_name"  value="<?=$cat_name?>" readonly="" /></td>
                            <?php else: ?>
                                <td><input class="head-text" type="text" name="brand_name" value="<?=brandname($brand_id);?>"/></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Текущая картинка:</td>
                            <td><img src="<?=PRODUCTIMG . brandimg($brand_id) ?>" alt="<?=$cat_name?>"/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="file" name="brandimg" /></td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Загрузить картинку</button>
                    </div>
                </form>    
                <?php unset($_SESSION['edit_brand_image']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>


