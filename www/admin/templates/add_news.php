<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Добавление новости</h4>
                <hr class="hr">
                <br />
                
                <?php // print_arr($_SESSION)?>
                <?php
                    if(isset($_SESSION['add_news']['res'])){
                        echo $_SESSION['add_news']['res'];
                        unset($_SESSION['add_news']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название новости:</td>
                            <td><input class="head-text form-control" type="text" name="title" /></td>
                        </tr>
                        <tr>
                            <td>Ключевые слова:</td>
                            <td><input class="head-text form-control" type="text" name="keywords" value="<?= htmlspecialchars($_SESSION['add_news']['keywords']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Описание:</td>
                            <td><input class="head-text form-control" type="text" name="description" value="<?= htmlspecialchars($_SESSION['add_news']['description']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Анонс новости:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor1" class="full-text" name="anons"><?= $_SESSION['add_news']['anons'] ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace('editor1');
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>Текст новости:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor2" class="full-text" name="text"><?= $_SESSION['add_news']['text'] ?></textarea>
                                <script type="text/javascript">
                                    CKEDITOR.replace('editor2');
                                </script>
                            </td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div>

                </form>
                <?php unset($_SESSION['add_news']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>

