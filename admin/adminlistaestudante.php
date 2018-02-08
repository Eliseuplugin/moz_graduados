<!DOCTYPE html>
<html lang="pt">
<head>
	<title>Estudantes</title>
	<?php 
		session_start();
		$LinksRoute="../";
		include '../inc/links.php';

	 ?>

	 <script type="text/javascript" src="../js/jPages.js"></script>
    <script src="../js/SendForm.js"></script>
    <script>
        $(document).ready(function(){
            $(function(){
              $("div.holder").jPages({
                containerID : "itemContainer",
                perPage: 20
              });
            });
            $('.list-catalog-container li').click(function(){
               window.location="adminlistaestudante.php?StudentS="+$(this).attr("data-code-section");
            });
        });
    </script>
</head>
<body>
	<?php  
        include '../library/configServer.php';
        include '../library/consulSQL.php';
        include '../process/SecurityAdmin.php';
        include '../inc/NavLateral.php';
        $StudentS=consultasSQL::CleanStringText($_GET['StudentS']);
        $StudentN=consultasSQL::CleanStringText($_GET['StudentN']);
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php 
            include '../inc/NavUsuarioInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema E-Graduados <small>Administração usuários</small></h1>
          </div>
      </div>
      <div class="conteiner-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
              <li role="presentation"><a href="adminuser.php">Administradores</a></li>
              <li role="presentation"  class="active"><a href="adminestudante.php">Estudantes</a></li>
              <li role="presentation"><a href="adminpersonal.php">Pessoal administrativo</a></li>
            </ul>
        </div>
                <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user03.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bem-vindo à seção onde a lista de alunos da instituição está localizada, você pode pesquisar os alunos por seção ou nome. Você pode atualizar ou excluir dados do aluno.<br>
                    <strong class="text-danger"><i class="zmdi zmdi-alert-triangle"></i> &nbsp; Importante! </strong>Se você excluir o aluno do sistema, todos os dados relacionados a ele serão excluídos, incluindo empréstimos e logs no blog.
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                        <li><a href="adminstudent.php">Novo estudante</a></li>
                        <li class="active">Lista de estudantes</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="margin: 0 0 50px 0;">
            <form class="pull-right" style="width: 30% !important;" action="adminlistestudante.php" method="get" autocomplete="off">
                <div class="group-material">
                    <input type="search" style="display: inline-block !important; width: 70%;" class="material-control tooltips-general" placeholder="Buscar estudante" name="StudentN" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚ ]{1,50}" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escreva os nomes, sem os sobrenomes">
                    <button class="btn" style="margin: 0; height: 43px; background-color: transparent !important;">
                        <i class="zmdi zmdi-search" style="font-size: 25px;"></i>
                    </button>
                </div>
            </form>
            <h2 class="text-center all-tittles" style="margin: 25px 0; clear: both;">Seções</h2>
            <ul class="list-unstyled text-center list-catalog-container">
                <?php
                    $selectSections=ejecutarSQL::consultar("SELECT * FROM secao ORDER BY Nome ASC");
                    while($fila=mysql_fetch_array($selectSections)){
                        echo '<li class="list-catalog" data-code-section="'.$fila['CodigoSecao'].'">'.$fila['Nome'].'</li>'; 
                    }
                    mysql_free_result($selectSections);
                ?>
            </ul>
        </div>
        <div class="container-fluid">
            <h2 class="text-center all-tittles">Lista de estudantes</h2>
            <?php
                if(!$StudentN=="" || !$StudentS==""){
                    echo '<div class="table-responsive">
                        <div class="div-table" style="margin:0 !important;">
                            <div class="div-table-row div-table-row-list" style="background-color:#DFF0D8; font-weight:bold;">
                                <div class="div-table-cell" style="width: 6%;">#</div>
                                <div class="div-table-cell" style="width: 18%;">BI</div>
                                <div class="div-table-cell" style="width: 18%;">Sobrenome</div>
                                <div class="div-table-cell" style="width: 18%;">Nomes</div>
                                <div class="div-table-cell" style="width: 18%;">Seção</div>
                                <div class="div-table-cell" style="width: 9%;">Actualizar</div>
                                <div class="div-table-cell" style="width: 9%;">Eliminar</div>
                            </div>
                        </div>
                    </div>';
                }
                if(!$StudentN==""){
                    $selectStudentByName=executarSQL::consultar("SELECT * FROM estudiante WHERE Nome LIKE '%".$StudentN."%' ORDER BY Sobrenome ASC, Nome ASC");
                    if(mysql_num_rows($selectStudentByName)>0){
                        echo '<ul id="itemContainer" class="list-unstyled">';
                        $c=1;
                        while($dataSN=mysql_fetch_array($selectStudentByName)){
                            $seletSect=executarSQL::consultar("SELECT * FROM secao WHERE CodigoSecao='".$dataSN['CodigoSecao']."'");
                            $dataS=mysql_fetch_array($seletSect);
                            echo '<li>
                                <div class="table-responsive">
                                    <div class="div-table" style="margin:0 !important;">
                                        <div class="div-table-row div-table-row-list">
                                            <div class="div-table-cell" style="width: 6%;">'.$c.'</div>
                                            <div class="div-table-cell" style="width: 18%;">'.$dataSN['BI'].'</div>
                                            <div class="div-table-cell" style="width: 18%;">'.$dataSN['Sobrenome'].'</div>
                                            <div class="div-table-cell" style="width: 18%;">'.$dataSN['Nome'].'</div>
                                            <div class="div-table-cell" style="width: 18%;">'.$dataS['Nome'].'</div>
                                            <div class="div-table-cell" style="width: 9%;"><button class="btn btn-success btn-update" data-code="'.$dataSN['BI'].'" data-url="../process/SelectDataStudent.php"><i class="zmdi zmdi-refresh"></i></button></div>
                                            <form class="div-table-cell form_SRCB" action="../process/DeleteStudent.php" method="post" data-type-form="delete" style="width: 9%;">
                                                <input value="'.$dataSN['NIE'].'" type="hidden" name="primaryKey">
                                                <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>';
                            mysql_free_result($seletSect);
                            $c++;
                        }
                        echo '</ul><div class="holder"></div>';
                    }else{
                        echo '<br><br><br><h3 class="text-center all-tittles">Não há estudante registrado com os nomes "'.$StudentN.'"</h3><br><br>';
                    }
                    mysql_free_result($selectStudentByName);
                }else if(!$StudentS==""){
                    $selectStudentBySection=executarSQL::consultar("SELECT * FROM estudiante WHERE CodigoSecao='".$StudentS."' ORDER BY Sobrenome ASC, Nome ASC");
                    if(mysql_num_rows($selectStudentBySection)>0){
                        echo '<ul id="itemContainer" class="list-unstyled">';
                        $c=1;
                        while($dataSS=mysql_fetch_array($selectStudentBySection)){
                            $seletSect=executarSQL::consultar("SELECT * FROM secao WHERE CodigoSecao='".$dataSS['CodigoSecao']."'");
                            $dataSt=mysql_fetch_array($seletSect);
                            echo '<li>
                                <div class="table-responsive">
                                    <div class="div-table" style="margin:0 !important;">
                                        <div class="div-table-row div-table-row-list">
                                            <div class="div-table-cell" style="width: 6%;">'.$c.'</div>
                                            <div class="div-table-cell" style="width: 18%;">'.$dataSS['BI'].'</div>
                                            <div class="div-table-cell" style="width: 18%;">'.$dataSS['Sobrenome'].'</div>
                                            <div class="div-table-cell" style="width: 18%;">'.$dataSS['Nome'].'</div>
                                            <div class="div-table-cell" style="width: 18%;">'.$dataSt['Nome'].'</div>
                                            <div class="div-table-cell" style="width: 9%;"><button class="btn btn-success btn-update" data-code="'.$dataSS['NIE'].'" data-url="../process/SelectDataStudent.php"><i class="zmdi zmdi-refresh"></i></button></div>
                                            <form class="div-table-cell form_SRCB" action="../process/DeleteStudent.php" method="post" data-type-form="delete" style="width: 9%;">
                                                <input value="'.$dataSS['NIE'].'" type="hidden" name="primaryKey">
                                                <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>';
                            mysql_free_result($seletSect);
                            $c++;
                        }
                        echo '</ul><div class="holder"></div>';
                    }else{
                        echo '<br><br><br><h3 class="text-center all-tittles">Não há estudantes registrados nesta seção</h3><br><br>';
                    }
                    mysql_free_result($selectStudentBySection);
                }else{
                    echo '<br><br><br><h3 class="text-center all-tittles">Selecione uma seção ou procure por um estudante pelos seus nomes</h3><br><br>';
                }
            ?>
        </div>

</body>
</html>