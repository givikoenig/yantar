<?php defined('ISHOP') or die('Access denied'); ?>

        <div class="col-sm-4">
            <!--<a href=?view=edit_brand&amp;brand_id=1#area1">Go!</a>-->
            <div class="menu">
                <?php // print_arr($cat); ?>
                
                <div class="accordion">
                    <div class="accordion-group">
                        <div class="accordion-heading area">
                            <span class="subsubp pagesmenu">
                                <a <?php if(  preg_match( '/brand|cat/' , eyenow()) )
                                echo "class='nav-activ'"; ?> href="?view=brands">Каталог товаров</a>
                            </span>   
                        </div>
                    </div>
                </div>   
                
                <!--<a class="nav-activ accordion-toggle" href="?view=brands">Основные категории товаров</a>-->
                <!--<div class="accordion">-->
<!--                    <div class="accordion-group">
                        <?php foreach ($cat as $key => $value): ?>
                            <div class="accordion-heading area">
                               <a class="accordion-toggle" <?php if (!empty($value['sub'])) echo "data-toggle='collapse'"; ?>  href="#area<?= $key ?>"><?= $value[0] ?></a>
                               <a href="?view=cat&amp;category=<?= $key ?>" class="edit" title="Редактировать категорию"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="accordion-body collapse" id="area<?= $key ?>">
                                <div class="accordion-inner">
                                    <div class="accordion" id="equipamento<?= $key ?>">
                                        <?php if (!empty($value['sub'])):?>
                                            <?php foreach ($value['sub'] as $key1 => $value1): ?>
                                                <?php if (empty(submenu($key1))): ?>
                                                    <div class="accordion-group">
                                                        <div class="accordion-heading equipamento">
                                                            <a class="accordion-toggle" data-parent=
                                                               "#equipamento<?= $key ?>-<?= $key1 ?>" href=
                                                               "?view=cat&category=<?= $key1 ?>#ponto<?= $key ?>-<?= $key1 ?>"><?= $value1; ?></a>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="accordion-group">
                                                        <div class="accordion-heading equipamento sub">
                                                            <span class="info-caret right"></span>
                                                            <a class="accordion-toggle" data-parent=
                                                               "#equipamento<?= $key ?>-<?= $key1 ?>" data-toggle="collapse" href=
                                                               "?view=cat&category=<?= $key1 ?>#ponto<?= $key ?>-<?= $key1 ?>"><?= $value1; ?></a>
                                                            <a href="?view=cat&amp;category=<?= $key1 ?>" class="edit" title="Редактировать категорию"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-body collapse" id="ponto<?= $key ?>-<?= $key1 ?>">
                                                        <div class="accordion-inner">
                                                            <div class="accordion" id="servico<?= $key ?>">
                                                                <div class="accordion-group">
                                                                    <?php $sub_menu = submenu($key1); ?>
                                                                    <?php foreach ($sub_menu as $key2 => $value2): ?>
                                                                        <div class="accordion-heading ponto">
                                                                            <a class="accordion-toggle" href="?view=cat&category=<?= $key2 ?>"><?= $value2[0] ?></a>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>    

                                                <?php endif; ?>   
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>-->
               
                    <!-- Аккордеон -->
                    <ul class="nav-catalog" id="accordion">
                        <?php foreach($cat as $key => $item): ?>
                            <?php if(count($item) > 1): // если это родительская категория ?>
                            <h3><li><a href="#"><?=$item[0]?></a></li></h3>
                                <ul>
                                    <li><a <?=active_url("category=$key")?> href="?view=cat&amp;category=<?=$key?>">&nbsp;- Все модели</a></li>
                                    <br />
                                    <?php if(!empty($item['sub'])): ?>
                                        <?php foreach($item['sub'] as $key => $sub): ?>
                                            <?php $subsub = submenu($key); ?>
                                            <?php if (!$subsub): ?>
                                                <li><a <?=active_url("category=$key")?> href="?view=cat&amp;category=<?=$key?>">&nbsp;- <?=$sub?></a></li>
                                            <?php else: ?>
                                                <p class="subsubp"><span class="caret"></span> <?=$sub?></p>
                                                <ul class="nav-catalog">
                                                    <li><a <?=active_url("category=$key")?> href="?view=cat&amp;category=<?=$key?>">&nbsp;&nbsp;&nbsp;- Все модели</a></li>
                                                    <br />
                                                    <?php foreach($subsub as $keys => $values): ?>
                                                        <li><a <?=active_url("category=$keys")?> href="?view=cat&amp;category=<?=$keys?>">&nbsp;&nbsp;&nbsp;- <?=$values[0]?></a></li>
                                                        <br />
                                                    <?php endforeach;?>
                                                </ul>
                                            <?php endif;?>    
                                        <br />
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                </ul>
                            <?php elseif($item[0]): // если самостоятельная категория ?>
                                <li><a <?=active_url("category=$key")?> href="?view=cat&amp;category=<?=$key?>"><?=$item[0]?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <!-- Аккордеон -->
                    
                    
                <!--</div>-->
            </div>
            



            
            
            
        </div>
        
