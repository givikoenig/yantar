<?php defined('ISHOP') or die('Access denied'); ?>

<div class="navbar-fixed-top hidden-xs">
    <div class="container">
        <div class="row">
            <span class="visible-sm-inline-block company">YANTAR-SHOP</span>
            <a class="email top-email hidden-sm" data-account="baltbereg39"><i class="fa fa-envelope"></i></a>
            <ul class="navbar-right list-inline">
                <?php if ($_SESSION['auth']['login']):?>
                <li class="loggeduser"><i class="fa fa-user-circle" title="<?=$_SESSION['auth']['login']?>"></i>&nbsp;<span class="size hidden-sm"><?=$_SESSION['auth']['login']?></span></li>
                <?php endif; ?>
                <li><a href="<?= PATH ?>">главная</a></li>
                <li><a href="?view=catalog">каталог</a></li>
                <?php if ($pages): ?>
                    <?php foreach ($pages as $item): ?>
                        <li><a href="?view=page&amp;page_id=<?= $item['page_id'] ?>"><?= $item['title'] ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>      
    </div>
</div>
</div><!--./navbar-static-top-->
