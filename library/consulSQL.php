<?php 
error_reporting(E_PARSE);
/**
* 
*/
class executarSQL{
	public static function conectar(){
		if(!$con= mysql_connect(SERVER,USER,PASS)){
			die("Erro em acessar o servidor, verifique os seus dados");
		}
		if (!mysql_select_db(BD)) {
			die("Erro ao conectar com a base de dados, verifique o nome da base de dados");
		}
		mysql_set_charset('utf8',$con);
		return $con;

	}
	public static function consultar($query){
		mysql_query("SET AUTOCOMMIT=0;", executarSQL::conectar());
		mysql_query("BEGIN;", executarSQL::conectar());
		if (!$consul = mysql_query($query, executarSQL::conectar())) {
			die(mysql_error().'Erro na consulta SQL executada ');
			mysql_query("ROOLBACK;", executarSQL::conectar());

		}else{
			mysql_query("COMMIT;", executarSQL::conectar());
		}
		return $consul;

	}
} 


class consultasSQL{
	public static function limparCampo($valor) {
		$valor = str_ireplace("<script>", "", $valor);
		$valor = str_ireplace("</script>", "", $valor);
		$valor = str_ireplace("--", "", $valor);
		$valor = str_ireplace("^", "", $valor);
		$valor = str_ireplace("[", "", $valor);
		$valor = str_ireplace("]", "", $valor);
		$valor = str_ireplace("\\", "", $valor);
		$valor = str_ireplace("=", "", $valor);
		return $valor;
	}
	public static function CleanStringText($val) {
		$data = addcslashes($val);
		$dados = consultasSQL::limparCampo($data);
		return $dados;
	}
	public static function InsertSQL($tabela, $campos, $valores) {
		if (!$consul = executarSQL::consultar("INSERT INTO $tabela ($campos) VALUES($valores)")) {
			die("Ocorreu um erro ao guardar os dados");
		}
		return $consul;
	}
	public static function DeleteSQL($tabela, $condicao)
	{
		if (!$consul = executarSQL::consultar("DELETE FROM $tabela WHERE $condicao")) {
			die("Ocorreu um erro ao eliminar os dados");
		}
		return $consul;
	}

	public static function UpdateSQL($tabela, $campos, $condicao)
	{
		if (!$consul = executarSQL::consultar("UPDATE $ tabela SET $campos WHERE $condicao")) {
			die("Ocorreu um erro ao atualizar os dados");
		}
		return $consul;
	}
}