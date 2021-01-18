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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE idec_matriculas SET dataEntrega=%s WHERE id=%s",
                       GetSQLValueString($_POST['dataEntrega'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($updateSQL, $ConexaoIdec) or die(mysql_error());
}

$colname_rs_matriculas = "-1";
if (isset($_GET['id'])) {
  $colname_rs_matriculas = $_GET['id'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_matriculas = sprintf("SELECT * FROM idec_matriculas WHERE id = %s", GetSQLValueString($colname_rs_matriculas, "int"));
$rs_matriculas = mysql_query($query_rs_matriculas, $ConexaoIdec) or die(mysql_error());
$row_rs_matriculas = mysql_fetch_assoc($rs_matriculas);
$totalRows_rs_matriculas = mysql_num_rows($rs_matriculas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.Fdata {	font-family: Calibri;
}
</style>
</head>

<body>
<table width="341" height="175" align="center" style="background: url(../img/imgCertificadoEntregueOK.png) no-repeat; text-align: right; font-family: Calibri; font-size: 20px;">
  <tr>
    <td align="center" valign="bottom">
    
    
    
    <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <table width="283">
        <tr>
          <td width="61" align="center"><input name="id" type="hidden" id="id" value="<?php echo $row_rs_matriculas['id']; ?>" /></td>
          <td width="210" align="center"><span class="Fdata">DATA DA ENTREGA:</span></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center"><input name="dataEntrega" type="text" id="dataEntrega" size="15" />
            <input type="submit" name="button" id="button" value="OK" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
    </form></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rs_matriculas);
?>
