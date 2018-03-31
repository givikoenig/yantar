<?php defined('ISHOP') or die('Access denied');
// ======= Каталог  - получение массива //
function catalog(){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
     $query = "SELECT * FROM brands"; // ORDER BY parent_id, brand_name";
     $res = mysqli_query($dblink,$query);

     //массив категорий
     $cat = array();
     if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res)) {
            if($row['parent_id'] == '0'){
               $cat[$row['brand_id']][] = $row['brand_name']; 
               $cat[$row['brand_id']][] = $row['img'];
            } elseif ($row['sub_sub'] == '0') {
               $cat[$row['parent_id']]['sub'][$row['brand_id']] = $row['brand_name'];
                $cat[$row['parent_id']]['img'][$row['brand_id']] = $row['img'];
            }
        }
     } 
     return $cat;
}
// ======= Каталог  - получение массива //
// ======меню каталога и др.внутренних страниц========//
function menu() {
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT brand_id, brand_name FROM brands WHERE parent_id = '0' OR has_child = '1'";
     $res = mysqli_query($dblink,$query);
     
     $menu = array();
     if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res)) {
            $menu[$row['brand_id']][] = $row['brand_name']; 
        }
     }   
     return $menu;
}
// ======меню каталога и др.внутренних страниц========//
// ===субменю каталога включая 2-ой уровень вложенности=====//
function submenu($sub_parentid){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT brand_id, brand_name FROM brands
                WHERE parent_id = $sub_parentid" ;
    $res = mysqli_query($dblink,$query);
    
    $submenu = array();
    if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res)){
            $submenu[$row['brand_id']][] = $row['brand_name'];
        }
    }    
    return $submenu;
}
// ===субменю каталога включая 2-ой уровень вложенности=====//
// === только пункты субменю каталога 1-го ур.влож., у которых есть подкатегории=====//
function l_submenu($category){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT brand_id, brand_name FROM brands
                WHERE brand_id = $category AND has_child = '1'" ;
    $res = mysqli_query($dblink,$query);
    
    $l_submenu = array();
    if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res)){
            $l_submenu[$row['brand_id']][] = $row['brand_name'];
        }
    }    
    return $l_submenu;
}
// === только пункты субменю каталога 1-го ур.влож., у которых есть подкатегории=====//
//====субменю категории (напр. сувениров)====//
function get_catmenu($category){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT parent_id FROM brands WHERE brand_id = $category";
    $res = mysqli_query($dblink,$query);
    $parentid = mysqli_fetch_row($res);
    $query2 = "SELECT brand_name, brand_id FROM brands WHERE parent_id = $parentid[0]";
    $res2 = mysqli_query($dblink,$query2);
    $subcats = array();
    if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res2)){
            $subcats[$row['brand_id']][] = $row['brand_name'];
            $subcats[$row['brand_id']][] = $row['parent_id'];
        }
    }  
    return $subcats;
}
//====субменю категории (напр. сувениров)====//

//===кол-во самостоятельных категорий с parent_id = 0 =====//
function main_brands_count() {
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
$query = "SELECT count(brand_id) as count FROM brands WHERE parent_id = '0'";
$res = mysqli_query($dblink,$query);
if(mysqli_affected_rows($dblink) > 0 ){
    $data = mysqli_fetch_assoc($res);
}    
return $data[count];
}
//===кол-во самостоятельных категорий с parent_id = 0 =====//

