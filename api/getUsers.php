<?php

require_once ( __PATH_ROOT__ .'/dao/DataBase.php' ) ;

$data = new DataBase();

if ($_GET['action'] === "get_all") {
	$res = $data->getUsers();
}

if ($_GET['action'] === "insert") {
	$res = $data->insertUser();
}


if ($_GET['action'] === "user_one") {
	$res = $data->user_one($_GET["id"]);
}


if ($_GET['action'] === "update") {
	$res = $data->alterUser();
}

if ($_GET['action'] === "delete") {
	$res = $data->deleteUser($_GET["id"]);
}


echo json_encode($res);

?>