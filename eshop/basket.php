<?php
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Корзина пользователя</title>
</head>
<body>
	<h1>Ваша корзина</h1>
<?php
	if(!$goods = myBasket())
		echo '<p>Корзина пуста! Вернитесь в <a href="catalog.php">каталог</a></p>';
	else echo '<p>Вернуться в <a href="catalog.php">каталог</a></p>';
	if(!is_array($goods)) die;
?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php
		$sum = 0;
		$j = 1;
		foreach ($goods as $item) {
	?>
			<tr>
				<td><?=$j++?></td>
				<td><?=$item['title']?></td>
				<td><?=$item['author']?></td>
				<td><?=$item['pubyear']?></td>
				<td><?=$item['price']?></td>
				<td><input form="recount" min="1" type="number" name="quantity<?=$j-1?>" value="<?=$item['quantity']?>"></td>
				<td><a href="delete_from_basket.php?id=<?=$item['id']?>">Удалить</a></td>
			</tr>
				</tr>
		<?php
			$num = $j-1;
			$sum+=$item['price']*$item['quantity'];
			}
		?>
</table>

<p>Всего товаров в корзине <?=$count?> на сумму: <?=$sum?> руб.</p>
<form id="recount" action="recount.php" method="get">
	<button type="submit">Пересчитать</button>
</form>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>

</body>
</html>







