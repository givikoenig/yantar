<?php defined('ISHOP') or die('Access denied');

//===фильтрация входящих данных из админки=== //
function clear_admin($var){
    $var = mysqli_real_escape_string($var);
    return $var;
}
//===фильтрация входящих данных из админки=== //

// ======= Каталог  - получение массива //
function catalog(){
     $query = "SELECT * FROM brands"; // ORDER BY parent_id, brand_name";
     $res = mysqli_query($dblink,$query);
     //массив категорий
     $cat = array();
     if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res)) {
            if($row['parent_id'] == '0'){
               $cat[$row['brand_id']][] = $row['brand_name']; 
               $cat[$row['brand_id']][] = $row['img'];
            } elseif($row['sub_sub'] == '0'){
                $cat[$row['parent_id']]['sub'][$row['brand_id']] = $row['brand_name'];
            }
        }
     } 
     return $cat;
}
// ======= Каталог  - получение массива //

// ===имя каталога по его ID =====//
function brandname($brand_id){
    $query = "SELECT brand_name FROM brands
                WHERE brand_id = $brand_id ";
    $res = mysqli_query($dblink,$query);
    
 
    if(mysqli_affected_rows($dblink) > 0 ){
        $row = mysqli_fetch_array($res);
        $brandname = $row[0];
    }    
    return $brandname;
}
function brandimg($brand_id){
    $query = "SELECT img FROM brands
                WHERE brand_id = $brand_id ";
    $res = mysqli_query($dblink,$query);
    
 
    if(mysqli_affected_rows($dblink) > 0 ){
        $row = mysqli_fetch_array($res);
        $brandimg = $row[0];
    }    
    return $brandimg;
}
// ===субменю каталога =====//

// ===субменю каталога =====//
function submenu($sub_parentid){
    $query = "SELECT brand_id, brand_name FROM brands
                WHERE parent_id = $sub_parentid ";
    $res = mysqli_query($dblink,$query);
    
    $submenu = array();
    if(mysqli_affected_rows($dblink) > 0 ){
        while ($row = mysqli_fetch_assoc($res)){
            $submenu[$row['brand_id']][] = $row['brand_name'];
        }
    }    
    return $submenu;
}
// ===субменю каталога =====//

/* ===Страницы=== */
function pages(){
    $query = "SELECT page_id, title, position FROM pages ORDER BY position";
//    $query = "SELECT order_id, customer_id, date FROM orders ORDER BY order_id";
    $res = mysqli_query($dblink,$query);
    
    $pages = array();
    while($row = mysqli_fetch_assoc($res)){
        $pages[] = $row;
    }
    return $pages;
}
/* ===Страницы=== */



//======Отдельнеая страницв==========//
function get_page($page_id){
    $query = "SELECT * FROM pages WHERE page_id = $page_id";
    $res = mysqli_query($dblink,$query);
    
    $page = array();
    $page = mysqli_fetch_assoc($res);
    
    return $page;
}
//======Отдельнеая страницв==========//
//=======Редактирование страницы======//
function edit_page($page_id){
    $title = trim($_POST['title']); //обязательное к заполнению поле
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $position = (int)$_POST['position'];
    $text = trim($_POST['text']);
    
    if(empty($title)){
        $_SESSION['edit_page']['res'] = "<div class='error'>Должно быть название страницы!</div>";
        return false;
    }else{
        $title = clear_admin($title); //обязательное к заполнению поле
        $keywords = clear_admin($keywords);
        $description = clear_admin($description);
        $text = clear_admin($text);
        
        $query = "UPDATE pages SET 
                    title = '$title',
                    keywords = '$keywords',
                    description = '$description',
                    position = '$position',
                    text = '$text'
                    WHERE page_id = $page_id";
        $res = mysqli_query($dblink,$query) or die(mysqli_error());
        
        if(mysqli_affected_rows($dblink) > 0 ){
            $_SESSION['answer'] = "<div class='success'>Страница обновлена!</div>";
            return true;
        }else{
            $_SESSION['edit_page']['res'] = "<div class='error'>На странице ничего не изменено или произошла ошибка редактирования.</div>";
            return false;
        }
    }
}
//=======Редактирование страницы======//
//=======Добавление страницы======//
function add_page() {
    $title = trim($_POST['title']); //обязательное к заполнению поле
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $position = (int)$_POST['position'];
    $text = trim($_POST['text']);
    
    if(empty($title)){
        $_SESSION['add_page']['res'] = "<div class='error'>Должно быть название страницы!</div>";
        $_SESSION['add_page']['keywords'] = $keywords;
        $_SESSION['add_page']['description'] = $description;
        $_SESSION['add_page']['position'] = $position;
        $_SESSION['add_page']['text'] = $text;
        return false;
    }else{
        $title = clear_admin($title); //обязательное к заполнению поле
        $keywords = clear_admin($keywords);
        $description = clear_admin($description);
        $text = clear_admin($text);    
        $query = "INSERT INTO pages (title, keywords, description, position, text)"
                . "VALUES ('$title', '$keywords', '$description', '$position', '$text')";
        $res = mysqli_query($dblink,$query);
        if(mysqli_affected_rows($dblink) > 0 ){
            $_SESSION['answer'] = "<div class='success'>Страница добавлена!</div>";
            return true;
        }else{
            $_SESSION['add_page']['res'] = "<div class='error'>Ошибка при добавлении страницы!</div>";
            return false;
        }
    }
}
//=======Добавление страницы======//
//=======Удаление страницы======//
function del_page($page_id){
    $query = "DELETE FROM pages WHERE page_id = $page_id";
    $res = mysqli_query($dblink,$query);
    
    if(mysqli_affected_rows($dblink) > 0){
        $_SESSION['answer'] = "<div class='success'>Страница удалена.</div>";
        return true;
    }else{
        $_SESSION['answer'] = "<div class='error'>Ошибка удаления!</div>";
        return false;
    }
}
//=======Удаление страницы======//
//=====кол-во новостей=====//
function count_news(){
  $query = "SELECT count(news_id) FROM news";
    $res = mysqli_query($dblink,$query);
    
    $count_news = mysqli_fetch_row($res);
    return $count_news[0];
}
//=====кол-во новостей=====//
//=====архив новостей ======//
function get_all_news($start_pos, $perpage){
    $query = "SELECT news_id, title, anons, data FROM news ORDER BY data DESC LIMIT $start_pos, $perpage";
    $res = mysqli_query($dblink,$query);

    $all_news = array();
    while($row = mysqli_fetch_assoc($res)){
        $all_news[] = $row;
    }
    return $all_news;
}
//=====архив новостей ======//
//=======Добавление новости======//
function add_news(){
    $title = trim($_POST['title']); //обязательное к заполнению поле
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $anons = trim($_POST['anons']);    
    $text = trim($_POST['text']); 
    
    if(empty($title)){
        $_SESSION['add_news']['res'] = "<div class='error'>Должно быть название новости!</div>";
        $_SESSION['add_news']['keywords'] = $keywords;
        $_SESSION['add_news']['description'] = $description;
        $_SESSION['add_news']['anons'] = $anons;
        $_SESSION['add_news']['text'] = $text;
        return false;
    }else{
        $title = clear_admin($title); //обязательное к заполнению поле
        $keywords = clear_admin($keywords);
        $description = clear_admin($description);
        $anons = clear_admin($anons);
        $text = clear_admin($text);
        $data = date("Y-m-d");
        
        $query = "INSERT INTO news (title, keywords, description, data, anons, text)"
            . "VALUES ('$title', '$keywords', '$description', '$data', '$anons', '$text')";
        $res = mysqli_query($dblink,$query);
        if(mysqli_affected_rows($dblink) > 0 ){
            $_SESSION['answer'] = "<div class='success'>Новость добавлена!</div>";
            return true;
        }else{
            $_SESSION['add_news']['res'] = "<div class='error'>Ошибка при добавлении новости!</div>";
            return false;
        }
    }
}
//=======Добавление новости======//
//======Отдельнеая новость==========//
function get_news($news_id){
    $query = "SELECT * FROM news WHERE news_id = $news_id";
    $res = mysqli_query($dblink,$query);
    
    $news = array();
    $news = mysqli_fetch_assoc($res);
    
    return $news;
}
//======Отдельнеая новость==========//
//=======Редактирование новости======//
function edit_news($news_id){
    $title = trim($_POST['title']); //обязательное к заполнению поле
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $data = trim($_POST['data']);
    $anons = trim($_POST['anons']);
    $text = trim($_POST['text']);
    
    if(empty($title)){
        $_SESSION['edit_news']['res'] = "<div class='error'>Должно быть название новости!</div>";
        return false;
    }else{
        $title = clear_admin($title); //обязательное к заполнению поле
        $keywords = clear_admin($keywords);
        $description = clear_admin($description);
        $data = clear_admin($data);
        $anons = clear_admin($anons);
        $text = clear_admin($text);
        
        $query = "UPDATE news SET 
                    title = '$title',
                    keywords = '$keywords',
                    description = '$description',
                    anons = '$anons',
                    text = '$text',
                    data = '$data'    
                    WHERE news_id = $news_id";
        $res = mysqli_query($dblink,$query) or die(mysqli_error());
        
        if(mysqli_affected_rows($dblink) > 0 ){
            $_SESSION['answer'] = "<div class='success'>Новость обновлена!</div>";
            return true;
        }else{
            $_SESSION['edit_news']['res'] = "<div class='error'>В новости ничего не изменено или произошла ошибка редактирования.</div>";
            return false;
        }
    }
}
//=======Редактирование новости======//
//=====Удаление новости+========//
function del_news($news_id){
   $query = "DELETE FROM news WHERE news_id = $news_id";
    $res = mysqli_query($dblink,$query);
    
    if(mysqli_affected_rows($dblink) > 0){
        $_SESSION['answer'] = "<div class='success'>Новость удалена.</div>";
        return true;
    }else{
        $_SESSION['answer'] = "<div class='error'>Ошибка удаления!</div>";
        return false;
    } 
}
//=====Удаление новости+========//
//====информеры - получение массива ====== //
function informer(){
   $query = "SELECT * FROM links
                RIGHT JOIN informers ON
                    links.parent_informer = informers.informer_id
                        ORDER BY informer_position, links_position";
//   exit($query);
   $res = mysqli_query($dblink,$query);
   
   $informers = array();
   $name = ''; // флаг имени информера
   $position = 0;
   $icon = '';
   if(mysqli_affected_rows($dblink) > 0 ){
        while($row = mysqli_fetch_assoc($res)) {
            if ($row['informer_name'] != $name) { // если такого информера в массиве еще нет
                $informers[$row['informer_id']][] = $row['informer_name']; // добавляем информер в массив
                $informers[$row['informer_id']]['position'] = $row['informer_position'];
                $informers[$row['informer_id']]['informer_id'] = $row['informer_id'];
                $informers[$row['informer_id']]['icon'] = $row['icon'];
                $name = $row['informer_name'];
                $position = $row['informer_position'];
                $icon = $row['icon'];
            }
        if($informers[$row['parent_informer']])
        $informers[$row['parent_informer']]['sub'][$row['link_id']] = $row['link_name']; //заносим страницы в информер
           
      }
   }     
   return $informers;
}
//====информеры - получение массива ====== //

