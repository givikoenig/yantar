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
                            <a class="navbar-brand" href="./">
                                <img src="<?= TEMPLATE ?>images/logo.png" alt="YANTAR-SHOP">
                            </a>
                        </div>
                        <form class="phone  text-center visible-xs-block" action="#" method="get">
                            <button type="button" class="btn-rose" onclick="window.location.href = 'tel:+79165276545'"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i></button>
                            <a href="tel:+79165276545"> +7 916 527 65 45</a>
                        </form>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="topMenuCollapse">
                    <div class="col-md-3 col-sm-3 hidden-xs phonewrapper">
                        <div class="phone">
                            <button type="button" class="btn-rose" onclick="window.location.href = 'tel:+79165276545'"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
                            </button>
                            <a href="tel:+79165276545"> +7 916 527 65 45</a>
                        </div>
                    </div>
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
                    <div class="col-md-4 col-sm-5 col-xs-12 btnwrapper">
                        <form class="cart text-right" name="korzina">
                            <input type="hidden" name="view" value="cart">
                            <?php if ($_SESSION['total_quantity']) : ?>
                                <?php if ($_SESSION['total_sum'] < $_SESSION['min_sum']): ?> 
                                    <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Корзина"><i  class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                                    </button>
                                    <p>
                                        <a href="?view=cart">Корзина </a><span>(</span><span style="color: #ed6349"> <?= $_SESSION['total_quantity'] ?> </span><span>)</span>
                                        <br />
                                        <span style="color: #ed6349"><?= $_SESSION['total_sum'] ?></span><span style="color: #ed6349" class="rouble"> c</span>
                                    </p>
                                <?php else: ?>
                                    <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Оформить заказ"><i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
                                    </button>
                                    <p style="color: #ed6349">
                                        <a href="?view=cart" style="color: #ed6349">Корзина</a><span> (</span><span ><?= $_SESSION['total_quantity'] ?> </span><span>)</span>
                                        <br />
                                        <span ><?= $_SESSION['total_sum'] ?></span><span class="rouble"> c</span>
                                    </p>
                                <?php endif; ?>
                            <?php else: ?>
                                    <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Корзина"><i  class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                                </button>
                                <p>    
                                    <a href="?view=cart">Корзина </a><span>(0)</span>
                                </p>
                            <?php endif; ?>
                        </form>

                        <form class="mail text-center" action="#" method="get">
                            <button class="btn-rose" data-toggle="tooltip" data-placement="left" title="baltbereg39@mail.ru"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
                            </button>
                            <p><a class="email" data-account="baltbereg39" data-text="Email"></a></p>
                        </form>

                        <form class="register text-center" name="register">
                            <input type="hidden" name="view" value="reg">
                            <button type="submit" class="btn-rose" data-toggle="tooltip" data-placement="left" title="Регистрация"><i class="fa fa-check fa-2x" aria-hidden="true"></i>
                            </button>
                            <p><a href="?view=reg">Регистрация</a></p>
                        </form>
                        
                        <?php // unset($_SESSION['auth']); ?>
                        
<!--                        <nav>
                            <ul>
                                <li class="login">
                                    <?php if (!$_SESSION['auth']['login']): //если еще никто не залогинен?>
                                    <a class="login-trigger" href="#">Вход</a>
                                    <div class="login-content">
                                        <form name="signup" method="post" action="#">
                                            
                                            
                                            <fieldset class="inputs">
                                                <input class="username" type="text" name="login" placeholder="Логин" required>   
                                                <input class="password" type="password" name="pass" placeholder="Пароль" required>
                                            </fieldset>
                                            <fieldset class="actions">
                                                <input type="submit"  name="auth" id="submit" value="Войти">
                                            </fieldset>

                                            <div class="enter">
                                                    <div class="row">
                                                        <div class="col-md-8 col-push-2">
                                                            <div class="aenter">
                                                                <table class="zakaz-data" border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td class="zakaz-txt">Логин</td>
                                                                        <td class="zakaz-inpt"><input type="text" name="login" id="login"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="zakaz-txt">Пароль</td>
                                                                        <td class="zakaz-inpt"><input type="password" name="pass" id="pass"/></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="benter text-center">
                                                                <input class="btn btn-default" type="submit" name="auth" id="auth" value="Вход"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="authform">
                                                        <?php if (isset($_SESSION['auth']['error'])): //если ошибка логин/пароль?>
                                                            <div class='error'><?= $_SESSION['auth']['error'] ?></div>
                                                            <?php unset($_SESSION['auth']); ?>    
                                                        <?php else: ?> 
                                                        <?php endif; ?>
                                                    </div>    
                                                </div>    

                                        </form>
                                    </div>
                                    <?php else : //если юзер залогинился ?>
                                        <a class="login-trigger" href="#">Выход</a>
                                        <div class="login-content">
                                            <div class="logout">
                                            <p class="text-center "><a  href="?do=logout">Выход&nbsp;&nbsp<i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a></p>
                                            </div>
                                        </div>
                                    
                                        
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </nav>-->
                        

                        <form class="signup text-center" name="signup" method="post" action="#">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown"> 
                                    <?php if (!$_SESSION['auth']['login']): //если еще никто не залогинен?>
                                        <button type="submit" class="btn-rose dropdown-toggle" data-toggle="dropdown"title="Вход"><i class="fa fa-sign-in fa-2x" aria-hidden="true"></i></button>
                                        <p><a class="signuplink" href="#" style="color: #939393" data-toggle="dropdown">Вход</a></p>
                                    <?php else : //если юзер залогинился ?>
                                        <button class="btn-rose dropdown-toggle" data-toggle="dropdown" title="<?= $_SESSION['auth']['login'] ?>"><i class="fa fa-user fa-2x" aria-hidden="true"></i></button>
                                        <p><a class="signuplink" href="#"  data-toggle="dropdown" style="color: #ed6349"><?= htmlspecialchars($_SESSION['auth']['login']) ?></a></p>
                                    <?php endif; ?>

                                    <ul class="dropdown-menu ">
                                        <li>
                                            <?php if (!$_SESSION['auth']['login']): //если еще никто не залогинен?>
                                                <div class="enter">
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
                                                        <div class="col-md-4">
                                                            <div class="benter text-center">
                                                                <input class="btn btn-default" type="submit" name="auth" id="auth" value="Вход"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="authform">
                                                        <?php if (isset($_SESSION['auth']['error'])): //если ошибка логин/пароль?>
                                                            <div class='error'><?= $_SESSION['auth']['error'] ?></div>
                                                            <?php unset($_SESSION['auth']); ?>    
                                                        <?php else: ?> 
                                                        <?php endif; ?>
                                                    </div>    
                                                </div>
                                            <?php else : //если юзер залогинился ?>
                                                <div class="logout">
                                                    <p class="text-center "><a  href="?do=logout">Выход&nbsp;&nbsp<i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a></p>
                                                </div> 
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </form>                       
    
                    </div<!-- /.btnwrapper-->
                </div><!-- /.navbar-collapse-->
            </div><!-- /.row-->
        </div><!-- /.container-->
    </nav>
</div> <!--./menu-top -->


