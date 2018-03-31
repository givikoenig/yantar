<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
<?php include 'users_leftbar.php';?>    

        <div class="col-sm-8">
            <nav class="adm-pag text-center" aria-label="Page navigation">
                <ul class="pagination pagination-sm paggy">
                    <?php if($pages_count > 1) pagination($page, $pages_count); ?>
                </ul>
            </nav>
            <div class="content">
                <?php // print_arr($users);?>
                <hr class="hr">
                <h4>Зарегистрированные пользователи</h4>
                <hr class="hr">
                <br />
                <?php
                if (isset($_SESSION['answer'])) {
                    echo $_SESSION['answer'];
                    unset($_SESSION['answer']);
                }
                ?>
                <a href="?view=add_user" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Добавить пользователя</a>
                <br />
                <?php if($users): ?>
                <table class="table" cellspacing="1">
                    <tr class="str">
                        <td class="number">№</td>
                        <td class="str_name">Имя</td>
                        <td class="str_name">Логин</td>
                        <td class="str_name">Mail</td>
                        <td class="str_name">Телефон</td>
                        <td class="str_sort">Роль</td>
                        <td colspan="2" class="str_action text-center">Действие</td>
                    </tr>
                    <?php $i = 1;?>
                    <?php foreach($users as $item): ?>
                    <tr <?php if($item['name_role'] == 'Администратор') echo "class='highlight'" ?>>
                        <td><?=$i?></td>
                        <td class="name_page"><?= htmlspecialchars($item['name']) ?></td>
                        <td class="name_page"><?= htmlspecialchars($item['login']) ?></td>
                        <?php $mpieces = explode("@", htmlspecialchars($item['email'])); ?>
                        <td class="name_page"><a class="email" data-account="<?=$mpieces[0]?>" data-host="<?=$mpieces[1]?>" data-subject="Re: Заказ в Интернет-магазине"></a></td>
                        <td class="name_page"><?= htmlspecialchars($item['phone']) ?></td>
                        <td><?= htmlspecialchars($item['name_role'])?></td>
                        <td>
                          <a href="?view=edit_user&amp;user_id=<?=$item['customer_id']?>" class="edit" title="Редактировать"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </td>
                        <td>
                          <a href="?view=del_user&amp;user_id=<?=$item['customer_id']?>" class="del" title="Удалить"><i class="fa fa-times" aria-hidden="true"></i></a> 
                        </td>
                    </tr>
                    <?php $i++;?>
                    <?php endforeach;?>
                </table>
                <?php else:?>
                    <div class="error">Нет зарегистрированных пользователей</div>
                <?php endif;?>
                <a href="?view=add_user" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Добавить пользователя</a>    
            </div>
            <nav class="adm-pag text-center" aria-label="Page navigation">
                <ul class="pagination pagination-sm paggy">
                    <?php if($pages_count > 1) pagination($page, $pages_count); ?>
                </ul>
            </nav>
        </div>
    </div>
<!--</div>-->

</body>
</html>
