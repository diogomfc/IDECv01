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
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="341" height="140" align="center" style="background: url(../img/imgCertificadoEntregue.png) no-repeat;">
    <tr>
      <td align="center" valign="bottom"><table width="245">
        <tr>
          <td width="117"><a href="CertificadoSim.php?pg=todos&amp;func=SIM&amp;id=<?php echo $row_rs_matriculas['id']; ?>"><img src="../img/imgSim.png" alt="" width="102" height="47" /></a></td>
          <td width="116"><a href="CertificadoSim.php?pg=todos&amp;func=NAO&amp;id=<?php echo $row_rs_matriculas['id']; ?>"><img src="../img/imgNao.png" alt="" width="102" height="47" /></a></td>
        </tr>
      </table></td>
    </tr>
  </table>
  
</form>
</body>
</html>
<?php
mysql_free_result($rs_matriculas);
?>
