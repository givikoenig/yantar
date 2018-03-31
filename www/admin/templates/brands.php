<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <div class="row">
    <?php include 'cat_leftbar.php';?>    
        
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Список категорий</h4>
                <hr class="hr">
                <?php
                if (isset($_SESSION['answer'])) {
                    echo $_SESSION['answer'];
                    unset($_SESSION['answer']);
                }
                ?>
                <a href="?view=add_brand" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Добавить категорию</a>
                <br />
                <table class="table" cellspacing="1">
                    <tr class="str">
                        <td class="number">№</td>
                        <td class="str_name">Категория</td>
                        <td colspan="3" class="str_action text-center">Действие</td>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($cat as $key => $value): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td class="name_page"><?= $value[0] ?></td>
                            <td>
                                <a href="?view=edit_brand_image&amp;brand_id=<?= $key ?>" class="chim" title="Сменить картинку категории"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                            </td>
                            <td>
                                <a href="?view=edit_brand&amp;brand_id=<?= $key ?>" class="edit" title="Редактировать"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </td>
                            <td>
                               <a href="?view=del_brand&amp;brand_id=<?= $key ?>" class="del" title="Удалить"><i class="fa fa-times" aria-hidden="true"></i></a> 
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>      
                </table>
                <a href="?view=add_brand" class="btn btn-warning btn-xs btn-str btn-str-bottom" role="button">Добавить категорию</a>
            </div>   
        </div>
    </div>
</div>

</body>
</html>
