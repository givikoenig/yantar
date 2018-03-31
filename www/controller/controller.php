<?php defined('ISHOP') or die('Access denied');


session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();


// update last activity time stamp

require_once 'functions/functions.php';
require_once MODEL;

$cat = catalog();
$menu = menu();
$allproducts = allproducts();
$informers = informer();
$info_num = count($informers);
$max_informer_num = 4; //макс.кол-во информеров
if($info_num > $max_informer_num) $info_num = $max_informer_num;
switch($info_num) {
    case(1):
        $col_num = 12;
        break;
    case(2):
        $col_num = 6;
        break;
    case(3):
        $col_num = 4;
        break;
    case(4):
        $col_num = 3;
        break;
}
$max_sale_img = 15; //макс.кол-во картинок в карусели "Распродажа"
$loginout = "";
$out = "";
//Получение массива страниц
$pages = pages();
//получение названия новостей
$news_perpage = NEWSPERPAGE;
$news = get_title_new($news_perpage);

if($_POST['lostpass']){
        lostpass();
//        redirect();   
}
//регистрация
if($_POST['reg']){
    registration();
    redirect();   
}
// авторизация
if($_POST['auth']){
    authorization();
//    redirect();
    if($_SESSION['auth']['login']){
        // если пользователь авторизовался
        echo "<div><pre class='success'>Добро пожаловать," . htmlspecialchars($_SESSION['auth']['login']) . "</pre></div>";
        exit;
    }else{
        // если авторизация неудачна
        echo $_SESSION['auth']['error'];
        unset($_SESSION['auth']);
        exit;
    }
}
// выход пользователя
if($_GET['do'] == 'logout'){
    logout();
    redirect();
}
//получение динамичной части шаблона #content
$view = empty($_GET['view']) ? 'mainpage' : $_GET['view'];

switch ($view) {
    case('mainpage') :
        //главная страница
        $new_eyestoppers = eyestopper('new');
        $sale_eyestoppers = eyestopper('sale');
        $hits_eyestoppers = eyestopper('hits');
        break;
    case('hits') :
        // товары дня
        $eye = 'hits';
        //параметры для pagination//
        $eye_perpage = EYEPERPAGE;
        if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
            if($page < 1) $page = 1;
        }else{
            $page = 1;
        }
        $eyestoppers = eyestopper('hits');
        $eye_count_rows = eye_count_rows($eye);
        $eye_pages_count = ceil($eye_count_rows / $eye_perpage);
        if(!$eye_pages_count) $eye_pages_count = 1; //минимум 1 страница
        if($page > $eye_pages_count) $page = $eye_pages_count; //если запрошенная стр. больше максимума
        $eye_start_pos = ($page -1) * $eye_perpage; //начальная позиция для запроса
        $eye_products = eye_products($eye,  $eye_start_pos, $eye_perpage);
        //параметры для pagination//
        break;
    case('new');
        //новинки
        $eye = 'new';
        //параметры для pagination//
        $eye_perpage = EYEPERPAGE;
        if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
            if($page < 1) $page = 1;
        }else{
            $page = 1;
        }
        $eyestoppers = eyestopper('new');
        $eye_count_rows = eye_count_rows($eye);
        $eye_pages_count = ceil($eye_count_rows / $eye_perpage);
        if(!$eye_pages_count) $eye_pages_count = 1; //минимум 1 страница
        if($page > $eye_pages_count) $page = $eye_pages_count; //если запрошенная стр. больше максимума
        $eye_start_pos = ($page -1) * $eye_perpage; //начальная позиция для запроса
        $eye_products = eye_products($eye,  $eye_start_pos, $eye_perpage);
        //параметры для pagination//
        break;
    case('sale');
        //распродажа
        $eye = 'sale';
        //параметры для pagination//
        $eye_perpage = EYEPERPAGE;
        if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
            if($page < 1) $page = 1;
        }else{
            $page = 1;
        }
        $eyestoppers = eyestopper('sale');
        $eye_count_rows = eye_count_rows($eye);
        $eye_pages_count = ceil($eye_count_rows / $eye_perpage);
        if(!$eye_pages_count) $eye_pages_count = 1; //минимум 1 страница
        if($page > $eye_pages_count) $page = $eye_pages_count; //если запрошенная стр. больше максимума
        $eye_start_pos = ($page -1) * $eye_perpage; //начальная позиция для запроса
        $eye_products = eye_products($eye,  $eye_start_pos, $eye_perpage);
        //параметры для pagination//
        break;
    case('catalog');
        //каталог
        break;
    case('page');
        // отдельная страница
        $page_id = abs((int)$_GET['page_id']);
        $get_page = get_page($page_id);
        break;
    case('info');
        //информеры
        break;
    case('news');
        //отдельная новость
        $news_id = abs((int)$_GET['news_id']);
        $news_text = get_news_text($news_id);
        break;
    case('archive');
        //все новости (архив новостей)
        //параметры для pagination//
        $perpage = 3; //кол-во товаров на страницу
        if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
            if($page < 1) $page = 1;
        }else{
            $page = 1;
        }
        $count_rows = count_news(); //кол-во новостей
        $pages_count = ceil($count_rows / $perpage);
        if(!$pages_count) $pages_count = 1; //минимум 1 страница
        if($page > $pages_count) $page = $pages_count; //если запрошенная стр. больше максимума
        $start_pos = ($page -1) * $perpage; //начальная позиция для запроса
        
        $all_news = get_all_news($start_pos, $perpage);
        break;
    case('cat');
        $category = abs((int)$_GET['category']);
