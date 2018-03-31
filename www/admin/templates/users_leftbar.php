<?php defined('ISHOP') or die('Access denied'); ?>
<!--<div class="row">-->
        <div class="col-sm-4">
            <div class="menu">
                <div class="accordion">
                    <div class="accordion-group">
                        <div class="accordion-heading area">
                            <span class="subsubp pagesmenu">
                                <a <?php if(  empty(eyenow()) || preg_match( '/users/' , eyenow()) )
                                echo "class='nav-activ'"; ?> href="?view=users">Зарегистрированные</a>
                            </span>   
                        </div>
                        <div class="accordion-heading area">
                            <span class="subsubp pagesmenu">
                                <a <?php if( preg_match( '/custom/' , eyenow()) )
                                echo "class='nav-activ'"; ?> href="?view=customers">Все пользователи</a>
                             </span>   
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        
