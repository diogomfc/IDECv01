<?php require_once('../Connections/conexao.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


date_default_timezone_set('America/Sao_Paulo');

@$di = explode("/", $_POST['data'] );
@$dataAgendamento = $di[2] . "-" . $di[1] . "-" . $di[0];


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO idec_agendamentoprofessor (professor, curso, disciplina, polos, `data`, obs, horario, horario1, endereco, representante, cel, tel1, tel2, tel3, numero, cep, cidade, bairro, estado, referencia, telProfessor, celProfessor, cpfProfessor, turma) VALUES (%s, %s, %s, %s, '$dataAgendamento', %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['professor'], "text"),
                       GetSQLValueString($_POST['curso'], "text"),
                       GetSQLValueString($_POST['disciplina'], "text"),
                       GetSQLValueString($_POST['polos'], "text"),
                       GetSQLValueString($_POST['obs'], "text"),
                       GetSQLValueString($_POST['horario'], "text"),
                       GetSQLValueString($_POST['horario1'], "text"),
					   GetSQLValueString($_POST['endereco'], "text"),
					   GetSQLValueString($_POST['representante'], "text"),
					   GetSQLValueString($_POST['cel'], "text"),
					   GetSQLValueString($_POST['tel1'], "text"),
					   @GetSQLValueString($_POST['tel2'], "text"),
					   GetSQLValueString($_POST['tel3'], "text"),
					   GetSQLValueString($_POST['numero'], "text"),
					   @GetSQLValueString($_POST['cep'], "text"),
					   @GetSQLValueString($_POST['cidade'], "text"),
					   GetSQLValueString($_POST['bairro'], "text"),
					   @GetSQLValueString($_POST['estado'], "text"),
					   GetSQLValueString($_POST['referencia'], "text"),
					   GetSQLValueString($_POST['telProfessor'], "text"),
					   GetSQLValueString($_POST['celProfessor'], "text"),
					   GetSQLValueString($_POST['cpfProfessor'], "text"),
					   @GetSQLValueString($_POST['turma'], "text"));
					   

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_turmas = "SELECT * FROM idec_abrirturmas WHERE polos != '' ORDER BY polos ASC";
$rs_turmas = mysql_query($query_rs_turmas, $ConexaoIdec) or die(mysql_error());
$row_rs_turmas = mysql_fetch_assoc($rs_turmas);
$totalRows_rs_turmas = mysql_num_rows($rs_turmas);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_cursos = "SELECT * FROM idec_cursos WHERE cursos != '' ORDER BY cursos ASC";
$rs_cursos = mysql_query($query_rs_cursos, $ConexaoIdec) or die(mysql_error());
$row_rs_cursos = mysql_fetch_assoc($rs_cursos);
$totalRows_rs_cursos = mysql_num_rows($rs_cursos);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_polos = "SELECT * FROM idec_polos WHERE polos != '' ORDER BY polos ASC";
$rs_polos = mysql_query($query_rs_polos, $ConexaoIdec) or die(mysql_error());
$row_rs_polos = mysql_fetch_assoc($rs_polos);
$totalRows_rs_polos = mysql_num_rows($rs_polos);

