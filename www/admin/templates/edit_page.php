<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Редактирование страницы</h4>
                <hr class="hr">
                <br />
                <?php
                    if(isset($_SESSION['edit_page']['res'])){
                        echo $_SESSION['edit_page']['res'];
                        unset($_SESSION['edit_page']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название страницы:</td>
                            <td><input class="head-text form-control" type="text" name="title" value="<?= htmlspecialchars($get_page['title']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Ключевые слова:</td>
                            <td><input class="head-text form-control" type="text" name="keywords" value="<?= htmlspecialchars($get_page['keywords']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Описание:</td>
                            <td><input class="head-text form-control" type="text" name="description" value="<?= htmlspecialchars($get_page['description']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Позиция страницы:</td>
                            <td><input class="num-text form-control" type="text" name="position" value="<?= $get_page['position'] ?>" /></td>
                        </tr>
                        <tr>
                            <td>Содержание страницы:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor7" class="full-text" name="text"><?= $get_page['text'] ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace('editor7');
                                </script>
                            </td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div>
                </form>
                <?php unset($_SESSION['edit_page']); ?>
            </div>   
        </div>
    </div>
</div>

</body>
</html>

