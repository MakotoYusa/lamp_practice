<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$token = get_csrf_token();
$items = sort_new_arrival($db);

if(isset($_POST['action']) === TRUE){
  $action = $_POST['action'];
}

if($action === 'sort'){
  $sort_type = $_POST['sort_type'];
  if ($sort_type === 'new_arrival') {
    $items = sort_new_arrival($db);
    set_message('新着順に並び替えました。');
  } else if ($sort_type === 'low_price') {
    $items = sort_low_price($db);
    set_message('価格が安い順に並び替えました。');
  } else if ($sort_type === 'high_price') {
    $items = sort_high_price($db);
    set_message('価格が高い順に並び替えました。');
  } else {
    set_error('並び替えに失敗しました。');
  }
}

include_once VIEW_PATH . 'index_view.php';