//======массив способов доставки======//
function deliveries(){
    $query = "SELECT * FROM dostavka";
//    exit($query);
    $res = mysqli_query($dblink,$query);
    $deliveries = array();
    while($row = mysqli_fetch_assoc($res)){
        $deliveries[] = $row;
    }
    return $deliveries;
}
//======массив способов доставки======//
//====добавление способа доставки======//
function add_delivery(){
    $name = trim($_POST['name']); //обязательное к заполнению поле
    if(empty($name)){
        $_SESSION['add_delivery']['res'] = "<div class='error'>Должно быть название способа доставки!</div>";
        return false;
    }else{
        $name = clear_admin($name); //обязательное к заполнению поле
        
        $query = "INSERT INTO dostavka (name) VALUES ('{$name}')";
        $res = mysqli_query($dblink,$query);
        if(mysqli_affected_rows($dblink) > 0){
            $_SESSION['answer'] = "<div class='success'>Способ доставки добавлен!</div>";
            return true;
        }else{
            $_SESSION['add_delivery']['res'] = "<div class='error'>Ошибка при добавлении способа доставки !</div>";
            return false;
        }
    }    
    
}
//====добавление способа доставки======//
//======Отдельный способ доставки==========//
function get_dostavka($meth_id){
    $query = "SELECT * FROM dostavka WHERE dostavka_id = $meth_id";
    $res = mysqli_query($dblink,$query);
    
    $dostavka = array();
    $dostavka = mysqli_fetch_assoc($res);
    
    return $dostavka;
}
//======Отдельный способ доставки==========//
//=======редактирование способа доставки======//
function edit_delivery($meth_id){
    $name = trim($_POST['name']); //обязательное к заполнению поле
    if(empty($name)){
        $_SESSION['edit_delivery']['res'] = "<div class='error'>Должно быть название способа доставки!</div>";
        return false;
    }else{
        $name = clear_admin($name);
        $query = "UPDATE dostavka SET name = '$name' WHERE dostavka_id = $meth_id";
        $res = mysqli_query($dblink,$query);
        if(mysqli_affected_rows($dblink) > 0){
            $_SESSION['answer'] = "<div class='success'>Способ доставки обновлен.</div>";
            return true;
        }else{
            $_SESSION['edit_delivery']['res'] = "<div class='error'>Ничего не изменилось, или ошибка при редактировании способа доставки!</div>";
            return false;
        }
    }
}
//=======редактирование способа доставки======//
//=====Удаление способа доставки+========//
function del_delivery($meth_id){
   $query = "DELETE FROM dostavka WHERE dostavka_id = $meth_id";
    $res = mysqli_query($dblink,$query);
    
    if(mysqli_affected_rows($dblink) > 0){
        $_SESSION['answer'] = "<div class='success'>Способ доставки удален.</div>";
        return true;
    }else{
        $_SESSION['answer'] = "<div class='error'>Ошибка удаления!</div>";
        return false;
    } 
}
//=====Удаление новости+========//
//===массив информеров для выпад.списка====//
function get_informers(){
    $query = "SELECT * FROM informers";
    $res = mysqli_query($dblink,$query);
    
    $informers = array();
    while($row = mysqli_fetch_assoc($res)){
        $informers[] = $row;
    }
    
    return $informers;
}
//===массив информеров для выпад.списка====//
//======добавление страницы информера=======//
function add_link(){
    $link_name = trim($_POST['link_name']); //обязательное к заполнению поле
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $parent_informer = (int)($_POST['parent_informer']);
    $links_position = (int)($_POST['links_position']);
    $text = trim($_POST['text']);
    
    if(empty($link_name)){
        $_SESSION['add_link']['res'] = "<div class='error'>Должно быть название информера!</div>";
        $_SESSION['add_link']['keywords'] = $keywords;
        $_SESSION['add_link']['description'] = $description;
        $_SESSION['add_link']['parent_informer'] = $parent_informer;
        $_SESSION['add_link']['links_position'] = $links_position;
        $_SESSION['add_link']['text'] = $text;
        return false;
    }else{
        $link_name = clear_admin($link_name); //обязательное к заполнению поле
        $keywords = clear_admin($keywords);
        $description = clear_admin($description);
        $text = clear_admin($text);
        
        $query = "INSERT INTO links (link_name, keywords, description, parent_informer, links_position, text)"
                . "VALUES ('$link_name', '$keywords', '$description', '$parent_informer', '$links_position', '$text')";
        $res = mysqli_query($dblink,$query) or die(mysqli_error());
        if(mysqli_affected_rows($dblink) > 0 ){
            $_SESSION['answer'] = "<div class='success'>Страница информера добавлена!</div>";
            return true;
        }else{
            $_SESSION['add_link']['res'] = "<div class='error'>Ошибка при добавлении страницы !</div>";
            return false;
        }
    }
}
//======добавление страницы информера=======//
/* ===Получение текста информера=== */
function get_text_informer($informer_id){
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
//====получение данных страницы информера======//
function get_link($link_id){
    $query = "SELECT * FROM links WHERE link_id = $link_id";
    $res = mysqli_query($dblink,$query);
    
    $link = array();
    $link = mysqli_fetch_assoc($res);
    return $link;
}
//====получение данных страницы информера======//
/* ===Редактирование страницы информера=== */
function edit_link($link_id){
    $link_name = trim($_POST['link_name']);
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $parent_informer = (int)$_POST['parent_informer'];
    $links_position = (int)$_POST['links_position'];
    $text = trim($_POST['text']);

    if(empty($link_name)){
        // если нет названия
        $_SESSION['edit_link']['res'] = "<div class='error'>Должно быть название страницы!</div>";
        return false;
    }else{
        $link_name = clear_admin($link_name);
        $keywords = clear_admin($keywords);
        $description = clear_admin($description);
        $text = clear_admin($text);

        $query = "UPDATE links SET
                    link_name = '$link_name',
                    keywords = '$keywords',
                    description = '$description',
                    parent_informer = $parent_informer,
                    links_position = $links_position,
                    text = '$text'
                        WHERE link_id = $link_id";
        $res = mysqli_query($dblink,$query) or die(mysqli_error());
        if(mysqli_affected_rows($dblink) > 0){
            $_SESSION['answer'] = "<div class='success'>Страница информера обновлена!</div>";
            return true;
        }else{
            $_SESSION['edit_link']['res'] = "<div class='error'>Ошибка при редактировании страницы!</div>";
            return false;
        }
    }
}
/* ===Редактирование страницы информера=== */
//=======удаление страницы информера=======//
function del_link($link_id){
    $query = "DELETE FROM links WHERE link_id = $link_id";
    $res = mysqli_query($dblink,$query);
    if(mysqli_affected_rows($dblink) > 0){
            $_SESSION['answer'] = "<div class='success'>Страница информера удалена!</div>";
        }else{
            $_SESSION['answer']['res'] = "<div class='error'>Ошибка!</div>";
        }
    
}
//=======удаление страницы информера=======//
//=======добавление информера============//
function add_informer(){
    $informer_name = clear_admin(trim($_POST['informer_name']));
    $icon = trim($_POST['icon']);
    $informer_position = (int)$_POST['informer_position'];
    
    if(empty($informer_name)){
        $_SESSION['add_informer']['res'] = "<div class='error'>У информера должно быть название.</div>";
        return false;
    }else{
        $query = "INSERT INTO informers (informer_name, informer_position, icon)"
                . "VALUES ('$informer_name', '$informer_position', '$icon')";
        $res = mysqli_query($dblink,$query);
        if(mysqli_affected_rows($dblink) > 0){
            $_SESSION['answer'] = "<div class='success'>Информер добавлен.</div>";
            return true;
        }else{
            $_SESSION['add_informer']['res'] = "<div class='error'>Ошибка при добавлении информера!</div>";
            return false;
        }
    }
}
//=======добавление информера============//
//=======удаление информера===========//
function del_informer($informer_id){
    //удаляем страницы информера
    mysqli_query($dblink,"DELETE FROM links WHERE parent_informer = $informer_id");
    
    //удаляем информер
    $query = "DELETE FROM informers WHERE informer_id = $informer_id";
    $res = mysqli_query($dblink,$query);
    if(mysqli_affected_rows($dblink) > 0){
       $_SESSION['answer'] = "<div class='success'>Информер удален.</div>";
    }else{
       $_SESSION['answer'] = "<div class='error'>Ошибка!</div>";
    }
}
//=======удаление информера===========//
//========получение данных информера=====//
function get_informer($informer_id){
    $query = "SELECT * FROM informers WHERE informer_id = $informer_id";
    $res = mysqli_query($dblink,$query);
    
    $informers = array();
    $informers = mysqli_fetch_assoc($res);
    return $informers;
}
//========получение данных информера=====//
//======редактирование информера=========//
function edit_informer($informer_id){
    $informer_name = clear_admin(trim($_POST['informer_name']));
    $icon = trim($_POST['icon']);
    $informer_position = (int)$_POST['informer_position'];
    if(empty($informer_name)){
        $_SESSION['edit_informer']['res'] = "<div class='error'>У информера должно быть название.</div>";
        return false;
    }else{
        $query = "UPDATE informers  SET informer_name = '$informer_name', informer_position = '$informer_position', icon = '$icon'"
                . "WHERE informer_id = $informer_id";
        $res = mysqli_query($dblink,$query);
        if(mysqli_affected_rows($dblink) > 0){
            $_SESSION['answer'] = "<div class='success'>Информер обновлен.</div>";
            return true;
        }else{
            $_SESSION['edit_informer']['res'] = "<div class='error'>Ошибка обновления информера!</div>";
            return false;
        }
    }
}
//======редактирование информера=========//
//======замена картикнки категории=======//
function edit_brand_image($id){
    $brand_name = clear_admin(trim($_POST['brand_name']));
    
    if($brand_name){
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
        if ($_FILES['brandimg']['name']) {
//                $baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['brandimg']['name'])); // расширение картинки
                $baseimgExt = strtolower(preg_replace_callback(
                        '#.+\.([a-z]+)$#i',
                        create_function('$matches',
                            'return $matches[1]'
                        ),
                        $_FILES['brandimg']['name'])
                );
                $baseimgName = "b_{$id}.{$baseimgExt}"; // новое имя картинки
                $baseimgTmpName = $_FILES['brandimg']['tmp_name']; // временное имя файла
                $baseimgSize = $_FILES['brandimg']['size']; // вес файла
                $baseimgType = $_FILES['brandimg']['type']; // тип файла
                $baseimgError = $_FILES['brandimg']['error']; // 0 - OK, иначе - ошибка
                $error = "";

                if (!in_array($baseimgType, $types))
                    $error .= "Допустимые расширения - .gif, .jpg, .png <br />";
                if ($baseimgSize > SIZE)
                    $error .= "Максимальный вес файла - 1 Мб";
                if ($baseimgError)
                    $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";

                if (!empty($error))
                    $_SESSION['answer'] = "<div class='error'>Ошибка при загрузке картинки товара! <br /> {$error}</div>";
                // если нет ошибок
                if (empty($berror)) {
                    if (@move_uploaded_file($baseimgTmpName, "../userfiles/product_img/tmp/$baseimgName")) {
                        resize("../userfiles/product_img/tmp/$baseimgName", "../userfiles/product_img/baseimg/$baseimgName", 190, 190, $baseimgExt);
                        @unlink("../userfiles/product_img/tmp/$baseimgName");
                        mysqli_query($dblink,"UPDATE brands SET img = '$baseimgName' WHERE brand_id = $id");
                    } else {
                        $_SESSION['answer'] .= "<div class='error'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге /userfiles/product_img/</div>";
                    }
                }
                /* базовая картинка */
            $_SESSION['answer'] .= "<div class='success'>Картинка загружена.</div>";
            return true;
            } else {
                 $_SESSION['edit_brand_image']['res'] = "<div class='error'>Ошибка загрузки</div>";
            }
            
        
    }else{
        $_SESSION['edit_brand_image']['res'] = "<div class='error'>Есть имя, ID категории - $brand_name -  $brand_id </div>";
        return false;
    }


   
   
    
    
}
//======замена картикнки категории=======//
//=======добавление категории=========//
function add_brand() {
    $brand_name = clear_admin(trim($_POST['brand_name']));
    $parent_id = (int) $_POST['parent_id'];
    if (empty($brand_name)) {
        $_SESSION['add_brand']['res'] = "<div class='error'>Не указано название категории.</div>";
        return false;
    } else {
        //проверяем, нет ли такой категории на одном уровне одного раздела
        $query = "SELECT brand_id FROM brands WHERE brand_name = '$brand_name' AND parent_id = $parent_id";
        $res = mysqli_query($dblink,$query);
        if (mysqli_num_rows($res) > 0) {
            $_SESSION['add_brand']['res'] = "<div class='error'>Категория с таким названием уже существует</div>";
            return false;
        } else {
            //проверяем, есть ли у нас бабушка
            $qry = "SELECT parent_id FROM brands WHERE brand_id = $parent_id";
            $result = mysqli_query($dblink,$qry);
            $row1 = mysqli_fetch_row($result);
            $gr_mom = $row1[0];
            if ($gr_mom > 0) {
                $has_child = '1';
            } else {
                $has_child = '0';
            }
            mysqli_query($dblink,"UPDATE brands SET has_child = '$has_child' WHERE brand_id = $parent_id");
        }
        $query = "INSERT INTO brands (brand_name, parent_id, sub_sub)"
                . "VALUES ('$brand_name', $parent_id, '$has_child')";
        $res = mysqli_query($dblink,$query);
        if (mysqli_affected_rows($dblink) > 0) {
            $id = mysqli_insert_id(); // ID сохраненного товара
            $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
            /* базовая картинка */
            if ($_FILES['brandimg']['name']) {
//                $baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['brandimg']['name'])); // расширение картинки
                $baseimgExt = strtolower(preg_replace_callback(
                        '#.+\.([a-z]+)$#i',
                        create_function('$matches',
                            'return $matches[1]'
                        ),
                        $_FILES['brandimg']['name'])
                ); 
                $baseimgName = "b_{$id}.{$baseimgExt}"; // новое имя картинки
                $baseimgTmpName = $_FILES['brandimg']['tmp_name']; // временное имя файла
                $baseimgSize = $_FILES['brandimg']['size']; // вес файла
                $baseimgType = $_FILES['brandimg']['type']; // тип файла
                $baseimgError = $_FILES['brandimg']['error']; // 0 - OK, иначе - ошибка
                $error = "";

                if (!in_array($baseimgType, $types))
                    $error .= "Допустимые расширения - .gif, .jpg, .png <br />";
                if ($baseimgSize > SIZE)
                    $error .= "Максимальный вес файла - 1 Мб";
                if ($baseimgError)
                    $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";

                if (!empty($error))
                    $_SESSION['answer'] = "<div class='error'>Ошибка при загрузке картинки товара! <br /> {$error}</div>";
                // если нет ошибок
                if (empty($berror)) {
                    if (@move_uploaded_file($baseimgTmpName, "../userfiles/product_img/tmp/$baseimgName")) {
                        resize("../userfiles/product_img/tmp/$baseimgName", "../userfiles/product_img/baseimg/$baseimgName", 190, 190, $baseimgExt);
                        @unlink("../userfiles/product_img/tmp/$baseimgName");
                        mysqli_query($dblink,"UPDATE brands SET img = '$baseimgName' WHERE brand_id = $id");
                    } else {
                        $_SESSION['answer'] .= "<div class='error'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге /userfiles/product_img/</div>";
                    }
                }
            }
            /* базовая картинка */
            $_SESSION['answer'] .= "<div class='success'>Категория добавлена.</div>";
            return true;
        } else {
            $_SESSION['add_brand']['res'] = "<div class='error'>Ошибка при добавлении категории!</div>";
            return false;
        }
    }
}
//=======добавление категории=========//
//=======редактирование категории========//
function edit_brand($brand_id){
    $brand_name = clear_admin(trim($_POST['brand_name']));
    $parent_id = (int)$_POST['parent_id'];
    
    if(empty($brand_name)){
        $_SESSION['edit_brand']['res'] = "<div class='error'>Не указано название категории.</div>";
        return false;
    }else{
        //проверяем, нет ли одноименной категории
            $query0 = "SELECT brand_id FROM brands WHERE brand_name = '$brand_name' AND parent_id = $parent_id";
            $res0 = mysqli_query($dblink,$query0);
        if(mysqli_num_rows($res0) > 0){
           $_SESSION['edit_brand']['res'] = "<div class='error'>Категория с таким названием уже существует</div>";
            return false; 
        }else{
            //проверяем, есть ли у нас бабушка
            $qry = "SELECT parent_id FROM brands WHERE brand_id = $parent_id";
            $reslt = mysqli_query($dblink,$qry);
            $row1 = mysqli_fetch_row($reslt);
            $gr_mom = $row1[0];
            ($gr_mom > 0) ? ($has_child = '1') : ($has_child = '0');
            mysqli_query($dblink,"UPDATE brands SET has_child = '$has_child' WHERE brand_id = $parent_id"); 
        }
        $query = "UPDATE brands SET brand_name = '$brand_name', parent_id = $parent_id, sub_sub = '$has_child' WHERE brand_id = $brand_id";
        $res = mysqli_query($dblink,$query);
        if(mysqli_affected_rows($dblink) > 0){
           mysqli_query($dblink,"UPDATE brands SET has_child = '0' WHERE parent_id = '0'"); 
           $_SESSION['answer'] .= "<div class='success'>Категория обновлена.</div>";
            return true;
        }else{
           $_SESSION['edit_brand']['res'] = "<div class='error'>Ошибка при редактировании категории!</div>";
           return false;
        }
    }
}
//=======редактирование категории========//
//========удаление категории============//
function del_brand($brand_id){
    $query = "SELECT count(*) FROM brands WHERE parent_id = $brand_id";
    $res = mysqli_query($dblink,$query);
    $row = mysqli_fetch_row($res);
    if($row[0]){
       $_SESSION['answer'] = "<div class='error'>Категория имеет подкатегории. Сначала удалите или переместите их в другие родительские категории</div>"; 
    }else{
        mysqli_query($dblink,"DELETE FROM goods WHERE goods_brandid = $brand_id"); //сначала уцдаляем товары категории
        mysqli_query($dblink,"DELETE FROM brands WHERE brand_id = $brand_id");
        $_SESSION['answer'] = "<div class='success'>Категория удалена.</div>";
    }
}
//========удаление категории============//
//получение кол-ва товаров для pagination
function count_rows($category){
    $query = "(SELECT COUNT(goods_id) as count_rows
                 FROM goods
                    WHERE goods_brandid = $category)
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
                )
                )";
    $res = mysqli_query($dblink,$query);
    
    while($row = mysqli_fetch_assoc($res)){
        if($row['count_rows']) $count_rows = $row['count_rows'];
    }
    return $count_rows;
}

