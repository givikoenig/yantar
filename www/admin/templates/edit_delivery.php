<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Редактирование способа доставки</h4>
                <hr class="hr">
                <br />
                
                <?php // print_arr($get_dostavka);?>
                <?php
                    if(isset($_SESSION['edit_delivery']['res'])){
                        echo $_SESSION['edit_delivery']['res'];
                        unset($_SESSION['edit_delivery']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Способ доставки:</td>
                            <td><input class="head-text form-control" type="text" name="name" value="<?= htmlspecialchars($get_dostavka['name']) ?>" /></td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div>    
                </form>
                <?php unset($_SESSION['edit_delivery']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>

