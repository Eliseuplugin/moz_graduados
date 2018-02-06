<<<<<<< HEAD
<?php
	session_start();
	$usuariot = $_POST['loginName'];
	$senhat = $_POST['loginPassword'];
	$tipot = $_POST['UserType'];
	echo $usuariot.' - '.$senhat.' - '.$tipot;

	
		
?>
=======
<?php 
	session_start();
	$usuariot = $_POST['loginName'];
	$senha = $_POST['loginPassword'];
	echo $usuariot.' - '.$senhat;
	header("Location: tela_cadastro.php");

 ?>
>>>>>>> 7354fdd63ba1a1688b08fc4f2673f320e99d9598
