<?php
function clear_int($int) {
	return int($int);
}

function clear_str($str) {
	return trim(strip_tags($str));
}
function addItemToCatalog($title, $author, $pubyear, $price) {
	global $link;
	//Проверка на пустые значения
	if(empty($title) || empty($author) || empty($pubyear) || empty($price))
		return false;
	$sql = 'INSERT INTO catalog (title, author, pubyear, price) VALUES (?, ?, ?, ?)';
	if(!$stmt = mysqli_prepare($link, $sql))
		return false;
	mysqli_stmt_bind_param($stmt, "ssii", $title, $author, $pubyear, $price);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	return true;
}


function selectAllItems() {
	global $link;

	$sql = 'SELECT id, title, author, pubyear, price FROM catalog';

	if(!$result = mysqli_query($link, $sql))
		return false;

	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	return $items;
}

function saveBasket() {
	global $basket;
	$basket = base64_encode(serialize($basket));
	setcookie('basket', $basket, 0x7FFFFFFF);
}

function basketInit(){
	global $basket, $count;

	if(!isset($_COOKIE['basket'])) {
		$basket = ['orderid' => uniqid()];
        saveBasket();
	}
	else {
		$basket = unserialize(base64_decode($_COOKIE['basket']));

		foreach ($basket as $key => $val) {
			if($key != 'orderid') {
			$count += $val;
		}
		}

	}
}

function add2Basket($id) {
	global $basket;
	$basket[$id] = 1;
    saveBasket();
}

function myBasket(){
	global $link, $basket;

	$goods = array_keys($basket);

	array_shift($goods);

	if(!$goods)
		return false;
	$ids = implode(",", $goods);
	// $ids = 3,6,4,2,9
	//Теперь можно создать запрос с дипазоном этих id
	$sql = "SELECT id, title, author, pubyear, price FROM catalog WHERE id IN($ids)";
	//Делаем запрос к базе
	if(!$result = mysqli_query($link, $sql))
		return false;

	$items = result2Array($result);
	mysqli_free_result($result);
	return $items;
}


function result2Array($data) {
	global $basket;
	$arr = [];
	while($row = mysqli_fetch_assoc($data)) {
		$row['quantity'] = $basket[$row['id']];
		$arr[] = $row;
	}
	return $arr;
}
function deleteItemFromBasket($id) {
	global $basket;

	unset($basket[$id]);
	saveBasket();
}


function saveOrder($datetime) {
	global $link, $basket;

	$goods = myBasket();


	$sql = 'INSERT INTO orders (
		title,
		author,
		pubyear,
		price,
		quantity,
		orderid,
		datetime
		)
	VALUES (?,?,?,?,?,?,?)';

	if(!$stmt = mysqli_prepare($link, $sql))
		return false;
	if(is_array($goods)) {
		foreach ($goods as $item) {
		mysqli_stmt_bind_param($stmt, "ssiiisi",
								$item['title'],
								$item['author'],
								$item['pubyear'],
								$item['price'],
								$item['quantity'],
								$basket['orderid'],
								$datetime
								);
		mysqli_stmt_execute($stmt);
		}
		mysqli_stmt_close($stmt);
	} else
		return false;
	setcookie('basket', '', 1);
	return true;
}
function getOrders() {
	global $link;

	if(!is_file(ORDERS_LOG)) {
		echo "no file";
		return false;
	}

	$orders = file(ORDERS_LOG);


	$allorders = [];
	foreach ($orders as $order) {


		$list = explode("|", trim($order));

		$orderinfo = [];

		$orderinfo["name"] = $list[0];
		$orderinfo["email"] = $list[1];
		$orderinfo["phone"] = $list[2];
		$orderinfo["address"] = $list[3];
		$orderinfo["orderid"] = $list[4];
		$orderinfo["date"] = $list[5];



		$date = $list[3];
		$orderid = $list[4];
		$sql = "SELECT title, author, pubyear, price, quantity FROM orders WHERE orderid = '$orderid'";


		if(!$result = mysqli_query($link, $sql))
			return false;
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);

		$orderinfo["goods"] = $items;

		$allorders[] = $orderinfo;
	}

	return $allorders;
}

function shop_delete_from_catalog($id) {
	global $link;

	$sql = "DELETE from catalog WHERE id=$id";
	if(!$result = mysqli_query($link, $sql))
		return false;
}