//        $mainbrandscount = main_brands_count();
        $submenu = submenu($category);
        $l_submenu = l_submenu($category);
        $subcats = get_catmenu($category);
        //=====сортировка=====//
        //массив параметров сортировки
        //ключи - то, что передаем в GET
        //значение - то, что показываем пльзователю + часть SQL-запроса для модели
        $order_p =array(
                       'pricea' => array('по цене &uarr;', 'price ASC'),
                       'priced' => array('по цене &darr;', 'price DESC'),
                       'datea' => array('по дате добавления &uarr;', 'date ASC'),
                       'dated' => array('по дате добавления &darr;', 'date DESC'),
                       'namea' => array('от А до Я', 'name ASC'),
                       'named' => array('от Я до А', 'name DESC'),
                       );
        $order_get = clear($_GET['order']);
        if(array_key_exists($order_get, $order_p)){
            $order = $order_p[$order_get][0];
            $order_db = $order_p[$order_get][1];
        }else{
            // по умолчанию сортировка по первому элементу массива $order_p
            $order = $order_p['namea'][0];
            $order_db = $order_p['namea'][1];
        }
//=====сортировка=====//
//параметры для pagination//
        $perpage = PERPAGE; //кол-во товаров на страницу
        if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
            if($page < 1) $page = 1;
        }else{
            $page = 1;
        }
        $count_rows = count_rows($category);
        $pages_count = ceil($count_rows / $perpage);
        if(!$pages_count) $pages_count = 1; //минимум 1 страница
        if($page > $pages_count) $page = $pages_count; //если запрошенная стр. больше максимума
        $start_pos = ($page -1) * $perpage; //начальная позиция для запроса
//параметры для pagination//
        $brand_name = brand_name($category); //хлебные крохи
        $products = products($category, $order_db, $start_pos, $perpage);
        break;
    case('addtocart'):
        // добавление в корзину
        $goods_id = abs((int)$_GET['goods_id']);
        $count = abs((int)$_GET['count']);
        addtocart($goods_id, $count);
        $_SESSION['total_sum'] = total_sum($_SESSION['cart']);
        $_SESSION['min_sum'] = 3000; //миним. сумма заказа
        // кол-во товара в корзине + защита от ввода несуществующего ID товара
        total_quantity();
        redirect();
    break;
    case('cart');
        /*корзина*/
        //получение способов доставки
        $dostavka = get_dostavka();
        // пересчет товаров в корзине
        if(isset($_GET['id'], $_GET['qty'])){
            $goods_id = abs((int)$_GET['id']);
            $qty = abs((int)$_GET['qty']);

            $qty = $qty - $_SESSION['cart'][$goods_id]['qty'];
            addtocart($goods_id, $qty);

            $_SESSION['total_sum'] = total_sum($_SESSION['cart']); // сумма заказа

            total_quantity(); // кол-во товара в корзине + защита от ввода несуществующего ID товара
            redirect();
        }
        // удаление товара из корзины
        if (isset($_GET['delete'])){
            $id = abs((int)$_GET['delete']);
            if($id){
                delete_from_cart($id);
            }
            redirect();
        }
        if ($_POST['order']){
            add_order();
            redirect();
        }
    break;
    case('reg');
        break;
    case('lostpass');
        break;
    case('search');
        //поиск
        $result_search = search();
        break;
    case('product');
        //отдельный товар
        $goods_id = abs((int)$_GET['goods_id']);
        if($goods_id){
            $goods = get_goods($goods_id);
            if($goods) $brand_name = brand_name($goods['goods_brandid']); //хлебные крохи
        }
        break;
    
    default :
        // если из адресной строки получено имя несуществующего вида
        $view = 'mainpage';
}

// подключение вида
require_once TEMPLATE.'index.php';
