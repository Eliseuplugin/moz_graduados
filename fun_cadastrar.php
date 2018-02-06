<?php
	session_start();
	$usuariott = $_POST['loginName'];
	$senhatt = $_POST['loginPassword'];
	echo $usuariott.' - '.$senhatt;
	header("Location: tela_cadastro.php");
	
		
?>