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

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM idec_mensagem WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($deleteSQL, $ConexaoIdec) or die(mysql_error());
}

$maxRows_rs_mensagem = 8;
$pageNum_rs_mensagem = 0;
if (isset($_GET['pageNum_rs_mensagem'])) {
  $pageNum_rs_mensagem = $_GET['pageNum_rs_mensagem'];
}
$startRow_rs_mensagem = $pageNum_rs_mensagem * $maxRows_rs_mensagem;

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_mensagem = "SELECT * FROM idec_mensagem ORDER BY id DESC";
$query_limit_rs_mensagem = sprintf("%s LIMIT %d, %d", $query_rs_mensagem, $startRow_rs_mensagem, $maxRows_rs_mensagem);
$rs_mensagem = mysql_query($query_limit_rs_mensagem, $ConexaoIdec) or die(mysql_error());
$row_rs_mensagem = mysql_fetch_assoc($rs_mensagem);

if (isset($_GET['totalRows_rs_mensagem'])) {
  $totalRows_rs_mensagem = $_GET['totalRows_rs_mensagem'];
} else {
  $all_rs_mensagem = mysql_query($query_rs_mensagem);
  $totalRows_rs_mensagem = mysql_num_rows($all_rs_mensagem);
}
$totalPages_rs_mensagem = ceil($totalRows_rs_mensagem/$maxRows_rs_mensagem)-1;

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_estudantes = "SELECT * FROM idec_estudantes";
$rs_estudantes = mysql_query($query_rs_estudantes, $ConexaoIdec) or die(mysql_error());
$row_rs_estudantes = mysql_fetch_assoc($rs_estudantes);
$totalRows_rs_estudantes = mysql_num_rows($rs_estudantes);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_professores = "SELECT * FROM idec_professores";
$rs_professores = mysql_query($query_rs_professores, $ConexaoIdec) or die(mysql_error());
$row_rs_professores = mysql_fetch_assoc($rs_professores);
$totalRows_rs_professores = mysql_num_rows($rs_professores);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_vendedores = "SELECT * FROM ide_representantes";
$rs_vendedores = mysql_query($query_rs_vendedores, $ConexaoIdec) or die(mysql_error());
$row_rs_vendedores = mysql_fetch_assoc($rs_vendedores);
$totalRows_rs_vendedores = mysql_num_rows($rs_vendedores);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_AcessoSistema = "SELECT * FROM acesso_ao_sistema";
$rs_AcessoSistema = mysql_query($query_rs_AcessoSistema, $ConexaoIdec) or die(mysql_error());
$row_rs_AcessoSistema = mysql_fetch_assoc($rs_AcessoSistema);
$totalRows_rs_AcessoSistema = mysql_num_rows($rs_AcessoSistema);
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

  <style>
  .SSS {
	font-family: Calibri;
	font-size: 18px;
}
  .aa {
}
  .aay {
	color: #009900;
}
  .ss {
	font-weight: normal;
}
  .ssd {
	color: #666666;
}
  .aajj {
	color: #666666;
}
  </style>


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




</head>

