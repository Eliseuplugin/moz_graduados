<?php 
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$primaryKey=consultasSQL::CleanStringText($_POST['primaryKey']);
if(consultasSQL::UpdateSQL("administrador", "Status='Desativado'", "CodigoAdmin='$primaryKey'"))
	{
		echo '<script type="text/javascript"> $(document).ready(function(){swal({
			title:"Conta desativada!",
			text:"A conta de administrador foi desativada com sucesso",
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
            });
        </script>'; 
	}else{
    echo '<script type="text/javascript">
        swal({ 
            title:"Ocorreu um erro inesperado!", 
            text:"A conta de administrador não pôde ser desativada, tente novamente", 
            type: "error", 
            confirmButtonText: "Aceitar" 
        });
    </script>';
}