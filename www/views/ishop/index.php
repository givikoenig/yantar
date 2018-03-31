<?php require_once 'inc/head.php'; ?>
<body>
<?php require_once 'inc/topfixmenu.php'; ?>
<?php require_once 'inc/topmenu.php'; ?>    
    <div class="contentwrapper">
        <?php // print_arr($GLOBALS['dblink']); ?>
        <div id="content">
            <?php include $view. '.php'; ?>
        </div>
    </div> 
<?php require_once 'inc/footer.php'; ?>

</body>
</html>