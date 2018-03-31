<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Редактирование новости</h4>
                <hr class="hr">
                <br />
                
                <?php // print_arr($get_news);?>
                <?php
                    if(isset($_SESSION['edit_news']['res'])){
                        echo $_SESSION['edit_news']['res'];
                        unset($_SESSION['edit_news']['res']);
                    }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название новости:</td>
                            <td><input class="head-text form-control" type="text" name="title" value="<?= htmlspecialchars($get_news['title']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Ключевые слова:</td>
                            <td><input class="head-text form-control" type="text" name="keywords" value="<?= htmlspecialchars($get_news['keywords']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Описание:</td>
                            <td><input class="head-text form-control" type="text" name="description" value="<?= htmlspecialchars($get_news['description']) ?>" /></td>
                        </tr>
                        <tr>
                            <td>Дата новости (ГГГГ-ММ-ДД):</td>
                            <td class="picker"><input id="datepicker" class="date-text" type="text" name="data" value="<?= $get_news['data'] ?>" /></td>
                        </tr>
                        <tr>
                            <td>Анонс новости:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor1" class="full-text" name="anons"><?= $get_news['anons'] ?></textarea>
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
                                <textarea id="editor2" class="full-text" name="text"><?= $get_news['text'] ?></textarea>
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
                <?php unset($_SESSION['edit_news']); ?>
            </div>   
        </div>

    </div>
</div>

</body>
</html>

