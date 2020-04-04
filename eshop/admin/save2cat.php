<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/config.inc.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$title = trim(strip_tags($_POST['title']));
	$author = trim(strip_tags($_POST['author']));
	$pubyear = (int)$_POST['pubyear'];
	$price = (int)$_POST['price'];

	if(!addItemToCatalog($title, $author, $pubyear, $price)) {
		echo 'Произошла ошибка при добавлении товара в каталог';
	} else {
		header("Location: add2cat.php");
		exit;
	}
}
?>

