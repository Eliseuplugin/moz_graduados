<?php
	session_start();
	$usuariot = $_POST['loginName'];
	$senhat = $_POST['loginPassword'];
	echo $usuariot.' - '.$senhat;
	header("Location: tela_cadastro.php");
	
		
?>