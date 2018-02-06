<?php 
include '../library/configServer.php';
include '../library/consulSQL.php';

session_start();
if(isset($_SESSION['UserPrivilege'])){
	if(isset($_SESSION['SessionToken']) && isset($_SESSION['codeBit'])){
		$hora=data("H:i:s");
		consultasSQL::UpdateSQL("login", "Sair='$hora'", "Codigo='".$_SESSION['codeBit']."'");
		session_unset();
		session_destroy();
		header("Location: ../index.php");
	}
}else{
	header("Location: ../index.php");
}