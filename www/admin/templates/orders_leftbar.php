<?php defined('ISHOP') or die('Access denied'); ?>

<div class="row">
        <div class="col-sm-4">
            <div class="menu">
                <?php // print_arr(eyenow());?>
                <?php // echo eyenow();?>
                <div class="accordion">
                    <div class="accordion-group">
                        <div class="accordion-heading area">
                            <span class="subsubp pagesmenu">
                                <a <?php if(  empty(eyenow()) || preg_match( '/zakaz/' , eyenow()) )
                                echo "class='nav-activ'"; ?> href="?view=zakaz">Новые заказы</a>
                            </span>   
                        </div>
                        <div class="accordion-heading area">
                            <span class="subsubp pagesmenu">
                                <a <?php if( preg_match( '/orders/' , eyenow()) )
                                echo "class='nav-activ'"; ?> href="?view=orders">Все заказы</a>
                             </span>   
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        
