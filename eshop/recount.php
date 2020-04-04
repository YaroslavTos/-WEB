<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
$q[]=$basket['orderid'];
foreach ($_GET as $key => $val) {
	$name = 'quantity'.++$j;
	if($key == $name) {
		$q[] = $val;
	}
}
$keys = array_keys($basket);
$vals = array_values($q);
$n = count($keys);
for($i=0; $i<$n; $i++) {
$basket[ $keys[$i] ] = $vals[ $i ];
}
saveBasket();
header("Location: basket.php"); //перенаправляем пользователя обратно на страницу каталога
exit; //завершаем скрипт