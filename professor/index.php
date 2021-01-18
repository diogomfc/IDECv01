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
        <td width="955" align="right" valign="top"><table width="866">
          <tr>
            <td width="111" height="43">&nbsp;</td>
            <td width="284">&nbsp;</td>
            <td width="28">&nbsp;</td>
            <td width="28">&nbsp;</td>
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
              <td colspan="2" align="right" valign="middle" style="color: #FFCC00; font-size: 30px; font-weight: bold;">&nbsp;</td>
              <td width="280">&nbsp;</td>
              <td width="42"><img src="../img/IMGCalendarioAgendamento.png" alt="" width="34" height="38" /></td>             
		      
			  <?php $sql_2 = mysql_query("SELECT * FROM idec_agendamentoprofessor WHERE data = '$dataMenor'"); ?> 
              <?php while($res_2 = mysql_fetch_array($sql_2)){ ?>
              <td width="187"><span class="FONTDATA"><?php echo date('d/m/Y', strtotime($res_2['data']));?> </span></td>
              <td width="44"><img src="../img/IMGAgendamentoAulas2.png" alt="" width="35" height="40" /></td>
              <td width="280"><span class="FONTDATA"><?php echo $res_2['horario']; ?></span><span style="font-size: 30px; color: #FFFFFF;"> às </span><span class="FONTDATA"><?php echo $res_2['horario1']; ?></span></td>
              </tr>
              <tr>
                
                <td height="42" colspan="2">&nbsp;</td>
                <td colspan="7" valign="bottom"><span class="FONTLIST">POLO:</span>
                <input name="" type="hidden" value="<?php echo $idPolos = $res_2['polos']; ?>" />
                 <?php $sql_3 = mysql_query("SELECT * FROM idec_polos WHERE id = '$idPolos'"); ?> 
              <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
                  <input name="polo" type="text" id="polo" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase;" value="<?php echo $res_3['polos']; ?>" size="15" readonly="readonly" />
                  <?php } ?>
               <span class="FONTLIST"> TURMA: </span>
               <input name="" type="hidden" value="<?php echo $idTumras = $res_2['turma']; ?>" />
                 <?php $sql_4 = mysql_query("SELECT * FROM idec_abrirturmas WHERE id = '$idTumras'"); ?> 
              <?php while($res_4 = mysql_fetch_array($sql_4)){ ?>
               <input name="turma" type="text" id="turma" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase;" value="<?php echo $nomeTuma = $res_4['polos']; ?>" size="40" readonly="readonly" />
			   <?php } ?>
               </td>
             
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="7"><span class="FONTLIST">ENDEREÇO: </span><input name="endereco" type="text" id="endereco" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase;" value="<?php echo $res_2['endereco']; ?>" size="40" readonly="readonly" /><span class="FONTLIST"> Nº: </span><input name="numero" type="text" id="numero" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['numero']; ?>" size="7" readonly="readonly" /> <span class="FONTLIST">CEP: </span><input name="cep" type="text" id="cep" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['cep']; ?>" size="13" readonly="readonly" /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="7"><span class="FONTLIST">BAIRRO:
                  <input name="bairro" type="text" id="bairro" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['bairro']; ?>" size="30" readonly="readonly" />
                </span><span class="FONTLIST">CIDADE:
                <input name="cidade" type="text" id="cidade" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['cidade']; ?>" size="25" readonly="readonly" />
                </span><span class="FONTLIST">UF:
                <input name="estado" type="text" id="estado" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['estado']; ?>" size="5" readonly="readonly" />
                </span></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="7"><span class="FONTLIST">REFERÊNCIA\ESCOLA: </span>
                <input name="referencia" type="text" id="referencia" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['referencia']; ?>" size="60" readonly="readonly" /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="7"><span class="FONTLIST">REPRESENTANTE: 
                    <input name="representante" type="text" id="representante" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['representante']; ?>" size="50" readonly="readonly" />
                </span></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="7" align="left"><span class="FONTLIST">TEL: 
                  <input name="tel" type="text" id="tel" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['tel1']; ?>" size="13" readonly="readonly" />
                </span><span class="FONTLIST"> CEL: 
                <input name="cel" type="text" id="cel" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['cel']; ?>" size="13" readonly="readonly" />
                </span><span class="FONTLIST"> TEL1: </span>
                <input name="tel1" type="text" id="tel1" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['tel2']; ?>" size="13" readonly="readonly" />
                <span class="FONTLIST"> TEL2: 
                <input name="tel2" type="text" id="tel2" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['tel2']; ?>" size="13" readonly="readonly" />
                </span></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="7" align="left"><span class="FONTLIST">CURSO:</span> <input name="curso" type="text" id="curso" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['curso']; ?>" size="60" readonly="readonly" /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="7" align="left"><span class="FONTLIST">DISCIPLINAS:</span> <input name="disciplinas" type="text" id="disciplinas" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $res_2['disciplina']; ?>" size="70" readonly="readonly" /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td width="52" rowspan="3" align="left" valign="top"><span class="FONTLIST">OBS:</span></td>
                <td colspan="6" rowspan="3" align="left" valign="top"><textarea name="obs" cols="75" rows="3" readonly="readonly" id="obs" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; text-transform:uppercase; "><?php echo $res_2['obs']; ?></textarea></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="7" rowspan="2" align="center" valign="top"><table width="752">
                  <tr>
                    <td width="331"><a rel="superbox[iframe][1000x500]" href="../pgsCadastros/historicoEstudante.php?polos=<?php echo $idTumras; ?><?php echo $nomeTuma; ?>"><img src="../img/BTListagemAlunosTurmas.png" alt="" width="308" height="23" /></a></td>
                    <td width="136"><img src="../img/BTDiariodeClasse.png" width="308" height="23" /></td>
                    <td width="136">VER MAPAS</td>
                  </tr>
                </table>                  <a rel="superbox[iframe][1000x500]" href="../pgsCadastros/historicoEstudante.php?polos=<?php echo $ID_polosid; ?><?php echo $ID_polos; ?>"></a></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <?php }} ?>
      </table></td>
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
