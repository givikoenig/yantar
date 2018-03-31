<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'users_leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <?php // print_arr($get_user);?>
                <hr class="hr">
                <h4>Редактирование пользователя</h4>
                <hr class="hr">
                <br />
                <?php
                    if(isset($_SESSION['edit_user']['res'])){
                        echo $_SESSION['edit_user']['res'];
                        unset($_SESSION['edit_user']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Имя пользователя:</td>
                            <td><input class="head-text form-control" type="text" name="name" value="<?=  htmlspecialchars($get_user['name'])?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Логин:</td>
                            <td>
                                <?php if($_SESSION['auth']['user_id'] != $user_id): //если редактируется не свой профиль ?>
                                    <input class="head-text form-control" type="text" name="login" value="<?=  htmlspecialchars($get_user['login'])?>" />
                                <?php else: //если редактируется свой профиль?>
                                    <input class="head-text form-control" type="text" name="login" value="<?=  htmlspecialchars($get_user['login'])?>" disabled="" />
                                    <span class="small">(Собственный логин изменить нельзя)</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Новый пароль:</td>
                            <td><input class="head-text form-control" type="text" name="password" /></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Email:</td>
                            <td><input class="head-text form-control" type="text" name="email" value="<?= htmlspecialchars($get_user['email'])?>" /></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Телефон:</td>
                            <td><input class="head-text form-control" type="text" name="phone" value="<?=  htmlspecialchars($get_user['phone'])?>" /></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Адрес:</td>
                            <td><input class="head-text form-control" type="text" name="address" value="<?=  htmlspecialchars($get_user['address'])?>" /></td>
                        </tr>
                        <?php if($_SESSION['auth']['user_id'] != $user_id): //если редактируется не свой профиль ?>
                        <tr>
                            <td class="add-edit-txt">Роль пользователя:</td>
                            <td>
                                <?php if($roles): ?>
                                <select class="select-inf form-control selectpicker show-tick" name="id_role">
                                    <?php foreach ($roles as $item): ?>
                                        <option <?php if($item['id_role'] == $get_user['id_role']) echo "selected" ?> value="<?=$item['id_role']?>"><?=$item['name_role']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php endif;?>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div>
                </form>
                <?php unset($_SESSION['edit_user']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>

