<?php require_once('../Connections/ConexaoIdec.php'); ?>

<?php

$data1 = date('Y-m-d');
$sql_cadastra = mysql_query("UPDATE idec_agendamentoprofessor SET status = 'OFF' WHERE data < '$data1'");

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$professor  = $_SESSION['nome'];
$painel_atual = "professor";


// Verifica se não há a variável da sessão que identifica o usuário
if ($painel = $_SESSION['painel'] != $painel_atual) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../index.php"); exit;
}




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

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_result = "SELECT id, MIN(data), status FROM idec_agendamentoprofessor WHERE professor = '$professor' AND status = 'ON'";
$result = mysql_query($query_result, $ConexaoIdec) or die(mysql_error());
$row_result = mysql_fetch_assoc($result);
$totalRows_result = mysql_num_rows($result);

$dataMenor = $row_result['MIN(data)'];
$status1 =  $row_result['status'];
$idProfessor = $row_result['id'];


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

				closeTxt: "FECHAR",

				loadTxt: "Carregando...",

				nextTxt: "Next",

				prevTxt: "Previous"

			};

			$.superbox();

		});

	</script>




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
  .FONTLIST {
	color: #B00C0B;
	font-weight: bold;
	font-size: 24px;
}
  .FONTDATA {
	font-size: 30px;
	color: #FF9900;
}
  </style>

</head>

<body><table width="997" height="717" align="center" style="background: url(../img/imgFundoGerenciamentoProfessorIndex.png) no-repeat; color: #000000; font-family: Calibri; font-size: 20px;">
  <tr>
    <td width="140" valign="top" class="" ><table width="984">
      <tr>
        <td width="7" height="121">&nbsp;</td>
        <td width="955" align="right" valign="top"><table width="526">
          <tr>
            <td width="111" height="43">&nbsp;</td>
            <td width="284">&nbsp;</td>
            <td width="28"><a href="../CadastroAcesso.php"><img src="../img/imNovoUsuario2.png" width="28" height="30" title="Novo Usuário" /></a></td>
            <td width="28"><a><img src="../img/imgTrocarSenha2.png" width="28" height="30" title="Trocar Senha de Acesso"/></a></td>
            <td width="28"><a href="../logout.php"><img src="../img/btLogof.png" width="28" height="30" title="Logoff" /></a></td>
            <td width="19">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5" align="right">Seja Bem Vindo:<strong> <?php echo $_SESSION['nome']; ?></strong></td>
            <td align="right">&nbsp;</td>
            </tr>
        </table></td>
        <td width="10">&nbsp;</td>
      </tr>
      <tr>
        <td height="146">&nbsp;</td>
        <td valign="top"><table width="984" height="144">
          <tr>
            <td width="22" height="138">&nbsp;</td>
            <td width="160"><img src="../img/BTMDiarioDeClasse.png" width="146" height="97" /></td>
            <td width="161"><img src="../img/BTMListaDePresenca.png" width="157" height="101" /></td>
            <td width="87">&nbsp;</td>
            <td width="110">&nbsp;</td>
            <td width="115">&nbsp;</td>
            <td width="122">&nbsp;</td>
            <td width="171">&nbsp;</td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32">&nbsp;</td>
        <td align="right"><table width="596">
          <tr>
            <td width="457" height="24" align=""><?php if($status1 != 'ON'){ echo "<br><br> <b><font size='5'><font color='#FF9900'>NO MOMENTO NÃO EXISTE AULAS AGENDADAS!</font><br><br>"; }else{ ?></td>
            <td width="43"><a rel="superbox[iframe][700x350]" href="../pgsCadastros/CadastroMensagens.php"><img src="../img/btNovaMsn.png" alt="" width="26" height="26" title="Adicionar nova mensagem"/></a></td>
            <td width="80"><a href="JavaScript:location.reload(true);"><img src="../img/atualizar.png" alt="" width="24" height="24" title="ATUALIZAR MENSAGEM" /></a></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="232">&nbsp;</td>
        <td valign="top"><table width="945" border="0">
            <tr>
              <td width="1" align="right" valign="top" style="color: #FFFFFF; font-size: 30px;">&nbsp;</td>
              <td width="1" align="right" valign="top" style="color: #FFFFFF; font-size: 30px;">&nbsp;</td>
              <td align="right" valign="middle" style="color: #FFCC00; font-size: 30px; font-weight: bold;">&nbsp;</td>
              <td width="41"><img src="../img/IMGCalendarioAgendamento.png" alt="" width="34" height="38" /></td>             
		      
			  <?php $sql_2 = mysql_query("SELECT * FROM idec_agendamentoprofessor WHERE data = '$dataMenor'"); ?> 
              <?php while($res_2 = mysql_fetch_array($sql_2)){ ?>
              <td width="173"><span class="FONTDATA"><?php echo date('d/m/Y', strtotime($res_2['data']));?> </span></td>
              <td width="41"><img src="../img/IMGAgendamentoAulas2.png" alt="" width="35" height="40" /></td>
              <td width="304"><span class="FONTDATA"><?php echo $res_2['horario']; ?></span><span style="font-size: 30px; color: #FFFFFF;"> às </span><span class="FONTDATA"><?php echo $res_2['horario1']; ?></span></td>
              </tr>
            
              <tr>
              <input name="input" type="hidden" value="<?php echo $polos = $res_2['polo']; ?>" />
                <?php $sql_3 = mysql_query("SELECT * FROM idec_abrirturmas WHERE id = '$polos'"); ?>
              <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
                <input name="input" type="hidden" value="<?php echo $ID_polosid = $res_3['id']; ?>" />
                <td height="42" colspan="2">&nbsp;</td>
                <td colspan="5" valign="bottom"><span class="FONTLIST">POLO:</span> <?php echo $ID_polos = $res_3['polos']; ?></td>
              <?php } ?>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="5"><span class="FONTLIST">ENDEREÇO: </span><?php echo $res_2['endereco']; ?></td>
                </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="5"><span class="FONTLIST">CURSO:</span> <?php echo $res_2['curso']; ?></td>
                </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="5"><span class="FONTLIST">DISCIPLINAS:</span> <?php echo $res_2['disciplina']; ?></td>
                </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="5"><span class="FONTLIST">OBS:</span> <?php echo $res_2['obs']; ?></td>
                </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="5" align="center"><a rel="superbox[iframe][1000x500]" href="../pgsCadastros/historicoEstudante.php?polos=<?php echo $ID_polosid; ?><?php echo $ID_polos; ?>"><img src="../img/BTListagemAlunosTurmas.png" width="308" height="23" /></a></td>
              </tr>
              <?php }} ?>
      </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="50">&nbsp;</td>
        <td valign="middle">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($result);
?>
