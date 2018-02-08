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
	 				Bem-vindo a sessao donde se encontra a lista dos administradores, podes desativar a conta ou administrador ou eliminar os dados 
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
                        	<div class="div-table-cell">'.$fila['NomeUsuario'].'</div>
                        	<div class="div-table-cell">'.$fila['E-mail'].'</div>
                        	<div class="div-table-cell">'.$fila['Status'].'</div>';
                        	if($fial['Status']=='Activo'){
                        		$checkAdminLoan=executarSQL::consultar("SELECT * FROM emprestimo WHERE CodigoAdmin='".$fila['CodigoAdmin']."'");
                        		echo '<form class="div-table-cell form_SRCB" action="../process/desativadoAdmin.php" method="post" data-type-form="updateAccountAdmin" > <input value="'.$fila["CodigoAdmin"].'" type="hidden" name="primaryKey">
                        		<button type="submit" class="btn btn-primary tooltips-general" data-toggle="tooltip" data-placement="top" title="Conta ativa, pressione o botão para desativá-la"><i class="zmdi zmdi-swap"></i></button>
                        		</form>
                                    <div class="div-table-cell"><button class="btn btn-success btn-update" data-code="'.$fila['CodigoAdmin'].'" data-url="../process/SelectDataAdmin.php"><i class="zmdi zmdi-refresh"></i></button></div>';
                                    if(mysql_num_rows($checkAdminLoan)>0){
                                        echo '<div class="div-table-cell"><button disabled="disabled" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></button></div>';
                                        }else{
                                        echo '<form class="div-table-cell form_SRCB" action="../process/DeleteAdmin.php" method="post" data-type-form="delete" >
                                            <input value="'.$fila["CodigoAdmin"].'" type="hidden" name="primaryKey">
                                            <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></button>
                                        </form>';
                                        }
                                }else{
                                    echo '
                                    <form class="div-table-cell form_SRCB" action="../process/ActivateAdmin.php" method="post" data-type-form="updateAccounAdmin" >
                                        <input value="'.$fila["CodigoAdmin"].'" type="hidden" name="primaryKey">
                                        <button type="submit" class="btn btn-info tooltips-general" data-toggle="tooltip" data-placement="top" title="Conta desativada, pressione o botão para ativá-la">
                                        <i class="zmdi zmdi-swap"></i></button>
                                    </form>
                                    <div class="div-table-cell"><button class="btn btn-success btn-update" data-code="'.$fila['CodigoAdmin'].'" data-url="../process/SelectDataAdmin.php"><i class="zmdi zmdi-refresh"></i></button></div>
                                    <div class="div-table-cell"><button disabled="disabled" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></button></div>';
                                    }
                            echo '</div>'; 
                        $p++;
                        mysql_free_result($checkAdminLoan);
                    }
                    echo '</div>';
                }else{
                    echo '<br><br><br><h2 class="text-center all-tittles">Não há administradores registrados no sistema</h2><br><br><br>';
                    }
                mysql_free_result($checkAdmin);
            ?>
        </div>
        <div class="msjFormSend"></div>
        <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <form class="form_SRCB modal-content" action="../process/AtualizarAdmin.php" method="post" data-type-form="update"  autocomplete="off">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center all-tittles">Atualizar dados do administrador</h4>
            </div>
            <div class="modal-body" id="ModalData"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success"><i class="zmdi zmdi-refresh"></i> &nbsp;&nbsp; Guardar alteraçoes</button>
              </div>
               </form>
          </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Ajuda do sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include '../help/ajuda-adminlistausuario.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acordo</button>
                </div>
              </div>
          </div>
      </div>
	 		 <?php include '../inc/footer.php';?>
	 	</div>
</body>
</html>