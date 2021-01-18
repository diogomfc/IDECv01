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
  $insertSQL = sprintf("INSERT INTO idec_agendamentoprofessor (professor, curso, disciplina, polo, `data`, obs, horario, horario1, endereco, representante, cel, tel1, tel2, tel3, numero, cep, cidade, bairro, estado, referencia) VALUES (%s, %s, %s, %s, '$dataAgendamento', %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['professor'], "text"),
                       GetSQLValueString($_POST['curso'], "text"),
                       GetSQLValueString($_POST['disciplina'], "text"),
                       GetSQLValueString($_POST['polo'], "text"),
                       GetSQLValueString($_POST['obs'], "text"),
                       GetSQLValueString($_POST['horario'], "text"),
                       GetSQLValueString($_POST['horario1'], "text"),
					   GetSQLValueString($_POST['endereco'], "text"),
					   GetSQLValueString($_POST['representante'], "text"),
					   GetSQLValueString($_POST['cel'], "text"),
					   GetSQLValueString($_POST['tel1'], "text"),
					   GetSQLValueString($_POST['tel2'], "text"),
					   GetSQLValueString($_POST['tel3'], "text"),
					   GetSQLValueString($_POST['numero'], "text"),
					   GetSQLValueString($_POST['cep'], "text"),
					   GetSQLValueString($_POST['cidade'], "text"),
					   GetSQLValueString($_POST['bairro'], "text"),
					   GetSQLValueString($_POST['estado'], "text"),
					   GetSQLValueString($_POST['referencia'], "text"));
					   

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_professores = "SELECT * FROM idec_professores";
$rs_professores = mysql_query($query_rs_professores, $ConexaoIdec) or die(mysql_error());
$row_rs_professores = mysql_fetch_assoc($rs_professores);
$totalRows_rs_professores = mysql_num_rows($rs_professores);

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="../img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="/IDECv01/js/jquery-ui-1.10.4/development-bundle/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"></script>
  <script src="../js/jquery.mask/mascaras.js"type="text/javascript"></script>
