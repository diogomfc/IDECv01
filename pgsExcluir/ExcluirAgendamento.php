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
  $deleteSQL = sprintf("DELETE FROM idec_agendamentoprofessor WHERE id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($deleteSQL, $ConexaoIdec) or die(mysql_error());

  $deleteGoTo = "../admin/agendamentoAulas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_rs_AgAulas = "-1";
if (isset($_GET['id'])) {
  $colname_rs_AgAulas = $_GET['id'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_AgAulas = sprintf("SELECT * FROM idec_agendamentoprofessor WHERE id = %s", GetSQLValueString($colname_rs_AgAulas, "int"));
$rs_AgAulas = mysql_query($query_rs_AgAulas, $ConexaoIdec) or die(mysql_error());
$row_rs_AgAulas = mysql_fetch_assoc($rs_AgAulas);
$totalRows_rs_AgAulas = mysql_num_rows($rs_AgAulas);
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
<table width="1016" height="246" border="0" align="center" style="background:url(../img/imgFundoExcluirAgendamento.png) no-repeat">
  <tr>
    <td width="978" height="242"><form id="form1" name="form1" method="post" action="">
      <table width="653" height="197" align="center">
        <tr>
          <td height="14" colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td height="15" colspan="3"><p>Tem certeza que deseja excluir esse AGENDAMENTO:</p></td>
        </tr>
        <tr>
          <td height="31" colspan="3"><?php echo $row_rs_AgAulas['professor']; ?></td>
        </tr>
        <tr>
          <td height="33" colspan="3" align="left">Data: <?php echo date('d/m/Y', strtotime($row_rs_AgAulas['data']));?></td>
          </tr>
        <tr>
          <td height="31" colspan="3">Das: <?php echo $row_rs_AgAulas['horario']; ?> às <?php echo $row_rs_AgAulas['horario1']; ?></td>
        </tr>
        <tr>
          <input name="idpolos" type="hidden" value="<?php echo $ids_turmas = $row_rs_AgAulas['turma']; ?>" />
		  <?php $sql_3 = mysql_query("SELECT * FROM idec_abrirturmas WHERE id = '$ids_turmas'"); ?>
              <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
          <td height="31" colspan="3">Turma: <?php echo $res_3['polos']; ?></td>
        <?php } ?>
        </tr>
        <tr>
          <td width="195" height="24"><input name="id" type="hidden" id="id" value="<?php echo $row_rs_AgAulas['id']; ?>" /></td>
          <td width="229"><input type="submit" name="button" id="button" value="SIM" />
            <input name="button2" type="submit" id="button2" onclick="MM_goToURL('parent','../admin/agendamentoAulas.php');return document.MM_returnValue" value="NÃO" /></td>
          <td width="186">&nbsp;</td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_AgAulas);
?>