$colname_rs_professores = "-1";
if (isset($_GET['idProfessor'])) {
  $colname_rs_professores = $_GET['idProfessor'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_professores = sprintf("SELECT * FROM idec_professores WHERE id = %s", GetSQLValueString($colname_rs_professores, "int"));
$rs_professores = mysql_query($query_rs_professores, $ConexaoIdec) or die(mysql_error());
$row_rs_professores = mysql_fetch_assoc($rs_professores);
$totalRows_rs_professores = mysql_num_rows($rs_professores);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="../img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="/IDECv01/js/jquery-ui-1.10.4/development-bundle/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"></script>
  <script src="../js/jquery.mask/mascaras.js"type="text/javascript"></script>
<script src="../js/jquery.mask/jquery.mask.js"type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script>

  function SomenteMaiusculo(e){
    var disciplina = new CaixaAltaMask(document.getElementById("disciplina"));
	var obs = new CaixaAltaMask(document.getElementById("obs"));
	var curso = new CaixaAltaMask(document.getElementById("curso"));
	var turma = new CaixaAltaMask(document.getElementById("turma"));	
}

  function nomesPolos(id){
	$.post("AGPolosJava.php", {idpolos:id}, function(retorno){ 
	  dados = retorno.split("/");
	  $('#representante').val(dados[0]);
	   $('#cel').val(dados[1]);
	    $('#tel1').val(dados[2]);
		 $('#tel2').val(dados[3]);
		  $('#tel3').val(dados[4]);
		   $('#endereco').val(dados[5]);
		    $('#numero').val(dados[6]);
			 $('#cep').val(dados[7]);
			  $('#cidade').val(dados[8]);
			   $('#bairro').val(dados[9]);
			    $('#estado').val(dados[10]);
				 $('#referencia').val(dados[11]);
	  });
  }
 function nomesPolo(id){
	$.post("AGturmasJava.php", {idturma:id}, function(retorno){ 
	  dados = retorno.split("/");
	  $('#status').val(dados[0]);
	  });
  }
$(function() {
    $( "#data" ).datepicker({
	showOn: "button",
    buttonImage: "../img/AgendaCalender2.png",
    buttonImageOnly: true,
    buttonText: "Select date",	
	dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
});
  });
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

  </script>

</head>

<body>

<table width="996" height="348" align="center" style="background: url(../img/imgFundoAgendamentoProfessores1.png) no-repeat; font-family: Calibri; font-size: 20px;">
  <tr>
    <td height="342" valign="top"><table width="990">
      <tr>
        <td width="1" height="112">&nbsp;</td>
        <td colspan="2" align="right" valign="top"><table width="462" style="color: #1B4871; font-family: Calibri; font-size: 18px; font-weight: normal;">
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
        <td width="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="50">&nbsp;</td>
        <td width="178" valign="top"><a href="../admin/index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
        <td width="789" valign="top"><a href="../admin/agendamentoAulas.php"><img src="../img/BTPesquisarAgendamento.png" width="197" height="33" /></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="29">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="552">&nbsp;</td>
        <td colspan="2" valign="top"><table width="969">
          <tr>            </tr>
        </table>
          <form action="<?php echo $editFormAction; ?>" method="POST" name="form" id="form" onkeypress='return SomenteMaiusculo(event)'>
            <table width="969">
              <tr>
                <td height="10" colspan="4">PROFESSOR:
                  <label for="professor"></label>
                  <input name="professor" type="text" id="professor" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " value="<?php echo $row_rs_professores['nome']; ?>" size="60" readonly="readonly" />
                  <input name="idProfessor" type="hidden" id="idProfessor" value="<?php echo $row_rs_professores['id']; ?>" /></td>
              </tr>
              <tr>
                <td height="11" colspan="2">CPF:
                  <label for="cpfProfessor"></label>
                  <input name="cpfProfessor" type="text" id="cpfProfessor" style="font-family:Calibri; font-size:20px;  color:#099; border:none; background-color: transparent; " value="<?php echo $row_rs_professores['cpf']; ?>" size="13" readonly="readonly"/></td>
                <td align="center">&nbsp;</td>
                <td width="277" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td height="25" colspan="2">TEL:
                  <label for="telProfessor"></label>
                  <input name="telProfessor" type="text" id="telProfessor" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_rs_professores['tel_residencial']; ?>" size="13" readonly="readonly" />
                  CEL:
                  <label for="celProfessor"></label>
                  <input name="celProfessor" type="text" id="celProfessor" style="font-family:Calibri; font-weight:bold; font-size:20px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_rs_professores['celular']; ?>" size="13" readonly="readonly" /></td>
                <td width="293" rowspan="2" align="center">DAS:
                  <label for="horario"></label>
                  <input name="horario" type="text" id="horario" size="6" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold;" />
                  AS:
                  <label for="horario1"></label>
                  <input name="horario1" type="text" id="horario1" size="6" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold;" /></td>
                <td width="277" rowspan="2" align="center"><input name="data" type="text" id="data" style="font-family:Calibri; font-size:25px; color:#000; font-weight:bold; border:none; background-color: transparent;" size="10" /></td>
              </tr>
              <tr>
                <td height="25" colspan="2" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td height="52" colspan="4" valign="top">POLO:
                  <label for="polos"></label>
                  <span id="spryselect1">
                    <select name="polos" id="polos1" size="1" style="font-family:Calibri; font-size:18px; color:#000; font-weight:bold;" onchange="nomesPolos(this.value)">
                      <option value="-1">----- SELECIONE O POLO -----</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_rs_polos['id']?>"><?php echo $row_rs_polos['polos']?></option>
                      <?php
} while ($row_rs_polos = mysql_fetch_assoc($rs_polos));
  $rows = mysql_num_rows($rs_polos);
  if($rows > 0) {
      mysql_data_seek($rs_polos, 0);
	  $row_rs_polos = mysql_fetch_assoc($rs_polos);
  }
?>
                    </select>
                    <span class="selectRequiredMsg">Por favor selecione um item válido.</span><span class="selectInvalidMsg">Por favor selecione um item válido.</span></span></td>
</tr>
              <tr>
                <td height="23" colspan="4">ENDEREÇO:
                  <label for="endereco"></label>
                  <input name="endereco" type="text" id="endereco" size="50" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; text-transform:uppercase; "  />
                  Nº
                  <input name="numero" type="text" id="numero" size="6" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; text-transform:uppercase; " />
                  CEP:
                  <input name="cep" type="text" id="cep" size="11" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " /></td>
              </tr>
              <tr>
                <td height="23" colspan="4">BAIRRO:
                  <label for="bairro"></label>
                  <input name="bairro" type="text" id="bairro" size="40" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; text-transform:uppercase; " />
                  CIDADE:
                  <input name="cidade" type="text" id="cidade" size="11" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " />
                  UF:
                  <input name="estado" type="text" id="estado" size="6" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " /></td>
              </tr>
              <tr>
                <td height="23" colspan="4">REFERÊNCIA\ESCOLA:
                  <input name="referencia" type="text" id="referencia" size="50" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; text-transform:uppercase; " /></td>
              </tr>
              <tr>
                <td height="23" colspan="4">REPRESENTANTE:
                  <input name="representante" type="text" id="representante" size="40" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; text-transform:uppercase; " /></td>
              </tr>
              <tr>
                <td height="25" colspan="4">TEL:
                  <label for="tel1"></label>
                  <input name="tel1" type="text" id="tel1" size="11" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " />
                  CEL:
                  <input name="cel" type="text" id="cel" size="11" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " />
                  TEL1:
                  <input name="tel2" type="text" id="tel2" size="11" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " />
                  TEL2:
                  <input name="tel3" type="text" id="tel3" size="11" readonly="readonly" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " /></td>
              </tr>
              <tr>
                <td height="25" colspan="4" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td height="26" align="right">CURSO:</td>
                <td height="26" colspan="3"><span id="spryselect3">
                <label for="select1"></label>
                <select name="curso" size="1" id="curso" style="font-family:Calibri; font-size:18px; color:#000; font-weight:bold;">
                  <option value="-1">----- SELECIONE A CURSO -----</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_rs_cursos['cursos']?>"><?php echo $row_rs_cursos['cursos']?></option>
                  <?php
} while ($row_rs_cursos = mysql_fetch_assoc($rs_cursos));
  $rows = mysql_num_rows($rs_cursos);
  if($rows > 0) {
      mysql_data_seek($rs_cursos, 0);
	  $row_rs_cursos = mysql_fetch_assoc($rs_cursos);
  }