<script src="../js/jquery.mask/jquery.mask.js"type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script>

  function SomenteMaiusculo(e){
    var disciplina = new CaixaAltaMask(document.getElementById("disciplina"));
	var obs = new CaixaAltaMask(document.getElementById("obs"));
	var representante = new CaixaAltaMask(document.getElementById("representante"));
	var endereco = new CaixaAltaMask(document.getElementById("endereco"));
	var cidade = new CaixaAltaMask(document.getElementById("cidade"));
	var bairro = new CaixaAltaMask(document.getElementById("bairro"));
	var estado = new CaixaAltaMask(document.getElementById("estado"));	
	var referencia = new CaixaAltaMask(document.getElementById("referencia"));	
	var estado = new CaixaAltaMask(document.getElementById("estado"));		
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

<table width="996" height="348" align="center" style="background: url(../img/imgFundoAgendamentoProfessores.png) no-repeat; font-family: Calibri; font-size: 18px; font-weight: bold;">
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
        <td height="136">&nbsp;</td>
        <td colspan="2" valign="middle"><form action="<?php echo $editFormAction; ?>" method="POST" name="form" id="form" onkeypress='return SomenteMaiusculo(event)'>
          <table width="971" height="140" align="center">
            <tr>
              <td width="153" height="13" align="right">POLO:</td>
              <td>
                <span id="spryselect2">
                <label for="polos"></label>
                <select name="polos" id="polos1" onchange="nomesPolos(this.value)">
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
                <span class="selectInvalidMsg">Obrigatório.</span></span>
                <span id="spryselect1">
                <label for="professor"></label>
                PROFESSOR:
                
                </label>
  <select name="professor" id="professor">
    <option value="-1">----- SELECIONE O PROFESSOR -----</option>
    <?php
do {  
?>
    <option value="<?php echo $row_rs_professores['id']?>"><?php echo $row_rs_professores['nome']?></option>
    <?php
} while ($row_rs_professores = mysql_fetch_assoc($rs_professores));
  $rows = mysql_num_rows($rs_professores);
  if($rows > 0) {
      mysql_data_seek($rs_professores, 0);
	  $row_rs_professores = mysql_fetch_assoc($rs_professores);
  }
?>
  </select>
                <span class="selectInvalidMsg">Obrigatório.</span></span></td>
              </tr>
            <tr>
              <td height="4" align="right">REPRESENTANTE:</td>
              <td><input name="representante" type="text" id="representante" size="45" style="text-transform:uppercase; background: #EAEAEA" />
                </td>
              </tr>
            <tr>
              <td height="6" align="right">CEL:</td>
              <td><input name="cel" type="text" id="cel" size="12" style="background: #EAEAEA;" />
TEL1:
  <input name="tel1" type="text" id="tel1" size="12" style="background: #EAEAEA;"/>
TEL2:
<input name="tel2" type="text" id="tel2" size="12" style="background: #EAEAEA;" />
TEL3
<input name="tel3" type="text" id="tel3" size="12" style="background: #EAEAEA;"/></td>
            </tr>
            <tr>
              <td height="13" align="right">TURMA:</td>
              <td>
               <span id="spryselect3">
              <select name="polo" id="polo1" size="1" style="text-transform:uppercase;" onchange="nomesPolo(this.value)">
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
?> <span class="selectInvalidMsg">Obrigatório.</span></span>
              </select>
STATUS:
<span id="sprytextfield2">
<input name="status" type="text" id="status" size="7" style="font-family:Calibri; font-size:18px; color:#00f; border:none; background-color: transparent;" readonly="readonly" />
<span class="textfieldRequiredMsg"></span> DATA:
<span id="sprytextfield3">
<input name="data" type="text" id="data" size="7" />
<span class="textfieldRequiredMsg"></span> DAS
<span id="sprytextfield4">
<input name="horario" type="text" id="horario" size="2" />
<span class="textfieldRequiredMsg"></span> ÀS
<span id="sprytextfield5">
<input name="horario1" type="text" id="horario1" size="2" />
<span class="textfieldRequiredMsg"></span></td>
            </tr>
            <tr>
              <td height="6" align="right">CURSO:</td>
              <td><span id="spryselect4">
                <select name="curso" size="1" id="curso">
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
                <span class="selectInvalidMsg">Obrigatório.</span></span></td>
              </tr>
            <tr>
              <td height="1" align="right">DISCIPLINA:</td>
              <td><span id="sprytextfield1">
                <input name="disciplina" type="text" id="disciplina" size="90" style="text-transform:uppercase;" />
                <span class="textfieldRequiredMsg"></span></span></td>
            </tr>
            <tr>
              <td height="2" align="right">ENDEREÇO:</td>
              <td><input name="endereco" type="text" id="endereco" size="60" style="text-transform:uppercase; background: #EAEAEA"/>
                Nº
                <label for="numero"></label>
                <input name="numero" type="text" id="numero" size="10" style="background: #EAEAEA;"/></td>
            </tr>
            <tr>
              <td height="6" align="right">CEP:</td>
              <td><label for="status">
                <input name="cep" type="text" id="cep" size="10" style="background: #EAEAEA;"  />
CIDADE:
<input type="text" name="cidade" id="cidade" style="text-transform:uppercase; background: #EAEAEA"/>
BAIRRO:
<input name="bairro" type="text" id="bairro" size="30" style="text-transform:uppercase; background: #EAEAEA" />
ESTADO:
<input name="estado" type="text" id="estado" size="3" style="text-transform:uppercase; background: #EAEAEA" />
              </label></td>
            </tr>
            <tr>
              <td height="5" align="right">ESCOLA/REFERÊNCIA:</td>
              <td><label for="textfield"></label>
                <input name="referencia" type="text" id="referencia" size="60" style="text-transform:uppercase; background: #EAEAEA"/></td>
            </tr>
            <tr>
              <td height="29" align="right">OBS:</td>
              <td><label for="obs"></label>
                <textarea name="obs" cols="70" rows="4" id="obs" style="text-transform:uppercase;"></textarea></td>
            </tr>
            <tr>
              <td height="29">&nbsp;</td>
              <td><input type="image" name="button" id="button" src="../img/BTAgendar.png" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form" />
        </form></td>
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
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {invalidValue:"-1"});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
</script>
</body>
</html>
<?php
mysql_free_result($rs_professores);

mysql_free_result($rs_turmas);

mysql_free_result($rs_cursos);

mysql_free_result($rs_polos);
?>
