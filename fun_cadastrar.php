<?php
	session_start();
	$usuariot = $_POST['loginName'];
	$senhat = $_POST['loginPassword'];
	$tipot = $_POST['UserType'];
	echo $usuariot.' - '.$senhat.' - '.$tipot;

	
		
?>