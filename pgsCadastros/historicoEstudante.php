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

$maxRows_rs_matriculas = 100;
$pageNum_rs_matriculas = 0;
if (isset($_GET['pageNum_rs_matriculas'])) {
  $pageNum_rs_matriculas = $_GET['pageNum_rs_matriculas'];
}
$startRow_rs_matriculas = $pageNum_rs_matriculas * $maxRows_rs_matriculas;

$colname_rs_matriculas = "-1";
if (isset($_GET['polos'])) {
  $colname_rs_matriculas = $_GET['polos'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_matriculas = sprintf("SELECT * FROM idec_matriculas WHERE polo = %s", GetSQLValueString($colname_rs_matriculas, "text"));
$query_limit_rs_matriculas = sprintf("%s LIMIT %d, %d", $query_rs_matriculas, $startRow_rs_matriculas, $maxRows_rs_matriculas);
$rs_matriculas = mysql_query($query_limit_rs_matriculas, $ConexaoIdec) or die(mysql_error());
$row_rs_matriculas = mysql_fetch_assoc($rs_matriculas);

if (isset($_GET['totalRows_rs_matriculas'])) {
  $totalRows_rs_matriculas = $_GET['totalRows_rs_matriculas'];
} else {
  $all_rs_matriculas = mysql_query($query_rs_matriculas);
  $totalRows_rs_matriculas = mysql_num_rows($all_rs_matriculas);
}
$totalPages_rs_matriculas = ceil($totalRows_rs_matriculas/$maxRows_rs_matriculas)-1;

$colname_rs_polos = "-1";
if (isset($_POST['polos'])) {
  $colname_rs_polos = $_POST['polos'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_polos = sprintf("SELECT * FROM idec_abrirturmas WHERE polos = %s", GetSQLValueString($colname_rs_polos, "text"));
$rs_polos = mysql_query($query_rs_polos, $ConexaoIdec) or die(mysql_error());
$row_rs_polos = mysql_fetch_assoc($rs_polos);
$totalRows_rs_polos = mysql_num_rows($rs_polos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.CCaa {
	font-size: 28px;
}
.AA {
	color: #1A476F;
	font-weight: bold;
	text-align: center;
	font-size: 18px;
	font-family: Calibri;
}
.CCC {
	font-family: Calibri;
	text-align: center;
	font-size: 18px;
	color: #1B4871;
}
.SSS {
	font-family: Calibri;
	font-weight: bold;
	font-size: 22px;
}
</style>
</head>

<body>
<table width="813" align="center">
  <tr>
   <input name="input" type="hidden" value="<?php echo $polo = $row_rs_matriculas['polo']; ?>" />
    <?php $sql_2 = mysql_query("SELECT * FROM idec_abrirturmas WHERE id = '$polo'"); ?>
              <?php while($res_2 = mysql_fetch_array($sql_2)){ ?>
    <td><span class="CCaa">Relação de estudantes polo: </span><span class="SSS"><?php echo $res_2['polos']; ?></span>
       <?php } ?></td>
  </tr>
  <tr>
    <td class="CCaa">Total de: <span style="font-weight: bold; font-family: Calibri; font-size: 22px;"><?php echo $totalRows_rs_matriculas ?></span></td>
  </tr>
  <tr>
    <td><table width="807" border="0">
      <tr class="AA">
        <td width="511" bgcolor="#BBCBDE" class="AA">ESTUDANTE:</td>
        <td width="131" bgcolor="#BBCBDE" class="AA">CPF:</td>
		<td width="131" bgcolor="#BBCBDE" class="AA">EMAIL:</td>
        <td width="115" bgcolor="#BBCBDE" class="AA">CERTIFICADO:</td>
      </tr>
      <?php do { ?>
      <tr class="CCC">
        <input name="input2" type="hidden" value="<?php echo $EntregueSim = $row_rs_matriculas['certificadosSim']; ?>" />
        <td bgcolor="#ECF3F7"><span style="text-transform:uppercase;"><?php echo $nomeEstudante = $row_rs_matriculas['nomeEstudante']; ?></span></td>
        <?php $sql_3 = mysql_query("SELECT * FROM idec_estudantes WHERE nome = '$nomeEstudante '"); ?>
        <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
        <td bgcolor="#ECF3F7"><?php echo $res_3['cpf']; ?></td>
		<td bgcolor="#ECF3F7"><?php echo $res_3['email']; ?></td>
        <?php } ?>
        <td bgcolor="#ECF3F7" width="115"><?php  if ($EntregueSim != 'SIM') {
      echo "<IMG SRC='../img/imgNao1.png'>";
      }else{
      echo "<IMG SRC='../img/imgSim1.png'>";
       }?>
          <span style="font-size: 12px"><?php echo $row_rs_matriculas['dataEntrega']; ?></span></td>
      </tr>
      <?php } while ($row_rs_matriculas = mysql_fetch_assoc($rs_matriculas)); ?>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rs_matriculas);

mysql_free_result($rs_polos);
?>
