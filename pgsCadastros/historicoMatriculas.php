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

$maxRows_rs_listarMatriculas = 10;
$pageNum_rs_listarMatriculas = 0;
if (isset($_GET['pageNum_rs_listarMatriculas'])) {
  $pageNum_rs_listarMatriculas = $_GET['pageNum_rs_listarMatriculas'];
}
$startRow_rs_listarMatriculas = $pageNum_rs_listarMatriculas * $maxRows_rs_listarMatriculas;

$colname_rs_listarMatriculas = "-1";
if (isset($_GET['code'])) {
  $colname_rs_listarMatriculas = $_GET['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_listarMatriculas = sprintf("SELECT * FROM idec_matriculas WHERE estudante_id = %s", GetSQLValueString($colname_rs_listarMatriculas, "text"));
$query_limit_rs_listarMatriculas = sprintf("%s LIMIT %d, %d", $query_rs_listarMatriculas, $startRow_rs_listarMatriculas, $maxRows_rs_listarMatriculas);
$rs_listarMatriculas = mysql_query($query_limit_rs_listarMatriculas, $ConexaoIdec) or die(mysql_error());
$row_rs_listarMatriculas = mysql_fetch_assoc($rs_listarMatriculas);

if (isset($_GET['totalRows_rs_listarMatriculas'])) {
  $totalRows_rs_listarMatriculas = $_GET['totalRows_rs_listarMatriculas'];
} else {
  $all_rs_listarMatriculas = mysql_query($query_rs_listarMatriculas);
  $totalRows_rs_listarMatriculas = mysql_num_rows($all_rs_listarMatriculas);
}
$totalPages_rs_listarMatriculas = ceil($totalRows_rs_listarMatriculas/$maxRows_rs_listarMatriculas)-1;

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link rel="shortcut icon" href="img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="/IDECv01/js/jquery-ui-1.10.4/development-bundle/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src="/IDECv01/js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
  <script src="/IDECv01/js/jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"></script>
  <script>
  $(function() {
    $( document ).tooltip();
  });
  </script>
  <style>
  label {
    display: inline-block;
    width: 10em;
  }
  </style>




<style type="text/css">
.AA {	color: #1A476F;
	font-weight: bold;
	text-align: center;
}
.CC {
	text-align: center;
	font-family: Calibri;
}
.CCt {
	font-weight: bold;
}
.CCaa {
	font-size: 28px;
	text-align: center;
}
.CCaacc {
	text-align: right;
	font-size: 24;
}
.BNNN {
	text-align: center;
}
</style>
</head>

<body>
<table width="" align="center">
  <tr>
    <td style="font-size: 22px; text-align: center; font-weight: bold;"></td>
  </tr>
  <tr>
    <td height="40" class="CCaa">Histórico de matrículas do(a) estudante: <span style="font-weight: bold"><?php echo $row_rs_listarMatriculas['nomeEstudante']; ?></span></td>
  </tr>
  <tr>
    <td height="" class="CC"><table border="0">
      <tr>
        <td bgcolor="#BBCBDE" class="AA">MATRICULA:</td>
        <td width="100" bgcolor="#BBCBDE" class="AA">INÍCIO CURSO:</td>
        <td width="120" bgcolor="#BBCBDE" class="AA">TÉRMINO CURSO:</td>
        <td bgcolor="#BBCBDE" class="AA">CURSOS:</td>
        <td bgcolor="#BBCBDE" class="AA">DISCIPLIAS:</td>
        <td width="100" bgcolor="#BBCBDE" class="AA">POLO:</td>
        <td bgcolor="#BBCBDE" class="AA">STATUS:</td>
        <td bgcolor="#BBCBDE" class="AA">REPRESENTANTE:</td>
        <td bgcolor="#BBCBDE"><span class="AA">VALOR:</span></td>
      </tr>
      <?php do { ?>
        <tr>
        
        <?php 
		
		$data_inicial = date("Y-m-d");  
        $data_final = $row_rs_listarMatriculas['terminoCurso'];

        $d1 = strtotime("$data_inicial");
        $d2 = strtotime("$data_final");

        $data =($d2 - $d1)/86400;
		
		?>
          <input name="" type="hidden" value="<?php echo $curso = $row_rs_listarMatriculas['id_curso']; ?>" />
          <input name="" type="hidden" value="<?php echo $polo = $row_rs_listarMatriculas['polo']; ?>" />
          <td height="" bgcolor="#D3DBE3"><?php echo $row_rs_listarMatriculas['cod']; ?></td>
          <td bgcolor="#D3DBE3"><?php echo date('d/m/Y', strtotime($row_rs_listarMatriculas['inicioCurso']));?></td>
          <td bgcolor="#D3DBE3"><?php echo date('d/m/Y', strtotime($row_rs_listarMatriculas['terminoCurso']));?></td>
          
		  <?php $sql_2 = mysql_query("SELECT * FROM idec_cursos WHERE id_curso = '$curso'"); ?>
           <?php while($res_2 = mysql_fetch_array($sql_2)){ ?>
          <td bgcolor="#D3DBE3"><?php echo $res_2['cursos']; ?></td>
          <?php } ?>
          
          <td bgcolor="#D3DBE3"><a href="#" ><img src="../img/listar.png" width="32" height="32" title="<?php echo $row_rs_listarMatriculas['disciplinas']; ?>"/></a></td>
          
          <?php $sql_3 = mysql_query("SELECT * FROM idec_abrirturmas WHERE id = '$polo'"); ?>
           <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
          <td bgcolor="#D3DBE3"><?php echo $res_3['polos']; ?></td>
          <?php } ?>
          
          <td bgcolor="#D3DBE3"><?php if ($data < 0) {
      echo "<b><font color='#FF0000'>Turma Encerrada </font></b>";
      }else{
      echo "<b><font color='#009900'>Turma Aberta </font></b>";
       }
	 ?></td></td>
          <td bgcolor="#D3DBE3"><?php echo $row_rs_listarMatriculas['representante']; ?></td>
          <td bgcolor="#D3DBE3"><?php echo $row_rs_listarMatriculas['valor']; ?></td>
		  
        </tr>
        <?php } while ($row_rs_listarMatriculas = mysql_fetch_assoc($rs_listarMatriculas)); ?>

  </table></td>
  </tr>
  <tr>
    <td height=""></td>
  </tr>
</table>
<p>

</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_listarMatriculas);
?>
