<?php require_once('Connections/ConexaoIdec.php'); ?>
<?php require_once('Connections/conexao.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE acesso_ao_sistema SET senha=%s WHERE id=%s",
                       GetSQLValueString($_POST['senha'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs_Acesso = "-1";
if (isset($_GET['id_Acesso'])) {
  $colname_rs_Acesso = $_GET['id_Acesso'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_Acesso = sprintf("SELECT * FROM acesso_ao_sistema WHERE id = %s", GetSQLValueString($colname_rs_Acesso, "int"));
$rs_Acesso = mysql_query($query_rs_Acesso, $ConexaoIdec) or die(mysql_error());
$row_rs_Acesso = mysql_fetch_assoc($rs_Acesso);
$totalRows_rs_Acesso = mysql_num_rows($rs_Acesso);
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

<div id="caixa_login">


<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="372" height="239" align="center">
    <tr>
      <td height="12" align="center">&nbsp;</td>
      <td height="12" align="left">Nome de Acesso:</td>
    </tr>
    <tr>
      <td height="35" align="center">&nbsp;</td>
      <td align="center"><label for="textfield5"></label>
        <input name="nome" type="text" id="textfield5" value="<?php echo $row_rs_Acesso['nome']; ?>" /></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="left">Nova Senha:</td>
    </tr>
    <tr>
      <td width="106">&nbsp;</td>
      <td width="254"><label for="senha"></label>
      <input name="senha" type="password" id="senha" value="<?php echo $row_rs_Acesso['senha']; ?>" /></td>
    </tr>
    <tr>
      <td height="54">&nbsp;</td>
      <td><input class="input" type="submit" name="button" value="MUDAR" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="id" type="hidden" id="id" value="<?php echo $row_rs_Acesso['id']; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="id_Acesso" type="hidden" id="id_Acesso" value="<?php echo $_SESSION['id']; ?>" /></td>
    </tr>
</table>
  <input type="hidden" name="MM_update" value="form1" />
</form>
</div>
</body>
</html>
<?php
mysql_free_result($rs_Acesso);
?>
