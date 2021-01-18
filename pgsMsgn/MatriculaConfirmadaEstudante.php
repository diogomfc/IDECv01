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
  $insertSQL = sprintf("INSERT INTO idec_matriculas (polo) VALUES (%s)",
                       GetSQLValueString($_POST['polo'], "text"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($insertSQL, $ConexaoIdec) or die(mysql_error());
}

$colname_rs_matriculas = "-1";
if (isset($_GET['code'])) {
  $colname_rs_matriculas = $_GET['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_matriculas = sprintf("SELECT * FROM idec_matriculas WHERE cod = %s", GetSQLValueString($colname_rs_matriculas, "text"));
$rs_matriculas = mysql_query($query_rs_matriculas, $ConexaoIdec) or die(mysql_error());
$row_rs_matriculas = mysql_fetch_assoc($rs_matriculas);
$totalRows_rs_matriculas = mysql_num_rows($rs_matriculas);

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
	font-size: 18px;
	text-align: left;
}
#form1 table tr td table tr td {
	text-align: left;
}
.fontep {
	font-family: Calibri;
}
.ne {
	font-weight: bold;
	font-size: 22px;
}
</style>
</head>

<body>
<table width="1011" height="134" border="0" align="center" style="background: url(../img/TopoIdec.png) no-repeat; font-family: Calibri; font-size: 15px; color: #5080D8; font-weight: bold;">
  <tr>
    <td height="130" align="right" valign="top"><table width="462">
      <tr>
        <td width="111" height="43">&nbsp;</td>
        <td width="131">&nbsp;</td>
        <td width="103">&nbsp;</td>
        <td width="34"><a href="#"><img src="../img/btInfo.png" alt="" width="28" height="30" title="Informação do Sistema"/></a></td>
        <td width="32"><a href="../admin/index.php"><img src="../img/btLogof.png" alt="" width="28" height="30" title="Logoff" /></a></td>
        <td width="23">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="1016" height="246" border="0" align="center" style="background: url(../img/imgFundoMatriculaCofirmada.png) no-repeat; font-size: 20px; font-family: Calibri;">
  <tr>
    <td width="978" height="242"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <table width="582" height="213" align="center">
        <tr>
          <td height="170" colspan="3"><table width="556">
            <tr>
              <td width="58">&nbsp;</td>
              <td width="156" style="text-align: right">Estudante:</td>
              <td width="326" class="ne"><?php echo $row_rs_matriculas['nomeEstudante']; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Matricula:</td>
              <td class="ne"><?php echo $row_rs_matriculas['cod']; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Início do Curso:</td>
              <td class="ne"><?php echo $row_rs_matriculas['inicioCurso']; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Término do Curso:</td>
              <td class="ne"><?php echo $row_rs_matriculas['terminoCurso']; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Polo:</td>
              <input name="input" type="hidden" value="<?php echo $polo = $row_rs_matriculas['polo']; ?>" />
              <?php $sql_3 = mysql_query("SELECT * FROM idec_abrirturmas WHERE id = '$polo'"); ?>
              <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
              <td class="ne"><?php echo $nomePolo = $res_3['polos']; ?>
                <input name="polo" type="hidden" id="polo" value="<?php echo $res_3['polos']; ?>" />
				<?php } ?>
                </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="35"><a href="../admin/index.php"><img src="../img/BTHomer2.png" alt="" width="176" height="29" /></a></td>
          <td width="200"><a href="../admin/matriculas.php"><img src="../img/BTPesquisarMatricula.png" alt="" width="189" height="32" /></a></td>
          <td width="200"><a href="../admin/estudante1.php"><img src="../img/BTPesquisarEstudante1.png" alt="" width="197" height="33" /></a></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form></td>
  </tr>
</table>
<table width="148" align="center">
  <tr>
    <td width="140" class="rodape">AVANTE INFORMÀTICA</td>
  </tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_matriculas);
?>
