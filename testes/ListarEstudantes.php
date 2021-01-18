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

$maxRows_Rs_listarEstudantes = 10;
$pageNum_Rs_listarEstudantes = 0;
if (isset($_GET['pageNum_Rs_listarEstudantes'])) {
  $pageNum_Rs_listarEstudantes = $_GET['pageNum_Rs_listarEstudantes'];
}
$startRow_Rs_listarEstudantes = $pageNum_Rs_listarEstudantes * $maxRows_Rs_listarEstudantes;

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_Rs_listarEstudantes = "SELECT * FROM idec_estudantes";
$query_limit_Rs_listarEstudantes = sprintf("%s LIMIT %d, %d", $query_Rs_listarEstudantes, $startRow_Rs_listarEstudantes, $maxRows_Rs_listarEstudantes);
$Rs_listarEstudantes = mysql_query($query_limit_Rs_listarEstudantes, $ConexaoIdec) or die(mysql_error());
$row_Rs_listarEstudantes = mysql_fetch_assoc($Rs_listarEstudantes);

if (isset($_GET['totalRows_Rs_listarEstudantes'])) {
  $totalRows_Rs_listarEstudantes = $_GET['totalRows_Rs_listarEstudantes'];
} else {
  $all_Rs_listarEstudantes = mysql_query($query_Rs_listarEstudantes);
  $totalRows_Rs_listarEstudantes = mysql_num_rows($all_Rs_listarEstudantes);
}
$totalPages_Rs_listarEstudantes = ceil($totalRows_Rs_listarEstudantes/$maxRows_Rs_listarEstudantes)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="0">
  <tr>
    <td>nome</td>
    <td>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Rs_listarEstudantes['nome']; ?></td>
      <td><a href="TesteListarMatriculas.php?code=<?php echo $row_Rs_listarEstudantes['code']; ?>">matricula</a></td>
    </tr>
    <?php } while ($row_Rs_listarEstudantes = mysql_fetch_assoc($Rs_listarEstudantes)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Rs_listarEstudantes);
?>