?>
                </select>
                <span class="selectInvalidMsg">Por favor selecione um item válido.</span><span class="selectRequiredMsg">Por favor selecione um item válido.</span></span></td>
                </tr>
              <tr>
                <td height="23" align="right">TURMA:</td>
                <td height="23" colspan="3"><span id="spryselect2">
                <select name="turma" id="polo1" size="1" style="text-transform:uppercase; font-family:Calibri; font-size:18px; color:#000; font-weight:bold;" onchange="nomesPolo(this.value)">
                  <option value="-1">----- SELECIONE A TURMA -----</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_rs_turmas['id']?>"><?php echo $row_rs_turmas['polos']?></option>
                  <?php
} while ($row_rs_turmas = mysql_fetch_assoc($rs_turmas));
  $rows = mysql_num_rows($rs_turmas);
  if($rows > 0) {
      mysql_data_seek($rs_turmas, 0);
	  $row_rs_turmas = mysql_fetch_assoc($rs_turmas);
  }
?>
                </select>
                <span class="selectInvalidMsg">Por favor selecione um item válido.</span><span class="selectRequiredMsg">Por favor selecione um item válido.</span></span>
                  <input name="status" type="text" id="status" size="18" style="font-family:Calibri; font-size:18px; color:#00f; border:none; background-color: transparent;" readonly="readonly" /></td>
                </tr>
              <tr>
                <td height="26" align="right">DISCIPLINA:                  </td>
                <td height="26" colspan="3"><input name="disciplina" type="text" id="disciplina" size="90" style="font-family:Calibri; font-size:18px; color:#000; font-weight:bold;" /></td>
                </tr>
              <tr>
                <td colspan="4" align="center"><label for="select"></label>                  <textarea name="obs" cols="100" rows="4" id="obs" style="font-family:Calibri; font-size:18px; color:#000; font-weight:bold;" placeholder="OBSERVAÇÕES" ></textarea></td>
                </tr>
              <tr>
                <td width="92">&nbsp;</td>
                <td colspan="3"><input type="image" name="button" id="button" src="../img/BTAgendar.png" /></td>
              </tr>
              </table>
           <input type="hidden" name="MM_insert" value="form" />
        </form>
<label for="textfield2"></label></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1"});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {invalidValue:"-1"});
</script>
</body>
</html>
<?php
mysql_free_result($rs_professores);

mysql_free_result($rs_turmas);

mysql_free_result($rs_cursos);

mysql_free_result($rs_polos);
?>
