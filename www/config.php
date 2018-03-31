<?php
defined('ISHOP') or die('Access denied');
define('PATH', 'http://suvenirbronz.m39.ru/');

define('MODEL', 'model/model.php');
define('CONTROLLER', 'controller/controller.php');
define('VIEW', 'views/');
define('TEMPLATE', VIEW.'ishop/');
define('PRODUCTIMG', PATH.'userfiles/product_img/baseimg/');
define('GALLERYIMG', PATH.'userfiles/product_img/');

define('SIZE', 1048576);

define('HOST', 'localhost');
define('USER', 'suvenirbronz');
define('PASS', 'LVEtE5GMB0bAsrNT');
define('DB', 'suvenirbronz');

define('TITLE', 'Интернет-магазин по оптовой продаже сувениров и украшений из янтаря, латуни и бронзы');
define('ADMIN_EMAIL', 'iv.garin@gmail.com');

//кол-во товаров на страницу
    define('PERPAGE', 12);
    define('EYEPERPAGE', 12); //для айстопперов
    define('NEWSPERPAGE', 3); //для новостей на гл.стр.
    
//Папка шаблонов административной части
define('ADMIN_TEMPLATE', 'templates/');  

global $dblink;
$dblink = mysqli_connect(HOST, USER, PASS, DB);
//mysqli_select_db(DB) or die('No connection to DB');
mysqli_query($dblink, 'SET NAMES "UTF8"');
