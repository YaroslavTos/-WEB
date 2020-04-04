<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Форма оформления заказа</title>
</head>
<body>
	<h1>Оформление заказа</h1>
	<form action="saveorder.php" method="post">
		<p>Заказчик: <input type="text" name="name" size="50" />
		<p>Email заказчика: <input type="text" name="email"
					size="50" />
		<p>Телефон для связи: <input type="text" name="phone"
						size="50" />
		<p>Адрес доставки: <input type="text" name="address"
						size="100" />
		<p><input type="submit" value="Заказать" />
	</form>
</body>
</html>