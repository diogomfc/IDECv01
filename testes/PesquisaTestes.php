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

$maxRows_RSMAT = 10;
$pageNum_RSMAT = 0;
if (isset($_GET['pageNum_RSMAT'])) {
  $pageNum_RSMAT = $_GET['pageNum_RSMAT'];
}
$startRow_RSMAT = $pageNum_RSMAT * $maxRows_RSMAT;

$colname_RSMAT = "-1";
if (isset($_GET['code'])) {
  $colname_RSMAT = $_GET['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_RSMAT = sprintf("SELECT * FROM idec_matriculas WHERE estudante_id = %s", GetSQLValueString($colname_RSMAT, "text"));
$query_limit_RSMAT = sprintf("%s LIMIT %d, %d", $query_RSMAT, $startRow_RSMAT, $maxRows_RSMAT);
$RSMAT = mysql_query($query_limit_RSMAT, $ConexaoIdec) or die(mysql_error());
$row_RSMAT = mysql_fetch_assoc($RSMAT);

if (isset($_GET['totalRows_RSMAT'])) {
  $totalRows_RSMAT = $_GET['totalRows_RSMAT'];
} else {
  $all_RSMAT = mysql_query($query_RSMAT);
  $totalRows_RSMAT = mysql_num_rows($all_RSMAT);
}
$totalPages_RSMAT = ceil($totalRows_RSMAT/$maxRows_RSMAT)-1;

$colname_RSESTD = "-1";
if (isset($_GET['code'])) {
  $colname_RSESTD = $_GET['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_RSESTD = sprintf("SELECT * FROM idec_estudantes WHERE code = %s", GetSQLValueString($colname_RSESTD, "text"));
$RSESTD = mysql_query($query_RSESTD, $ConexaoIdec) or die(mysql_error());
$row_RSESTD = mysql_fetch_assoc($RSESTD);
$totalRows_RSESTD = mysql_num_rows($RSESTD);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="0">

  <?php do { ?>
  <tr>
    <td width="172" style="text-align:right;" span>ESTUDANTE</td>
    <td width="793"><?php echo $row_RSESTD['nome']; ?> <?php echo $row_RSESTD['code']; ?>
      <form id="form1" name="form1" method="post" action="">
        <input name="code" type="hidden" id="code" value="<?php echo $row_RSESTD['code']; ?>" />
      </form></td>
  </tr>
  <tr>
    <td width="172" style="text-align:right;" span>MATRÍCULA:</td>
    <td><?php echo $row_RSMAT['cod']; ?></td>
  </tr>
  <tr>
    <td span style="text-align:right;">CURSO:</td>
    <td><?php echo $row_RSMAT['id_curso']; ?></td>
  </tr>
  <tr>
    <td style="text-align:right;" span>POLO:</td>
    <td><?php echo $row_RSMAT['polo']; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:right;" span><img src="../img/linha.png" width="969" height="2" /></td>
    </tr>
</tr>
<?php } while ($row_RSMAT = mysql_fetch_assoc($RSMAT)); ?>
<MM_REPEATEDREGION SOURCE="@@rs@@"><MM:DECORATION OUTLINE="Repeat" OUTLINEID=1></tr></MM:DECORATION></MM_REPEATEDREGION>
</table>
</body>
</html>
<?php
mysql_free_result($RSMAT);

mysql_free_result($RSESTD);
?>
