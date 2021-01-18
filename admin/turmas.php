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

$maxRows_rs_polosTurmas = 100;
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
$query_rs_polosTurmas = sprintf("SELECT * FROM idec_abrirturmas WHERE polos LIKE %s ORDER BY polos ASC" , GetSQLValueString("%" . $colname_rs_polosTurmas . "%", "text")) ;
$query_limit_rs_polosTurmas = sprintf("%s LIMIT %d, %d", $query_rs_polosTurmas, $startRow_rs_polosTurmas, $maxRows_rs_polosTurmas);
$rs_polosTurmas = mysql_query($query_limit_rs_polosTurmas, $ConexaoIdec) or die(mysql_error());
$row_rs_polosTurmas = mysql_fetch_assoc($rs_polosTurmas);
$totalRows_rs_polosTurmas = mysql_num_rows($rs_polosTurmas);

if (isset($_GET['totalRows_rs_polosTurmas'])) {
  $totalRows_rs_polosTurmas = $_GET['totalRows_rs_polosTurmas'];
} else {
  $all_rs_polosTurmas = mysql_query($query_rs_polosTurmas);
  $totalRows_rs_polosTurmas = mysql_num_rows($all_rs_polosTurmas);
}
$totalPages_rs_polosTurmas = ceil($totalRows_rs_polosTurmas/$maxRows_rs_polosTurmas)-1;

$queryDeletar = mysql_query("DELETE FROM idec_abrirturmas WHERE polos = ''");
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

  <style>
  label {
    display: inline-block;
    width: 10em;
  }
  .SSS {
	font-family: Calibri;
	font-size: 18px;
}
  </style>





<style type="text/css">
.aa {
	color: #1B4871;
	font-family: Calibri;
	font-size: 18px;
}
.bb {
	color: #333;
	font-weight: bold;
}
.bb {
	font-family: Calibri;
}
.bb {
	font-size: 18px;
}
.total {
	font-weight: bold;
	font-family: Calibri;
	color: #2D76B9;
}
</style>
</head>

<body>
<table width="1080" height="348" align="center" style="background: url(../img/imgFundoPolos1.png) no-repeat; color: #1B4871; font-family: Calibri;">
  <tr>
    <td valign="top"><table width="1064">
      <tr>
        <td width="3" height="114">&nbsp;</td>
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
        <td width="1">&nbsp;</td>
        </tr>
      <tr>
        <td height="31">&nbsp;</td>
        <td width="188"><a href="index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
        <td width="856"><a href="../pgsCadastros/CadastroAbrirTurmas.php"><img src="../img/btAbrirTurmas.png" width="197" height="33" /></a></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="123">&nbsp;</td>
        <td colspan="2" valign="top"><form id="form1" name="form1" method="post" action="">
          <table width="984" height="89" align="center">
            <tr>
              <td width="144" height="11">&nbsp;</td>
              <td width="274">&nbsp;</td>
              <td width="354">&nbsp;</td>
              <td width="97">&nbsp;</td>
              <td width="91">&nbsp;</td>
            </tr>
            <tr>
              <td height="11"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">POLOS/TURMAS</span></td>
              <td width="274">&nbsp;</td>
              <td width="354">&nbsp;</td>
              <td width="97">&nbsp;</td>
              <td width="91">&nbsp;</td>
            </tr>
            <tr>
              <td height="31" colspan="2"><label for="rm">
                <input name="polos" type="text" id="polos" size="60" />
              </label></td>
              <td height="31"><label for="nome">
                <input type="image" name="button" id="button" src="../img/BT2localizar.png" />
              </label></td>
              <td height="31">&nbsp;</td>
              <td height="31">&nbsp;</td>
            </tr>
          </table>
        </form></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="27">&nbsp;</td>
        <td colspan="2"><table width="535">
          <tr>
            <td width="233">&nbsp;</td>
            <td width="290" valign="bottom" class="total"><?php echo $totalRows_rs_polosTurmas ?></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="67" colspan="4" valign="top"><table width="1066" border="0">
          <tr>
            <td width="394"><span style="font-family: Calibri; font-weight: bold; color: #B7302A; font-size: 18px; text-align: center;">POLOS/TURMAS:</span></td>
            <td width="201"><span style="font-family: Calibri; color: #1A476F; font-weight: bold; font-size: 18px; text-align: center;">DATA INÍCIO:</span></td>
            <td width="201"><span style="font-family: Calibri; color: #1A476F; font-weight: bold; font-size: 18px; text-align: center;">DATA FINAL</span></td>
            <td width="185"><span style="font-family: Calibri; color: #1A476F; font-weight: bold; font-size: 18px; text-align: center;">STATUS:</span></td>
            <td width="69">&nbsp;</td>
            </tr>
          <?php $i = 0; do { ?>
            <tr>
              <?php 
		
		$data_inicial = date("Y-m-d");  
        $data_final = $row_rs_polosTurmas['dataFinal'];

        $d1 = strtotime("$data_inicial");
        $d2 = strtotime("$data_final");

        $data =($d2 - $d1)/86400;
		
		       ?>
              <input name="input" type="hidden" value="<?php echo $idturmas = $row_rs_polosTurmas['id']; ?>" />
              <td class="aa" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><span style=" text-transform:uppercase;"><?php echo $row_rs_polosTurmas['polos']; ?></span></td>
              <td class="aa" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><?php echo date('d/m/Y', strtotime($row_rs_polosTurmas['dataInicio']));?></td>
              <td class="aa" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><?php echo date('d/m/Y', strtotime($row_rs_polosTurmas['dataFinal']));?></td>
              <td class="bb" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><?php if ($data < 0) {
           mysql_query("UPDATE idec_abrirturmas SET status = 'Encerrada' WHERE id ='$idturmas'");
           }else{
           mysql_query("UPDATE idec_abrirturmas SET status = 'Aberta' WHERE id ='$idturmas'");	
           }
	      ?>
                <?php if ($row_rs_polosTurmas['status'] == 'Encerrada'){
      echo "<b><font color='#FF0000'>Turma Encerrada </font></b>";
      }else{
      echo "<b><font color='#009900'>Turma Aberta </font></b>";
       }
	 ?></td>
              <td bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>" class="bb"><span style="font-weight: bold; font-family: Calibri; color: #F00;"><a href="../pgsExcluir/ExcluirTurma.php?id=<?php echo $row_rs_polosTurmas['id']; ?>"><img src="../img/Delete.png" title="EXCLUIR TURMA" alt="" width="24" height="24" /></a><a rel="superbox[iframe][1000x500]" href="../pgsCadastros/historicoEstudante.php?polos=<?php echo $row_rs_polosTurmas['id']; ?><?php echo $row_rs_polosTurmas['polos']; ?>"><img src="../img/imgRelacaoAlunos.png" alt="" title="ALUNOS DESSA TURMA" width="21" height="24" /></a><a href="JavaScript:location.reload(true);"><img src="../img/atualizar.png" alt="" width="24" height="24" title="ATUALIZAR STATUS" /></a></span></td>
              </tr>
            <tr>
              <td colspan="5" class="aa"><img src="../img/linha.png" width="1066" height="2" /></td>
              </tr>
            <?php $i++; } while ($row_rs_polosTurmas = mysql_fetch_assoc($rs_polosTurmas)); ?>
        </table></td>
        </tr>
      <tr>
        <td height="24" colspan="4"><img src="../img/IMGbarraRodape.png" width="1065" height="32" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_polosTurmas);
?>
