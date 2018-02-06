<!DOCTYPE html>
<html lang="pt">
<head>
	<title>Inicio</title>
	<?php 
		session_start();
		$LinksRoute="./";
		include './inc/links.php';
	 ?>
</head>
<body>
	<?php 
		include './library/configServer.php';
		include './library/consulSQL.php';
		if (!$_SESSION['UserPrivilege']=='Admin' && $_SESSION['SessionToken']=="") {
			header("Location: process/logout.php");
			exit();
		} 
		include './inc/NavLateral.php';

	 ?>
	 <div class="content-page-container full-reset custom-scroll-containers">
	 		<?php
	 			include './inc/NavUsuarioInfo.php'; 
	 			?>
	 			<div class="container">
	 				<div class="page-header">
	 					<h1 class="all-tittles">Sistema E-graduados <small>Inicio</small></h1>
	 				</div>
	 			</div>
	 			<?php 
	 				$checkAdmins=executarSQL::consultar("SELECT * FROM administrador WHERE Nome <> 'Super Administrador'");
	 				$checkStudents=executarSQL::consultar("SELECT * FROM estudante");
	 				$checkGraduados=executarSQL::consultar("SELECT * FROM graduado");
	 				$checkVagas=executarSQL::consultar("SELECT * FROM vagas");
	 				$totalVagas=0;
	 				while ($DBT=mysql_fetch_array($checkVagas)) {
	 					$totalVagas=$totalVagas+$DBT['Existentes'];
	 				}

	 			 ?>
	 			 <section class="full-reset text-center" style="padding: 40px 0;">
	 			 	<article class="tile" data-href="./admin/adminlistausuarios.php" data-num="<?php echo mysql_num_rows($checkAdmins); ?>">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-face"></i></div>
                <div class="tile-name all-tittles">administradores</div>
                <div class="tile-num full-reset"><?php echo mysql_num_rows($checkAdmins); ?></div>
            </article>
            <article class="tile" data-href="./admin/adminlistaestudantes.php" data-num="<?php echo mysql_num_rows($checkStudents); ?>">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-accounts"></i></div>
                <div class="tile-name all-tittles">estudantes</div>
                <div class="tile-num full-reset"><?php echo mysql_num_rows($checkStudents); ?></div>
            </article>
            <article class="tile" data-href="./admin/adminlistagraduados.php" data-num="<?php echo mysql_num_rows($checkStudents); ?>">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-accounts"></i></div>
                <div class="tile-name all-tittles">estudantes</div>
                <div class="tile-num full-reset"><?php echo mysql_num_rows($checkGraduados); ?></div>
            </article>
            <article class="tile" data-href="./admin/adminlistavagas.php" data-num="<?php echo mysql_num_rows($checkStudents); ?>">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-accounts"></i></div>
                <div class="tile-name all-tittles">estudantes</div>
                <div class="tile-num full-reset"><?php echo mysql_num_rows($checkVagas); ?></div>
            </article>
	 			 </section>
	 			 <?php 
	 			 	mysql_free_result($checkAdmins);
	 			 	mysql_free_result($checkGraduados);
					mysql_free_result($checkStudents);
					mysql_free_result($checkVagas);
	 			  ?>
	 			   <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ajuda do sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include './help/help-home.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; Termos e condicoes</button>
                </div>
            </div>
          </div>
        </div>
        <?php include './inc/footer.php'; ?>
	</div>
</body>
</html>