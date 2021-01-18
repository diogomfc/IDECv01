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

if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM idec_estudantes WHERE id=%s",
                       GetSQLValueString($_POST['id'], "text"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($deleteSQL, $ConexaoIdec) or die(mysql_error());

  $deleteGoTo = "../admin/estudante1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_POST['code'])) && ($_POST['code'] != "")) {
  $deleteSQL = sprintf("DELETE FROM idec_matriculas WHERE estudante_id=%s",
                       GetSQLValueString($_POST['code'], "text"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($deleteSQL, $ConexaoIdec) or die(mysql_error());
}

$colname_rs_estudante = "-1";
if (isset($_GET['id'])) {
  $colname_rs_estudante = $_GET['id'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_estudante = sprintf("SELECT * FROM idec_estudantes WHERE id = %s", GetSQLValueString($colname_rs_estudante, "int"));
$rs_estudante = mysql_query($query_rs_estudante, $ConexaoIdec) or die(mysql_error());
$row_rs_estudante = mysql_fetch_assoc($rs_estudante);
$totalRows_rs_estudante = mysql_num_rows($rs_estudante);

$colname_rs_matriculas = "-1";
if (isset($_POST['code'])) {
  $colname_rs_matriculas = $_POST['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_matriculas = sprintf("SELECT * FROM idec_matriculas WHERE estudante_id = %s", GetSQLValueString($colname_rs_matriculas, "text"));
$rs_matriculas = mysql_query($query_rs_matriculas, $ConexaoIdec) or die(mysql_error());
$row_rs_matriculas = mysql_fetch_assoc($rs_matriculas);
$totalRows_rs_matriculas = mysql_num_rows($rs_matriculas);





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
<table width="1016" height="246" border="0" align="center" style="background:url(../img/imgFundoExcluirEstudante.png) no-repeat">
  <tr>
    <td width="978" height="242"><form id="form1" name="form1" method="post" action="">
      <table width="549" height="213" align="center">
        <tr>
          <td height="181" colspan="3"><p>Tem certeza que deseja excluir esse ESTUDANTE:</p>
            <p><?php echo $row_rs_estudante['nome']; ?></p>
            <p></p></td>
        </tr>
        <tr>
          <td width="179" height="24"><input name="id" type="hidden" id="id" value="<?php echo $row_rs_estudante['id']; ?>" />
            <input name="code" type="hidden" id="code" value="<?php echo $row_rs_estudante['code']; ?>" /></td>
          <td width="211"><input type="submit" name="button" id="button" value="SIM" />
            <input name="button2" type="submit" id="button2" onclick="MM_goToURL('parent','../admin/estudante1.php');return document.MM_returnValue" value="NÃO" /></td>
          <td width="143">&nbsp;</td>
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
mysql_free_result($rs_estudante);

mysql_free_result($rs_matriculas);
?>
