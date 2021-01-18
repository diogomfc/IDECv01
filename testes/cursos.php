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

$maxRows_ListarCursos = 10;
$pageNum_ListarCursos = 0;
if (isset($_GET['pageNum_ListarCursos'])) {
  $pageNum_ListarCursos = $_GET['pageNum_ListarCursos'];
}
$startRow_ListarCursos = $pageNum_ListarCursos * $maxRows_ListarCursos;

$colname_ListarCursos = "-1";
if (isset($_POST['cursos'])) {
  $colname_ListarCursos = $_POST['cursos'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_ListarCursos = sprintf("SELECT * FROM idec_cursos WHERE cursos LIKE %s", GetSQLValueString("%" . $colname_ListarCursos . "%", "text"));
$query_limit_ListarCursos = sprintf("%s LIMIT %d, %d", $query_ListarCursos, $startRow_ListarCursos, $maxRows_ListarCursos);
$ListarCursos = mysql_query($query_limit_ListarCursos, $ConexaoIdec) or die(mysql_error());
$row_ListarCursos = mysql_fetch_assoc($ListarCursos);

if (isset($_GET['totalRows_ListarCursos'])) {
  $totalRows_ListarCursos = $_GET['totalRows_ListarCursos'];
} else {
  $all_ListarCursos = mysql_query($query_ListarCursos);
  $totalRows_ListarCursos = mysql_num_rows($all_ListarCursos);
}
$totalPages_ListarCursos = ceil($totalRows_ListarCursos/$maxRows_ListarCursos)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../img/iconIdec.png" />

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
.aa {
	color: #1B4871;
	text-align: center;
	font-size: 18px;
	font-family: Calibri;
}
.cCE {
	text-align: center;
}
.center {
	text-align: center;
}
.ccc {
	text-align: center;
}
.cccAA {
	font-family: Calibri;
	font-size: 18px;
}
.cccC {
	font-weight: bold;
}
.cccF {
	color: #B7302A;
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
    <td width="200"><a href="../pgsCadastros/CadastroCursos.php"><img src="../img/btNovoCurso.png" alt="" width="200" height="25" /></a></td>
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
              <td width="420"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">PESQUISA CURSOS:</span></td>
              <td width="128">&nbsp;</td>
              <td width="115">&nbsp;</td>
            </tr>
            <tr>
              <td height="31"></td>
              <td height="31"></td>
              <td height="31"><label for="cursos"></label>
                <input name="cursos" type="text" id="cursos" size="60" /></td>
              <td height="31"></label></td>
              <td height="31"><input type="submit" name="button" id="button" value="LOCALIZAR" /></td>
            </tr>
          </table>
        </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="995" border="0">
        <tr>
          <td width="" bgcolor="#BBCBDE" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">CURSOS:</span></span></span></td>
          <td width="" bgcolor="#BBCBDE" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">DISCIPLINAS:</span></span></span></td>
          <td width="" bgcolor="#BBCBDE" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">C.H:</span></span></span></td>
          <td width="" bgcolor="#BBCBDE" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">VALOR:</span></span></span></td>
          <td bgcolor="#BBCBDE">&nbsp;</td>
        </tr>
        <?php do { ?>
          <tr>
            <td bgcolor="#D3DBE3" class="aa"><?php echo $row_ListarCursos['cursos']; ?></td>
            <td bgcolor="#D3DBE3" class="aa"><?php echo $row_ListarCursos['disciplinas']; ?></td>
            <td bgcolor="#D3DBE3" class="aa"><?php echo $row_ListarCursos['cargaHoraria']; ?></td>
            <td bgcolor="#D3DBE3" class="aa"><?php echo $row_ListarCursos['valores']; ?></td>
            <td width="" bgcolor="#D3DBE3"><span style="font-weight: bold; font-family: Calibri; color: #F00; text-align: center;"><a href="../pgsExcluir/ExcluirCursos.php?id=<?php echo $row_ListarCursos['id']; ?>"></a></span><a href="../pgsExcluir/ExcluirCursos.php?id=<?php echo $row_ListarCursos['id_curso']; ?>" class="cCE"><img src="../img/Delete.png" title="EXCLUIR CURSO" width="24" height="24" /></a></td>
          </tr>
          <?php } while ($row_ListarCursos = mysql_fetch_assoc($ListarCursos)); ?>
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
mysql_free_result($ListarCursos);
?>
