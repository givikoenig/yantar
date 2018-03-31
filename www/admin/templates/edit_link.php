<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Редактирование страницы информера</h4>
                <hr class="hr">
                <br />
                
                <?php // print_arr($get_link)?>
                <?php
                    if(isset($_SESSION['edit_link']['res'])){
                        echo $_SESSION['edit_link']['res'];
                        unset($_SESSION['edit_link']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название страницы:</td>
                            <td><input class="head-text form-control" type="text" name="link_name" value="<?=  htmlspecialchars($get_link['link_name'])?>"/></td>
                        </tr>
                        <tr>
                            <td>Ключевые слова:</td>
                            <td><input class="head-text form-control" type="text" name="keywords" value="<?= htmlspecialchars($get_link['keywords']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Описание:</td>
                            <td><input class="head-text form-control" type="text" name="description" value="<?= htmlspecialchars($get_link['description']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Информер:</td>
                            <td>
                                <select class="select-inf form-control" name="parent_informer">
                                    <?php foreach($informers as $item): ?>
                                        <option <?php if($item['informer_id'] == $get_link['parent_informer']) echo "selected" ?> value="<?=$item['informer_id']?>"><?=$item['informer_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Позиция страницы:</td>
                            <td><input class="num-text form-control" type="text" name="links_position" value="<?= $get_link['links_position'] ?>" /></td>
                        </tr>
                        <tr>
                            <td>Содержание страницы:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor1" class="full-text" name="text"><?= $get_link['text'] ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace('editor1');
                                </script>
                            </td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div>
                </form>
                <?php unset($_SESSION['edit_link']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>
