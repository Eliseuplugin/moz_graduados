<?php 
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
include '../library/SED.php';

$adminName=consultasSQL::CleanStringText($_POST['adminName']);
$adminUserName=consultasSQL::CleanStringText($_POST['adminUserName']);
$adminMail=consultasSQL::CleanStringText($_POST['adminMail']);
$adminPassword1=consultasSQL::CleanStringText($_POST['adminPassword1']);
$adminPassword2=consultasSQL::CleanStringText($_POST['adminPassword2']);
$adminState="Activo";
$checkAdmin=executarSQL::consultar("SELECT * FROM administrador");
$checktotal=mysql_num_rows($checkAdmin);
$numA=$checktotal+1;
$checEmpresa=executarSQL::consultar("SELECT * FROM administrador WHERE NomeUsuario='".$adminUserName."'");
$checkUsertotal=mysql_num_rows($checkUserName);
if($checkUsertotal<=0){
	$adminPassword1=SED::encryption($adminPassword1);
	if(consultasSQL::InsertSQL("administrador", "CodigoAdmin,Status, Nome, NomeUsuario,Senha,Email", "'$adminCode','$adminState','$adminName','$adminUserName','$adminPassword1','$adminMail'")){
		echo '<script type="text/javascript">
		swal({
			title:"Administrador registrado!",
			text:"Os dados do administrador foram armazenados correctamente",
			type: "success",
			confirmButtonText: "Aceitar"
		});
		$(".form_SRCB")[0].reset();
		</script>';
	}else{
		echo '<script type="text/javascript">
		swal({
			title:"Ocorreu um erro inesperado",
			text:"Nao pode-se registrar o administrador, por favor tente novamente",
			type: "error",
			confirmButtonText: "Aceitar"
		});
		</script>';
	}else{
		echo '<script type="text/javascript">
		swal({
			title:"Ocorreu um erro inesperado",
			text:"Introduziste um nome de administrador que ja esta sendo utilizado, por favor ingresse outro nome",
			type: "error",
			confirmButtonText: "Aceitar"
		});
		</script>';
	}else{
		echo '<script type="text/javascript">
		swal({
			title:"Ocorreu um erro inesperado",
			text:"As contrasenhas nao coincidem. Por favor ingresse novamente as contrasenhas",
			type: "error",
			confirmButtonText: "Aceitar"
		});
		</script>';
	}else{
		echo '<script type="text/javascript">
		swal({
			title:"Ocorreu um erro inesperado",
			text:"Introduziste um nome de administrador que ja esta sendo utilizado, por favor ingresse outro nome",
			type: "error",
			confirmButtonText: "Aceitar"
		});
		</script>';
	}else{
		echo '<script type="text/javascript">
		swal({
			title:"Ocorreu um erro inesperado",
			text:"Primeiro deves registrar os dados da empresa, veja a opcao Administracao e logo os Dados da Instituicao",
			type: "error",
			confirmButtonText: "Aceitar"
		});
		</script>';
	}
mysql_free_result($checEmpresa);
mysql_free_result($checkAdmin);
mysql_free_result($checkUserName);
