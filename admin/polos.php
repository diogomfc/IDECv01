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

$maxRows_ListarPolos = 10;
$pageNum_ListarPolos = 0;
if (isset($_GET['pageNum_ListarPolos'])) {
  $pageNum_ListarPolos = $_GET['pageNum_ListarPolos'];
}
$startRow_ListarPolos = $pageNum_ListarPolos * $maxRows_ListarPolos;

$colname_ListarPolos = "-1";
if (isset($_POST['polos'])) {
  $colname_ListarPolos = $_POST['polos'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_ListarPolos = sprintf("SELECT * FROM idec_polos WHERE polos LIKE %s", GetSQLValueString("%" . $colname_ListarPolos . "%", "text"));
$query_limit_ListarPolos = sprintf("%s LIMIT %d, %d", $query_ListarPolos, $startRow_ListarPolos, $maxRows_ListarPolos);
$ListarPolos = mysql_query($query_limit_ListarPolos, $ConexaoIdec) or die(mysql_error());
$row_ListarPolos = mysql_fetch_assoc($ListarPolos);

if (isset($_GET['totalRows_ListarPolos'])) {
  $totalRows_ListarPolos = $_GET['totalRows_ListarPolos'];
} else {
  $all_ListarPolos = mysql_query($query_ListarPolos);
  $totalRows_ListarPolos = mysql_num_rows($all_ListarPolos);
}
$totalPages_ListarPolos = ceil($totalRows_ListarPolos/$maxRows_ListarPolos)-1;
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
	font-weight: bold;
	text-align: left;
}
.cCE {
	text-align: center;
}
.AA {
	color: #1B4871;
	font-weight: bold;
	font-family: Calibri;
}
.AA1 {
	color: #1B4871;
	font-family: Calibri;
	font-size: 18px;
}
</style>
</head>

<body>
<table width="1079" height="385" align="center" style="background: url(../img/imgFundoPolos2.png) no-repeat; color: #1B4871; font-family: Calibri;">
  <tr>
    <td valign="top"><table width="1072">
      <tr>
        <td width="6" height="113">&nbsp;</td>
        <td colspan="4" align="right" valign="top"><table width="462">
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
        <td width="5">&nbsp;</td>
      </tr>
      <tr>
        <td height="40">&nbsp;</td>
        <td width="181"><a href="index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
        <td width="805"><a href="../pgsCadastros/CadastroEndPolos.php"><img src="../img/BTCadastroPolos.png" alt="" width="200" height="32" /></a></td>
        <td width="24">&nbsp;</td>
        <td width="23">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="103">&nbsp;</td>
        <td colspan="4" valign="top"><form id="form1" name="form1" method="post" action="">
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
              <td width="420"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">PESQUISA POLOS:</span></td>
              <td width="128">&nbsp;</td>
              <td width="115">&nbsp;</td>
            </tr>
            <tr>
              <td height="31"></td>
              <td height="31"></td>
              <td height="31"><input name="polos" type="text" id="polos" size="60" /></td>
              <td height="31"><input type="image" name="button" id="button" src="../img/BT2localizar.png" /></td>
              <td height="31">&nbsp;</td>
            </tr>
          </table>
        </form></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="33">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="63" colspan="5" valign="top"><table width="1066" border="0">
          <tr>
            <td width="163"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px;">POLOS:</span></td>
            <td><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px;">ENDEREÇO:</span></td>
            <td><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px;">CEP:</span></td>
            <td><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px;">ESCOLA:</span></td>
            <td width="226"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px;">GESTOR:</span></td>
            <td width="76"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px;">TELEFONE:</span></td>
            <td>&nbsp;</td>
          </tr>
          <?php do { ?>
          <tr>
          <input name="" type="hidden" value="<?php echo $cel = $row_ListarPolos['cel'];?>" />
          <input name="" type="hidden" value="<?php echo $tel1 = $row_ListarPolos['tel1'];?>" />
          <input name="" type="hidden" value="<?php echo $tel2 = $row_ListarPolos['tel2'];?>" />
          <input name="" type="hidden" value="<?php echo $tel3 = $row_ListarPolos['tel3'];?>" />
          <input name="" type="hidden" value="<?php echo $IDrepresentante = $row_ListarPolos['representante']; ?>" />
            <td bgcolor="#ECF3F7" class="AA1" style="text-transform:uppercase"><?php echo $row_ListarPolos['polos']; ?></td>
            <td width="184" bgcolor="#ECF3F7" class="AA1" style="text-transform:uppercase" ><?php echo $row_ListarPolos['endereco']; ?></td>
            <td width="146" bgcolor="#ECF3F7"><?php echo $row_ListarPolos['cep']; ?></td>
            <td width="226" bgcolor="#ECF3F7" style="text-transform:uppercase"><?php echo $row_ListarPolos['referencia']; ?></td>
            <?php $sql_2 = mysql_query("SELECT * FROM ide_representantes WHERE id = '$IDrepresentante'"); ?>
              <?php while($res_2 = mysql_fetch_array($sql_2)){ ?>
            <td bgcolor="#ECF3F7" style="text-transform:uppercase"><?php echo $res_2['nome']; ?></td>
            <?php } ?>
            <td align="center" bgcolor="#ECF3F7"><img src="../img/IMGtelefones1.png" width="30" height="22" title="
            <?php echo 
			$cel.' // '.$tel1.' // '.$tel2.' // '.$tel3;?>
            " /></td>
            <td width="24" bgcolor="#ECF3F7"><a href="../pgsExcluir/ExcluirPolo.php?id=<?php echo $row_ListarPolos['id']; ?>" class="cCE"><img src="../img/Delete.png" alt="" title="EXCLUIR POLOS" width="24" height="24" /></a></td>
          </tr>
          <tr>
            <td colspan="7" bgcolor="#ECF3F7" class="AA1"><img src="../img/linha.png" width="1060" height="2" /></td>
            </tr>
          <?php } while ($row_ListarPolos = mysql_fetch_assoc($ListarPolos)); ?>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="6"><img src="../img/IMGbarraRodape.png" width="1073" height="32" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($ListarPolos);
?>
