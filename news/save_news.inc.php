<?php
if (!empty($_POST['title']) &&
    !empty($_POST['category']) &&
	!empty($_POST['description']) &&
	!empty($_POST['source'])) {
		if ($news->saveNews($_POST['title'],$_POST['category'],$_POST['description'],$_POST['source']));
		header ('Location: news.php');
	} else {
		$errMsg='Заполните все поля формы!';
	}