//======страницы========//
function pages(){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT page_id, title FROM pages ORDER BY position";
    $res = mysqli_query($dblink,$query);
    
    $pages = array();
    while ($row = mysqli_fetch_assoc($res)){
        $pages[] = $row; 
    }
    return $pages;
}
//======страницы========//
//======отдельная страница========//
function get_page($page_id){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT title, text FROM pages WHERE page_id = $page_id";
    $res = mysqli_query($dblink,$query);
    
    $get_page = array();
    $get_page = mysqli_fetch_assoc($res);
    return $get_page;
}
//======отдельная страница========//
//===названия новостей==========//
function get_title_new($news_perpage){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT news_id, title, data FROM news ORDER BY data DESC LIMIT $news_perpage";
    $res = mysqli_query($dblink,$query);
    
    $news = array();
    while($row = mysqli_fetch_assoc($res)){
        $news[] = $row;
    }
    return $news;
}
//===названия новостей==========//
//===отдельная новость=======//
function get_news_text($news_id){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT title, text, data FROM news WHERE news_id = $news_id";
    $res = mysqli_query($dblink,$query);
    
    $news_text = array();
    $news_text = mysqli_fetch_assoc($res);
    return $news_text;
}
//===отдельная новость=======//
//=====архив новостей ======//
function get_all_news($start_pos, $perpage){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT news_id, title, anons, data FROM news ORDER BY data DESC LIMIT $start_pos, $perpage";
    $res = mysqli_query($dblink,$query);

    $all_news = array();
    while($row = mysqli_fetch_assoc($res)){
        $all_news[] = $row;
    }
    return $all_news;
}
//=====архив новостей ======//
//=====кол-во новостей=====//
function count_news(){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
  $query = "SELECT count(news_id) FROM news";
    $res = mysqli_query($dblink,$query);
    
    $count_news = mysqli_fetch_row($res);
    return $count_news[0];
}
//=====кол-во новостей=====//
//====информеры - получение массива ====== //
function informer(){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
   $query = "SELECT * FROM links
                INNER JOIN informers ON
                    links.parent_informer = informers.informer_id
                        ORDER BY informer_position, links_position";
   $res = mysqli_query($dblink,$query);
   
   $informers = array();
   $name = ''; // флаг имени информера
   $position = 0;
   $icon = '';
   if(mysqli_affected_rows($dblink) > 0 ){
        while($row = mysqli_fetch_assoc($res)) {
            if ($row['informer_name'] != $name) { // если такого информера в массиве еще нет
                $informers[$row['informer_id']][] = $row['informer_name']; // добавляем информер в массив
                $informers[$row['informer_id']][] = $row['informer_position'];
                $informers[$row['informer_id']][] = $row['icon'];
                $name = $row['informer_name'];
                $position = $row['informer_position'];
                $icon = $row['icon'];
            }
            $informers[$row['parent_informer']]['sub'][$row['link_id']] = $row['link_name']; //заносим страницы в информер
        }
   }     
   return $informers;
}
//====информеры - получение массива ====== //
/* ===Получение текста информера=== */
function get_text_informer($informer_id){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT link_id, link_name, text, informers.informer_id, informers.informer_name
                FROM links
                    LEFT JOIN informers ON informers.informer_id = links.parent_informer
                        WHERE link_id = $informer_id";
    $res = mysqli_query($dblink,$query);

    $text_informer = array();
    $text_informer = mysqli_fetch_assoc($res);
    return $text_informer;
}
/* ===Получение текста информера=== */

//===Айстопперы - новинки, лидеры продаж, распродажа ====//
function eyestopper($eyestopper){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT goods_id, name, articul, img, anons, price, old_price, available FROM goods
                WHERE visible='1' AND $eyestopper='1'";
    $res = mysqli_query($dblink,$query);
    
    $eyestoppers = array();
    if(mysqli_affected_rows($dblink) > 0 ){
        while($row = mysqli_fetch_assoc($res)){
            $eyestoppers[] = $row;
        }
    }
    return $eyestoppers;
}
//===Айстопперы - новинки, лидеры продаж, распродажа ====//
//получение кол-ва товаров для pagination
function count_rows($category){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "(SELECT COUNT(goods_id) as count_rows
                 FROM goods
                    WHERE goods_brandid = $category AND visible = '1')
                UNION        
               (SELECT COUNT(goods_id) as count_rows
                  FROM goods
                    WHERE goods_brandid IN
                (

                SELECT brand_id FROM brands WHERE parent_id IN
                      (
                       SELECT brand_id FROM brands WHERE brand_id = $category
                      )
                      UNION
                       SELECT brand_id FROM brands WHERE parent_id IN
                         (
                          SELECT brand_id FROM brands WHERE parent_id = $category
                         )
                ) AND visible = '1')";
    $res = mysqli_query($dblink,$query);
    
    while($row = mysqli_fetch_assoc($res)){
        if($row['count_rows']) $count_rows = $row['count_rows'];
    }
    return $count_rows;
}

