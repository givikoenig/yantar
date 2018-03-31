<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Добавление страницы</h4>
                <hr class="hr">
                <br />
                
                <?php // print_arr($_SESSION)?>
                <?php
                    if(isset($_SESSION['add_page']['res'])){
                        echo $_SESSION['add_page']['res'];
                        unset($_SESSION['add_page']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название страницы:</td>
                            <td><input class="head-text form-control" type="text" name="title" /></td>
                        </tr>
                        <tr>
                            <td>Ключевые слова:</td>
                            <td><input class="head-text form-control" type="text" name="keywords" value="<?= htmlspecialchars($_SESSION['add_page']['keywords']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Описание:</td>
                            <td><input class="head-text form-control" type="text" name="description" value="<?= htmlspecialchars($_SESSION['add_page']['description']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Позиция страницы:</td>
                            <td><input class="num-text form-control" type="text" name="position" value="<?= $_SESSION['add_page']['position'] ?>" /></td>
                        </tr>
                        <tr>
                            <td>Содержание страницы:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor1" class="full-text" name="text"><?= $_SESSION['add_page']['text'] ?></textarea>
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
                <?php unset($_SESSION['add_page']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>


