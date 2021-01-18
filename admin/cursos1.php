<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$painel_atual = "admin";

// Verifica se não há a variável da sessão que identifica o usuário
if ($painel = $_SESSION['painel'] != $painel_atual) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../index.php"); exit;
}

?>



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
$query_ListarCursos = sprintf("SELECT * FROM idec_cursos WHERE cursos LIKE %s ORDER BY idec_cursos.id_curso DESC", GetSQLValueString("%" . $colname_ListarCursos . "%", "text"));
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
<table width="1021" height="457" align="center" style="background: url(../img/imgFundoCursos1.png) no-repeat; color: #1B4871; font-family: Calibri;">
  <tr>
    <td width="1023" height="451" valign="top"><table width="984">
      <tr>
        <td width="3" height="123">&nbsp;</td>
        <td colspan="2" align="right" valign="top"><table width="462">
          <tr>
            <td width="111" height="43">&nbsp;</td>
            <td width="131">&nbsp;</td>
            <td width="103">&nbsp;</td>
            <td width="34"><a href="#"><img src="../img/btInfo.png" alt="" width="28" height="30" title="Informação do Sistema"/></a></td>
            <td width="32"><a href="../logout.php"><img src="../img/btLogof.png" alt="" width="28" height="30" title="Logoff" /></a></td>
            <td width="23">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="5">Seja Bem Vindo:<strong> <?php echo $_SESSION['nome']; ?></strong></td>
          </tr>
        </table></td>
        <td width="69">&nbsp;</td>
      </tr>
      <tr>
        <td height="47">&nbsp;</td>
        <td width="180"><a href="index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
        <td width="755"><a href="../pgsCadastros/CadastroCursos.php"><img src="../img/btCadastrarCursos.png" alt="" width="200" height="32" /></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="84">&nbsp;</td>
        <td colspan="2" valign="top"><form id="form1" name="form1" method="post" action="">
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
                <input name="cursos" type="text" id="cursos" size="60" onkeypress="javascript:this.value=this.value.toUpperCase();" /></td>
              <td height="31" valign="top"></label>
                <input type="image" name="button" id="button" src="../img/BT2localizar.png" /></td>
              <td height="31">&nbsp;</td>
            </tr>
          </table>
        </form></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="60" colspan="3" valign="top"><table width="984" border="0">
          <tr>
            <td width="211" align="left" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">CURSOS:</span></span></span></td>
            <td width="364" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">DISCIPLINAS:</span></span></span></td>
            <td width="80" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">C.H:</span></span></span></td>
            <td width="100" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">VALOR:</span></span></span></td>
            <td width="40">&nbsp;</td>
            </tr>
         <?php do { ?>
            <tr>
              <td class="aa" bgcolor="#ECF3F7"><?php echo $row_ListarCursos['cursos']; ?></td>
              <td class="aa" bgcolor="#ECF3F7"><?php echo $row_ListarCursos['disciplinas']; ?></td>
              <td class="aa" bgcolor="#ECF3F7"><?php echo $row_ListarCursos['cargaHoraria']; ?></td>
              <td class="aa" bgcolor="#ECF3F7"><?php echo $row_ListarCursos['valores']; ?></td>
              <td width="32" bgcolor="#ECF3F7"><span style="font-weight: bold; font-family: Calibri; color: #F00; text-align: center;"><a href="../pgsExcluir/ExcluirCursos.php?id=<?php echo $row_ListarCursos['id']; ?>"></a></span><a href="../pgsExcluir/ExcluirCursos.php?id=<?php echo $row_ListarCursos['id_curso']; ?>" class="cCE"><img src="../img/Delete.png" alt="" width="24" height="24" title="EXCLUIR CURSO" /></a><a href="../pgsCadastros/AlterarCursos.php?id_curso=<?php echo $row_ListarCursos['id_curso']; ?>"><img src="../img/ico-editar.png" width="24" height="24" /></a></td>
              </tr>
            <tr>
              <td height="6" colspan="5" align="left"><img src="../img/linha.png" width="980" height="2" /></td>
              </tr>
            <?php } while ($row_ListarCursos = mysql_fetch_assoc($ListarCursos)); ?>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><span class="aa"><img src="../img/IMGbarraRodape.png" alt="" width="983" height="32" /></span></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($ListarCursos);
?>
