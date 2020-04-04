<?php
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
	if($_SERVER[REQUEST_METHOD] == 'POST') {
		$name = clear_str($_POST['name']);
		$email = clear_str($_POST['email']);
		$phone = clear_str($_POST['phone']);
		$adress = clear_str($_POST['address']);
		$orderid = $basket['orderid'];
		$time = time();
		$str = "$name|$email|$phone|$adress|$orderid|$time\n";

	$f = fopen('admin/'.ORDERS_LOG, "a") or die;
	fputs($f, $str);
	fclose($f);

	saveOrder($time);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>