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

$token = get_csrf_token();

if (is_admin($user) === false) {
    $orders = get_orders($db, $user['user_id']);
} else {
    $orders = get_all_orders($db);
}

include_once VIEW_PATH . 'orders_view.php';
