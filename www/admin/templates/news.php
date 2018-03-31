<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
<?php include 'leftbar.php';?>    
    
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Список новостей</h4>
                <hr class="hr">
                
                <?php // print_arr($all_news)?>
                <?php
                    if(isset($_SESSION['answer'])){
                        echo $_SESSION['answer'];
                        unset($_SESSION['answer']);
                    }
                ?>
                <a href="?view=add_news" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Добавить новость</a>
                <br />
                <table class="table" cellspacing="1">
                    <tr class="str">
                        <td class="number">№</td>
                        <td class="str_name">Новость</td>
                        <td class="str_sort">Дата</td>
                        <td class="str_action">Действие</td>
                    </tr>
                    <?php $i = 1 ?>
                    <?php foreach ($all_news as $item): ?>
                    <tr>
                        <td><?=$i?></td>
                        <td class="name_page"><?= $item['title'] ?></td>
                        <td><?= $item['data'] ?></td>
                        <td>
                                    <a href="?view=edit_news&amp;news_id=<?= $item['news_id'] ?>" class="edit" title="Редактировать"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="?view=del_news&amp;news_id=<?= $item['news_id'] ?>" class="del" title="Удалить"><i class="fa fa-times" aria-hidden="true"></i></a>
                         </td>
                     </tr>
                    <?php $i++;?>
                    <?php endforeach; ?>
                </table>
                <a href="?view=add_news" class="btn btn-warning btn-xs btn-str btn-str-bottom" role="button">Добавить новость</a>
            </div>
            <!--<br />-->
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
