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
$order_id = get_post('order_id');

if (is_valid_csrf_token($token)) {
    if (is_admin($user) === false) {
        $order = get_order($db, $order_id, $user['user_id']);
        $order_details = get_order_details($db, $order_id, $user['user_id']);
    } else {
        $order = get_all_order($db, $order_id);
        $order_details = get_all_order_details($db, $order_id);
    }
} else {
    set_error('不正な操作が行われました。');
}

include_once VIEW_PATH . 'order_details_view.php';
