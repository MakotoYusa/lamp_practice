<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();

if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$token = get_post('token');
$sort_type = get_get('sort_type');

if (is_valid_csrf_token($token)) {
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
} else {
    set_error('不正な操作が行われました。');
}

redirect_to(HOME_URL);
