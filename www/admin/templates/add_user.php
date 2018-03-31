<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'users_leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Добавление пользователя</h4>
                <hr class="hr">
                <br />
                <?php
                    if(isset($_SESSION['add_user']['res'])){
                        echo $_SESSION['add_user']['res'];
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">* Имя пользователя:</td>
                            <td><input class="head-text form-control" type="text" name="name" value="<?=htmlspecialchars($_SESSION['add_user']['name'])?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">* Логин пользователя:</td>
                            <td><input class="head-text form-control" type="text" name="login" value="<?=htmlspecialchars($_SESSION['add_user']['login'])?>" /></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">* Пароль:</td>
                            <td><input class="head-text form-control" type="text" name="password" value="<?=htmlspecialchars($_SESSION['add_user']['password'])?>" /></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">* Email пользователя:</td>
                            <td><input class="head-text form-control" type="text" name="email" value="<?=htmlspecialchars($_SESSION['add_user']['email'])?>" /></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Роль пользователя:</td>
                            <td>
                                <?php if($roles): ?>
                                <select class="select-inf form-control selectpicker show-tick" name="id_role">
                                    <?php foreach ($roles as $item): ?>
                                    <option value="<?=$item['id_role']?>"><?=$item['name_role']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php endif;?>
                            </td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div>
                </form>
                <?php unset($_SESSION['add_user']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>