function eye_count_rows($eye){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT COUNT(goods_id) as eye_count_rows
                 FROM goods
                    WHERE $eye = '1' AND visible = '1'";
    $res = mysqli_query($dblink,$query);
    while($row = mysqli_fetch_assoc($res)){
        if($row['eye_count_rows']) $eye_count_rows = $row['eye_count_rows'];
    }
    return $eye_count_rows;
}
//получение кол-ва товаров для pagination
//получение массива товаров по категории  //
function products($category, $order_db, $start_pos, $perpage){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "(SELECT goods_id, name, articul, img, price, old_price, date, available
                 FROM goods
                    WHERE goods_brandid = $category AND visible = '1')
                UNION        
               (SELECT goods_id, name, articul, img, price, old_price, date, available
                  FROM goods WHERE goods_brandid IN
                   (
                    SELECT brand_id FROM brands WHERE parent_id IN
                      (
                       SELECT brand_id FROM brands WHERE brand_id = $category
                      )
                      UNION
                       SELECT brand_id FROM brands WHERE parent_id IN
                         (
                          SELECT brand_id FROM brands WHERE parent_id = $category
                         )
                   )
                   AND visible = '1'
                ) ORDER BY $order_db LIMIT $start_pos, $perpage";
    $res = mysqli_query($dblink,$query);
    
    $products = array();
    if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res)){
            $products[] = $row;
        }
    }    
    return $products;
}
//получение массива товаров по категории  //
//получение массива товаров по айстопперам
function eye_products($eye, $start_pos, $eye_perpage){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT goods_id, name, articul, img, price, old_price, date, available
                 FROM goods
                    WHERE $eye = '1' AND visible = '1'
                        LIMIT $start_pos, $eye_perpage";
    $res = mysqli_query($dblink,$query);
    
    $eye_products = array();
    if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res)){
            $eye_products[] = $row;
        }
    }    
    return $eye_products;
}
//получение массива товаров по айстопперам

function allproducts(){ // все товары
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $qyery = "SELECT goods_id, name, articul, img, price
                FROM goods
                    WHERE visible = '1'";
    $res = mysqli_query($dblink,$qyery);
    
    $allproducts = array();
    if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res)){
            $allproducts[] = $row;
        }
    }
    return $allproducts;
}

