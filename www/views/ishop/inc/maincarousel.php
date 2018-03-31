<?php defined('ISHOP') or die('Access denied'); ?>
<div class="row sliderwrapper">
    <div class="screenwrapper">
        <div class="screen">
            <div id="carousel" class="carousel fade clearfix" data-ride="carousel">
                <!-- Indicators -->
                <div class="indicators-wrap">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel" data-slide-to="1"></li>
                        <li data-target="#carousel" data-slide-to="2"></li>
                        <li data-target="#carousel" data-slide-to="3"></li>
                    </ol>
                </div>
                <!-- carousel-inner -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="<?= TEMPLATE ?>images/slide1.png" alt="">
                        <div class="container">
                            <div class="carousel-caption">
                                <span class="slide-caption-1">Золото<br>&nbsp;&nbsp;Балтийского<br>&nbsp;&nbsp;&nbsp;&nbsp;моря</span>
                                <a href="#" class="btn-rose slide1">узнать больше</a>
                            </div>
                        </div>  
                    </div>
                    <div class="item">
                        <img src="<?= TEMPLATE ?>images/slide2.png" alt="">
                        <div class="container">
                            <div class="carousel-caption">
                                <span class="slide2-caption">оригинальные подарки<br>&nbsp;&nbsp;&nbsp;для всей семьи</span>
                                <a href="#best" class="btn-rose slide2">смотреть</a>
                            </div>
                        </div>  
                    </div>
                    <div class="item">
                        <img src="<?= TEMPLATE ?>images/slide3.png" alt="">
                        <div class="container">
                            <div class="carousel-caption">
                                <span class="slide3-caption">стильные новинки<br>&nbsp;&nbsp;&nbsp;из натурального янтаря</span>
                                <a href="#new" class="btn-rose slide3">смотреть</a>
                            </div>
                        </div>  
                    </div>
                    <div class="item">
                        <img src="<?= TEMPLATE ?>images/slide4.png" alt="">
                        <div class="container">
                            <div class="carousel-caption">
                                <span class="slide4-caption">высочайшая степень<br>&nbsp;&nbsp;&nbsp;детализации изделий</span>
                                <a href="?view=catalog#casting" class="btn-rose slide4">смотреть</a>
                            </div>
                        </div>  
                    </div>
                </div> <!-- ./carousel-inner -->
                <!-- Controls -->
                <div class="controls-wrap">
                    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                        <div class="left-wrap hidden-xs">
                            <i class="fa fa-square fa-2x" aria-hidden="true"></i>
                            <span class="fa fa-chevron-left" aria-hidden="true"></span>
                        </div>
                        <span class="fa fa-chevron-left visible-xs-block" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                        <div class="right-wrap hidden-xs">
                            <i class="fa fa-square fa-2x" aria-hidden="true"></i>
                            <span class="fa fa-chevron-right" aria-hidden="true"></span>
                        </div>
                        <span class="fa fa-chevron-right visible-xs-block" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

