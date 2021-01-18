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

$maxRows_ListarAgenda = 10;
$pageNum_ListarAgenda = 0;
if (isset($_GET['pageNum_ListarAgenda'])) {
  $pageNum_ListarAgenda = $_GET['pageNum_ListarAgenda'];
}
$startRow_ListarAgenda = $pageNum_ListarAgenda * $maxRows_ListarAgenda;

$colname_ListarAgenda = "-1";
if (isset($_POST['professor'])) {
  $colname_ListarAgenda = $_POST['professor'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_ListarAgenda = sprintf("SELECT * FROM idec_agendamentoprofessor WHERE professor LIKE %s", GetSQLValueString("%" . $colname_ListarAgenda . "%", "text"));
$query_limit_ListarAgenda = sprintf("%s LIMIT %d, %d", $query_ListarAgenda, $startRow_ListarAgenda, $maxRows_ListarAgenda);
$ListarAgenda = mysql_query($query_limit_ListarAgenda, $ConexaoIdec) or die(mysql_error());
$row_ListarAgenda = mysql_fetch_assoc($ListarAgenda);

if (isset($_GET['totalRows_ListarAgenda'])) {
  $totalRows_ListarAgenda = $_GET['totalRows_ListarAgenda'];
} else {
  $all_ListarAgenda = mysql_query($query_ListarAgenda);
  $totalRows_ListarAgenda = mysql_num_rows($all_ListarAgenda);
}
$totalPages_ListarAgenda = ceil($totalRows_ListarAgenda/$maxRows_ListarAgenda)-1;
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
        <td width="755"><a href="../pgsCadastros/CadastroAgendarProfessor.php"><img src="../img/BTAgendar.png" alt="" width="154" height="32" /></a></td>
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
              <td width="420"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">PESQUISA PROFESSOR:</span></td>
              <td width="128">&nbsp;</td>
              <td width="115">&nbsp;</td>
            </tr>
            <tr>
              <td height="31"></td>
              <td height="31"></td>
              <td height="31"><label for="professor"></label>
                <input name="professor" type="text" id="professor" size="60" /></td>
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
            <td width="257" align="left" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">PROFESSOR:</span></span></span></td>
            <td width="447" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">CURSO:</span></span></span></td>
            <td width="95" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">POLO:</span></span></span></td>
            <td width="141" class="ccc"><span class="cccF"><span class="cccC"><span class="cccAA">DATA:</span></span></span></td>
            <td width="24">&nbsp;</td>
            </tr>
          <?php do { ?>
            <tr>
            <input name="idprofessor" type="hidden" value="<?php echo $ids_professor = $row_ListarAgenda['professor']; ?>" />
              <?php $sql_2 = mysql_query("SELECT * FROM idec_professores WHERE id = '$ids_professor'"); ?>
              <?php while($res_2 = mysql_fetch_array($sql_2)){ ?>
              <td class="aa" bgcolor="#ECF3F7"><?php echo $res_2['nome']; ?></td>
              <?php } ?>
              <td class="aa" bgcolor="#ECF3F7"><?php echo $row_ListarAgenda['curso']; ?></td>
              <input name="idpolos" type="hidden" value="<?php echo $ids_polos = $row_ListarAgenda['polo']; ?>" />
			  <?php $sql_3 = mysql_query("SELECT * FROM idec_abrirturmas WHERE id = '$ids_polos'"); ?>
              <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
              <td class="aa" bgcolor="#ECF3F7"><?php echo $res_3['polos']; ?></td>
              <?php } ?>
              <td class="aa" bgcolor="#ECF3F7"><?php echo date('d/m/Y', strtotime($row_ListarAgenda['data']));?></td>
              <td width="24" bgcolor="#ECF3F7"><span style="font-weight: bold; font-family: Calibri; color: #F00; text-align: center;"><a href="../pgsExcluir/ExcluirAgendamento.php?id=<?php echo $row_ListarAgenda['id']; ?>"></a></span><img src="../img/Delete.png" alt="" width="24" height="24" title="EXCLUIR AGENDAMENTO" /></a></td>
            </tr>
            <tr>
              <td height="6" colspan="5" align="left"><img src="../img/linha.png" width="980" height="2" /></td>
            </tr>
            <?php } while ($row_ListarAgenda = mysql_fetch_assoc($ListarAgenda)); ?>
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
mysql_free_result($ListarAgenda);
?>