<body><table width="997" height="717" align="center" style="background: url(../img/imgFundoGerenciamento2.png) no-repeat; color: #1B4871; font-family: Calibri;">
  <tr>
    <td width="140" valign="top" class="" ><table width="984">
      <tr>
        <td width="7" height="121">&nbsp;</td>
        <td width="955" align="right" valign="top"><table width="462">
          <tr>
            <td width="111" height="43">&nbsp;</td>
            <td width="212">&nbsp;</td>
            <td width="28"><a href="../CadastroAcesso.php"><img src="../img/imNovoUsuario2.png" width="28" height="30" title="Novo Usuário" /></a></td>
            <td width="28"><a href="../trocarSenha.php?id_Acesso=<?php echo $_SESSION['id']; ?>"><img src="../img/imgTrocarSenha2.png" width="28" height="30" title="Trocar Senha de Acesso"/></a></td>
            <td width="32"><a href="../logout.php"><img src="../img/btLogof.png" width="28" height="30" title="Logoff" /></a></td>
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
        <td width="10">&nbsp;</td>
      </tr>
      <tr>
        <td height="242">&nbsp;</td>
        <td valign="top"><table width="984" height="240">
          <tr>
            <td width="25" height="115">&nbsp;</td>
            <td width="123"><a href="estudante1.php"><img name="btalunos" src="../img/btalunos.gif" width="116" height="113" border="0" id="btalunos" alt="" title="Alunos" /></a></td>
            <td width="118"><a href="matriculas.php"><img name="btmatriculas" src="../img/btmatriculas.png" width="116" height="113" border="0" id="btmatriculas" alt="" title="Matrículas" /></a></td>
            <td width="116"><a href="cursos1.php"><img name="btcursos" src="../img/btcursos.gif" width="116" height="113" border="0" id="btcursos" alt=""  title="Cursos"/></a></td>
            <td width="121" align="center"><a href="turmas.php"><img src="../img/btAbrirTurmaIndex.png" width="116" height="113" /></a></td>
            <td width="127"><a href="professor.php"><img name="btprofessores" src="../img/btprofessores.gif" width="116" height="113" border="0" id="btprofessores" alt="" title="Professores" /></a></td>
            <td width="134"><a href="vendedores.php"><img name="btvendedores" src="../img/btvendedores.gif" width="116" height="113" border="0" id="btvendedores" alt="" title="Vendedores" /></a></td>
            <td width="184"><a href="certificados.php"><img src="../img/btCertificados.png" width="110" height="95" title="Certificados" /></a></td>
          </tr>
          <tr>
            <td height="117">&nbsp;</td>
            <td><a href="agendamentoAulas.php"><img src="../img/IMGAgendamentoAulas.png" width="145" height="120" /></a></td>
            <td><a href="polos.php"><img name="btpolos" src="../img/btpolos.png" width="116" height="113" border="0" id="btpolos" alt="" title="Polos" /></a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
			<a href="../chat/index.php" target="new"><img src="../img/btChat.png" width="116" height="113" /></a></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32">&nbsp;</td>
        <td align="right"><table width="410">
          <tr>
            <td width="305" height="24"><span class="ssd">Total: </span></a><span class="aay"><?php echo $totalRows_rs_mensagem ?></span></td>
            <td width="26"><a rel="superbox[iframe][700x350]" href="../pgsCadastros/CadastroMensagens.php"><img src="../img/btNovaMsn.png" alt="" width="26" height="26" title="Adicionar nova mensagem"/></a></td>
            <td width="63"><a href="JavaScript:location.reload(true);"><img src="../img/atualizar.png" alt="" width="24" height="24" title="ATUALIZAR MENSAGEM" /></a></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="232">&nbsp;</td>
        <td valign="top"><table width="963" border="0" align="left">
          <tr>
              <td width="265" class="aa">Para:</td>
              <td colspan="2" class="aa">   Mensagem :</td>
              </tr>
            <?php 
			$i = 0;
			
			do { ?>
              <tr bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>">
                <td bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><?php echo $row_rs_mensagem['paraPessoa']; ?></td>
                <td width="660" bgcolor="<?php if ($i%2==0){ echo "#F8F8F8"; } ?>"><?php echo $row_rs_mensagem['mensagem']; ?></td>
                <td width="24"><a href="index.php?id=<?php echo $row_rs_mensagem['id']; ?>"><img src="../img/Delete.png" title="DELETAR MENSAGEM"  width="24" height="24" /></a></td>
                </tr>
              <?php $i++; } while ($row_rs_mensagem = mysql_fetch_assoc($rs_mensagem)); ?>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="50">&nbsp;</td>
        <td valign="middle"><span class="aajj">Existem <?php echo $totalRows_rs_estudantes ?> Alunos, <?php echo $totalRows_rs_professores ?> Pofessores,  <?php echo $totalRows_rs_vendedores ?> Vendedores Cadastrados</span></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rs_mensagem);

mysql_free_result($rs_estudantes);

mysql_free_result($rs_professores);

mysql_free_result($rs_vendedores);

mysql_free_result($rs_AcessoSistema);
?>
