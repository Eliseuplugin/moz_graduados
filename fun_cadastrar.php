<?php 
	session_start();
	$usuariot = $_POST['loginName'];
	$senha = $_POST['loginPassword'];
	echo $usuariot.' - '.$senhat;
	header("Location: tela_cadastro.php");

 ?>