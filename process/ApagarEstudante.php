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
	$selectAllLoansStud=executarSQL::consultar("SELECT * FROM emprestimoestudante WHERE BI='".$primaryKey."'");
	while ($dataAllLoans=mysql_fetch_array($selectAllLoansStud)) {
		if(consultasSQL::DeleteSQL("emprestimo", "CodigoEmprestimo='".$dataAllLoans['CodigoEmprestimo']."'")){
		}else{
			$totalErrors=$totalErrors+1;
		}
	}else{
		$totalErrors=$totalErrors+1;
	}
}
if($totalErrors<=0){
	if(consultasSQL::DeleteSQL("login", "CodigoUsuario='".$primaryKey."' AND Tipo='Estudante'")){
		if(consultasSQL::DeleteSQL("estudante", "BI='".$primaryKey."'")){
			if($NumRep>1){
				echo '<script type="text/javascript">swal({
					title:"Estudante eliminado",
					text:"Todos os dados dos alunos e empréstimos associados foram eliminados com sucesso do sistema",
					type: "success",
					confirmButtonText: "Aceitar"
				},
				function(isConfirm){
					if (isConfirm) {
						location.reload();
					} else {
						location.reload();
					}
				});
				</script>';
			}else{
				if(consultasSQL::DeleteSQL("gerente", "BI='".$KeyRep."'")){
					echo '<script type="text/javascript">
					swal({
						title:"Estudante eliminado!",
						text:"Todos os dados dos alunos e empréstimos associados foram eliminados com sucesso do sistema",
						type: "success",
						confirmButtonText:"Aceitar"
					},
					function(isConfirm){
						if (isConfirm)
							{
							location.reload();
						} else {
							location.reload();
						}
					});
					</script>';
				}else{
					echo '<script type="text/javascript">
					swal({
						title:"Estudante eliminado!",
						text:"Os dados do aluno foram excluídos, no entanto, alguns dados não podem ser removidos do sistema",
						type: "success",
						confirmButtonText:"Aceitar"
					},
					function(isConfirm){
						if (isConfirm)
							{
							location.reload();
						} else {
							location.reload();
						}
					});
					</script>';
				}else{
					echo '<script type="text/javascript">
					swal({
						title:"Ocorreu um erro inesperado!",
						text:"Não conseguimos apagar os dados do aluno, tente novamente",
						type: "success",
						confirmButtonText:"Aceitar"
					},
					function(isConfirm){
						if (isConfirm)
							{
							location.reload();
						} else {
							location.reload();
						}
					});
					</script>';
				}else {
					echo '<script type="text/javascript">
					swal({
						title:"Ocorreu um erro inesperado!",
						text:"Não conseguimos apagar os dados do aluno, tente novamente",
						type: "success",
						confirmButtonText:"Aceitar"
					},
					function(isConfirm){
						if (isConfirm)
							{
							location.reload();
						} else {
							location.reload();
						}
					});
					</script>';
				}else{
					echo '<script type="text/javascript">
                    swal({ 
                        title:"Ocorreu um erro inesperado!", 
                        text:"Não conseguimos apagar os dados do aluno, tente novamente", 
                        type: "error", 
                        confirmButtonText: "Aceitar" 
                    });
                </script>';
            }else{
            	echo '<script type="text/javascript">
            swal({ 
                title:"Ocorreu um erro inesperado!", 
                text:"Não conseguimos apagar os dados do aluno, tente novamente", 
                type: "error", 
                confirmButtonText: "Aceitar" 
            });
        </script>'; 
    }
}else{
    echo '<script type="text/javascript">
        swal({ 
            title:"Ocorreu um erro inesperado!", 
            text:"O aluno tem empréstimos pendentes, os dados do aluno não podem ser excluídos enquanto os livros não são devolvidos", 
            type: "error", 
            confirmButtonText: "Aceitar" 
        });
    </script>';

}
mysql_free_result($selectStu);
mysql_free_result($selectRepre);
mysql_free_result($selectAllLoansStud);