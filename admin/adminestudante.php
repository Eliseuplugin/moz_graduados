<!DOCTYPE html>
<html lang="pt">
<head>
	<title>Estudantes</title>
	<?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php'; 
    ?>
    <script src="../js/SendForm.js"></script>
    <script>
        $().ready(function(){
            $(".check-representative").keyup(function(){
              $.ajax({
                url:"../process/check-representative.php?DUI="+$(this).val(),
                success:function(data){
                  $(".representative-resul").html(data);
                }
              });
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
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php 
            include '../inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema bibliotecario <small>Administracao de Usuarios</small></h1>
            </div>
        </div>
        <div class="conteiner-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
              <li role="presentation"><a href="adminuser.php">Administradores</a></li>
              <!-- <li role="presentation"><a href="adminteacher.php">Docentes</a></li> -->
              <li role="presentation"  class="active"><a href="adminstudent.php">Estudantes</a></li>
              <li role="presentation"><a href="adminpersonal.php">Pessoal administrativo</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user03.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bem-vindo à seção para registrar novos alunos, para registrar um aluno, você deve preencher todos os campos do seguinte formulário
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                      <li class="active">Novo estudante</li>
                      <li><a href="adminliststudent.php">Lista de estudantes</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Registrar um novo estudante</div>
                <form action="../process/AddStudent.php" method="post" class="form_SRCB" data-type-form="save" autocomplete="off">
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                           <?php
                                $checkTeacherSection=ejecutarSQL::consultar("SELECT * FROM docente");
                                if(mysql_num_rows($checkTeacherSection)<=0){
                                    echo '<br><div class="alert alert-danger text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante!:</strong> Você não pode registrar estudantes, você deve primeiro adicionar professores ao sistema</div>';
                                }
                            ?>
                           <legend>Dados do aluno</legend><br>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escreva aqui o NUMERO DE PROCESSO do estudante" name="studentNIE" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="NUMERO DE PROCESSO do estudante">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>NUMERO DE PROCESSO</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escreva aqui o nome do aluno" name="studentName" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" maxlength="50" data-toggle="tooltip" data-placement="top" title="Nome do aluno">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nome</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escreva aqui o sobrenome do aluno" name="studentSurname" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" maxlength="50" data-toggle="tooltip" data-placement="top" title="Sobrenome do estudante">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Sobrenome</label>
                            </div>
                           <div class="group-material">
                                <span>Seção</span>
                                <select class="material-control tooltips-general" name="studentSection" data-toggle="tooltip" data-placement="top" title="Escolha a seção a que o aluno pertence">
                                    <option value="" disabled="" selected="">Selecione uma seção</option>
                                    <?php
                                        
                                        if(mysql_num_rows($checkTeacherSection)>0){
                                            while($fila=mysql_fetch_array($checkTeacherSection)){
                                                $checkStudentSection=ejecutarSQL::consultar("select * from seccion where CodigoSeccion='".$fila['CodigoSeccion']."' order by Nombre");
                                                $row=mysql_fetch_array($checkStudentSection);
                                                echo '<option value="'.$row['CodigoSeccion'].'">'.$row['Nombre'].'</option>';
                                                mysql_free_result($checkStudentSection);
                                            }
                                        }
                                        mysql_free_result($checkTeacherSection);
                                    ?>
                                </select>
                            </div>
                            <legend>Dados do gerente</legend><br>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Parentesco" name="representativeRelationship" required="" pattern="[a-zA-ZéíóúáñÑ ]{1,30}" maxlength="30" data-toggle="tooltip" data-placement="top" title="Parentesco">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Parentesco</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general check-representative" placeholder="Escreva aqui o número de BI do gerente" name="representativeDUI" pattern="[0-9-]{1,10}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Apenas números e hifens, 10 dígitos">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Número de BI do gerente</label>
                            </div>
                            <div class="full-reset representative-resul"></div>
                            <legend>Informação da conta <small>(Para entrar no sistema)</small></legend><br>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general input-check-user" data-user="Student" placeholder="Nome de usuario" name="UserName" required="" maxlength="20" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,20}" data-toggle="tooltip" data-placement="top" title="Escreva um nome de usuário sem espaços, que será usado para fazer login">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nome de usuario</label>
                                <div class="check-user-bd"></div>
                           </div>
                           <div class="group-material">
                                <input type="password" class="material-control tooltips-general" placeholder="Senha" name="Password1" required="" maxlength="200" data-toggle="tooltip" data-placement="top" title="Escreva uma senha">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Senha</label>
                            </div>
                           <div class="group-material">
                                <input type="password" class="material-control tooltips-general" placeholder="Repita a senha" name="Password2" required="" maxlength="200" data-toggle="tooltip" data-placement="top" title="Repita a senha">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Repetir a senha
</label>
                           </div>
                            <p class="text-center">
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpar</button>
                                <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                            </p> 
                       </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="msjFormSend"></div>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Ajuda do sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include '../help/help-adminstudent.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acordo</button>
                </div>
            </div>
          </div>
        </div>
        <?php include '../inc/footer.php'; ?>
    </div>
		
</body>
</html>