function eye_count_rows($eye){
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
//===получение названий для хлебных крошек===//
function brand_name($category){
    $query = "(SELECT brand_id, brand_name, parent_id, has_child, sub_sub FROM brands
                WHERE brand_id = (SELECT parent_id FROM brands WHERE brand_id = $category)
                )
                UNION
                (SELECT brand_id, brand_name, parent_id, has_child, sub_sub FROM brands WHERE brand_id = $category)";
    $res = mysqli_query($dblink,$query);
    $brand_name = array();
    while($row = mysqli_fetch_assoc($res)){
        $brand_name[] = $row;
    }
    return $brand_name;
}
//===получение названий для хлебных крошек===//
//получение массива товаров по категории  //
function products($category, $start_pos, $perpage){
    $query = "(SELECT goods_id, name, articul, img, price, old_price, date, visible, available
                 FROM goods
                    WHERE goods_brandid = $category)
                UNION        
               (SELECT goods_id, name, articul, img, price, old_price, date, visible, available
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
                )
              ) LIMIT $start_pos, $perpage";
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
//=============добавление товара====================//
function add_product(){
    date_default_timezone_set("ETC/GMT-3");
    $name = trim($_POST['name']);
//    $price = round(floatval(preg_replace("#,#", ".", $_POST['price'])),2);
    $price = round(floatval(
                        preg_replace_callback(
                        '#,#',
                         '.',
                        $_POST['price'])
            ),2);
    
    
//    $baseimgExt = strtolower(preg_replace_callback(
//                        "#.+\.([a-z]+)$#i",
//                        create_function('$matches',
//                            'return $matches[1]'
//                        ),
//                        $_FILES['brandimg']['name']));
    
//    $old_price = round(floatval(preg_replace("#,#", ".", $_POST['old_price'])),2);
    $old_price = round(floatval(
                        preg_replace_callback(
                        '#,#',
                         '.',
                        $_POST['old_price'])
            ),2);
    
    $articul = trim($_POST['articul']);
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $goods_brandid = (int)$_POST['category'];
    $anons = trim($_POST['anons']);
    $content = trim($_POST['content']);
    $new = (int)$_POST['new'];
    $hits = (int)$_POST['hits'];
    $sale = (int)$_POST['sale'];
    $visible = (int)$_POST['visible'];
    $available = (int)$_POST['available'];
    $date = date("Y-m-d");
    
    if(empty($name)){
        $_SESSION['add_product']['res'] = "<div class='error'>У товара должно быть название!</div>";
        $_SESSION['add_product']['price'] = $price;
        $_SESSION['add_product']['old_price'] = $old_price;
        $_SESSION['articul']['articul'] = $articul;
        $_SESSION['add_product']['keywords'] = $keywords;
        $_SESSION['add_product']['description'] = $description;
        $_SESSION['add_product']['anons'] = $anons;
        $_SESSION['add_product']['content'] = $content;
        return false;
    }else{
         $name = clear_admin($name);
         $articul = clear_admin($articul);
         $keywords = clear_admin($keywords);
         $description = clear_admin($description);
         $anons = clear_admin($anons);
         $content = clear_admin($content);
         
         $query = "INSERT INTO goods (name, keywords, description, goods_brandid, anons, content, hits, new, sale,"
                 . " price, old_price, articul, date, visible, available)"
                 . "VALUES ('$name', '$keywords', '$description', $goods_brandid, '$anons', '$content',"
                 . " '$hits', '$new', '$sale', $price, $old_price, '$articul', '$date', '$visible', '$available')";
         $res = mysqli_query($dblink,$query) or die(mysqli_error());
         
         if(mysqli_affected_rows($dblink) > 0){
            $id = mysqli_insert_id(); // ID сохраненного товара
            $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
            /* базовая картинка */
            if($_FILES['baseimg']['name']){
//                $baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['baseimg']['name'])); // расширение картинки
                $baseimgExt = strtolower(preg_replace_callback(
                        '#.+\.([a-z]+)$#i',
                        create_function('$matches',
                            'return $matches[1]'
                        ),
                        $_FILES['brandimg']['name']));
                $baseimgName = "{$id}.{$baseimgExt}"; // новое имя картинки
                $baseimgTmpName = $_FILES['baseimg']['tmp_name']; // временное имя файла
                $baseimgSize = $_FILES['baseimg']['size']; // вес файла
                $baseimgType = $_FILES['baseimg']['type']; // тип файла
                $baseimgError = $_FILES['baseimg']['error']; // 0 - OK, иначе - ошибка
                $error = "";

                if(!in_array($baseimgType, $types)) $error .= "Допустимые расширения - .gif, .jpg, .png <br />";
                if($baseimgSize > SIZE) $error .= "Максимальный вес файла - 1 Мб";
                if($baseimgError) $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";

                if(!empty($error)) $_SESSION['answer'] = "<div class='error'>Ошибка при загрузке картинки товара! <br /> {$error}</div>";

                // если нет ошибок
                if(empty($error)){
                    if(@move_uploaded_file($baseimgTmpName, "../userfiles/product_img/tmp/$baseimgName")){
                        resize("../userfiles/product_img/tmp/$baseimgName", "../userfiles/product_img/baseimg/$baseimgName", 180, 180, $baseimgExt);
                        @unlink("../userfiles/product_img/tmp/$baseimgName");
                        mysqli_query($dblink,"UPDATE goods SET img = '$baseimgName' WHERE goods_id = $id");
                    }else{
                        $_SESSION['answer'] .= "<div class='error'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге /userfiles/product_img/</div>";
                    }
                }
            }
            /* базовая картинка */
            //==картинки галереи==//
               if($_FILES['galleryimg']['name'][0]){
                   for($i=0; $i < count($_FILES['galleryimg']['name']); $i++){
                       $error = "";
                       if($_FILES['galleryimg']['name'][$i]){
                           //если есть файл
//                         //  $galleryimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['galleryimg']['name'][$i])); // расширение картинки
                           $baseimgExt = strtolower(preg_replace_callback(
                        '#.+\.([a-z]+)$#i',
                        create_function('$matches',
                            'return $matches[1]'
                        ),
                        $_FILES['galleryimg']['name']));
                            $galleryimgName = "{$id}_{$i}.{$galleryimgExt}"; // новое имя картинки
                            $galleryimgTmpName = $_FILES['galleryimg']['tmp_name'][$i]; // временное имя файла
                            $galleryimgSize = $_FILES['galleryimg']['size'][$i]; // вес файла
                            $galleryimgType = $_FILES['galleryimg']['type'][$i]; // тип файла
                            $galleryimgError = $_FILES['galleryimg']['error'][$i]; // 0 - OK, иначе - ошибка
                            
                            if(!in_array($galleryimgType, $types)){
                                $error .= "Допустимые расширения - .gif, .jpg, .png <br />";
                                $_SESSION['answer'] .= "<div class='error'>Ошибка при загрузке картинки {$_FILES['galleryimg']['name'][$i]} <br /> {$error}</div>";
                                continue;
                            }
                            
                            if($galleryimgSize > SIZE){
                                $error .= "Максимальный вес файла - 1 Мб";
                                $_SESSION['answer'] .= "<div class='error'>Ошибка при загрузке картинки {$_FILES['galleryimg']['name'][$i]} <br /> {$error}</div>";
                                continue;
                            }
                            
                            if($galleryimgError){
                                $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";
                                $_SESSION['answer'] .= "<div class='error'>Ошибка при загрузке картинки {$_FILES['galleryimg']['name'][$i]} <br /> {$error}</div>";
                                continue;
                            }
                            
                            //если нет ошибок
                            if(empty($error)){
                                if(@move_uploaded_file($galleryimgTmpName, "../userfiles/product_img/photos/$galleryimgName")){
                                    resize("../userfiles/product_img/photos/$galleryimgName", "../userfiles/product_img/thumbs/$galleryimgName", 45, 45, $galleryimgExt);
                                    if(!isset($galleryfiles)){
                                        $galleryfiles = $galleryimgName;
                                    }else{
                                        $galleryfiles .= "|{$galleryimgName}";
                                    }
                                }else{
                                    $_SESSION['answer'] .= "<div class='error'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге /userfiles/product_img/</div>";
                                }
                            }
                       }
                   }
                   if(isset($galleryfiles)){
                       mysqli_query($dblink,"UPDATE goods SET img_slide = '$galleryfiles' WHERE goods_id = $id");
                   }
               }
             ////////////////////
             $_SESSION['answer'] .= "<div class='success'>Товар добавлен</div>";
             return true;    
         }else{
            $_SESSION['add_product']['res'] = "<div class='error'>Ошибка при добавлении товара!</div>";
            return false;
         }
     }
}
//=============добавление товара====================//
//===получение данных товара====//
function get_product($goods_id){
    $query = "SELECT * FROM goods WHERE goods_id = $goods_id";
    $res = mysqli_query($dblink,$query);
    
    $product = array();
    $product = mysqli_fetch_assoc($res);
    return $product;
}
//===получение данных товара====//
//======редактирование товара======//
function edit_product($id){
    $name = trim($_POST['name']);
//    $price = round(floatval(preg_replace("#,#", ".", $_POST['price'])),2);
    $price = round(floatval(
                        preg_replace_callback(
                        '#,#',
                         '.',
                        $_POST['price'])
            ),2);
//    $old_price = round(floatval(preg_replace("#,#", ".", $_POST['old_price'])),2);
    $old_price = round(floatval(
                        preg_replace_callback(
                        '#,#',
                         '.',
                        $_POST['old_price'])
            ),2);
    $articul = trim($_POST['articul']);
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $goods_brandid = (int)$_POST['category'];
    $anons = trim($_POST['anons']);
    $content = trim($_POST['content']);
    $new = (int)$_POST['new'];
    $hits = (int)$_POST['hits'];
    $sale = (int)$_POST['sale'];
    $visible = (int)$_POST['visible'];
    $available = (int)$_POST['available'];
    
    if(empty($name)){
        $_SESSION['edit_product']['res'] = "<div class='error'>У товара должно быть название!</div>";
        return false;
    }else{
         $name = clear_admin($name);
         $articul = clear_admin($articul);
         $keywords = clear_admin($keywords);
         $description = clear_admin($description);
         $anons = clear_admin($anons);
         $content = clear_admin($content);
         
         $query = "UPDATE goods SET "
                 . "name = '$name',"
                 . "keywords = '$keywords',"
                 . "description = '$description',"
                 . "goods_brandid = $goods_brandid,"
                 . "anons = '$anons',"
                 . "content = '$content',"
                 . "hits = '$hits',"
                 . "new = '$new',"
                 . "sale = '$sale',"
                 . "price = $price,"
                 . "old_price = $old_price,"
                 . "articul = '$articul',"
                 . "visible = '$visible',"
                 . "available = '$available'"
                 . "WHERE goods_id = $id";
         $res = mysqli_query($dblink,$query) or die(mysqli_error());
         //=====базовая картинка=======//
         $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
         if($_FILES['baseimg']['name']){
//             $baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['baseimg']['name'])); // расширение картинки
             $baseimgExt = strtolower(preg_replace_callback(
                        "#.+\.([a-z]+)$#i",
                        create_function('$matches',
                            'return $matches[1]'
                        ),
                        $_FILES['brandimg']['name']));
             $baseimgName = "{$id}.{$baseimgExt}"; // новое имя картинки
             $baseimgTmpName = $_FILES['baseimg']['tmp_name']; // временное имя файла
             $baseimgSize = $_FILES['baseimg']['size']; // вес файла
             $baseimgType = $_FILES['baseimg']['type']; // тип файла
             $baseimgError = $_FILES['baseimg']['error']; // 0 - OK, иначе - ошибка
             
             $error = "";
             if(!in_array($baseimgType, $types)) $error .= "Допустимые расширения - .gif, .jpg, .png <br />";
             if($baseimgSize > SIZE) $error .= "Максимальный вес файла - 1 Мб";
             if($baseimgError) $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";
             
             if(!empty($error)) $_SESSION['answer'] = "<div class='error'>Ошибка при загрузке картинки товара! <br /> {$error}</div>";
             
             // если нет ошибок
             if(empty($error)){
                if(@move_uploaded_file($baseimgTmpName, "../userfiles/product_img/tmp/$baseimgName")){
                   resize("../userfiles/product_img/tmp/$baseimgName", "../userfiles/product_img/baseimg/$baseimgName", 180, 180, $baseimgExt);
                   @unlink("../userfiles/product_img/tmp/$baseimgName");
                   mysqli_query($dblink,"UPDATE goods SET img = '$baseimgName' WHERE goods_id = $id");
                }else{
                   $_SESSION['answer'] .= "<div class='error'>Не удалось переместить загруженную картинку. Проверьте права на папки в каталоге /userfiles/product_img/</div>";
                }
             }
         }
         //=====базовая картинка=======//
         $_SESSION['answer'] .= "<div class='success'>Товар обновлен</div>";
         return true;
    }
}
//======редактирование товара======//
//======удаление товара===========//
function del_product($goods_id){
    $query = "DELETE FROM goods WHERE goods_id = $goods_id";
    $res = mysqli_query($dblink,$query);
    
    if(mysqli_affected_rows($dblink) > 0){
        $_SESSION['answer'] = "<div class='success'>Товар удален.</div>";
        return true;
    }else{
        $_SESSION['answer'] = "<div class='error'>Ошибка удаления!</div>";
        return false;
    }
}
//======удаление товара===========//
//==AjaxUpload -- загрузка картинок галереи==//
function upload_gallery_img($id){
    $uploaddir = '../userfiles/product_img/photos/';
    $file = $_FILES['userfile']['name'];
//    $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $file));
    
    $ext = strtolower(preg_replace_callback(
                        '#.+\.([a-z]+)$#i',
                        create_function('$matches',
                            'return $matches[1]'
                        ),
                        $file)
            );
    $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
    
    if($_FILES['userfile']['size'] > SIZE){
        $res = array("answer" => "Ошибка! Максимальный вес файла 1 мб!");
        exit(json_encode($res));
    }
    if($_FILES['userfile']['error']){
        $res = array("answer" => "Ошибка! Возможно файл слишком большой!");
        exit(json_encode($res));
    }
    if(!in_array($_FILES['userfile']['type'], $types)){
        $res = array("answer" => "Допустимые расширения - .gif, .jpg, .png");
    }
    
    $query = "SELECT img_slide FROM goods WHERE goods_id = $id";
    $res = mysqli_query($dblink,$query);
    $row = mysqli_fetch_assoc($res);
    if($row['img_slide']){
        // если есть картинки в галерее
        if (preg_match("/|/", $row['img_slide'])) {
            $images = explode("|", $row['img_slide']);
        }else{
            $images = $row['img_slide'];
        }
        $lastimg = end($images);
        // получаем номер последней картинки
//        $lastnum = preg_replace("#\d+_(\d+)\.\w+#", "$1", $lastimg); // 1_1.ext
        $lastnum = strtolower(preg_replace_callback(
                        '#\d+_(\d+)\.\w+#',
                        create_function('$matches',
                            'return $matches[1]'
                        ),
                        $lastimg)
            );
        
        $lastnum += 1;
        $newimg = "{$id}_{$lastnum}.{$ext}"; // имя новой картинки
        $images = "{$row['img_slide']}|{$newimg}"; // строка для записи в БД
    }else{
        $newimg = "{$id}_1.{$ext}"; // имя новой картинки
        $images = $newimg; // строка для записи в БД
    }

    
    $uploadfile = $uploaddir.$newimg;
    if(@move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
       resize($uploadfile, "../userfiles/product_img/thumbs/$newimg", 45, 45, $ext);
       mysqli_query($dblink,"UPDATE goods SET img_slide = '$images' WHERE goods_id = $id");
       $res = array("answer" => "OK", "file" => $newimg);
        exit(json_encode($res));
    }
}
//==AjaxUpload -- загрузка картинок галереи==//
//======удаление картинок=========//
function del_img(){
    $goods_id = (int)$_POST['goods_id'];
    $img = clear_admin($_POST['img']);
    $rel = (int)$_POST['rel'];
    
    if(!$rel){
        //если удаляется базовая картинка
        $query = "UPDATE goods SET img = 'no_image.jpg' WHERE goods_id = $goods_id";
        mysqli_query($dblink,$query);
        if(mysqli_affected_rows($dblink) > 0){
            return '<input type="file" name="baseimg" />';
        }else{
            return false;
        }
    }else{
        //если удаляется картинка галереи
        $query = "SELECT img_slide FROM goods WHERE goods_id = $goods_id";
        $res = mysqli_query($dblink,$query);
        $row = mysqli_fetch_assoc($res);
        //получаем картинки в массив
        if (preg_match("/|/", $row['img_slide'])){
            $images = explode("|", $row['img_slide']);
        }else{
            $images = $row['img_slide'];
        }
        foreach($images as $item){
            //пропускаем удаляемую картинку
            if($item == $img) continue;
            //формируем строку с картинками
            if(!isset($galleryfiles)){
               $galleryfiles = $item;
            }else{
               $galleryfiles .= "|{$item}";
            }
        }
        mysqli_query($dblink,"UPDATE goods SET img_slide = '$galleryfiles' WHERE goods_id = $goods_id");
        if(mysqli_affected_rows($dblink) > 0){
            return true;
        }else{
            return false;
        }
    }
}
//======удаление картинок=========//
/* ===Ресайз картинок=== */
function resize($target, $dest, $wmax, $hmax, $ext){
    /*
    $target - путь к оригинальному файлу
    $dest - путь сохранения обработанного файла
    $wmax - максимальная ширина
    $hmax - максимальная высота
    $ext - расширение файла
    */
    list($w_orig, $h_orig) = getimagesize($target);
    $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная

    if(($wmax / $hmax) > $ratio){
        $wmax = $hmax * $ratio;
    }else{
        $hmax = $wmax / $ratio;
    }

    $img = "";
    // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
    switch($ext){
        case("gif"):
            $img = imagecreatefromgif($target);
            break;
        case("png"):
            $img = imagecreatefrompng($target);
            break;
        default:
            $img = imagecreatefromjpeg($target);
    }
    $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

    if($ext == "png"){
        imagesavealpha($newImg, true); // сохранение альфа канала
        $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
        imagefill($newImg, 0, 0, $transPng); // заливка
    }

    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
    switch($ext){
        case("gif"):
            imagegif($newImg, $dest);
            break;
        case("png"):
            imagepng($newImg, $dest);
            break;
        default:
            imagejpeg($newImg, $dest);
    }
    imagedestroy($newImg);
}
/* ===Ресайз картинок=== */
/* ===Подсвечивание активного пункта меню=== */
function active_url($str = 'view=pages'){
    $uri = $_SERVER['QUERY_STRING']; // получаем параметры
    if(!$uri) $uri = "view=pages"; // параметр по умолчанию
    $uri = explode("&", $uri); // разбиваем строку по разделителю
    if(preg_match("#page=#", end($uri))) array_pop($uri); // если есть параметр пагинации (page) - удаляем его
    if(in_array($str, $uri)){
        // если в массиве параметров есть строка - это активный пункт меню
        return "class='nav-activ'";
    }
}
/* ===Подсвечивание активного пункта меню=== */
//=========получение количества необработанных заказов===========//
function count_new_orders(){
    $query = "SELECT count(*) AS count FROM orders WHERE status = '0'";
    $res = mysqli_query($dblink,$query);
    $row = mysqli_fetch_assoc($res);
    return $row['count'];
}
//=========получение количества необработанных заказов===========//
//=====получение необработанных заказов==========//
function zakaz($start_pos, $perpage){
    //$status
    $query = "SELECT orders.order_id, orders.date, orders.status, customers.name
             FROM orders
                LEFT JOIN customers
                ON customers.customer_id = orders.customer_id
                 WHERE orders.status = '0' ORDER BY orders.date DESC 
                 LIMIT $start_pos, $perpage";
            //.$status;
    $res = mysqli_query($dblink,$query);
    $zakaz = array();
    while($row = mysqli_fetch_assoc($res)){
        $zakaz[] = $row;
    }
    return $zakaz;
}
//=====получение необработанных заказов==========//
//=====получение всех заказов==========//
function orders($start_pos, $perpage){
    //$status
    $query = "SELECT orders.order_id, orders.date, orders.status, customers.name
             FROM orders
                LEFT JOIN customers
                ON customers.customer_id = orders.customer_id
                 ORDER BY orders.date DESC 
                LIMIT $start_pos, $perpage";
            //.$status;
    $res = mysqli_query($dblink,$query);
    $orders = array();
    while($row = mysqli_fetch_assoc($res)){
        $orders[] = $row;
    }
    return $orders;
}
//=====получение всех заказов==========//
/* ===Количество всех заказов=== */
function count_orders(){
    $query = "SELECT COUNT(order_id) FROM orders";
    $res = mysqli_query($dblink,$query);

    $count_orders = mysqli_fetch_row($res);
    return $count_orders[0];
}
/* ===Количество заказов=== */
/* ===Количество необработанных заказов=== */
function count_zakaz(){
    $query = "SELECT COUNT(order_id) FROM orders WHERE status = '0'";
    $res = mysqli_query($dblink,$query);

    $count_zakaz = mysqli_fetch_row($res);
    return $count_zakaz[0];
}
/* ===Количество заказов=== */

