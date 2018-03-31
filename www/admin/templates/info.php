<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'leftbar.php'; ?>    

    <div class="col-sm-8">
        <div class="content">
            <hr class="hr">
            <?php // print_arr($informers);?>
            <h4>Информеры</h4>
            <?php
                if(isset($_SESSION['answer'])){
                  echo $_SESSION['answer'];
                  unset($_SESSION['answer']);
                }
            ?>
            <hr class="hr">
            <a href="?view=add_informer" class="btn btn-warning btn-xs btn-str btn-str-top" role="button">Добавить информер</a>
            <br />
            <?php foreach ($informers as $informer): ?>
                <table class="table" cellspacing="1">
                    <tr class="str str-inform">
                        <td class="toggle"><span class="info-caret down"></span></td>
                        <td class="toggle"><?=$informer['position']?></td>
                        <td class="inf_name"><?= $informer[0] ?></td>
                        
                        <td class="text-right">
                            <a href="?view=edit_informer&amp;informer_id=<?= $informer['informer_id'] ?>" class="edit icon-info" title="Редактировать"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="?view=del_informer&amp;informer_id=<?= $informer['informer_id'] ?>" class="del icon-info" title="Удалить"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php if ($informer['sub']): ?>
                        <tr class="str inf-page">
                            <td class="number">№</td>
                            <td class="str_name">Страница</td>
                            <td class="str_sort">Позиция</td>
                            <td class="str_action act-inf">Действие</td>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach ($informer['sub'] as $key => $value): ?>
                            <tr class="inf-page">
                                <td><?= $i ?></td>
                                <td class="str_name"><?= $value; ?></td>
                                <td><?= $i ?></td>
                                <td class="text-right">
                                    <a href="?view=edit_link&amp;link_id=<?= $key ?>" class="edit" title="Редактировать"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="?view=del_link&amp;link_id=<?= $key ?>" class="del" title="Удалить"><i class="fa fa-times" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                        <tr class="inf-page">
                            <td colspan="4"> 
                                <a href="?view=add_link&amp;informer_id=<?= $informer['informer_id'] ?>" class="btn btn-warning btn-xs btn-str btn-str-bottom" role="button">Добавить страницу в информер</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr class="inf-page">
                            <td class="text-center" colspan="4"><h5>В этом информере страниц нет</h5></td>
                        </tr>
                        <tr class="inf-page">
                        <td colspan="4"> 
                                <a href="?view=add_link&amp;informer_id=<?= $informer['informer_id'] ?>" class="btn btn-warning btn-xs btn-str btn-str-bottom" role="button">Добавить страницу в информер</a>
                        </td>
                        </tr>
                    <?php endif; ?>
                </table>
            <?php endforeach; ?>
            <a href="?view=add_informer" class="btn btn-warning btn-xs btn-str btn-str-bottom" role="button">Добавить информер</a>
        </div>
    </div>
</div>
</div>

</body>
</html>
