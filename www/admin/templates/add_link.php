<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Добавление страницы в информер</h4>
                <hr class="hr">
                <br />
                
                <?php // print_arr($informers)?>
                <?php
                    if(isset($_SESSION['add_link']['res'])){
                        echo $_SESSION['add_link']['res'];
                        unset($_SESSION['add_link']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название страницы:</td>
                            <td><input class="head-text" type="text" name="link_name" /></td>
                        </tr>
                        <tr>
                            <td>Ключевые слова:</td>
                            <td><input class="form-control head-text" type="text" name="keywords" value="<?= htmlspecialchars($_SESSION['add_link']['keywords']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Описание:</td>
                            <td><input class="form-control head-text" type="text" name="description" value="<?= htmlspecialchars($_SESSION['add_link']['description']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Информер:</td>
                            <td>
                                <select class="select-inf form-control selectpicker" name="parent_informer">
                                    <?php foreach($informers as $item): ?>
                                        <option <?php if($item['informer_id'] == $informer_id) echo "selected" ?> value="<?=$item['informer_id']?>"><?=$item['informer_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Позиция страницы:</td>
                            <td><input class="form-control num-text" type="text" name="links_position" value="<?= $_SESSION['add_link']['links_position'] ?>" /></td>
                        </tr>
                        <tr>
                            <td>Содержание страницы:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor1" class="full-text" name="text"><?= $_SESSION['add_link']['text'] ?></textarea>
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
                <?php unset($_SESSION['add_link']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>
