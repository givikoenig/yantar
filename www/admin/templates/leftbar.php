<?php defined('ISHOP') or die('Access denied'); ?>

<div class="row">
        <div class="col-sm-4">
            <div class="menu">
                <?php // print_arr($_SERVER['QUERY_STRING']);?>
                <?php // echo eyenow();?>
                <div class="accordion">
                    <div class="accordion-group">
                        <div class="accordion-heading area">
                            <span class="subsubp pagesmenu">
                                <a <?php if(  preg_match( '/pages|_page/' , eyenow()) )
                                echo "class='nav-activ'"; ?> href="?view=pages">Страницы TOP-меню</a>
                            </span>   
                        </div>
                        <div class="accordion-heading area">
                            <span class="subsubp pagesmenu">
                                    <a <?php if( preg_match( '/info|_info|_link/' , eyenow()) )
                                    echo "class='nav-activ'"; ?> href="?view=info">Информеры</a>
                             </span>   
                        </div>
                        <div class="accordion-heading area">
                            <span class="subsubp pagesmenu">
                                <a <?php if( preg_match( '/news/' , eyenow()) )
                                echo "class='nav-activ'"; ?> href="?view=news">Новости</a>
                            </span>    
                        </div>
                        <div class="accordion-heading area">
                            <span class="subsubp pagesmenu">
                                <a <?php if( preg_match( '/deliv/' , eyenow()) )
                                echo "class='nav-activ'"; ?> href="?view=delivery">Способы доставки</a>
                            </span>    
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        
