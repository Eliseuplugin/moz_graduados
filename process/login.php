<?php 
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
include '../library/SED.php';
$UserType=consultasSQL::CleanStringText($_POST['UserType']);
$loginName=consultasSQL::CleanStringText($_POST['loginName']);
$loginPassword=consultasSQL::CleanStringText($_POST['loginPassword']);
$fecha=date("d-m-Y");
$hora=date("H:i:s");
$pass=SED::encryption($loginPassword);
if($UserType=="Estudante"){
	$key="BI";
	$table="estudante";
	$userN="graduados";
}


 ?>