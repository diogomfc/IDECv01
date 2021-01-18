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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Chamados = 11;
$pageNum_Chamados = 0;
if (isset($_GET['pageNum_Chamados'])) {
  $pageNum_Chamados = $_GET['pageNum_Chamados'];
}
$startRow_Chamados = $pageNum_Chamados * $maxRows_Chamados;

$colname_Chamados = "-1";
if (isset($_POST['nome'])) {
  $colname_Chamados = $_POST['nome'];
}
$colcpf_Chamados = "-1";
if (isset($_POST['cpf'])) {
  $colcpf_Chamados = $_POST['cpf'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_Chamados = sprintf("SELECT * FROM idec_chamados WHERE nome LIKE %s and cpf LIKE %s ORDER BY idec_chamados.id DESC", GetSQLValueString("%" . $colname_Chamados . "%", "text"),GetSQLValueString("%" . $colcpf_Chamados . "%", "text"));
$query_limit_Chamados = sprintf("%s LIMIT %d, %d", $query_Chamados, $startRow_Chamados, $maxRows_Chamados);
$Chamados = mysql_query($query_limit_Chamados, $ConexaoIdec) or die(mysql_error());
$row_Chamados = mysql_fetch_assoc($Chamados);

if (isset($_GET['totalRows_Chamados'])) {
  $totalRows_Chamados = $_GET['totalRows_Chamados'];
} else {
  $all_Chamados = mysql_query($query_Chamados);
  $totalRows_Chamados = mysql_num_rows($all_Chamados);
}
$totalPages_Chamados = ceil($totalRows_Chamados/$maxRows_Chamados)-1;

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_listarCursos = "SELECT * FROM idec_chamados";
$rs_listarCursos = mysql_query($query_rs_listarCursos, $ConexaoIdec) or die(mysql_error());
$row_rs_listarCursos = mysql_fetch_assoc($rs_listarCursos);
$totalRows_rs_listarCursos = mysql_num_rows($rs_listarCursos);

$queryString_Chamados = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Chamados") == false && 
        stristr($param, "totalRows_Chamados") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Chamados = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Chamados = sprintf("&totalRows_Chamados=%d%s", $totalRows_Chamados, $queryString_Chamados);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../img/iconIdec.png" />

<script language="javascript" src="../lightbox/js/jquery-1.10.2.min.js"></script>
<script src="../js/lightbox/js/lightbox-2.6.min.js"></script>
<link href="../js/lightbox/css/lightbox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../js/jquery.superbox.css" type="text/css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.superbox-min.js"></script>

  <style>
  .SSS {
	font-family: Calibri;
	font-size: 18px;
}
  </style>


<script type="text/javascript">

		$(function(){

			$.superbox.settings = {

				closeTxt: "Fechar",

				loadTxt: "Carregando...",

				nextTxt: "Next",

				prevTxt: "Previous"

			};

			$.superbox();

		});

	</script>
<script language='JavaScript'>
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}
</script>


</head>

<body>
<table width="1008" height="717" align="center" style="background: url(../img/imgChamados.png) no-repeat; color: #1B4871; font-family: Calibri;">
  <tr>
    <td valign="top"><table width="1000">
      <tr>
        <td width="10" height="121">&nbsp;</td>
        <td width="984" align="right" valign="top"><table width="462">
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
        <td width="103">&nbsp;</td>
      </tr>
      <tr>
        <td height="39">&nbsp;</td>
        <td valign="top"><table width="359">
          <tr>
            <td width="182"><a href="index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
            <td width="165"><a href="../pgsCadastros/CadastroEstudante1.php"><img src="../img/BTChamado.png" width="154" height="32" /></a></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="75">&nbsp;</td>
        <td><form id="form1" name="form1" method="post" action="">
          <table width="984" height="50" align="center">
            <tr>
              <td width="126" height="11">&nbsp;</td>
              <td width="171"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">CPF:</span></td>
              <td width="420"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">NOME:</span></td>
              <td width="128">&nbsp;</td>
              <td width="115">&nbsp;</td>
            </tr>
            <tr>
              <td height="31"><label for="rm"></label></td>
              <td height="31"><label for="cpf"></label>
                <input type="text" name="cpf" id="cpf" onkeypress='return SomenteNumero(event)'/></td>
              <td height="31"><label for="nome"></label>
                <input name="nome" type="text" onkeypress="javascript:this.value=this.value.toUpperCase();" id="nome" size="60" /></td>
              <td height="31"><label for="matricula">
                <input type="image" name="button" id="button" src="../img/BT2localizar.png" />
              </label></td>
              <td height="31">&nbsp;</td>
            </tr>
          </table>
        </form></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="33">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="396">&nbsp;</td>
        <td valign="top"><table width="964" align="left">
          <tr>
            <td width="86"><span style="font-family: Calibri; font-weight: bold; color: #B7302A; font-size: 18px; text-align: center;">CHAMADOS</span></td>
            <td width="318"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px; text-align: center;">NOME:</span></td>
            <td width="151"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px; text-align: center;">CPF</span></td>
            <td width="220"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px; text-align: center;">CURSOS:</span></td>
            <td width="32" align="center"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px;">TEL:</span></td>
            <td width="129" align="center"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px;">GERÊNCIAR</span></td>
          </tr>
          <?php $i = 0;
			
			do { ?>
          <tr>
          <input name="" type="hidden" value="<?php echo $tel = $row_Chamados['tel'];  ?>" />
          <input name="" type="hidden" value="<?php echo $code = $row_Chamados['code'];  ?>" />
            <td width="86" height="31" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><span style="text-align: center; color: #1B4871; font-family: Calibri; font-size: 18px;"><?php echo $code; ?></span></td>
            <td width="318" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><span style="text-align: center; color: #1B4871; font-family: Calibri; font-size: 18px;"><?php echo $row_Chamados['nome']; ?></span></td>
            <td width="151" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><span style="font-weight: bold; text-align: center; color: #1B4871; font-family: Calibri; font-size: 18px;"><?php echo $row_Chamados['cpf']; ?></span></td> 
            <td width="220" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><span style="font-weight: bold; text-align: center; color: #1B4871; font-family: Calibri; font-size: 18px;"><?php echo $row_Chamados['curso']; ?></span></td> 
            <td width="32" align="center" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>" class="SSS"><a href=""><img src="../img/IMGtelefones1.png" width="30" height="22" title=" 
<?php echo $tel; ?> "/></a></td>
            <td align="center" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><span style="font-weight: bold; font-family: Calibri; color: #F00;"> <a href="../pgsExcluir/ExcluirEstudante.php?id=<?php echo $row_Chamados['id']; ?>"><img src="../img/Delete.png" alt="" title="EXCLUIR ESTUDANTE" width="24" height="24" /></a> <a href="../pgsCadastros/AlterarEstudante2.php?id=<?php echo $row_Chamados['id']; ?>"><img src="../img/Modify.png" alt="" title="ALTERAR CADASTRO DO ESTUDANTE" width="24" height="24" /></a> <a href="../pgsCadastros/RelatorioFichaCadastralEstudante.php?code=<?php echo $row_Chamados['code']; ?>"><img src="../img/imgImprimir.png" alt="" title="IMPRIMIR FICHA ESTUDANTE" width="21" height="22" /></a><a href="../pgsCadastros/CadastroMatriculas.php?id_estudantes=<?php echo $row_Chamados['id']; ?>"><img src="../img/Add.png" alt="" title="EFETUAR MATRICULA" width="24" height="24" /><a class="a" rel="superbox[iframe][1200x500]" href="../pgsCadastros/historicoMatriculas.php?code=<?php echo $row_Chamados['code']; ?>"><img title="HISTÓRICO MATRICULA ESTUDANTE" src="../img/visualizar16.gif" width="22" height="23" border="0"/></a></span></td>
          </tr>
          <?php $i++; } while ($row_Chamados = mysql_fetch_assoc($Chamados)); ?>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32">&nbsp;</td>
        <td valign="bottom" class="total">Total de registros: <?php echo $totalRows_Chamados ?></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Chamados);

mysql_free_result($rs_listarCursos);
?>
