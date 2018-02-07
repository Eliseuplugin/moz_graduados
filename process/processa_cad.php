<?php
	session_start();
	include_once("conexaoDB.php");
	$usuariot = $_POST['loginName'];
	$emailt = $_POST['email'];
	$senhat = $_POST['loginPassword'];
	$tipot = $_POST['select_tipo_usuario'];
	
	$result_usuario = "INSERT INTO usuarios(nome, email, senha, tipo_usuario_cod, criacao) VALUES ('$usuariot','$emailt','$senhat','$tipot', now())";
	$resultado_usuario = mysqli_query($conn, $result_usuario);

if(mysqli_insert_id($conn)){
	$_SESSION['msg'] = "<p style='color:green;'>Usuário cadastrado com sucesso</p>";
	header("Location: ../tela_cadastro.php");
}else{
	$_SESSION['msg'] = "<p style='color:red;'>Usuário não foi cadastrado com sucesso</p>";
	header("Location: ../tela_cadastro.php");
}
?>