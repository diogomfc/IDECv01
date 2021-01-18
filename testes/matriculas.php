<?php require_once('../Connections/ConexaoIdec.php'); ?>
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

$maxRows_rs_polosTurmas = 10;
$pageNum_rs_polosTurmas = 0;
if (isset($_GET['pageNum_rs_polosTurmas'])) {
  $pageNum_rs_polosTurmas = $_GET['pageNum_rs_polosTurmas'];
}
$startRow_rs_polosTurmas = $pageNum_rs_polosTurmas * $maxRows_rs_polosTurmas;

$colname_rs_polosTurmas = "-1";
if (isset($_POST['polos'])) {
  $colname_rs_polosTurmas = $_POST['polos'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_polosTurmas = sprintf("SELECT * FROM idec_abrirturmas WHERE polos LIKE %s", GetSQLValueString("%" . $colname_rs_polosTurmas . "%", "text"));
$query_limit_rs_polosTurmas = sprintf("%s LIMIT %d, %d", $query_rs_polosTurmas, $startRow_rs_polosTurmas, $maxRows_rs_polosTurmas);
$rs_polosTurmas = mysql_query($query_limit_rs_polosTurmas, $ConexaoIdec) or die(mysql_error());
$row_rs_polosTurmas = mysql_fetch_assoc($rs_polosTurmas);

if (isset($_GET['totalRows_rs_polosTurmas'])) {
  $totalRows_rs_polosTurmas = $_GET['totalRows_rs_polosTurmas'];
} else {
  $all_rs_polosTurmas = mysql_query($query_rs_polosTurmas);
  $totalRows_rs_polosTurmas = mysql_num_rows($all_rs_polosTurmas);
}
$totalPages_rs_polosTurmas = ceil($totalRows_rs_polosTurmas/$maxRows_rs_polosTurmas)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
    
<link rel="shortcut icon" href="img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="/IDECv01/js/jquery-ui-1.10.4/development-bundle/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src="../js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"></script>
  <script>
  $(function() {
    $( document ).tooltip();
  });
  </script>
  <style>
  label {
    display: inline-block;
    width: 5em;
  }
  </style>

<style type="text/css">
.aa {
	color: #1B4871;
}
.bb {
	color: #333;
	font-weight: bold;
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
    <td width="200"><a href="CadastroAbrirTurmas.php"><img src="../img/btAbrirTurmas.png" alt="" width="200" height="25" /></a></td>
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
              <td height="11"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">Polos/Turmas:</span></td>
              <td width="171">&nbsp;</td>
              <td width="420">&nbsp;</td>
              <td width="128">&nbsp;</td>
              <td width="115">&nbsp;</td>
            </tr>
            <tr>
              <td height="31"><label for="rm">
                <input type="text" name="polos" id="polos" />
              </label></td>
              <td height="31"><label for="polos">
                <input type="submit" name="button" id="button" value="LOCALIZAR" />
              </label></td>
              <td height="31"><label for="nome"></label></td>
              <td height="31">&nbsp;</td>
              <td height="31">&nbsp;</td>
            </tr>
          </table>
        </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="1009" border="0">
        <tr>
          <td width="197" bgcolor="#BBCBDE"><span style="font-family: Calibri; font-weight: bold; color: #B7302A; font-size: 18px; text-align: center;">Polo / Turma</span></td>
          <td width="232" bgcolor="#BBCBDE"><span style="font-family: Calibri; color: #1A476F; font-weight: bold; font-size: 18px; text-align: center;">Data inicio</span></td>
          <td width="227" bgcolor="#BBCBDE"><span style="font-family: Calibri; color: #1A476F; font-weight: bold; font-size: 18px; text-align: center;">Data Final</span></td>
          <td width="279" bgcolor="#BBCBDE"><span style="font-family: Calibri; color: #006600; font-weight: bold; font-size: 18px; text-align: center;">Status</span></td>
          <td width="52" bgcolor="#BBCBDE">&nbsp;</td>
        </tr>
        <?php do { ?>
          <tr>
            <td bgcolor="#D3DBE3" class="aa"><a href="#" title="<?php echo $row_rs_polosTurmas['polos']; ?>">POLOS</a></td>
            <td bgcolor="#D3DBE3" class="aa"><?php echo $row_rs_polosTurmas['dataInicio']; ?></td>
            <td bgcolor="#D3DBE3" class="aa"><?php echo $row_rs_polosTurmas['dataFinal']; ?></td>
            <td bgcolor="#D3DBE3" class="bb"><?php echo $row_rs_polosTurmas['status']; ?></td>
            <td bgcolor="#D3DBE3" class="bb"><span style="font-weight: bold; font-family: Calibri; color: #F00;"><a><img src="../img/Delete.png" alt="Excluir" width="24" height="24" /><a><img src="../img/imgRelacaoAlunos.png" alt="Excluir" width="21" height="24" /></a></a></span></td>
          </tr>
          <?php } while ($row_rs_polosTurmas = mysql_fetch_assoc($rs_polosTurmas)); ?>
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
mysql_free_result($rs_polosTurmas);
?>
