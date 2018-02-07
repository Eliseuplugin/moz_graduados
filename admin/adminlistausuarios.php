<!DOCTYPE html>
<html lang="pt">
<head>
	<title>Administradores</title>
	<?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php'; 
    ?>
    <script src="../js/SendForm.js"></script>
</head>
<body>
	<?php 
		include '../library/configServer.php';
        include '../library/consulSQL.php';
        include '../process/SecurityAdmin.php';
        include '../inc/NavLateral.php'; 

	 ?>
	 <div class="content-page-container full-reset custom-scroll-containers">
	 	<?php 
	 		include '../inc/NavUsuarioInfo.php';
	 	 ?>
	 	<div class="container">
	 		<div class="page-header">
	 			<h1 class="all-tittles">Sistema E-graduados <small>Administracao dos E-graduados</small></h1>
	 		</div>
	 	</div>
	 	<div class="container-fluid">
	 		<ul class="nav nav-tabs nav-justified" style="font-size: 17px;">
	 			<li role="presentation" class="active"><a href="adminusuario.php">Administradores</a>
	 			</li>
	 			<li role="presentation" class="active"><a href="adminestudante.php">Estudantes</a>
	 			</li>
	 			<li role="presentation" class="active"><a href="admingraduado.php">Graduados</a>
	 			</li>
	 		</ul>
	 	</div>
	 	<div class="container-fluid" style="margin: 50px 0;">
	 		<div class="row">
	 			<div class="col-xs-12 col-sm-4 col-md-3">
	 				<img src="../assets/img/user01.png" alt="user" class="img-responsive cennter-box" style="max-width: 110px;">
	 			</div>
	 			<div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
	 				Bem-vindo a sessao
	 			</div>
	 		</div>
	 	</div>
	 	<div class="container-fluid">
	 		<div class="row">
	 			<div class="col-xs-12 lead">
	 				<ol class="breadcrumb"> 
	 					<li><a href="adminusuario.php">Novo administrador</a></li>
	 					<li class="active">Lista dos administradores</li>
	 				</ol>
	 			</div>
	 		</div>
	 	</div>
	 	<div class="container-fluid">
	 		<h2 class="text-center all-tittles">Lista de administradores</h2>
	 		<?php 
	 			$checkAdmin=executarSQL::consultar("SELECT * FROM administrador WHERE Nome <> 'Super Administrador'");
	 			if(mysql_num_rows($checkAdmin)>0){
	 				echo '<div class="div-table" id="List-Admin">
	 				<div class="div-table-row div-table-head">
                        <div class="div-table-cell">#</div>
                        <div class="div-table-cell">Nome</div>
                        <div class="div-table-cell">Nome do usuario</div>
                        <div class="div-table-cell">E-mail</div>
                        <div class="div-table-cell">Status</div>
                        <div class="div-table-cell">Trocar</div>
                        <div class="div-table-cell">Atualizar</div><div class="div-table-cell">Eliminar</div>
                        </div>';
                        $p=1;
                        while ($fila=mysql_fetch_array($checkAdmin)) {
                        	echo '<div class="div-table-row">
                        	<div class="div-table-cell">'.$p.'</div>
                        	<div class="div-table-cell">'.$fila['Nome'].'</div>
                        	<div class="div-table-cell">'.$fila['NomeUsuario'].'</div>'
                        }
	 			}
	 		 ?>
	 	</div>
	 </div>

</body>
</html>