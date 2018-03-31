<?php defined('ISHOP') or die('Access denied'); ?>

<div class="container-fluid">
    <?php include 'cat_leftbar.php';?>
        <div class="col-sm-8">
            <div class="content">
                <hr class="hr">
                <h4>Добавление товара</h4>
                <hr class="hr">
                <br />
                <?php // print_arr(submenu(17));?>
                <?php
                    if(isset($_SESSION['add_product']['res'])){
                        echo $_SESSION['add_product']['res'];
                    }
                ?>
                
                <form  class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                    <table class="add_edit_page table" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="add-edit-txt">Название товара:</td>
                            <td><input class="head-text form-control" type="text" name="name" /></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Цена:</td>
                            <td><input class="head-text form-control" type="text" name="price" value="<?=$_SESSION['add_product']['price']?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Старая цена:</td>
                            <td><input class="head-text form-control" type="text" name="old_price" value="<?=$_SESSION['add_product']['old_price']?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Артикул:</td>
                            <td><input class="head-text form-control" type="text" name="articul" value="<?=$_SESSION['add_product']['articul']?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Ключевые слова</td>
                            <td><input class="head-text form-control" type="text" name="keywords" value="<?=$_SESSION['add_product']['keywords']?>"/></td>
                        </tr>
                        <tr>
                            <td class="add-edit-txt">Мета-описание:</td>
                            <td><input class="head-text form-control" type="text" name="description" value="<?=$_SESSION['add_product']['description']?>"/></td>
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
                            <td>Картинка товара:</td>
                            <td><input type="file" name="baseimg" /></td>
                        </tr>
                        <tr>
                            <td>Краткое описание:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="editor1" class="anons-text" name="anons"><?=$_SESSION['add_product']['anons']?></textarea>
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
                                <textarea id="editor2" class="anons-text" name="content"><?=$_SESSION['add_product']['content']?></textarea>
                                <script type="text/javascript">
                                        CKEDITOR.replace( 'editor2' );
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>Картинки галереи:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td id="btnimg" >
                                <div><input type="file" data-bfi-disabled name="galleryimg[]" /></div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="button" id="add" value="Добавить поле" />
                                <input type="button" id="del" value="Удалить поле" />
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Отметить как:</td>
                            <td><input type="checkbox" name="new" value="1" /> Новинка <br />
                                <input type="checkbox" name="hits" value="1" /> Лидер продаж <br />
                                <input type="checkbox" name="sale" value="1" /> Распродажа <br /></td>
                        </tr>
                        <tr>
                            <td>Показывать:</td>
                            <td><input type="radio" name="visible" value="1" checked="" /> Да <br />
                                <input type="radio" name="visible" value="0" /> Нет</td>
                        </tr>
                        <tr>
                            <td>Есть в наличии:</td>
                            <td><input type="radio" name="available" value="1" checked="" /> Да <br />
                                <input type="radio" name="available" value="0" /> Нет</td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-sm btn-str btn-str-top">Отправить запрос</button>
                    </div> 
                </form>
                

                <?php unset($_SESSION['add_product']); ?>
            </div>
            <br /><br/>
        </div>
    </div>
</div>

</body>
</html>

