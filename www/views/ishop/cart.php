<?php defined('ISHOP') or die('Access denied'); ?>
<?php require_once 'inc/index_mainmenu.php'; ?>
<section class="main-content cat-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="./"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="active">Корзина</li>
                    </ol>
                </div>          
            </div>
        </div>
        <div class="row"> <!-- разделитель cart -->
            <div class="col-xs-12">
                <div class="info-wrap">
                    <div class="hr">
                        <div class="gorizontal"></div>
                        <div class="vertical"></div>
                    </div>
                    <div class="ttl">
                        <h2>Оформление заказа</h2>
                    </div>
                </div>
            </div>
        </div> <!-- ./разделитель cart -->
        <?php
            if(isset($_SESSION['order']['res'])){
            echo $_SESSION['order']['res'];
            }
        ?>
        <?php if ($_SESSION['cart']): // проверка корзины, если в корзине есть товары ?>
            <form method="post" action="">
                <div class="row">
                    <div class="col-sm-10 col-sm-push-1">   
                        <div class="row c-title-wrap">
                            <div class="col-sm-7 text-center  hidden-xs">
                                <span class="c-title">Наименование</span>
                            </div>
                            <div class="col-sm-2">
                                <span class="c-title hidden-xs">Количество</span>
                            </div>
                            <div class="col-sm-3">
                                <span class="c-title hidden-xs">Стоимость</span>
                            </div>
                        </div>
                        <br />
                        <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                            <div class="row">
                                <div class="col-sm-2 hidden-xs">
                                    <a href="?view=product&amp;goods_id=<?= $key ?>"><img src="<?= PRODUCTIMG ?><?= $item['img'] ?>" width="80" title="" /></a>
                                </div>
                                <div class="col-sm-5 col-xs-4">
                                    <div  class="c-name">
                                        <a href="?view=product&amp;goods_id=<?=$key?>"><?=$item['name']?></a>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-3 c-item-wrap">
                                    <div class="input-group c-item">
                                        <span class="minus-span c-span" type="button"><i class="fa fa-minus-square"></i></span>
                                        <input id="id<?= $key ?>" type="text" class="kolvo" name="" value="<?= $item['qty'] ?>" size="5">
                                        <span class="plus-span c-span" type="button"><i class="fa fa-plus-square"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-3 c-item-wrap">
                                    <div class="c-item">
                                        <p class="best-caption"><?=$item['price']?><span class="rouble">c</span></p>
                                    </div>
                                </div>
                                <div class="col-sm-1 col-xs-2 c-item-wrap">
                                    <div class="c-item">
                                        <a href="?view=cart&amp;delete=<?= $key ?>"><i class="fa fa-times-circle" aria-hidden="true" title="Удалить товар из заказа"></i></a>
                                    </div>    
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <br />
                        <div class="row c-itogo-wrap">
                            <div class="col-sm-7 col-xs-4 c-itogo">
                                <span class="c-title">Итого: </span>
                            </div>
                            <div class="col-sm-2 col-xs-3">
                                <span class="c-title"><?= $_SESSION['total_quantity'] ?> шт.</span>
                            </div>
                            <div class="col-sm-2 col-xs-5">
                                <span class="c-title c-sum"><?= $_SESSION['total_sum'] ?></span><span class="rouble c-sum">c</span>
                            </div>
                        </div>
                    </div>
                </div>
                <br /><br />
                <div class="row">
                    <div class="col-sm-8 col-sm-push-2">   
                        <div class="regform">
                            <div class="sposob-dostavki">
                                <h4>Способы доставки:</h4>
                                <?php foreach($dostavka as $item): ?>
                                    <p><input type="radio" name="dostavka" value="<?=$item['dostavka_id']?>" /> <?=$item['name']?></p>
                                <?php endforeach; ?> 
                            </div>
                        </div>
                    </div>
                </div>
                <br /><br />
                <div class="row">
                    <div class="col-sm-8 col-sm-push-2">   
                        <div class="regform">
                            <div class="table-responsive">  
                                <h4>Информация для доставки:</h4>
                                <br /> 
                                <?php if (!$_SESSION['auth']['login']):?>
                                <table class="zakaz-data table" border="0" cellspacing="0" cellpadding="0">
                                        <tr class="notauth">
                                            <td class="zakaz-txt">*ФИО</td>
                                            <td class="zakaz-inpt"><input type="text" name="name" value="<?=htmlspecialchars($_SESSION['order']['name'])?>" /></td>
                                            <td class="zakaz-prim hidden-xs">Пример: Иванов Сергей Александрович</td>
                                        </tr>
                                        <tr class="notauth">
                                            <td class="zakaz-txt">*Е-маил</td>
                                            <td class="zakaz-inpt"><input type="text" name="e_mail" value="<?=htmlspecialchars($_SESSION['order']['email'])?>" /></td>
                                            <td class="zakaz-prim hidden-xs">Пример: test@mail.ru</td>
                                        </tr>
                                        <tr class="notauth">
                                            <td class="zakaz-txt">*Телефон</td>
                                            <td class="zakaz-inpt"><input type="text" name="phone" value="<?=htmlspecialchars($_SESSION['order']['phone'])?>" /></td>
                                            <td class="zakaz-prim hidden-xs">Пример: 8 937 999 99 99</td>
                                        </tr>
                                        <tr class="notauth">
                                            <td class="zakaz-txt">*Адрес доставки</td>
                                            <td class="zakaz-inpt"><input type="text" name="address" value="<?=htmlspecialchars($_SESSION['order']['address'])?>" /></td>
                                            <td class="zakaz-prim hidden-xs">Пример: г. Москва, пр. Мира, ул. Петра Великого д.19, кв 51.</td>
                                        </tr>
                                        <tr>
                                            <td class="zakaz-txt" style="vertical-align:top;">Примечание </td>
                                            <td class="zakaz-txtarea"><textarea name="prim" value="<?=htmlspecialchars($_SESSION['order']['prim'])?>"></textarea></td>
                                            <td class="zakaz-prim hidden-xs" style="vertical-align:top;">Пример: Позвоните пожалуйста после 10 вечера,<br />
                                                                до этого времени я на работе
                                            </td>
                                        </tr>
                                </table>
                                <?php else: ?>
                                    <table class="zakaz-data table" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="zakaz-txt" style="vertical-align:top;">Примечание </td>
                                            <td class="zakaz-txtarea"><textarea name="prim"></textarea></td>
                                            <td class="zakaz-prim hidden-xs" style="vertical-align:top;">Пример: Позвоните пожалуйста после 10 вечера,<br />
                                                                до этого времени я на работе
                                            </td>
                                        </tr>
                                </table>
                                <?php endif; ?>
                            </div> 
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-sm-push-3">   
                        <div class="regbtn text-center">
                            <input class="btn-rose" type="submit" name="order" value="Заказать" />
                        </div>
                    </div>
                </div>
                <br /><br /><br /><br />
           </form>
        <?php else: // если товаров нет ?>
                <div class="row">
                    <div class="col-sm-6 col-sm-push-3">   
                        <div class="regbtn text-center">
                            <h3>Корзина пуста</h3>
                            <h4>Для оформления заказа добавьте товар в корзину.</h4>
                            <br />
                            <img src="<?=TEMPLATE?>images/emptyCart.png" title="Корзина пуста">
                        </div>
                    </div>
                </div>
                <?php echo '<script>setTimeout(\'location="'.PATH.'"\', 10000)</script>'; ?>
        <?php endif; // конец условия проверки корзины ?>
    <?php unset($_SESSION['order']);?>
                            
    <?php require_once 'inc/socials.php'; ?>
    </div> <!-- ./container -->
</section> <!-- ./main-content -->        
