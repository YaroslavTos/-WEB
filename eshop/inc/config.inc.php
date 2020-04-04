<?php

define(DB_HOST, 'mysite.local');
define(DB_LOGIN, 'root');
define(DB_PASSWORD, '');
define(DB_NAME, 'eshop');
define(ORDERS_LOG, 'orders.log');
setcookie('test', 'test', 0x7FFFFFFF);

$basket = [];
$count = 0;

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

if(!$link) {
	echo 'Ошибка N: '
		.mysqli_connect_errno()
		.': '
		.mysqli_connect_error();
	}

basketInit();
