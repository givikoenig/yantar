<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Редактирование информера</h4>
                <hr class="hr">
                <br />
                <?php
                    if(isset($_SESSION['edit_informer']['res'])){
                        echo $_SESSION['edit_informer']['res'];
                        unset($_SESSION['edit_informer']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название информера:</td>
                            <td><input class="form-control head-text" type="text" name="informer_name" value="<?= htmlspecialchars($get_informer['informer_name'])?>"/></td>
                        </tr>
                        <tr>
                            <td>Иконка:
                                <p class="current-icon">(текущая: <i class ="fa <?=$get_informer['icon']?> fa-2x"></i> )</p>
                            </td>
                            <td>
                                <input class="form-control icp icp-auto iconpicker inf-icon" name="icon" type="text" value="<?= htmlspecialchars($get_informer['icon'])?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Позиция информера:</td>
                            <td><input class="form-control num-text" type="text" name="informer_position" value="<?= $get_informer['informer_position']?>"/></td>
                        </tr>
                    </table>
                    <div class="text-center">
                    <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div>
                </form>    
                <?php unset($_SESSION['add_informer']); ?>
            </div>   
        </div>
    </div>
</div>

</body>
</html>