//============просмотр заказа=============//
function show_order($order_id){
    //zakaz_tovar: name, price, quantity
    //orders: date, prim
    //customers: name, email, phone, address
    //dostavka: name
    $query = "SELECT zakaz_tovar.name, zakaz_tovar.price, zakaz_tovar.quantity,
                    orders.date, orders.prim, orders.status,
                    customers.name AS customer, customers.email, customers.phone, customers.address,
                    dostavka.name AS sposob
                        FROM zakaz_tovar
              LEFT JOIN orders
                ON zakaz_tovar.orders_id = orders.order_id
              LEFT JOIN customers
                ON customers.customer_id = orders.customer_id
              LEFT JOIN dostavka
                ON dostavka.dostavka_id = orders.dostavka_id
                    WHERE zakaz_tovar.orders_id = $order_id";
    $res = mysqli_query($dblink,$query);
    $show_order = array();
    while($row = mysqli_fetch_assoc($res)){
        $show_order[] = $row; 
    }
    return $show_order;
}

//============просмотр заказа=============//
//=========подтверждение заказа============//
function confirm_order($order_id){
    $query = "UPDATE orders SET status = '1' WHERE order_id = $order_id";
    $res = mysqli_query($dblink,$query);
    if(mysqli_affected_rows($dblink) > 0){
        return true;
    }else{
        return false;
    }
}
//=========подтверждение заказа============//
/* ===Удаление заказа=== */
function del_order($order_id){
    mysqli_query($dblink,"DELETE FROM orders WHERE order_id = $order_id");
    mysqli_query($dblink,"DELETE FROM zakaz_tovar WHERE orders_id = $order_id");
    if(mysqli_affected_rows($dblink) > 0){
        return true;
    }else{
        return false;
    }
}
/* ===Удаление заказа=== */
//=====кол-во зарегистрированных пользователей=====//
function count_users(){
  $query = "SELECT count(customer_id) FROM customers WHERE login IS NOT NULL";
  // $query = "SELECT count(login) FROM customers"; //- еще один вариант 
    $res = mysqli_query($dblink,$query);
    
    $count_users = mysqli_fetch_row($res);
    return $count_users[0];
}
//=====кол-во зарегистрированных пользователей=====//
//========получение списка зарегистрированных пользователей=======//
function get_users($start_pos, $perpage){
    $query = "SELECT customer_id, name, login, email, phone, name_role
                FROM customers
                LEFT JOIN roles
                    ON customers.id_role = roles.id_role
                WHERE login IS NOT NULL LIMIT $start_pos, $perpage";
    $res = mysqli_query($dblink,$query);
    
    $users = array();
    while($row = mysqli_fetch_assoc($res)) {
        $users[] = $row;
    }
    return $users;
}
//========получение списка зарегистрированных пользователей=======//
//=====кол-во зарегистрированных пользователей=====//
function count_customers(){
  $query = "SELECT count(customer_id) FROM customers";
    $res = mysqli_query($dblink,$query);
    
    $count_customers = mysqli_fetch_row($res);
    return $count_customers[0];
}
//=====кол-во зарегистрированных пользователей=====//
//========получение списка всех пользователей=======//
function get_customers($start_pos, $perpage){
    $query = "SELECT customer_id, name, login, email, phone, name_role
                FROM customers
                LEFT JOIN roles
                    ON customers.id_role = roles.id_role
                LIMIT $start_pos, $perpage";
    $res = mysqli_query($dblink,$query);
    
    $customers = array();
    while($row = mysqli_fetch_assoc($res)) {
        $customers[] = $row;
    }
    return $customers;
}
//========получение списка всех пользователей=======//
//======получение списка ролей пользователей======//
function get_roles(){
    $query = "SELECT id_role, name_role FROM roles";
    $res = mysqli_query($dblink,$query);
    
    $roles = array();
    while($row = mysqli_fetch_assoc($res)){
        $roles[] = $row;
    }
    return $roles;
}
//======получение списка ролей пользователей======//
//=====добавление пользователя========//
function add_user(){
    $error = ''; //проверки пустых полей
    
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $id_role = (int)$_POST['id_role'];
    
    if(empty($login)) $error .= '<li>Не указан логин</li>';
    if(empty($password)) $error .= '<li>Не указан пароль</li>';
    if(empty($name)) $error .= '<li>Не указано имя</li>';
    if(empty($email)) $error .= '<li>Не указан E-mail</li>';
    
    if(empty($error)){
        // все обязательные поля заполнены
        // проверяем, нет ли такого юзера в БД
        $query = "SELECT customer_id FROM customers WHERE login = '" .clear($login). "'LIMIT 1";
        $res = mysqli_query($dblink,$query);
        $row = mysqli_num_rows($res); // 1 - такой юзер есть, 0 - нет//
        if($row) {
           // если такой логин уже есть
           $_SESSION['add_user']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Пользователь с таким логином уже зарегистрирован.</div></div>";
           $_SESSION['add_user']['name'] = $name;
           $_SESSION['add_user']['email'] = $email;
           $_SESSION['add_user']['password'] = $password;
           return false;
        }else{
            // если все ОК - регистрируем
            $login = clear($login);
            $name = clear($name);
            $email = clear($email);
            $phone = clear($phone);
            $pass = md5 ($password);
            $query = "INSERT INTO customers (name, email, login, password, id_role)
                      VALUES ('$name', '$email', '$login', '$pass', $id_role)";
            $res = mysqli_query($dblink,$query);
            if(mysqli_affected_rows($dblink) > 0 ){
               // если запись добавлена
               $_SESSION['answer'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 success'>Пользователь добавлен.</div></div>"; 
               return true;
            }else{
                $_SESSION['add_user']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Ошибка записи!</div></div>";
                $_SESSION['add_user']['login'] = $login;
                $_SESSION['add_user']['name'] = $name;
                $_SESSION['add_user']['email'] = $email;
                $_SESSION['add_user']['password'] = $password;
                return false;
            }
        }
    }else{
       // если не заполнены обязательные поля
        $_SESSION['add_user']['res'] = "<div class='row'><div class='col-sm-6 col-sm-push-3 error'>Не заполнены обязательные поля: <ul> {$error} </ul></div></div>";
        $_SESSION['add_user']['login'] = $login;
        $_SESSION['add_user']['name'] = $name;
        $_SESSION['add_user']['email'] = $email;
        $_SESSION['add_user']['password'] = $password;
        return false;
    }
}
//=====добавление пользователя========//
//======получение данных пользователя=======//
function get_user($user_id){
    $query = "SELECT name, email, phone, address, login, id_role FROM customers WHERE customer_id = $user_id";
    $res = mysqli_query($dblink,$query);
    $user = array();
    $user = mysqli_fetch_assoc($res);
    return $user;
}
//======получение данных пользователя=======//
//======редактирование пользователя=======//
function edit_user($user_id){
    foreach($_POST as $key => $val){
        if($key == "x" OR $key == "y") continue;
        if($key == "password"){
            $val = trim($val," \xC2\xA0");
            if( !empty($val) ){
                $val = md5($val);
            }else{
                continue;  
            }
        }else{
            $val = clear($val);
        }
        $data[$key] = $val;
    }
    
    $fields = array_keys($data);
    $values = array_values($data);

    for($i = 0; $i < count($fields); $i++ ){
        $str .= "{$fields[$i]} = '{$values[$i]}',";
    }
    $str = substr($str, 0, -1);
    $query = "UPDATE customers SET {$str} WHERE customer_id = $user_id";
    
    $res = mysqli_query($dblink,$query);
    if(mysqli_affected_rows($dblink) > 0){
        $_SESSION['answer'] = "<div class='success'>Данные обновлены</div>";
        if($user_id == $_SESSION['auth']['user_id']){
            $_SESSION['auth']['admin'] = htmlspecialchars($_POST['name']);
        }
        return true;
    }else{
        $_SESSION['edit_user']['res'] = "<div class='error'>Ошибка!</div>";
        return false;
    }
}
//======редактирование пользователя=======//
//======удаление пользователя========//
function del_user($user_id){
    if($_SESSION['auth']['user_id'] == $user_id){
        $_SESSION['answer'] = "<div class='error'>Вы не можете удалить сами себя.</div>";
    }else{
        $query = "DELETE FROM customers WHERE customer_id = $user_id";
        mysqli_query($dblink,$query);
        if(mysqli_affected_rows($dblink) > 0 ){
            $_SESSION['answer'] = "<div class='success'>Пользователь удален</div>";
        }else{
            $_SESSION['answer'] = "<div class='error'>Ошибка удаления!</div>";
        }
    }
}
//======удаление пользователя========//

/* ===Сортировка страниц=== */
//function sort_pages($post) {
//
//        $position = 1;
//        foreach($post as $item){
//                $res = mysqli_query($dblink,"UPDATE pages SET position = $position WHERE page_id = $item");
//                if(!$res ||(mysqli_affected_rows($dblink) == -1)) {
//                        return FALSE;
//                }
//                $position++;
//        }
//
//        $result = mysqli_query($dblink,"SELECT page_id, position FROM pages");
//        if(!$result) {
//                return FALSE;
//        }
//        $row = array();
//        for($i = 0;$i < mysqli_num_rows($result);$i++) {
//                $row[] = mysqli_fetch_assoc($result);
//        }
//
//        return $row;
//}
/* ===Сортировка страниц=== */

/* ===Сортировка ссылок=== */
//function sort_links($post,$parent) {
//
//        $position = 1;
//        foreach($post as $item){
//                $res = mysqli_query($dblink,"UPDATE `links` SET `links_position`='{$position}' WHERE `link_id`='{$item}' AND `parent_informer` = '{$parent}'");
//                if(!$res ||(mysqli_affected_rows($dblink) == -1)) {
//                        return FALSE;
//                }
//                $position++;
//        }
//
//        $result = mysqli_query($dblink,"SELECT link_id,links_position FROM links WHERE `parent_informer` = '{$parent}' ORDER BY `links_position`");
//        if(!$result) {
//                return FALSE;
//        }
//        $row = array();
//        for($i = 0;$i < mysqli_num_rows($result);$i++) {
//                $row[] = mysqli_fetch_assoc($result);
//        }
//        return $row;
//}
/* ===Сортировка ссылок=== */
/* ===Сортировка информеров=== */
//function sort_informers($post) {
//
//        $position = 1;
//        foreach($post as $item){
//                $res = mysqli_query($dblink,"UPDATE informers SET informer_position = '{$position}' WHERE informer_id = '{$item}'");
//                if(!$res ||(mysqli_affected_rows($dblink) == -1)) {
//                        return FALSE;
//                }
//                $position++;
//        }
//        return TRUE;
//}
/* ===Сортировка информеров=== */


