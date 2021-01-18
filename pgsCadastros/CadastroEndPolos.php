<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php require_once('../Connections/conexao.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO idec_polos (polos, endereco, representante, cep, cidade, estado, complemento, referencia, numero, bairro, cel, tel1, tel2, tel3) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['polos'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['representante'], "text"),
                       GetSQLValueString($_POST['cep'], "text"),
                       GetSQLValueString($_POST['cidade'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['complemento'], "text"),
                       GetSQLValueString($_POST['referencia'], "text"),
                       GetSQLValueString($_POST['numero'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['cel'], "text"),
                       GetSQLValueString($_POST['tel1'], "text"),
                       GetSQLValueString($_POST['tel2'], "text"),
                       GetSQLValueString($_POST['tel3'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_representantes = "SELECT * FROM ide_representantes WHERE nome != '' ORDER BY nome ASC";
$rs_representantes = mysql_query($query_rs_representantes, $ConexaoIdec) or die(mysql_error());
$row_rs_representantes = mysql_fetch_assoc($rs_representantes);
$totalRows_rs_representantes = mysql_num_rows($rs_representantes);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_EndPolos = "SELECT * FROM idec_polos";
$rs_EndPolos = mysql_query($query_rs_EndPolos, $ConexaoIdec) or die(mysql_error());
$row_rs_EndPolos = mysql_fetch_assoc($rs_EndPolos);
$totalRows_rs_EndPolos = mysql_num_rows($rs_EndPolos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="../img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="/IDECv01/js/jquery-ui-1.10.4/development-bundle/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
  
<script src="../js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
<script src="../js/jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"> </script>


<script src="../js/jquery.mask/mascaras.js"type="text/javascript"></script>
<script src="../js/jquery.mask/jquery.mask.js"type="text/javascript"></script>  
  
<script>




function getEndereco() {
	
	if($.trim($("#cep").val()) != ""){
     
	$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
	
					
	if (resultadoCEP["tipo_logradouro"] != '') {
		if (resultadoCEP["resultado"]) {
		
			$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
			$("#bairro").val(unescape(resultadoCEP["bairro"]));
			$("#cidade").val(unescape(resultadoCEP["cidade"]));
			$("#estado").val(unescape(resultadoCEP["uf"]));
			$("#numero").focus();
			$('#cep').mask('99999-999');
			}
		}		
	});
	}
}

function SomenteMaiusculo(e){
    var polos = new CaixaAltaMask(document.getElementById("polos"));
	var complemento = new CaixaAltaMask(document.getElementById("complemento"));
	var referencia = new CaixaAltaMask(document.getElementById("referencia"));		
}


$(function() {
    $( "#dataInicio" ).datepicker({
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
  $(function() {
    $( "#dataFinal" ).datepicker({
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

function PesRepresentante(id){
	$.post("PESRepresentanteJava.php", {idPesRepresentante:id}, function(retorno){ 
	  dados = retorno.split("/");
	   $('#cel').val(dados[0]);
	    $('#tel1').val(dados[1]);
		 $('#tel2').val(dados[2]);
		  $('#tel3').val(dados[3]);
		   
	  });
}
  </script>

</head>

<body>

<table width="996" height="348" align="center" style="background: url(../img/imgFundoCadastroEndPolos.png) no-repeat; font-family: Calibri; font-size: 18px; font-weight: bold;">
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
        <td width="789" valign="top"><a href="../admin/polos.php"><img src="../img/BTPesquisarPolos.png" width="200" height="32" /></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="30">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="136">&nbsp;</td>
        <td colspan="2" valign="middle"><form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1" onkeypress='return SomenteMaiusculo(event)'>
          <table width="971" height="212" align="center">
            <tr>
              <td width="126" height="28" align="right">POLO:</td>
              <td><label for="polos"></label>
                <input name="polos" type="text" id="polos" size="30" />
                REPRESENTANTE:
                <select name="representante" id="representante1" onchange="PesRepresentante(this.value)">
                  <option value="">----- SELECIONE O REPRESENTANTE -----</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_rs_representantes['id']?>"><?php echo $row_rs_representantes['nome']?></option>
                  <?php
} while ($row_rs_representantes = mysql_fetch_assoc($rs_representantes));
  $rows = mysql_num_rows($rs_representantes);
  if($rows > 0) {
      mysql_data_seek($rs_representantes, 0);
	  $row_rs_representantes = mysql_fetch_assoc($rs_representantes);
  }
?>
                </select></td>
              </tr>
            <tr>
               <td height="1" align="right">CEL:
                 <label for="cel"></label></td>
              <td><input name="cel" type="text" id="cel" size="12" /> 
                TEL1:
                <input name="tel1" type="text" id="tel1" size="12" />
                TEL2:
                <input name="tel2" type="text" id="tel2" size="12" />
                TEL3
                <input name="tel3" type="text" id="tel3" size="12" /></td>
           
            </tr>
            <tr>
              <td height="2" align="right">CEP:</td>
              <td><input name="cep" type="text" id="cep" placeholder="Informe o CEP" onblur="getEndereco()" size="10"  />
CIDADE:
  <label for="cidade"></label>
  <input type="text" name="cidade" id="cidade" style="text-transform:uppercase;"/>
BAIRRO:
<label for="bairro"></label>
<input name="bairro" type="text" id="bairro" size="30" style="text-transform:uppercase;" />
ESTADO:
<label for="estado"></label>
<input name="estado" type="text" id="estado" size="3" /></td>
            </tr>
            <tr>
              <td height="1" align="right">ENDEREÇO:</td>
              <td><input name="endereco" type="text" id="endereco" size="60" style="text-transform:uppercase;"/>
                Nº 
                <label for="numero"></label>
                <input name="numero" type="text" id="numero" size="10" /></td>
            </tr>
            <tr>
              <td height="3" align="right">COMPLEMENTO:</td>
              <td><label for="complemento"></label>
                <input name="complemento" type="text" id="complemento" size="60" /></td>
            </tr>
            <tr>
              <td height="14" align="right">REFERÊNCIA:</td>
              <td><label for="referencia"></label>
                <input name="referencia" type="text" id="referencia" size="60" /></td>
            </tr>
            <tr>
              <td height="29">&nbsp;</td>
              <td><input type="image" name="button" id="button" src="../img/BTCadastrar1.png" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1" />
        </form></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_representantes);

mysql_free_result($rs_EndPolos);
?>
