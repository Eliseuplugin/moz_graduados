 <?php
        session_start();
        $LinksRoute="./";
        include './inc/links.php'; 
        
    ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Inicio de Sessao</title>

    <link rel="stylesheet" href="css/login.css"/>
    <script src="js/SendForm.js"></script>
</head>
<body class="full-cover-background" style="background-image:url(assets/img/code.jpeg);">
    <div class="form-container">
        <p class="text-center" style="margin-top: 17px;">
           <i class="zmdi zmdi-account-circle zmdi-hc-5x"></i>
       </p>
       <h3 class="text-center all-tittles" style="margin-bottom: 30px;">E-Graduados</h3>
       <h4 class="text-center all-tittles" style="margin-bottom: 30px;">Digite os dados da sua conta</h4>
       <form action="process/login.php" method="post" class="form_SRCB" data-type-form="login" autocomplete="off">
            <div class="group-material-login">
              <input type="text" class="material-login-control"  name="loginName" required="" maxlength="70">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-account"></i> &nbsp; Nome</label>
            </div><br>
            <div class="group-material-login">
              <input type="password" class="material-login-control" name="loginPassword" required="" maxlength="70">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-lock"></i> &nbsp; Senha</label>
            </div>
            <div class="group-material">
                <select class="material-control-login" name="UserType">
                    <option value="" disabled="" selected="">Tipo de usuario</option>
                    <option value="Admin">Administrador</option>
                    <option value="Student">Estudante</option>
                    <option value="Graduado">Graduado</option> 
                </select>
            </div> 
            
            <button class="btn-login" type="submit">Entre no sistema &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>
        </form>

        <form action="fun_cadastrar.php" method="post" class="form_SRCB" data-type-form="login" autocomplete="off">
<<<<<<< HEAD
         <button class="btn-cad" type="submit" >Criar Conta &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>
=======
          <button class="btn-cad" type="submit">Criar Conta &nbsp; <i class="zmdi zmdi-arrow-left"></i></button>
>>>>>>> 7354fdd63ba1a1688b08fc4f2673f320e99d9598
        </form>

    </div>  
    <div class="msjFormSend hidden"></div>
</body>
</html>