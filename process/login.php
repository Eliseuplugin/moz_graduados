<?php 
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
include '../library/SED.php';
$UserType=consultasSQL::CleanStringText($_POST['UserType']);
$loginName=consultasSQL::CleanStringText($_POST['loginName']);
$loginPassword=consultasSQL::CleanStringText($_POST['loginPassword']);
$fecha=date("d-m-Y");
$hora=date("H:i:s");
$pass=SED::encryption($loginPassword);
if($UserType=="Estudante"){
	$key="BI";
	$table="estudante";
	$userN="Estudante";
}

if($UserType=="Graduado"){
	$key="BI";
	$table="graduado";
	$userN="Graduado";
}

if($UserType=="Estudante" || $UserType=="Graduado"){
	$consult="SELECT * FROM ".$table." WHERE nome_usuario COLLATE latin1_bin='$loginName'AND senha COLLATE latin1_bin='$pass'";
	$urlLocation='<script type="text/javascript">window.location="catalogo.php"; </scrpit>';
}


if($UserType=="Admin"){
	$key="CodigoAdmin";
	$userN="Administrador";
	$consult="SELECT * FROM administrador WHERE  nome_usuario COLLATE latin1_bin='$loginName'AND senha COLLATE latin1_bin='$pass' AND Estado=Ativo'";
	$urlLocation='<script type="text/javascript">window.location="home.php"; </scrpit>';
}

if($UserType!=""){
	$checkUser=executarSQL::consultar($consult);
	$fila=mysql_fetch_array($checkUser);
	if(mysql_num_rows($checkUser)>0){
		$selectBit=executarSQL::consultar("SELECT * FROM login");
		$total=mysql_num_rows($selectBit)+1;
		$longitud=4;
		for ($i=1; $i<=$longitud; $i++) { 
			$numero = rand(0,9);
			$codigo .= $numero;
		}
		mysql_free_result($selectBit);
		$codeBit="UK".$fila[$key]."N".$codigo."-".$total
			."";
			if(consultasSQL::InsertSQL("login", "Codigo,CodigoUsuario,Tipo,Senha,Entrar,Sair", "'".$codeBit."','".$fila[$key]."','$userN','$Senha','$hora','Sim registrar'")){
				$_SESSION['Username']=$fila['nome_usuario'];
				$_SESSION['UserPrivilege']=$UserType;
				$_SESSION['primaryKey']=$fila[$key];
				$_SESSION['codeBit']=$codeBit;
				$_SESSION['SessionToken']=md5(uniqid(mt_rand(), true));
				if($UserType=="Admin"){
					$_SESSION['CheckConfig']='unrevised';
				}
				echo $urlLocation;
			}else{
				echo '<script type="text/javascript">swal({
					    title:"Ocorreu um erro inesperado!",
					    text:"Nao pode iniciar a sessao por favor tente novamente",
					    type: "erro",
					    confirmButtonText: "Aceitar"});
					    </script>';	
			}
	}else{
		echo '<script type="text/javascript">swal({
					    title:"Os dados sao invalidos ou a a conta foi desativada!",
					    text:"Verifique seus dados e tente novamente, ou entre em contacto com a equipe tecnica",
					    type: "erro",
					    confirmButtonText: "Aceitar"});
					    </script>';	
	}else{
		echo '<script type="text/javascript">swal({
					    title:"Selecione o tipo de usuario",
					    text:"Deves selecionar o tipo de usuario para iniciar a sessao no sistema",
					    type: "erro",
					    confirmButtonText: "Aceitar"});
					    </script>';	
}

mysql_free_result($checkUser);