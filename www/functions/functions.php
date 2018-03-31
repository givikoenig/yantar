<?php defined('ISHOP') or die('Access denied');

//===распечатка массива === //
function print_arr($arr){
    echo "<pre>";
        print_r($arr);
    echo "</pre>";
}
//===распечатка массива === //

//===фильтрация входящих данных === //
function clear($var){
    $var = mysqli_real_escape_string(strip_tags($var));
    return $var;
}
//===фильтрация входящих данных === //

 /* ===Редирект=== */
function redirect($http = false){
    if($http) $redirect = $http;
    else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    header("Location: $redirect");
    exit;
}
/* ===Редирект=== */

/*=Выход пользователя==*/
function logout(){
    unset($_SESSION['auth']);
}

//=добавление в корзину====//
function addtocart($goods_id, $qty = 1){
    if(isset($_SESSION['cart'][$goods_id])) {
        //если в массиве cart уже есть добавляемый товар
        $_SESSION['cart'][$goods_id]['qty'] += $qty;
        return $_SESSION['cart'];
    } else {
        //если товар кладется в корзину впервые
        $_SESSION['cart'][$goods_id]['qty'] = $qty;
        return $_SESSION['cart'];
    }
}
//=добавление в корзину====//

// кол-во товара в корзине + защита от ввода несуществующего ID товара
function total_quantity() {
    $_SESSION['total_quantity'] = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        if (isset($value['price'])) {
            // если получена цена товара из БД - суммируем кол-во
            $_SESSION['total_quantity'] += $value['qty'];
        } else {
            // иначе - удаляем такой ID из сессиии (корзины)
            unset($_SESSION['cart'][$key]);
        }
    }
}
// кол-во товара в корзине + защита от ввода несуществующего ID товара

//=добавление в корзину====//

//==удаление из корзины
function delete_from_cart($id){
    if($_SESSION['cart']){
        if(array_key_exists($id, $_SESSION['cart'])){
            $_SESSION['total_quantity'] -= $_SESSION['cart'][$id]['qty'];
            $_SESSION['total_sum'] -= $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
            unset($_SESSION['cart'][$id]);
        }
    }
}
//==удаление из корзины

function eyenow(){
    if($_SERVER['QUERY_STRING']){ //если есть параметры в запросе
        $uri = "";
        foreach($_GET as $key => $value ){
            //формируем строку параметров без номера страницы
            if($key != 'page') $uri .= "{$value}";
        }
        return $uri;
    }
}
//===Постраничная навигация===//
function pagination($page , $pages_count){
    if($_SERVER['QUERY_STRING']){ //если есть параметры в запросе
        foreach($_GET as $key => $value ){
            //формируем строку параметров без номера страницы
            if($key != 'page') $uri .= "{$key}={$value}&amp;";
        }
    }
    //формирование ссылок
    $back = '';
    $forward = '';
    $startpage = '';
    $endpage = '';
    $page2left = '';
    $page1left = '';
    $page2right = '';
    $page1right = '';
    
    if($page > 1){
        $back = "<li class='page-item prev'><a class='page-link' href='?{$uri}page=" . ($page - 1) . "'>&lsaquo;</a></li>";
    }
    if($page < $pages_count){
        $forward = "<li class='page-item next'><a class='page-link' href='?{$uri}page=" . ($page + 1) . "'>&rsaquo;</a></li>";
    }
    if($page > 3){
        $startpage = "<li class='page-item first'><a class='page-link' href='?{$uri}page=1'>&laquo;</a></li>";
    }
    if($page < ($pages_count - 2)){
        $endpage = "<li class='page-item last'><a class='page-link' href='?{$uri}page={$pages_count}'>&raquo;</a></li>";
    }
    if(($page - 2) > 0){
        $page2left = "<li class='page-item'><a class='page-link' href='?{$uri}page=" . ($page - 2) . "'>" . ($page - 2) . "</a></li>";
    }
    if(($page - 1) > 0){
        $page1left = "<li class='page-item'><a class='page-link' href='?{$uri}page=" . ($page - 1) . "'>" . ($page - 1) . "</a></li>";
    }
    if($page + 2 <= $pages_count ){
        $page2right = "<li class='page-item'><a class='page-link' href='?{$uri}page=" . ($page + 2) . "'>" . ($page + 2) . "</a></li>";
    }
    if($page + 1 <= $pages_count ){
        $page1right = "<li class='page-item'><a class='page-link' href='?{$uri}page=" . ($page + 1) . "'>" . ($page + 1) . "</a></li>";
    }
    //формируем вывод навигации
    echo ''.$startpage.$back.$page2left.$page1left.'<li class="page-item"><a class="nav_active">'.$page.'</a></li>'.$page1right.$page2right.$forward.$endpage.'';
}
//===Постраничная навигация===//

function captcha(){
    $i=1;
do
{
$num[$i] = mt_rand(0,9);
echo "<img src='".TEMPLATE."images/captcha/".$num[$i].".png' border='0'>";
$i++;
}
while ($i<5);
$captcha = $num[1].$num[2].$num[3].$num[4];
return $captcha;

}




