<?php defined('ISHOP') or die('Access denied'); ?>

<div class="menu-top">
    <nav class="navbar navbar-default">
        <div class="e-mail text-left visible-xs-inline-block">
            <a class="email" data-account="baltbereg39"><i class="fa fa-envelope"></i></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-2 hidden-sm">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topMenuCollapse" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="e-mail text-left visible-sm-block">
                            <a class="email" data-account="baltbereg39"><i class="fa fa-envelope"></i></a>
                        </div>
                        <div class="logo">
                            <a class="anavbar-brand" href="<?=PATH?>"><img src="<?=TEMPLATE?>images/logo.png"></a>
                        </div>
                        <form class="phone  text-center visible-xs-block" action="#" method="get">
                            <button type="button" class="btn-rose" onclick="window.location.href = 'tel:+79165276545'"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i></button>
                            <a href="tel:+79165276545"> +7 916 527 65 45</a>
                        </form>
                        <br />
                        <ul class="aul">
                            <?php if($_SESSION['total_quantity']):?>
                                <li class="awrap korz">
                                    <form class="cart visible-xs-block" name="korzina">
                                        <input type="hidden" name="view" value="cart">
                                        <?php if ($_SESSION['total_quantity'] > 0) : ?>
                                            <?php if ($_SESSION['total_sum'] < $_SESSION['min_sum']): ?>
                                                <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Корзина"><i  class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                                                </button>
                                                <span class="pscart badge"><?= $_SESSION['total_quantity'] ?></span>
                                                <span  class="scart rouble"><?= $_SESSION['total_sum'] ?>c</span>
                                            <?php else: ?>
                                                <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Корзина"><i  class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
                                                </button>
                                                <p class="fpcart">
                                                    <a href="?view=cart">Заказать</a>
                                                </p>
                                                <span class="pscart badge"><?= $_SESSION['total_quantity'] ?></span>
                                                <span  class="scart rouble"><?= $_SESSION['total_sum'] ?>c</span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Корзина"><i  class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                                            </button>
                                        <?php endif; ?>    
                                    </form>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['auth']['login']): ?>
                                <li class="loggeduser auser visible-xs-block"><i class="fa fa-user-circle" title="<?= $_SESSION['auth']['login'] ?>"></i>&nbsp;<span class="size hidden-sm"><?= $_SESSION['auth']['login'] ?></span></li>
                            <?php endif; ?>
                        </ul> 
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="topMenuCollapse">
                    <div class="col-md-3 col-sm-4 hidden-xs searchwrapper">
                        <form method="get">
                            <div class="input-group">
                                <input type="hidden" name="view" value="search">
                                <input type="text"  name="search" id="quickquery" class="btn-rose input-search" placeholder="Поиск по каталогу…">
                                <span class="input-group-btn">
                                    <button class="btn search" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>    
                    </div>
                    <div class="col-md-3 col-sm-3 hidden-xs phonewrapper">
                        <div class="phone">
                            <button type="button" class="btn-rose" onclick="window.location.href = 'tel:+79165276545'"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
                            </button>
                            <a href="tel:+79165276545"> +7 916 527 65 45</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-5 col-xs-12 btnwrapper ">
                        <ul class="aul">
                            <li class="awrap vhod">
                                <form class="signup atext-center" name="signup" method="post" action="#">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="dropdown" id="dropdown">
                                            <?php if (!$_SESSION['auth']['login']): //если еще никто не залогинен?>
                                                <button type="submit" class="knopka btn-rose dropdown-toggle" data-toggle="dropdown" title="Вход"><i class="fa fa-sign-in fa-2x" aria-hidden="true"></i></button>
                                                <p class="penter"><a class="ssylka signuplink" href="#dropdown" style="color: #926a40" data-toggle="dropdown">Вход</a></p>
                                            <?php else : //если юзер залогинился ?>
                                                <button type="submit" class="knopka btn-rose dropdown-toggle" data-toggle="dropdown" title="<?= $_SESSION['auth']['login'] ?>"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></button>
                                                <p class="apenter"><a class="ssylka signuplink" href="#dropdown" style="color: #926a40" data-toggle="dropdown">Выход</a></p>
                                                <?php // htmlspecialchars($_SESSION['auth']['login']) ?>
                                            <?php endif; ?>
                                            <ul class="dropdown-menu authmenu">
                                                <li>
                                                    <?php if (!$_SESSION['auth']['login']): //если еще никто не залогинен?>
                                                        <div class="ahide enter">
                                                            <div class="row">
                                                                <div class="col-md-8 col-push-2">
                                                                    <div class="aenter">
                                                                        <table class="zakaz-data" border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td class="zakaz-txt">Логин</td>
                                                                                <td class="zakaz-inpt"><input type="text" name="login" id="login" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="zakaz-txt">Пароль</td>
                                                                                <td class="zakaz-inpt"><input type="password" name="pass" id="pass" /></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="benter text-center">
                                                                        <input class="btn btn-default" type="submit" name="auth" id="auth" value="Вход"/>
                                                                        <p></p>
                                                                        <p><a href="?view=lostpass">Забыли пароль?</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="authform">
                                                                <?php if (isset($_SESSION['auth']['error'])): //если ошибка логин/пароль?>
                                                                    <div class='error'><?= $_SESSION['auth']['error'] ?></div>
                                                                    <?php unset($_SESSION['auth']); ?>    
                                                                    <?php // else: ?>
                                                                <?php endif; ?>
                                                            </div>    
                                                        </div>
                                                    <?php else : //если юзер залогинился ?>
                                                        <div class="ahide logout">
                                                            <p><a  href="?do=logout">Выход&nbsp;&nbsp<i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a></p>
                                                        </div> 
                                                    <?php endif; ?>
                                                </li>
                                            </ul>    
                                        </li>
                                    </ul>        
                                </form>
                            </li> 
                            <li class="awrap registr">
                                <form class="register" name="register">
                                    <input type="hidden" name="view" value="reg">
                                    <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Регистрация"><i class="fa fa-check fa-2x" aria-hidden="true"></i>
                                    </button>
                                    <p class="preg"><a href="?view=reg">Регистрация</a></p>
                                </form>
                            </li>
                            <li class="awrap hidden-xs">
                                <form class="mail" action="#" method="get">
                                    <button class="btn-rose" data-toggle="tooltip" data-placement="left" title="baltbereg39@mail.ru"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
                                    </button>
                                    <p class="pmail"><a class="email" data-account="baltbereg39" data-text="Email"></a></p>
                                </form>
                            </li>
                            <li class="awrap hidden-xs">  
                                <form class="cart" name="korzina">
                                    <input type="hidden" name="view" value="cart">
                                    <?php if ($_SESSION['total_quantity']) : ?>
                                        <?php if ($_SESSION['total_sum'] < $_SESSION['min_sum']): ?>
                                            <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Корзина"><i  class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                                            </button>
                                            <p class="pcart">
                                                <a href="?view=cart">Корзина </a>
                                            </p>
                                            <span class="pscart badge"><?= $_SESSION['total_quantity'] ?></span>
                                            <span  class="scart rouble"><?= $_SESSION['total_sum'] ?>c</span>
                                        <?php else: ?>
                                            <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Корзина"><i  class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
                                            </button>
                                            <p class="fpcart">
                                                <a href="?view=cart">Заказать</a>
                                            </p>
                                            <span class="pscart badge"><?= $_SESSION['total_quantity'] ?></span>
                                            <span  class="scart rouble"><?= $_SESSION['total_sum'] ?>c</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Корзина"><i  class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                                        </button>
                                        <p class="pcart">
                                            <a href="?view=cart">Корзина </a>
                                        </p>     
                                    <?php endif; ?>    
                                </form>
                            </li>      
                        </ul>      
                    </div>
                </div<!-- /.btnwrapper-->
            </div><!-- /.navbar-collapse-->
        </div><!-- /.row-->
</div><!-- /.container-->
</nav>
</div> <!--./menu-top -->