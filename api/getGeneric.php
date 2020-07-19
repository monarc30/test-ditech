<?php

require_once ( "../env.php" );
require_once ( "../dao/DataBase.php" ) ;

$data = new DataBase( $host, $user, $password, $dbname );

if ($_GET['action'] === "get_all") {
	$res = $data->getDebtors();
}

if ($_GET['action'] === "get_all_debts") {
	$res = $data->getDebtorsDebt();
}

if ($_GET['action'] === "insert") {
	$res = $data->insertDebtor();
}


if ($_GET['action'] === "debtor_one") {
	$res = $data->debtor_one($_GET["id"]);
}


if ($_GET['action'] === "update") {
	$res = $data->alterDebtor();
}

if ($_GET['action'] === "delete") {
	$res = $data->deleteDebtor($_GET["id"]);
}

echo json_encode($res);

