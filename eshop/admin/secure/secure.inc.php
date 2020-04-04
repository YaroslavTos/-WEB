<?
// Часть 10. Повышение безопасности приложения

const PWD_FILE_NAME = ".htpasswd"; //файл с паролями для каждого пользователя своя строка login:hash

function getHash($password){
	$hash = password_hash($password, PASSWORD_BCRYPT);
	return $hash;
}

//функция проверки пароля (хэша)
function checkHash($password, $hash) {
	return password_verify(trim($password), trim($hash));
}

//функция создающая новую запись в файле пользователей
function saveUser($login, $hash) {
	$str = "$login:$hash\n";
	if(file_put_contents(PWD_FILE_NAME, $str, FILE_APPEND))
		return true;
	else
		return false;
}

//функция проверяющая наличие пользователя в списке. Если пользователь найден то функция возвращает всю строку из файла с паролями
function userExists($login){
	if(!is_file(PWD_FILE_NAME))
		return false;
	$users = file(PWD_FILE_NAME);
	foreach ($users as $user) {
		if(strpos($user, $login.':') !== false)
			return $user;
	}
	return false;
}

function logOut() {
	session_destroy();
	header('Location: secure/login.php');
	exit;
}