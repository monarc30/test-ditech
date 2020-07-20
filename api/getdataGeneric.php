<?php

require_once ( "../env.php" );
require_once ( "../dao/DataBase.php" ) ;

require_once ( "../models/Debtors.php" );
require_once ( "../models/DebtorsDebt.php" );

$data = new DataBase( $host, $user, $password, $dbname );

$Debtors = new Debtors();
$DebtorsDebt = new DebtorsDebt();

if ($_GET['action'] === "get_all") {
	$res = $data->getDebtors();
}

if ($_GET['action'] === "get_all_debts") {
	$res = $data->getDebtorsDebt();
}

if ($_GET['action'] === "insert") {

	
	$name = $Debtors->setName($_POST['name']);
	$address = $Debtors->setAddress($_POST['address']);
	$cpf = $Debtors->setCpf($_POST['cpf']);
	$email = $Debtors->setEmail($_POST['email']);
	$birth = $Debtors->setBirth($_POST['birth']);	

	$res = $data->insertDebtor( $Debtors );
}

if ($_GET['action'] === "insert_debtors_debt") {	
	
	$description = $DebtorsDebt->setDescription($_POST['description']);
	$value = $DebtorsDebt->setValue($_POST['value']);
	$date_due = $DebtorsDebt->setDatadue($_POST['date_due']);
	$id_debtor = $DebtorsDebt->setIddebtor($_POST['id_debtor']);	
	
	$res = $data->insertDebtorDebt( $DebtorsDebt );
}

if ($_GET['action'] === "debtor_one") {	
	
	$id_debtor = $Debtors->setid($_GET["id"]);	
	$res = $data->debtor_one( $Debtors );

}

if ($_GET['action'] === "debtor_one_debtors_debt") {

	$id_debtor_debt = $DebtorsDebt->setid($_GET["id"]);	
	$res = $data->debtor_one_debtors( $DebtorsDebt );
}

if ($_GET['action'] === "update") {
	
	$name = $Debtors->setName($_POST['name']);
	$address = $Debtors->setAddress($_POST['address']);
	$cpf = $Debtors->setCpf($_POST['cpf']);
	$email = $Debtors->setEmail($_POST['email']);
	$birth = $Debtors->setBirth($_POST['birth']);
	$id = $Debtors->setid($_POST['id']);	
	
	$res = $data->alterDebtor( $Debtors );
}

if ($_GET['action'] === "update_debtors_debt") {


	$description = $DebtorsDebt->setDescription($_POST['description']);
	$value = $DebtorsDebt->setValue($_POST['value']);
	$date_due = $DebtorsDebt->setDatadue($_POST['date_due']);
	$id_debtor = $DebtorsDebt->setIddebtor($_POST['id_debtor']);
	$id = $DebtorsDebt->setid($_POST['id']);

	$res = $data->alterDebtorDebt( $DebtorsDebt );
}

if ($_GET['action'] === "delete") {

	
	$id_debtor = $Debtors->setid($_GET["id"]);	

	$res = $data->deleteDebtor( $Debtors );
}

if ($_GET['action'] === "delete_debtors") {

	$id_debtor_debt = $DebtorsDebt->setid($_GET["id"]);	

	$res = $data->deleteDebtorDebt( $DebtorsDebt );
	
}

echo json_encode($res);

