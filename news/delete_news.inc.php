<?php
require_once('./NewsDB.class.php');
$id = $news->clearInt($_GET['del']);
if($id) {
    if (!$news->deleteNews($id)) {
        $errMsg = "Произошла ошибка при удалении новости";
    } else {
        header('Location: news.php');
        exit;
    }
}
