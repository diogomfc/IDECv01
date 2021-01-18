<?php require_once('../../Connections/conexao_relatoria_boletos.php'); ?>
<?php require_once('../../Connections/conexao_relatoria_boletos.php'); ?>
<?php require_once('../../Connections/conexao_relatoria_boletos.php'); ?>
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

mysql_select_db($database_conexao_relatoria_boletos, $conexao_relatoria_boletos);
$query_rs_boletos = "SELECT * FROM boletos";
$rs_boletos = mysql_query($query_rs_boletos, $conexao_relatoria_boletos) or die(mysql_error());
$row_rs_boletos = mysql_fetch_assoc($rs_boletos);
$totalRows_rs_boletos = mysql_num_rows($rs_boletos);

mysql_select_db($database_conexao_relatoria_boletos, $conexao_relatoria_boletos);
$query_rs_clientes = "SELECT * FROM clientes";
$rs_clientes = mysql_query($query_rs_clientes, $conexao_relatoria_boletos) or die(mysql_error());
$row_rs_clientes = mysql_fetch_assoc($rs_clientes);
$totalRows_rs_clientes = mysql_num_rows($rs_clientes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="1082" align="center">
  <tr>
    <td width="17">&nbsp;</td>
    <td width="330">Nome Estudante:</td>
    <td width="222">Curso:</td>
    <td width="201">VENCIMENTO</td>
    <td width="153">VALOR</td>
    <td width="116">Estatus</td>
    <td width="11">&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td>
      <input name="input" type="hidden" value="<?php echo $IDclientes = $row_rs_boletos['Id_cliente']; ?>" /></td>
       <input name="input" type="hidden" value="<?php echo $situacao = $row_rs_boletos['Situacao']; ?>" />
	   <?php $sql_3 = mysql_query("SELECT * FROM clientes WHERE id = '$IDclientes'"); ?>
              <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
      <td><?php echo $res_3['Nome']; ?></td>
      <?php } ?>
      <td><?php echo $row_rs_boletos['Referente']; ?></td>
      <td><?php echo $row_rs_boletos['Vencimento']; ?></td>
      <td><?php echo $row_rs_boletos['Valor']; ?></td>
      <td><?php  
     switch($situacao)
 {
     case 1 : 
         echo "<b><font color='#FF9900'>EM ABERTO </font></b>";
     break;
     case 2 : 
         echo "<b><font color='#009900'>QUITADO </font></b>";
     break;
     case 3 : 
        echo "<b><font color='#FF0000'>VENCIDA </font></b>";
     break;
     default: "echo nenhum";
 }
?></td>
      <td>&nbsp;</td>
    </tr>
    <?php } while ($row_rs_boletos = mysql_fetch_assoc($rs_boletos)); ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rs_boletos);

mysql_free_result($rs_clientes);
?>
