<?php require_once('../Connections/ConexaoIdec.php'); ?>
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

if ((isset($_POST['id'])) && ($_POST['id'] != "") && (isset($_GET['id']))) {
  $deleteSQL = sprintf("DELETE FROM idec_abrirturmas WHERE id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($deleteSQL, $ConexaoIdec) or die(mysql_error());

  $deleteGoTo = "../admin/turmas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_Recordset1 = sprintf("SELECT * FROM idec_abrirturmas WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $ConexaoIdec) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/iconIdec.png" />
<style type="text/css">
#form1 table tr td {
	font-family: Calibri;
	color: #000;
	font-weight: bold;
	font-size: 24px;
	text-align: center;
}
#form1 table tr td table tr td {
	text-align: center;
}
</style>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
</head>

<body>
<table width="1011" height="134" border="0" align="center" style="background: url(../img/TopoIdec.png) no-repeat; font-family: Calibri; font-size: 15px; color: #5080D8; font-weight: bold;">
  <tr>
    <td height="130">&nbsp;</td>
  </tr>
</table>
<table width="1016" height="246" border="0" align="center" style="background:url(../img/imgFundoExcluirTurmas.png) no-repeat">
  <tr>
    <td width="978" height="242"><form id="form1" name="form1" method="post" action="">
      <table width="549" height="213" align="center">
        <tr>
          <td height="181" colspan="3"><p>Tem certeza que deseja excluir essa TURMA:
            </p>
            <p><?php echo $row_Recordset1['polos']; ?></p>
            <p><?php echo date('d/m/Y', strtotime($row_Recordset1['dataInicio']));?> - <?php echo date('d/m/Y', strtotime($row_Recordset1['dataFinal']));?></p></td>
        </tr>
        <tr>
          <td width="219" height="24"><input name="id" type="hidden" id="id" value="<?php echo $row_Recordset1['id']; ?>" /></td>
          <td width="98"><input type="submit" name="button" id="button" value="SIM" />
            <input name="button2" type="submit" id="button2" onclick="MM_goToURL('parent','../admin/turmas.php');return document.MM_returnValue" value="NÃO" /></td>
          <td width="216">&nbsp;</td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<table width="148" align="center">
  <tr>
    <td width="140" class="rodape">AVANTE INFORMÀTICA</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
