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

$maxRows_rs_ListarMatriculas = 10;
$pageNum_rs_ListarMatriculas = 0;
if (isset($_GET['pageNum_rs_ListarMatriculas'])) {
  $pageNum_rs_ListarMatriculas = $_GET['pageNum_rs_ListarMatriculas'];
}
$startRow_rs_ListarMatriculas = $pageNum_rs_ListarMatriculas * $maxRows_rs_ListarMatriculas;

$colname_rs_ListarMatriculas = "-1";
if (isset($_GET['code'])) {
  $colname_rs_ListarMatriculas = $_GET['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_ListarMatriculas = sprintf("SELECT * FROM idec_matriculas WHERE estudante_id = %s", GetSQLValueString($colname_rs_ListarMatriculas, "text"));
$query_limit_rs_ListarMatriculas = sprintf("%s LIMIT %d, %d", $query_rs_ListarMatriculas, $startRow_rs_ListarMatriculas, $maxRows_rs_ListarMatriculas);
$rs_ListarMatriculas = mysql_query($query_limit_rs_ListarMatriculas, $ConexaoIdec) or die(mysql_error());
$row_rs_ListarMatriculas = mysql_fetch_assoc($rs_ListarMatriculas);

if (isset($_GET['totalRows_rs_ListarMatriculas'])) {
  $totalRows_rs_ListarMatriculas = $_GET['totalRows_rs_ListarMatriculas'];
} else {
  $all_rs_ListarMatriculas = mysql_query($query_rs_ListarMatriculas);
  $totalRows_rs_ListarMatriculas = mysql_num_rows($all_rs_ListarMatriculas);
}
$totalPages_rs_ListarMatriculas = ceil($totalRows_rs_ListarMatriculas/$maxRows_rs_ListarMatriculas)-1;

$maxRows_rs_ListarCursos = 10;
$pageNum_rs_ListarCursos = 0;
if (isset($_GET['pageNum_rs_ListarCursos'])) {
  $pageNum_rs_ListarCursos = $_GET['pageNum_rs_ListarCursos'];
}
$startRow_rs_ListarCursos = $pageNum_rs_ListarCursos * $maxRows_rs_ListarCursos;

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_ListarCursos = "SELECT * FROM idec_cursos";
$query_limit_rs_ListarCursos = sprintf("%s LIMIT %d, %d", $query_rs_ListarCursos, $startRow_rs_ListarCursos, $maxRows_rs_ListarCursos);
$rs_ListarCursos = mysql_query($query_limit_rs_ListarCursos, $ConexaoIdec) or die(mysql_error());
$row_rs_ListarCursos = mysql_fetch_assoc($rs_ListarCursos);

if (isset($_GET['totalRows_rs_ListarCursos'])) {
  $totalRows_rs_ListarCursos = $_GET['totalRows_rs_ListarCursos'];
} else {
  $all_rs_ListarCursos = mysql_query($query_rs_ListarCursos);
  $totalRows_rs_ListarCursos = mysql_num_rows($all_rs_ListarCursos);
}
$totalPages_rs_ListarCursos = ceil($totalRows_rs_ListarCursos/$maxRows_rs_ListarCursos)-1;

$maxRows_rs_ListarCursos2 = 10;
$pageNum_rs_ListarCursos2 = 0;
if (isset($_GET['pageNum_rs_ListarCursos2'])) {
  $pageNum_rs_ListarCursos2 = $_GET['pageNum_rs_ListarCursos2'];
}
$startRow_rs_ListarCursos2 = $pageNum_rs_ListarCursos2 * $maxRows_rs_ListarCursos2;

$colname_rs_ListarCursos2 = "-1";
if (isset($_POST['id'])) {
  $colname_rs_ListarCursos2 = $_POST['id'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_ListarCursos2 = sprintf("SELECT * FROM idec_cursos WHERE id = %s", GetSQLValueString($colname_rs_ListarCursos2, "int"));
$query_limit_rs_ListarCursos2 = sprintf("%s LIMIT %d, %d", $query_rs_ListarCursos2, $startRow_rs_ListarCursos2, $maxRows_rs_ListarCursos2);
$rs_ListarCursos2 = mysql_query($query_limit_rs_ListarCursos2, $ConexaoIdec) or die(mysql_error());
$row_rs_ListarCursos2 = mysql_fetch_assoc($rs_ListarCursos2);

if (isset($_GET['totalRows_rs_ListarCursos2'])) {
  $totalRows_rs_ListarCursos2 = $_GET['totalRows_rs_ListarCursos2'];
} else {
  $all_rs_ListarCursos2 = mysql_query($query_rs_ListarCursos2);
  $totalRows_rs_ListarCursos2 = mysql_num_rows($all_rs_ListarCursos2);
}
$totalPages_rs_ListarCursos2 = ceil($totalRows_rs_ListarCursos2/$maxRows_rs_ListarCursos2)-1;
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
    <td>id</td>
    <td>ano</td>
    <td>estudante_id</td>
    <td>curso</td>
    <td>disciplinas</td>
    <td>polo</td>
    <td>nomeEstudante</td>
    <td>inicioCurso</td>
    <td>terminoCurso</td>
    <td>valor</td>
    <td>formaPagamento</td>
    <td>representante</td>
    <td>cod</td>
    <td>status</td>
    <td>posGraduacao</td>
    <td>extensao</td>
    <td>aperfeicoamento</td>
    <td>outros</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rs_ListarMatriculas['id']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['ano']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['estudante_id']; ?></td>
      <td>
        <?php echo $row_rs_ListarMatriculas['curso']; ?>
      </td>
      <td><?php echo $row_rs_ListarMatriculas['disciplinas']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['polo']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['nomeEstudante']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['inicioCurso']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['terminoCurso']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['valor']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['formaPagamento']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['representante']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['cod']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['status']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['posGraduacao']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['extensao']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['aperfeicoamento']; ?></td>
      <td><?php echo $row_rs_ListarMatriculas['outros']; ?></td>
    </tr>
    <?php } while ($row_rs_ListarMatriculas = mysql_fetch_assoc($rs_ListarMatriculas)); ?>
</table>
<form id="id" name="id" method="post" action="">
  <input name="id" type="hidden" id="id" value="<?php echo $row_rs_ListarMatriculas['curso']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_ListarMatriculas);

mysql_free_result($rs_ListarCursos);

mysql_free_result($rs_ListarCursos2);
?>
