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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_Recordset1 = "SELECT * FROM idec_disciplinas";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $ConexaoIdec) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../img/iconIdec.png" />
<style type="text/css">
.aa {
	color: #1B4871;
	font-weight: bold;
	text-align: left;
}
.cCE {
	text-align: center;
}
</style>
</head>

<body>
<table width="1327" align="center">
  <tr>
    <th colspan="6" scope="col"><img src="../img/TopoIdec.png" width="1008" height="124" /></th>
  </tr>
  <tr>
    <td width="164">&nbsp;</td>
    <td width="169"><a href="indexteste.php"><img src="../img/btHomer.png" width="168" height="25" /></a></td>
    <td width="200"><a href="../pgsCadastros/CadastroDisciplinas.php"><img src="../img/btNovaDisciplinas.png" alt="" width="200" height="25" /></a></td>
    <td width="290">&nbsp;</td>
    <td width="236">&nbsp;</td>
    <td width="240">&nbsp;</td>
  </tr>
  <tr>
    <td height="185" colspan="6" align="center"><table width="364" align="center">
      <tr>
        <td><form id="form1" name="form1" method="post" action="">
          <table width="984" height="89" align="center">
            <tr>
              <td width="126" height="11">&nbsp;</td>
              <td width="171">&nbsp;</td>
              <td width="420">&nbsp;</td>
              <td width="128">&nbsp;</td>
              <td width="115">&nbsp;</td>
            </tr>
            <tr>
              <td height="11">&nbsp;</td>
              <td width="171">&nbsp;</td>
              <td width="420"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">Pesquisa Disciplinas:</span></td>
              <td width="128">&nbsp;</td>
              <td width="115">&nbsp;</td>
            </tr>
            <tr>
              <td height="31"><label for="rm"></label></td>
              <td height="31"><label for="cpf"></label></td>
              <td height="31"><label for="disciplinas"></label>
                <input name="disciplinas" type="text" id="disciplinas" size="60" /></td>
              <td height="31"><label for="matricula"></label></td>
              <td height="31"><input type="submit" name="button" id="button" value="LOCALIZAR" /></td>
            </tr>
          </table>
        </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="1000" border="0">
        <tr>
          <td colspan="2" bgcolor="#BBCBDE"><span style="font-family: Calibri; color: #B7302A; font-weight: bold;">DISCIPLINAS:</span></td>
        </tr>
        <?php do { ?>
          <tr>
            <td width="962" bgcolor="#D3DBE3" class="aa"><?php echo $row_Recordset1['disciplinas']; ?></td>
            <td width="28" bgcolor="#D3DBE3"><a href="../pgsExcluir/ExcluirDisciplinas.php?id=<?php echo $row_Recordset1['id']; ?>" class="cCE"><img src="../img/Delete.png" alt="Excluir" width="24" height="24" /></a></td>
          </tr>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>
</p></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
