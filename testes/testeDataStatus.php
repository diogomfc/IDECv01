<?php require_once('../Connections/ConexaoIdec.php'); ?>

<?php

date_default_timezone_set('America/Sao_Paulo');

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

$maxRows_rsData = 10;
$pageNum_rsData = 0;
if (isset($_GET['pageNum_rsData'])) {
  $pageNum_rsData = $_GET['pageNum_rsData'];
}
$startRow_rsData = $pageNum_rsData * $maxRows_rsData;

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rsData = "SELECT * FROM idec_abrirturmas";
$query_limit_rsData = sprintf("%s LIMIT %d, %d", $query_rsData, $startRow_rsData, $maxRows_rsData);
$rsData = mysql_query($query_limit_rsData, $ConexaoIdec) or die(mysql_error());
$row_rsData = mysql_fetch_assoc($rsData);


if (isset($_GET['totalRows_rsData'])) {
  $totalRows_rsData = $_GET['totalRows_rsData'];
} else {
  $all_rsData = mysql_query($query_rsData);
  $totalRows_rsData = mysql_num_rows($all_rsData);
}
$totalPages_rsData = ceil($totalRows_rsData/$maxRows_rsData)-1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<p>&nbsp;</p>
<table width="1488" border="1">
<MM_REPEATEDREGION SOURCE="@@rs@@"><MM:DECORATION OUTLINE="Repeat" OUTLINEID=1>
  <tr></tr></MM:DECORATION></MM_REPEATEDREGION>
<MM_REPEATEDREGION SOURCE="@@rs@@"><MM:DECORATION OUTLINE="Repeat" OUTLINEID=1>
  <tr></tr>
</MM:DECORATION></MM_REPEATEDREGION>
<MM_REPEATEDREGION SOURCE="@@rs@@"><MM:DECORATION OUTLINE="Repeat" OUTLINEID=1>
  <tr></tr>
</MM:DECORATION></MM_REPEATEDREGION>
<tr>
  <td width="">id</td>
  <td width="">polos</td>
  <td width="">turma</td>
  <td width="">dataInicio</td>
  <td width="">dataFinal</td>
  <td width="">status</td>
</tr>
<?php do { ?>
<tr>
  <?php   
$data_inicial = date("Y-m-d");  
$data_final = $row_rsData['dataFinal'];


$d1 = strtotime("$data_inicial");
$d2 = strtotime("$data_final");

$data =($d2 - $d1)/86400;

    ?>
  <td><?php echo $idturmas = $row_rsData['id']; ?></td>
  <td><?php echo $row_rsData['polos']; ?></td>
  <td><?php echo $row_rsData['turma']; ?></td>
  <td><?php echo date('d/m/Y', strtotime($row_rsData['dataInicio']));?></td>
  <td><?php echo date('d/m/Y', strtotime($row_rsData['dataFinal'])); ?></td>
  <td><?php if ($data < 0) {
           mysql_query("UPDATE idec_abrirturmas SET status = 'Encerrada' WHERE id ='$idturmas'");
           }else{
           mysql_query("UPDATE idec_abrirturmas SET status = 'Aberta' WHERE id ='$idturmas'");	
           }
	  //if ($data < 0) {
      //echo "<b><font color='#FF0000'>Turma Encerrada </font></b>";
      //}else{
      //echo "<b><font color='#009900'>Turma Aberta </font></b>";
       //}
	  
	 //echo "<br>Falta $data dias.";?>
    <?php if ($row_rsData['status'] == 'Encerrada'){
      echo "<b><font color='#FF0000'>Turma Encerrada </font></b>";
      }else{
      echo "<b><font color='#009900'>Turma Aberta </font></b>";
       }
	 ?></td>
  <td></td>
</tr>
<?php } while ($row_rsData = mysql_fetch_assoc($rsData)); ?>
</table>
<form id="form1" name="form1" method="post" action="">
  <input type="submit" name="button" id="button" value="ATUALIZAR" />
</form>
<p>&nbsp;</p>
</body>

</html>
<?php
mysql_free_result($rsData);
?>
