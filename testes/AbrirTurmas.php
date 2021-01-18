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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO idec_abrirturmas (polos, turma, dataInicio, dataFinal) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['polos'], "text"),
                       GetSQLValueString($_POST['turma'], "text"),
                       GetSQLValueString($_POST['dataInicio'], "date"),
                       GetSQLValueString($_POST['dataFinal'], "date"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($insertSQL, $ConexaoIdec) or die(mysql_error());

  $insertGoTo = "turmas1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_RS_TURMAS = "SELECT * FROM idec_abrirturmas";
$RS_TURMAS = mysql_query($query_RS_TURMAS, $ConexaoIdec) or die(mysql_error());
$row_RS_TURMAS = mysql_fetch_assoc($RS_TURMAS);
$totalRows_RS_TURMAS = mysql_num_rows($RS_TURMAS);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_polos = "SELECT * FROM idec_polos";
$rs_polos = mysql_query($query_rs_polos, $ConexaoIdec) or die(mysql_error());
$row_rs_polos = mysql_fetch_assoc($rs_polos);
$totalRows_rs_polos = mysql_num_rows($rs_polos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="1052" align="center">
  <tr>
    <th colspan="6" scope="col"><img src="../img/TopoIdec.png" width="1008" height="124" /></th>
  </tr>
  <tr>
    <td width="23">&nbsp;</td>
    <td width="168"><a href="indexteste.php"><img src="../img/btHomer.png" width="168" height="25" /></a></td>
    <td width="250"><a href="../admin/turmas.php"><img src="../img/btPesquisar.png" width="200" height="25" /></a></td>
    <td width="220">&nbsp;</td>
    <td width="179">&nbsp;</td>
    <td width="184">&nbsp;</td>
  </tr>
  <tr>
    <td height="102" colspan="6" align="center"><table width="996" height="168" border="0" align="center" style="background: url(../img/imgFundoCadastroPolos.png) no-repeat; font-family: Calibri; font-weight: bold;">
      <tr>
        <td height="115"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="971" height="94" align="center">
<tr>
<td width="52" height="28">Polos:</td>
<td width="169"><label for="textfield"></label>
  <label for="polos"></label>
  <select name="polos" id="polos">
    <?php
do {  
?>
    <option value="<?php echo $row_rs_polos['polos']?>"<?php if (!(strcmp($row_rs_polos['polos'], $row_rs_polos['polos']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_polos['polos']?></option>
    <?php
} while ($row_rs_polos = mysql_fetch_assoc($rs_polos));
  $rows = mysql_num_rows($rs_polos);
  if($rows > 0) {
      mysql_data_seek($rs_polos, 0);
	  $row_rs_polos = mysql_fetch_assoc($rs_polos);
  }
?>
  </select></td>
<td width="62">Turma:</td>
<td width="58"><label for="dataInicio"></label>
  <label for="turma"></label>
  <select name="turma" size="1" id="turma">
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
    <option value="D">D</option>
    <option value="E">E</option>
    <option value="F">F</option>
    <option value="G">G</option>
    <option value="H">H</option>
    <option value="I">I</option>
    <option value="J">J</option>
  </select></td>
<td width="96">Data Inicio:</td>
<td width="168"><label for="dataInicio"></label>
  <input type="text" name="dataInicio" id="dataInicio" /></td>
<td width="89">Data final:</td>
<td width="241"><label for="dataFinal"></label>
  <input type="text" name="dataFinal" id="dataFinal" /></td>
</tr>
<tr>
  <td height="27">&nbsp;</td>
  <td colspan="7">&nbsp;</td>
</tr>
<tr>
  <td height="29">&nbsp;</td>
  <td colspan="7"><input type="submit" name="button" id="button" value="Abrir Turma" /></td>
</tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" /> 
        
        </form>
        </td>
      </tr>
    </table>      </p></td>
  </tr>
  <tr>
    <td height="31" colspan="6"></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($RS_TURMAS);

mysql_free_result($rs_polos);
?>
