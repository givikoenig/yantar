<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
<?php include 'orders_leftbar.php';?>    

        <div class="col-sm-8">
            <div class="content">
                
                <?php if($show_order):?>
                <hr class="hr">
                <h4>Заказ № <?=$order_id?> <?=$state?></h4>
                <hr class="hr">
                <br />
                <table class="table" cellspacing="1">
                    <tr class="str">
                        <td class="number">№</td>
                        <td class="str_name">Название товара</td>
                        <td class="str_name">Цена</td>
                        <td class="str_name">Кол-во</td>
                        <td class="str_action">
                            <?php if($show_order[0]['status'] == 0):?>
                                <a href="?view=zakaz&amp;confirm=<?=$order_id?>" class="edit icon-info" title="Подтвердить заказ"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                            <?php endif;?>    
                        </td>
                        <td class="str_action">
                            <a href="?view=orders&amp;del_order=<?=$order_id?>" class="del icon-info" title="Удалить заказ"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php $i = 1; $total_sum = 0;?>
                    <?php foreach($show_order as $item): ?>
                    <tr>
                        <td><?=$i?></td>
                        <td class="name_page"><?=$item['name']?></td>
                        <td><?=$item['price']?></td>
                        <td><?=$item['quantity']?></td>
                        <td colspan="2"></td>
                    </tr>
                    <?php $i++; $total_sum += $item['price'] * $item['quantity'];?>
                    <?php endforeach; ?>
                </table>
                <br />
                <table class="table" cellspacing="1">
                   <tr class="totalsum text-left">
                       <td>Общая цена заказа:&nbsp;&nbsp;&nbsp;&nbsp;<span class="orderdata_content"><?=$total_sum?></span> <span class="rouble">c</span></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr class="totalsum text-left">
                        <td>Дата заказа:&nbsp;&nbsp;&nbsp;&nbsp;<span class="orderdata_content"><?=$item['date']?></span></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr class="totalsum text-left">
                        <td>Способ доставки:&nbsp;&nbsp;&nbsp;&nbsp;<span class="orderdata_content"><?=$item['sposob']?></span></td>
                        <td colspan="3"></td>
                    </tr>
                </table>
                <?php else:?>
                <div class="error">Заказа с таким номером нет.</div>
                <?php endif;?>
                
                <br />
                <hr class="hr">
                <h4>Данные заказчика</h4>
                <hr class="hr">
                <br />
                <table class="table" cellspacing="1">
                    <tr class="str">
                        <td class="str_name">Ф.И.О.</td>
                        <td class="str_name">Адрес</td>
                        <td class="str_name">Для связи</td>
                        <td class="str_name">Примечание</td>
                    </tr>
                    <tr>
                        <td><?=htmlspecialchars($item['customer'])?></td>
                        <td><?=htmlspecialchars($item['address'])?></td>
                        <?php $mpieces = explode("@", htmlspecialchars($item['email'])); ?>
                        <td><a class="email" data-account="<?=$mpieces[0]?>" data-host="<?=$mpieces[1]?>" data-subject="Re: Заказ в Интернет-магазине"></a>
                            <br /><?=htmlspecialchars($item['phone'])?></td>
                        <td><?=htmlspecialchars($item['prim'])?></td>
                    </tr>
                </table>    
            </div>   
        </div>
    </div>
</div>

</body>
</html>
