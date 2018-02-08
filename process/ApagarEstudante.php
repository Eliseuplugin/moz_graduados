<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$primaryKey=consultasSQL::CleanStringText($_POST['primaryKey']);
$selectStu=executarSQL::consultar("SELECT * FROM estudante WHERE BI='".$primaryKey."'");
$dataStudent=mysql_fetch_array($selectStu);
$totalRepre=executarSQL::consultar("SELECT * FROM estudante WHERE BI='".$dataStudent['BI']."'");
$NumRep=mysql_num_rows($totalRepre);
$KeyRep=$dataStudent['BI'];
$selectAllLoansS=executarSQL::consultar("SELECT * FROM emprestimoestudante WHERE BI='".$primaryKey."'");
$totalP=0;
while ($rowA=mysql_fetch_array($selectAllLoansS)) {
	$seletLP=executarSQL::consultar("SELECT * FROM emprestimo WHERE CodigoEmprestimo='".$rowA['CodigoEmprestimo']."' AND status='Emprestimo'");
	if(mysql_num_rows($seletLP)>0){
		$totalP=$totalP+1;
	}
	mysql_free_result($seletLP);
}
if($totalP<=0){
	$totalErrors=0;
	$selectAllLoansStud=executarSQL::consultar("SELECT ")
}