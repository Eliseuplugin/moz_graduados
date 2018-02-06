<?php 
	if($LinksRoute=="../"){ $LinkRouteAdmin="";}else{ $LinkRouteAdmin="./admin/";}
 ?>
 <div class="navbar-lateral full-reset">
 	<div class="visible-xs font-movile-menu mobile-menu-button"></div>
 	<div class="full-reset container-menu-movile custom-scroll-containers">
 		<div class="logo full-reset all-tittles"><i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i>Sistema E-Graduado</div>
 		<div class="full-reset" style="background-color: #2b3d51; padding: 10px 0; color:#fff;">
 			<figure>
 				<img src="<?php echo $LinksRoute; ?> assets/img/logo.png" alt="Biblioteca" class="img-responsive center-box" style="width:55%;">
 			</figure>
 			<p class="text-center" style="padding-top: 15px;">Sistema E-Graduados</p>
 		</div>
 		<div class="full-reset nav-lateral-list-menu">
 			<ul class="list-unstyled">
 				<?php 
 					if($_SESSION['UserPrivilege']=='Student'||$_SESSION['UserPrivilege']=='Vagas'||$_SESSION['UserPrivilege']=='Personal'){
 						echo '<li><a href="catalogo.php"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Catalogo</a></li>';
 					}else if($_SESSION['UserPrivilege']=='Admin'){
 						echo '
 						<li><a href="'.$LinksRoute.'inicio.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio</a></li>
 						<li>
 							<div class="dropdown-menu-button"><i class="zmdi zmdi-case zmdi-hc-fw"></i>&nbsp;&nbsp;Administracao <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
 							<ul class="list-unstyled">
 								<li><a href="'.$LinkRouteAdmin.'adminegraduado.php"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>&nbsp;&nbsp;Dados E-graduados</a></li>
 								<li><a href="'.$LinkRouteAdmin.'admincurso.php"><i class="zmdi zmdi-boookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Novo curso</a></li>
 								</ul>
 							</li>
 						';
 					}

 				 ?>
 			</ul>
 		</div>
 	</div>
 </div>