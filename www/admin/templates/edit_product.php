<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'cat_leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <?php // print_arr($get_product); ?>
                <hr class="hr">
                <h4>Редактирование товара</h4>
                <hr class="hr">
                <br />
                <?php // print_arr(submenu(17));?>
                <?php
                    if(isset($_SESSION['edit_product']['res'])){
                        echo $_SESSION['edit_product']['res'];
                        unset($_SESSION['edit_product']);
                    }
                ?>
                <div id="goods_id" style="display: none;"><?=$get_product['goods_id']?></div>
                <form  class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название товара:</td>
                            <td><input class="head-text form-control" type="text" name="name" value="<?=htmlspecialchars($get_product['name'])?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Цена:</td>
                            <td><input class="head-text form-control" type="text" name="price" value="<?=$get_product['price']?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Старая цена:</td>
                            <td><input class="head-text form-control" type="text" name="old_price" value="<?=$get_product['old_price']?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Артикул:</td>
                            <td><input class="head-text form-control" type="text" name="articul" value="<?php printf($get_product['articul']); ?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Ключевые слова</td>
                            <td><input class="head-text form-control" type="text" name="keywords" value="<?=htmlspecialchars($get_product['keywords'])?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Мета-описание:</td>
                            <td><input class="head-text form-control" type="text" name="description" value="<?=htmlspecialchars($get_product['description'])?>"/></td>
                        </tr>
                        <tr>
                            <td>Родительская категория:</td>
                            <td>
                                <select class="select-inf form-control selectpicker show-tick  show-menu-arrow" name="category">
                                    <?php foreach ($cat as $key_parent => $item): ?>
                                        <?php if ($item['sub']): //если родительская категория?>
                                            <optgroup label="<?= $item[0] ?>">
                                            <?php $i = 0; ?>
                                            <?php foreach ($item['sub'] as $key => $sub):  // цикл дочерних категорий ?>
                                                <?php if (!submenu($key)): //если нет внучки ?>
                                                        <option  <?php if (($key == $brand_id) OR ( $key_parent == $brand_id AND $i == 0)) {
                                                            echo "selected";
                                                            $i = 1;
                                                            };
                                                            ?> value="<?= $key ?>"><?= $sub ?>
                                                        </option>
                                                        <!--</optgroup>-->     
                                                <?php else: ?>
                                                    <optgroup label="<?= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $sub ?>">
                                                        <?php foreach (submenu($key) as $key1 => $sub1): //цикл внучатых категорий ?>
                                                            $k = 0;
                                                            <option <?php if ($key1 == $brand_id OR $key == $brand_id AND $k == 0) {
                                                                echo "selected";
                                                                $k = 1;
                                                                };
                                                                ?> value="<?=$key1?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $sub1[0] ?></option>
                                                        <?php endforeach; ?>
                                                    </optgroup>
                                                <?php endif; ?>
                                                <?php endforeach;?>
                                            </optgroup> 
                                        <?php elseif ($item[0]): // если самостоятельная категория  ?>
                                            <option <?php if ($key_parent == $brand_id) echo "selected" ?>
                                                value="<?= $key_parent ?>"><?= $item[0] ?>
                                            </option>
                                        <?php endif; // конец условия родительская категория   ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Картинка товара: <br />
                                <span class="small">(кликните по картинке для удаления)</span></td>
                            <td class="baseimg"><?=$baseimg?></td>
                            <!--<input type="file" name="baseimg" />-->
                        </tr>
                        <tr>
                            <td>Краткое описание:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor1" class="anons-text" name="anons"><?=htmlspecialchars($get_product['anons'])?></textarea>
                                <script type="text/javascript">
                                        CKEDITOR.replace( 'editor1' );
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>Подробное описание:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor2" class="anons-text" name="content"><?=htmlspecialchars($get_product['content'])?></textarea>
                                <script type="text/javascript">
                                        CKEDITOR.replace( 'editor2' );
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>Картинки галереи: <br />
                                <span class="small">(кликните по картинке для удаления)</span></td>
                            <td class="slideimg"><?=$imgslide?></td>
                        </tr>
                        <tr>
                            <td>
                                <div id="butUpload" class="btn btn-default btn-sm">Выбрать файл</div>
                            </td>
                            <td>
                                <div id="filesUpload"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Отметить как:</td>
                            <td><input type="checkbox" name="new" value="1" <?php if($get_product['new']) echo 'checked=""'; ?> /> Новинка <br />
                                <input type="checkbox" name="hits" value="1" <?php if($get_product['hits']) echo 'checked=""'; ?> /> Лидер продаж <br />
                                <input type="checkbox" name="sale" value="1" <?php if($get_product['sale']) echo 'checked=""'; ?> /> Распродажа <br /></td>
                        </tr>
                        <tr>
                            <td>Показывать:</td>
                            <td><input type="radio" name="visible" value="1" <?php if($get_product['visible']) echo 'checked=""'; ?> /> Да <br />
                                <input type="radio" name="visible" value="0" <?php if(!$get_product['visible']) echo 'checked=""'; ?> /> Нет</td>
                        </tr>
                        <tr>
                            <td>Есть в наличии:</td>
                            <td><input type="radio" name="available" value="1" <?php if($get_product['available']) echo 'checked=""'; ?> /> Да <br />
                                <input type="radio" name="available" value="0" <?php if(!$get_product['available']) echo 'checked=""'; ?>/> Нет</td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div> 
                </form>
            </div>
            <br /><br/>
        </div>
    </div>
</div>
<script type="text/javascript">
// загрузка картинок
var button = $("#butUpload"), interval; // кнопка загрузки + интервал ожидания
var path = '<?=GALLERYIMG?>thumbs/'; // путь к папке превью
var id = $("#goods_id").text(); // ID товара

new AjaxUpload(button, {
    action: './',
    name: 'userfile',
    data: {id: id},
    onSubmit: function(file, ext){
        if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
            alert('Запрещенный тип файла');
            // cancel upload
            return false;
        }
        button.text("Загрузка");
        this.disable();

        interval = window.setInterval(function(){
            var text = button.text();
            if(text.length < 11){
                button.text(text + '.');
            }else{
                button.text("Загрузка");
            }
        },300);
    },
    onComplete: function(file, response){
        button.text("Загрузить еще?");
        window.clearInterval(interval);
        this.enable(); 
        var res = JSON.parse(response);
        if(res.answer == "OK"){
            $("#filesUpload").append("<img src='" + path + res.file + "' />");
        }else{
            alert(res.answer);
        }
    }
});
</script>

    
</body>
</html>