function prices($category){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "(SELECT price
                 FROM goods
                    WHERE goods_brandid = $category AND visible = '1')
                UNION        
               (SELECT price
                  FROM goods
                    WHERE goods_brandid IN
                (
                    SELECT brand_id FROM brands WHERE parent_id = $category
                ) AND visible = '1')";
    $res = mysqli_query($dblink,$query);
    $costs = array();
    while($row = mysqli_fetch_assoc($res)){
        $costs[] = $row;
    }
    $prices = array_column($costs, 'price');
    return $prices;
}
//получение массива товаров по категории  //
//===получение названий для хлебных крошек===//
function brand_name($category){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "(SELECT brand_id, brand_name FROM brands
                WHERE brand_id = (SELECT parent_id FROM brands WHERE brand_id = $category)
                )
                UNION
                (SELECT brand_id, brand_name FROM brands WHERE brand_id = $category)";
    $res = mysqli_query($dblink,$query);
    $brand_name = array();
    while($row = mysqli_fetch_assoc($res)){
        $brand_name[] = $row;
    }
    return $brand_name;
}
//===получение названий для хлебных крошек===//
/* ===Сумма заказа в корзине + атрибуты товара===*/
function total_sum($goods){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $total_sum = 0;

    $str_goods = implode(',',array_keys($goods));

    $query = "SELECT goods_id, name, price, img
                FROM goods
                    WHERE goods_id IN ($str_goods)";

    $res = mysqli_query($dblink,$query);

    while($row = mysqli_fetch_assoc($res)){
        $_SESSION['cart'][$row['goods_id']]['name'] = $row['name'];
        $_SESSION['cart'][$row['goods_id']]['price'] = $row['price'];
        $_SESSION['cart'][$row['goods_id']]['img'] = $row['img'];
        $total_sum += $_SESSION['cart'][$row['goods_id']]['qty'] * $row['price'];
    }
    return $total_sum;
}
/* ===Сумма заказа в корзине + атрибуты товара===*/
//======регистрация====== //
function registration(){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $error = ''; //проверки пустых полей
    
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $pr = trim($_POST['pr']);
    $captcha = trim($_POST['captcha']);
    
    if(empty($login)) $error .= '<li>Не указан логин</li>';
    if(empty($pass)) $error .= '<li>Не указан пароль</li>';
    if(empty($name)) $error .= '<li>Не указано имя</li>';
    if(empty($email)) $error .= '<li>Не указан E-mail</li>';
    if(empty($phone)) $error .= '<li>Не указан телефон</li>';
    if(empty($address)) $error .= '<li>Не указан адрес</li>';
    if(empty($pr)){
        $error .= '<li>Не введены символы с картинки</li>';
        unset($pr);
    }
    
    if(empty($error)) {
        if ($captcha == $pr) {
                // все обязательные поля заполнены
                // проверяем, нет ли такого юзера в БД
                $query = "SELECT customer_id FROM customers WHERE login = '" .clear($login). "'LIMIT 1";
                $res = mysqli_query($dblink,$query);
                $row = mysqli_num_rows($res); // 1 - такой юзер есть, 0 - нет//
                if($row) {
                    // если такой логин уже есть
                $_SESSION['reg']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Пользователь с таким логином уже зарегистрирован.</div></div>";
                $_SESSION['reg']['name'] = $name;
                $_SESSION['reg']['email'] = $email;
                $_SESSION['reg']['phone'] = $phone;
                $_SESSION['reg']['address'] = $address;
                } else { 
                  // если все ОК - регистрируем
                    $login = clear($login);
                    $name = clear($name);
                    $email = clear($email);
                    $phone = clear($phone);
                    $address = clear($address);
                    $pr = clear($pr);
                    $captcha = clear($captcha);
                    $pass = md5 ($pass);
                    $query = "INSERT INTO customers (name, email, phone, address, login, password)
                                VALUES ('$name', '$email',  '$phone', '$address',  '$login', '$pass')";
                    $res = mysqli_query($dblink,$query);
                    if(mysqli_affected_rows($dblink) > 0 ){
                        // если запись добавлена
                       $_SESSION['reg']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 success'>Регистрация прошла успешно.</div></div>"; 
                       $_SESSION['reg']['success'] = "OK";
                       $_SESSION['auth']['login'] = $_POST['login'];
                       $_SESSION['auth']['customer_id'] = mysqli_insert_id();
                       $_SESSION['auth']['email'] = $email;
                       $_SESSION['auth']['name'] = $name;//!!!
                    }else{
                       $_SESSION['reg']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Ошибка записи!</div></div>";
                       $_SESSION['reg']['login'] = $login;
                       $_SESSION['reg']['name'] = $name;
                       $_SESSION['reg']['email'] = $email;
                       $_SESSION['reg']['phone'] = $phone;
                       $_SESSION['reg']['address'] = $address;
                    }
                }
        } else {
           $_SESSION['reg']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Цифры с картинки введены неправильно</div></div>"; 
        }    
    } else {
        // если не заполнены обязательные поля
        $_SESSION['reg']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Не заполнены обязательные поля: <ul> {$error} </ul></div></div>";
        $_SESSION['reg']['login'] = $login;
        $_SESSION['reg']['name'] = $name;
        $_SESSION['reg']['email'] = $email;
        $_SESSION['reg']['phone'] = $phone;
        $_SESSION['reg']['address'] = $address;
    }
} 
//======регистрация====== //
//===восстановление доступа к аккаунту=====//
function lostpass(){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $usrname = trim($_POST['usrname']);
    $pr = trim($_POST['pr']);
    $captcha = trim($_POST['captcha']);
    
    if (empty($usrname) OR empty($pr)){
        $_SESSION['lostpass']['error'] = "Заполните обязательные поля. После проверки Вам будет отправлен новый пароль на Email, указанный при регистрации.";
    }else {
       if ($captcha == $pr) {
           $usrname = clear($usrname);
            $query = "SELECT customer_id FROM customers WHERE login = '$usrname' LIMIT 1";
            $res = mysqli_query($dblink,$query);
               if(mysqli_num_rows($res) == 1 ) {
                $simvols = array ("0","1","2","3","4","5","6","7","8","9",
                        "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
                        "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
                for ($key = 0; $key < 6; $key++){
                    shuffle ($simvols);
                    $string = $string.$simvols[1];
                }
                $pass = md5($string);
                $query = "UPDATE customers SET password = '$pass' WHERE login='$usrname' ";
                $res = mysqli_query($dblink,$query);
                $query = "SELECT email FROM customers WHERE login = '$usrname' LIMIT 1";
                $res = mysqli_query($dblink,$query);
                $row = mysqli_fetch_assoc($res);
                $email = $row['email'];
                mail_pass($usrname, $email, $string);
                $_SESSION['lostpass']['success'] = "На Ваш электронный адрес отправлен новый пароль";
                $_POST['usrname'] =  $_POST['pr'] = $_POST['captcha'] = $email = '';
                //exit;
            }
       } else {
           $_SESSION['lostpass']['error'] = "Символы с картинки введены неверно.";
           $_SESSION['lostpass']['usrname'] = $usrname;
       }    
    }
}
//===восстановление доступа к аккаунту=====//
//==отправка уведомлений о смене пароля к аккаунту==//
function mail_pass($login, $email, $pass){
    
    
    $subject = "Изменение учетной записи в Интернет-магазине";
    $headers .= "Content-type:text/plain; charset:utf-8\r\n";
    $headers .= "From: YANTAR-SHOP";
    // тело письма
    $mail_body = "\r\nЗдравствуйте, {$login} !\r\nВаш новый пароль в Интернет-магазине YANTAR-SHOP:\r\n  {$pass}";
    mail($email, $subject, $mail_body, $headers);
}
//==отправка уведомлений о смене пароля к аккаунту==//
//====авторизация====//
function authorization() {
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $login =  mysqli_real_escape_string($dblink, trim($_POST['login']));  //mysqli_real_escape_string(
    $pass = trim($_POST['pass']);
    if (empty($login) OR empty($pass)){
        // если не заполнены поля логина или пароля
        $_SESSION['auth']['error'] = "Поля логин/пароль должны быть заполнены.";
    }else {
       // если получены логин/пароль
        $pass = md5($pass);
        $query = "SELECT customer_id, login, email FROM customers WHERE login = '$login' AND password = '$pass' LIMIT 1";
        $res = mysqli_query($dblink,$query);
        if(mysqli_num_rows($res) == 1 ) {
            // если авторизация успешна
            $row = mysqli_fetch_row($res);
            $_SESSION['auth']['customer_id'] = $row[0];
            $_SESSION['auth']['login'] = $row[1];
            $_SESSION['auth']['email'] = $row[2];
            $_SESSION['auth']['name'] = $row[3]; //!!!
        }else{
            //если неверны логин/пароль
            $_SESSION['auth']['error'] = "Логин/пароль введены неверно.";
        }
    }
}
//====авторизация====//
//==Способы доставки===//
function get_dostavka(){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT * FROM dostavka";
    $res = mysqli_query($dblink,$query);
    
    $dostavka = array();
    while($row = mysqli_fetch_assoc($res)){
        $dostavka[] = $row;
    }
    return $dostavka;
}
//==Способы доставки===//
//=====добавление заказа=======//
function add_order(){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
   //получаем общие для всех данные (авторизованных и не очень)
   $dostavka_id = (int)$_POST['dostavka'];
   if(!$dostavka_id) $dostavka_id = 1;
   $prim = trim($_POST['prim']);
   if($_SESSION['auth']['login']) $customer_id = $_SESSION['auth']['customer_id'];
   
   if(!$_SESSION['auth']['login']){
    $error = ''; //проверки пустых полей
   
    $name = trim($_POST['name']);
    $e_mail = trim($_POST['e_mail']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    
    if(empty($name)) $error .= '<li>Не указано имя</li>';
    if(empty($e_mail)) $error .= '<li>Не указан E-mail</li>';
    if(empty($phone)) $error .= '<li>Не указан телефон</li>';
    if(empty($address)) $error .= '<li>Не указан адрес</li>'; 
    
    if(empty($error)) {
        //добавляем гостя в заказчики (но без данных авторизации)
        $customer_id = add_customer($name, $e_mail, $phone, $address);
        if (!$customer_id) return false;//прекращаем выполнение в случ.возникновения ошибки добавления гостя-заказчика
    }else{
      //если не заполнены обязательные поля  
      $_SESSION['order']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Не заполнены обязательные поля: <ul> {$error} </ul></div></div>";
      $_SESSION['order']['name'] = $name;
      $_SESSION['order']['e_mail'] = $e_mail;
      $_SESSION['order']['phone'] = $phone;
      $_SESSION['order']['address'] = $address;
      $_SESSION['order']['prim'] = $prim;
      return false;
    }
   }
   $_SESSION['order']['e_mail'] = $e_mail;
   save_order($customer_id, $dostavka_id, $prim );
}
//=====добавление заказа=======//
//======добавление заказчика-гостя======//
function add_customer($name, $email, $phone, $address){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $name = clear($_POST['name']);
    $e_mail = clear($_POST['e_mail']);
    $phone = clear($_POST['phone']);
    $address = clear($_POST['address']);
    $query = "INSERT INTO customers (name, email, phone, address)
                VALUES ('$name', '$e_mail', '$phone', '$address')";
    $res = mysqli_query($dblink,$query);
    if(mysqli_affected_rows($dblink) > 0){
        //если гость добавлен в заказчики, то получаем его id
        return mysqli_insert_id();
    }else{
        //если не добавлен новый заказчик
      $_SESSION['order']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Произошла ошибка при регистрации заказа<ul> {$error} </ul></div></div>";
      $_SESSION['order']['name'] = $name;
      $_SESSION['order']['email'] = $e_mail;
      $_SESSION['order']['phone'] = $phone;
      $_SESSION['order']['address'] = $address;
      $_SESSION['order']['prim'] = $prim;
      return false; 
    }
}
//======добавление заказчика-гостя======//
//=====coхранение заказа=======//
function save_order($customer_id, $dostavka_id, $prim){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $prim = clear($prim);
    $query = "INSERT INTO orders (customer_id, date, dostavka_id, prim)
                VALUES ($customer_id, '".date('Y-m-d H:i:s')."', $dostavka_id, '$prim')";
    mysqli_query($dblink,$query);
    if(mysqli_affected_rows($dblink) == -1){
        //если не получилось сохранить заказ - удаляем заказчика
        mysqli_query($dblink,"DELETE FROM customers
                        WHERE customer_id = $customer_id AND login = ''");
        return false;
    }
    $order_id = mysqli_insert_id(); //ID сохраненного заказа
    foreach($_SESSION['cart'] as $goods_id => $value) {
        $val .= "($order_id, $goods_id, {$value['qty']}, '{$value['name']}', {$value['price']}),";
    }
    $val = substr($val, 0, -1); //удаляем последнюю запятую
    
    $query = "INSERT INTO zakaz_tovar (orders_id, goods_id, quantity, name , price)
                VALUES $val";
    mysqli_query($dblink,$query);
    if(mysqli_affected_rows($dblink) == -1){
        // если не выгрузился заказ - удаляем заказчика(customers) и заказ (orders)
       mysqli_query($dblink,"DELETE FROM orders WHERE order_id = $order_id");
       mysqli_query($dblink,"DELETE FROM customers
                        WHERE customer_id = $customer_id AND login = ''");
       return false;
    }
    if ($_SESSION['auth']['email']) $email = $_SESSION['auth']['email'];
        else $email = $_SESSION['order']['email'];
        mail_order($order_id, $email);
    
    // если заказ выгрузился
    unset($_SESSION['cart']);
    unset($_SESSION['cart']['total_sum']);
    unset($_SESSION['cart']['total_quantity']);
    unset($_SESSION['total_sum']);
    unset($_SESSION['total_quantity']);
    $_SESSION['order']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 success'>Спасибо за Ваш заказ. В ближайшее время мы свяжемся с Вами.</div></div>";
    return true;
}
//=====сохранение заказа=======//
//==отправка уведомлений о заказе на email==//
function mail_order($order_id, $email){
    // mail(to, subject, body, header);
    // тема письма
    $subject = "Заказ в Интернет-магазине";
    // заголовки
    $headers .= "Content-type: text/plain; charset: utf-8\r\n";
    $headers .= "From: YANTAR-SHOP";
    // тело письма
    $mail_body = "Благодарим Вас за заказ в Интернет-магазине YANTAR-SHOP\r\n
                  Номер Вашего заказа:  {$order_id}\r\n\r\n
                  Заказанные товары:\r\n";
                  //атрибуты товара
                  foreach($_SESSION['cart'] as $goods_id => $value){
                      $mail_body .= "- {$value['name']}, Цена: {$value['price']} руб., Кол-во: {$value['qty']} шт.\r\n";
                  }
                  $mail_body .= "\r\nИтого: {$_SESSION['total_quantity']} шт. на сумму: {$_SESSION['total_sum']} руб.\r\n\r\n";
                  $mail_body .= "Мы свяжемся с Вами в ближайшее время.\r\n\r\n";
    $adm_mail_body = "Поступил заказ через Интернет-магазин YANTAR-SHOP\r\n
                  № заказа:  {$order_id}\r\n\r\n
                  Заказанные товары:\r\n";
                  //атрибуты товара
                  foreach($_SESSION['cart'] as $goods_id => $value){
                      $adm_mail_body .= "- {$value['name']}, {$value['price']} руб., {$value['qty']} шт.\r\n";
                  }
                  $adm_mail_body .= "\r\nИтого: {$_SESSION['total_quantity']} шт. на сумму: {$_SESSION['total_sum']} руб.\r\n";
   // отправка пиcем
    mail($email, $subject, $mail_body, $headers);
    mail(ADMIN_EMAIL, $subject, $adm_mail_body, $headers);
}
//==отправка уведомлений о заказе на email==//
//===поиск====//
function search(){
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $search = clear($_GET['search']);
    $result_search = array(); //результаты поиска
    
    if(mb_strlen($search, 'UTF-8') < 4){
        $result_search['notfound'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Поисковый запрос должен содержать не менее 4-х символов</div></div>";
    }else{
        $query = "SELECT goods_id, name, articul, anons, content, img, price, old_price, available, hits, new, sale
                    FROM goods
                       WHERE MATCH(name,articul,anons,content) AGAINST('{$search}*' IN BOOLEAN MODE) AND visible='1'";
      $res = mysqli_query($dblink,$query);
    //,articul,anons,content  
      if(mysqli_num_rows($res) > 0){
          while($row_search = mysqli_fetch_assoc($res)){
              $result_search[] = $row_search;
          }
      } else {
         $result_search['notfound'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>По Вашему запросу ничего не найдено</div></div>"; 
      }
    }
    return $result_search;
}
//===поиск====//
//===отдельный товар===//
function get_goods($goods_id) {
    $dblink = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_query($dblink, 'SET NAMES "UTF8"');
    
    $query = "SELECT * FROM goods WHERE goods_id = $goods_id AND visible = '1'";
    $res = mysqli_query($dblink,$query);
    
    $goods = array();
    $goods = mysqli_fetch_assoc($res);
    if($goods['img_slide']){
        $goods['img_slide'] = explode("|", $goods['img_slide']);
    }
    return $goods;
}
//===отдельный товар===//