<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
<?php include 'leftbar.php';?>    

        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Способы доставки товара</h4>
                <hr class="hr">
                <?php
                    if(isset($_SESSION['answer'])){
                        echo $_SESSION['answer'];
                        unset($_SESSION['answer']);
                    }
                ?>
                <a href="?view=add_delivery" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Добавить способ</a>
                <br />
                <table id="sort" class="table" cellspacing="1">
                    <tbody>
                    <tr class="no_sort str">
                        <td class="number">№</td>
                        <td class="str_name">Способ доставки</td>
                        <td colspan="2" class="str_action text-center">Действие</td>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($deliveries as $item): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td class="name_page"><?= $item['name'] ?></td>
                            <td>
                                <a href="?view=edit_delivery&amp;meth_id=<?= $item['dostavka_id'] ?>" class="edit" title="Редактировать"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td>
                                <a href="?view=del_delivery&amp;meth_id=<?= $item['dostavka_id'] ?>" class="del" title="Удалить"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?> 
                   </tbody>     
                </table>
                <a href="?view=add_delivery" class="btn btn-warning btn-xs btn-str btn-str-bottom" role="button">Добавить способ</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
