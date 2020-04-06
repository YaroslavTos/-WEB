<?php
require_once('./NewsDB.class.php');
if(!is_array($items = $news->getNews())){
    $errMsg = "Ошибка при выводе новостей";
} else {
    echo '<p>Всего новостей: '.count($items).'</p>';
    foreach($items as $item){
        $dt = date('d-m-Y H:i:s',$item['datetime']);
        echo
            '<div style="border: 2px solid salmon; background-color: silver; text-align: center; margin: 10px; padding: 15px">
  		    <p>title: '.$item['title'].'</p>
  				<p>category: '.$item['category'].'</p>
  				<p>description: '.$item['description'].'</p>
  				<p>source: '.$item['source'].'</p>
  				<p>datetime: '.$dt.'</p>
  				<p><a href="news.php?del='.$item['id'].'">Удалить!</a></p>
  			</div>';
    }
}