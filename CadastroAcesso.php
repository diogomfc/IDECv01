<?php require_once('Connections/ConexaoIdec.php'); ?>
<?php require_once('Connections/conexao.php'); ?>

<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nome = "Administrador";


// Verifica se não há a variável da sessão que identifica o usuário
if ($_SESSION['nome'] != $nome ) {
	
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: index.php"); exit;
}

?>



<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO acesso_ao_sistema (status, code, senha, nome, painel) VALUES ('ativo', %s, %s, %s, 'admin')",
                       GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['senha'], "text"),
                       GetSQLValueString($_POST['nome'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_AcessoSistema = "SELECT * FROM acesso_ao_sistema";
$rs_AcessoSistema = mysql_query($query_rs_AcessoSistema, $ConexaoIdec) or die(mysql_error());
$row_rs_AcessoSistema = mysql_fetch_assoc($rs_AcessoSistema);
$totalRows_rs_AcessoSistema = mysql_num_rows($rs_AcessoSistema);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IDEC -  Intermedia&ccedil;&atilde;o da Educa&ccedil;&atilde;o Cultural</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="Img/iconIdec.png" />

</head>

<body>
<div id="logo">
<img src="Img/logoidec.png">
</div>

<div id="caixa_loginCadastro">


<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <table width="406" height="212" align="center">
    <tr>
      <td height="5" align="center">CADASTRAR NOVO ACESSO</td>
    </tr>
    <tr>
      <td height="5" align="left">Nome:</td>
    </tr>
    <tr>
      <td height="35" align="center"><label for="textfield5"></label>
        <input name="nome" type="text" id="textfield5" /></td>
    </tr>
    <tr>
      <td align="left">CPF:</td>
    </tr>
    <tr>
      <td width="398"><label for="code"></label>
        <input type="text" name="code" id="code" />        
        <label for="senha"></label></td>
    </tr>
    <tr>
      <td height="19">Senha:</td>
    </tr>
    <tr>
      <td><input name="senha" type="password" id="senha" /></td>
    </tr>
    <tr>
      <td><input class="input" type="submit" name="button" value="CADASTRAR" /></td>
    </tr>
</table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

</div>
</body>
</html>
<?php
mysql_free_result($rs_AcessoSistema);
?>
