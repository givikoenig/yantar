<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
<?php include 'orders_leftbar.php';?>    

        <div class="col-sm-8">
            <nav class="adm-pag text-center" aria-label="Page navigation">
                <ul class="pagination pagination-sm paggy">
                    <?php if($pages_count > 1) pagination($page, $pages_count); ?>
                </ul>
            </nav>
            <div class="content">
                <?php // print_arr($orders);?>
                <hr class="hr">
                <h4>Заказы</h4>
                <span class="small">(Необработанные заказы подсвечены)</span>
                <hr class="hr">
                <br />
                <?php
                if (isset($_SESSION['answer'])) {
                    echo $_SESSION['answer'];
                    unset($_SESSION['answer']);
                }
                ?>
                <?php if($orders): ?>
                <table class="table" cellspacing="1">
                    <tr class="str">
                        <td class="number">№ заказа</td>
                        <td class="str_name">Заказчик</td>
                        <td class="str_sort">Дата</td>
                        <td class="str_action text-center">Просмотр</td>
                    </tr>
                    <?php foreach($orders as $item): ?>
                    <tr  <?php if($item['status'] == 0) echo "class='highlight'" ?>>
                        <td><?= $item['order_id'] ?></td>
                        <td class="name_page"><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= $item['date'] ?></td>
                        <td class="text-center"><a href="?view=show_order&amp;order_id=<?=$item['order_id']?>" class="edit" title="Просмотреть"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php endforeach;?>
                </table>
                <?php else:?>
                    <div class="error">Нет необработанных заказов</div>
                <?php endif;?>
            </div>
            <nav class="adm-pag text-center" aria-label="Page navigation">
                <ul class="pagination pagination-sm paggy">
                    <?php if($pages_count > 1) pagination($page, $pages_count); ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

</body>
</html>
