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
date_default_timezone_set('America/Sao_Paulo');
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
$maxRows_rs_matriculas = 30;
$pageNum_rs_matriculas = 0;
if (isset($_GET['pageNum_rs_matriculas'])) {
  $pageNum_rs_matriculas = $_GET['pageNum_rs_matriculas'];
}
$startRow_rs_matriculas = $pageNum_rs_matriculas * $maxRows_rs_matriculas;

$colname_rs_matriculas = "-1";
if (isset($_POST['polo'])) {
  $colname_rs_matriculas = $_POST['polo'];
  
}
$colestudante_rs_matriculas = "-1";
if (isset($_POST['nomeEstudante'])) {
  $colestudante_rs_matriculas = $_POST['nomeEstudante'];
}
$colname_rs_matriculas = "-1";
if (isset($_POST['polo'])) {
  $colname_rs_matriculas = $_POST['polo'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_matriculas = sprintf("SELECT * FROM idec_matriculas WHERE polo LIKE %s and nomeEstudante  LIKE %s", GetSQLValueString("%" . $colname_rs_matriculas . "%", "text"),GetSQLValueString("%" . $colestudante_rs_matriculas . "%", "text"));
$rs_matriculas = mysql_query($query_rs_matriculas, $ConexaoIdec) or die(mysql_error());
$row_rs_matriculas = mysql_fetch_assoc($rs_matriculas);
$totalRows_rs_matriculas = mysql_num_rows($rs_matriculas);

$colname_rs_cursos = "-1";
if (isset($_POST['cursos'])) {
  $colname_rs_cursos = $_POST['cursos'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_cursos = sprintf("SELECT * FROM idec_cursos WHERE cursos = %s", GetSQLValueString($colname_rs_cursos, "text"));
$rs_cursos = mysql_query($query_rs_cursos, $ConexaoIdec) or die(mysql_error());
$row_rs_cursos = mysql_fetch_assoc($rs_cursos);
$totalRows_rs_cursos = mysql_num_rows($rs_cursos);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../img/iconIdec.png" />

<script language="javascript" src="file:///D|/xampp/htdocs/lightbox/js/jquery-1.10.2.min.js"></script>
<script src="../js/lightbox/js/lightbox-2.6.min.js"></script>
<link href="../js/lightbox/css/lightbox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../js/jquery.superbox.css" type="text/css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.superbox-min.js"></script>
  
  <script type="text/javascript">

		$(function(){

			$.superbox.settings = {

				closeTxt: "FECHAR",

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
  </style>


<style type="text/css">
.AA {color: #1A476F;
	font-weight: bold;
	text-align: center;
}
.CCC {
	font-family: Calibri;
	text-align: center;
	font-size: 18px;
	color: #1B4871;
}
aa {
	font-family: Calibri;
}
.AA td {
	font-size: 18px;
	font-family: Calibri;
	color: #B7302A;
}
AAA {
	font-weight: bold;
}
.total {
	font-weight: bold;
	font-family: Calibri;
	color: #2D76B9;
}
</style>

</head>

<body>


<table width="996" height="398" align="center" style="background: url(../img/imgFundoCertificados.png) no-repeat; color: #1B4871; font-family: Calibri;">
  <tr>
    <td valign="top"><table width="991">
      <tr>
        <td width="3" height="115">&nbsp;</td>
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
        <td height="45">&nbsp;</td>
        <td width="204"><a href="index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
        <td width="935"><a href="estudante1.php"><img src="../img/BTPesquisarEstudante1.png" alt="" width="197" height="33" /></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="103">&nbsp;</td>
        <td colspan="2"><form id="form1" name="form1" method="post" action="">
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
              <td width="171"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">POLO:</span></td>
              <td width="420"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">ESTUDANTE:</span></td>
              <td width="128">&nbsp;</td>
              <td width="115">&nbsp;</td>
            </tr>
            <tr>
            
              <td height="31"></td>
              <td height="31"><label for="polo"></label>
                <input name="polo" type="text" id="polo" value="" onkeypress="javascript:this.value=this.value.toUpperCase();" /></td>
              <td height="31"><label for="nomeEstudante"></label>
                <input name="nomeEstudante" type="text" id="nomeEstudante" size="60" onkeypress="javascript:this.value=this.value.toUpperCase();" /></td>
              <td height="31">
                <input type="image" name="button" id="button" onclick="Oculta()" src="../img/BT2localizar.png" />
             </td>
              <td height="31"></td>
            </tr>
          </table>
        </form></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" align="left" valign="bottom"><table width="1130">
          <tr>
            <td width="231">&nbsp;</td>
            <td width="822" valign="bottom" class="total"><?php echo $totalRows_rs_matriculas ?></td>
            <td width="61"><a href="JavaScript:location.reload(true);"><img src="../img/atualizar.png" alt="" width="24" height="24" title="ATUALIZAR DADOS" /></a></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
      
        <td height="71" colspan="3" valign="top"><table id="tabela1" border="0">
          <tr class="AA">
            <td width="99">MATRÍCULA:</td>
            <td width="99">ESTUDANTE:</td>
            <td width="90">INÍCIO:</td>
            <td width="90">TÉRMINO:</td>
            <td width="155">CUROS:</td>
            <td width="104">DISCIPLINAS:</td>
            <td width="104">POLOS:</td>
            <td width="83">STATUS:</td>
            <td width="144">REPRESENTANTES:</td>
            <td width="68">VALOR:</td>
            <td width="122">CERTIFICADO: </td>
            </tr>
          <?php do { ?>
            <tr class="CCC">
              <?php 
		
		$data_inicial = date("Y-m-d");  
        $data_final = $row_rs_matriculas['terminoCurso'];

        $d1 = strtotime("$data_inicial");
        $d2 = strtotime("$data_final");

        $data =($d2 - $d1)/86400;
		
		       ?>
              <input name="input" type="hidden" value="<?php echo $EntregueNao = $row_rs_matriculas['certificadosNao']; ?>" />
              <input name="input" type="hidden" value="<?php echo $EntregueSim = $row_rs_matriculas['certificadosSim']; ?>" />
              <input name="input" type="hidden" value="<?php echo $curso = $row_rs_matriculas['id_curso']; ?>" />
              <input name="input" type="hidden" value="<?php echo $polo = $row_rs_matriculas['polo']; ?>" />
              <td width="99" bgcolor="#ECF3F7"><?php echo $row_rs_matriculas['cod']; ?></td>
              <td width="99" bgcolor="#ECF3F7" class="AA"><?php echo $row_rs_matriculas['nomeEstudante']; ?></td>
              <td width="90" bgcolor="#ECF3F7"><?php echo date('d/m/Y', strtotime($row_rs_matriculas['inicioCurso']));?></td>
              <td width="90" bgcolor="#ECF3F7"><?php echo date('d/m/Y', strtotime($row_rs_matriculas['terminoCurso']));?></td>
              <?php $sql_2 = mysql_query("SELECT * FROM idec_cursos WHERE id_curso = '$curso'"); ?>
              <?php while($res_2 = mysql_fetch_array($sql_2)){ ?>
              <td width="155" bgcolor="#ECF3F7"><?php echo $res_2['cursos']; ?></td>
              <?php } ?>
              <td width="104" bgcolor="#ECF3F7"><a href="#" ><img src="../img/listar.png" alt="" width="32" height="32" title="<?php echo $row_rs_matriculas['disciplinas']; ?>"/></a></td>
              <?php $sql_3 = mysql_query("SELECT * FROM idec_abrirturmas WHERE id = '$polo'"); ?>
              <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
              <td width="104" bgcolor="#ECF3F7"><?php echo $res_3['polos']; ?></td>
              <?php } ?>
              <td width="83" bgcolor="#ECF3F7"><?php  if ($data < 0) {
      echo "<b><font color='#FF0000'> Encerrado </font></b>";
      }else{
      echo "<b><font color='#009900'> Cursando </font></b>";
       }?></td>
              <td width="144" bgcolor="#ECF3F7"><?php echo $row_rs_matriculas['representante']; ?></td>
              <td width="68" bgcolor="#ECF3F7"><?php echo $row_rs_matriculas['valor']; ?></td>
              <td width="122" bgcolor="#ECF3F7">          
                <?php  if ($EntregueSim != 'SIM') {
      echo "<IMG SRC='../img/imgNao1.png'>";
      }else{
      echo "<IMG SRC='../img/imgSim1.png'>";
       }?>
                <a rel="superbox[iframe][400x210]" href="../pgsCadastros/SimNao.php?id=<?php echo $row_rs_matriculas['id']; ?>"><img src="../img/imgAlterar.png" alt="" width="53" height="11" title="ALTERAR"/></a><span style="font-size: 12px"><?php echo $row_rs_matriculas['dataEntrega']; ?></span></td>
            </tr>
            <tr class="CCC">
              <td height="" colspan="11" bgcolor="#ECF3F7" align="left"><img src="../img/linha.png" width="1141" height="2" /></td>
            </tr>
            <?php } while ($row_rs_matriculas = mysql_fetch_assoc($rs_matriculas)); ?>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><img src="../img/IMGbarraRodape.png" alt="" width="1146" height="32" /></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_matriculas);

mysql_free_result($rs_cursos);

?>
