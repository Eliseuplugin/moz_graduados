
<?php
	session_start();
	$usuariot = $_POST['loginName'];
	$senhat = $_POST['loginPassword'];
	$tipot = $_POST['UserType'];

	header("Location: tela_cadastro.php");

 ?>

