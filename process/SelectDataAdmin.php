<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$codeAdmin=consultasSQL::CleanStringText($_POST['code']);
$selectAdmin=ejecutarSQL::consultar("SELECT * FROM administrador WHERE CodigoAdmin='$codeAdmin'");
$dataAdmin=mysql_fetch_array($selectAdmin);
if(mysql_num_rows($selectAdmin)>=1){
    echo '
    <legend><strong>Informação do administrador</strong></legend><br>
    <input type="hidden" value="'.$dataAdmin["CodigoAdmin"].'" name="codeAdmin">
    <div class="group-material"> 
    <input type="text" class="material-control tooltips-general" value="'.$dataAdmin["Nome"].'" name="adminName" required="" maxlength="70" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,70}" data-toggle="tooltip" data-placement="top" title="Escreva o nome do administrador">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Nome completo</label>
    </div>
    <input type="hidden" value="'.$dataAdmin["NomeUsuario"].'" name"adminUserNameOld" >
    <div class="group-material">
        <input type="text" class="material-control tooltips-general input-check-user2" value="'.$dataAdmin["NomeUsuario"].'" name="adminUserName" data-user="Admin" required="" maxlength="20" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,20}" data-toggle="tooltip" data-placement="top" title="Escreva o nome do administrador">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Nome completo</label>
    </div>
    <input type="hidden" value="'.$dataAdmin["NombreUsuario"].'" name="adminUserNameOld" >
    <div class="group-material">
        <input type="text" class="material-control tooltips-general input-check-user2" value="'.$dataAdmin["NombreUsuario"].'" name="adminUserName" data-user="Admin" required="" maxlength="20" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,20}" data-toggle="tooltip" data-placement="top" title="Escreva um nome de usuário sem espaços, que será usado para fazer login">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Nome de usuario</label>
        <div class="check-user-bd2"></div>
    </div>
    <div class="group-material">
        <input type="email" class="material-control tooltips-general" value="'.$dataAdmin["Email"].'" name="adminMail" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escreva o e-mail do administrador">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Email</label>
    </div>
    <legend><strong>Mudança de senha
</strong></legend>
    <p><strong>Não é necessário alterar a senha, no entanto, se você quiser alterá-la, deve preencher os seguintes campos</strong></p><br>
    <div class="group-material">
        <input type="password" class="material-control tooltips-general" placeholder="Senha" name="adminPassword1" maxlength="200" data-toggle="tooltip" data-placement="top" title="Escreva uma senha">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Nova senha</label>
    </div>
    <div class="group-material">
        <input type="password" class="material-control tooltips-general" placeholder="Repita a senha" name="adminPassword2" maxlength="200" data-toggle="tooltip" data-placement="top" title="Repita a senha">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Repita a senha</label>
    </div>
    <script>
        $(document).ready(function(){
            $(".input-check-user2").keyup(function(){
                var userType=$(this).attr("data-user");
                var userName=$(this).val();
                $.ajax({
                    url:"../process/check-user.php?userName="+userName+"&&userType="+userType,
                    success:function(data){
                       $(".check-user-bd2").html(data);
                    }
                });
            });
        });
    </script>';
}else{
    echo '<div class="alert alert-danger text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Error!:</strong> Desculpe, ocorreu um erro.</div>';
}
mysql_free_result($codeAdmin);