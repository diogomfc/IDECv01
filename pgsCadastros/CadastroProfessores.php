<?php require_once('../Connections/Conexao1.php'); ?>
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="../img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.hht {
	font-size: 18px;
}
</style>

<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<script src="../js/jquery-1.11.1/jquery-1.11.1.min"type="text/javascript"></script>
<script src="../js/jquery.mask/mascaras.js"type="text/javascript"></script>
<script src="../js/jquery.mask/jquery.mask.js"type="text/javascript"></script>

<script language='JavaScript'>

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
  $(document).ready(function(){
  $('.data').mask('00/00/0000');
  $('.tel_fixo').mask('(00)0000-0000');
  $('.tel_cel').mask('(00)00000-0000'); 
});

function SomenteMaiusculo(e){
    var nome = new CaixaAltaMask(document.getElementById("nome"));
	var endereco = new CaixaAltaMask(document.getElementById("endereco"));
	var complemento_end = new CaixaAltaMask(document.getElementById("complemento_end"));
	var bairro = new CaixaAltaMask(document.getElementById("bairro"));
	var email = new CaixaAltaMask(document.getElementById("email"));
	var localTrabalho = new CaixaAltaMask(document.getElementById("localTrabalho"));	
	var formacaoEscolar = new CaixaAltaMask(document.getElementById("formacaoEscolar"));	
	var cidade = new CaixaAltaMask(document.getElementById("cidade"));
	var banco = new CaixaAltaMask(document.getElementById("banco"));
	var favorecido = new CaixaAltaMask(document.getElementById("favorecido"));
    var nome_graduacao1 = new CaixaAltaMask(document.getElementById("nome_graduacao1"));
    var curso_graduacao1 = new CaixaAltaMask(document.getElementById("curso_graduacao1"));
    var nome_graduacao2 = new CaixaAltaMask(document.getElementById("nome_graduacao2"));
    var curso_graduacao2 = new CaixaAltaMask(document.getElementById("curso_graduacao2"));
   var nome_posgraduacao1 = new CaixaAltaMask(document.getElementById("nome_posgraduacao1"));
var curso_posgraduacao1 = new CaixaAltaMask(document.getElementById("curso_posgraduacao1"));
var nome_posgraduacao2 = new CaixaAltaMask(document.getElementById("nome_posgraduacao2"));
var curso_posgraduacao2 = new CaixaAltaMask(document.getElementById("curso_posgraduacao2"));
var nome_posgraduacao3 = new CaixaAltaMask(document.getElementById("nome_posgraduacao3"));
var curso_posgraduacao3 = new CaixaAltaMask(document.getElementById("curso_posgraduacao3"));   
var nome_mestrado1 = new CaixaAltaMask(document.getElementById("nome_mestrado1"));
var curso_mestrado1 = new CaixaAltaMask(document.getElementById("curso_mestrado1"));
var nome_mestrado2 = new CaixaAltaMask(document.getElementById("nome_mestrado2"));
var curso_mestrado2 = new CaixaAltaMask(document.getElementById("curso_mestrado2"));
var nome_doutorado1 = new CaixaAltaMask(document.getElementById("nome_doutorado1"));
var curso_doutorado1 = new CaixaAltaMask(document.getElementById("curso_doutorado1"));
var RelacaoDisciplinas = new CaixaAltaMask(document.getElementById("RelacaoDisciplinas"));
}

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
<table width="985" height="1526" border="0" align="center" style="background: url(../img/imgFundoCadastroProfessor.png) no-repeat; text-align: right; font-family: Calibri; font-size: 20px;">
  <tr>
    <td width="978" height="956" align="left" valign="top"><table width="978" height="1100">
      <tr>
        <td width="1" height="121">&nbsp;</td>
        <td colspan="3" align="right" valign="top"><table width="462" style="color: #1B4871; font-family: Calibri; font-size: 18px; font-weight: normal;">
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
        <td height="53">&nbsp;</td>
        <td width="189"><a href="../admin/index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
        <td width="210"><a href="../admin/professor.php"><img src="../img/BTPesquisarProfessor1.png" width="197" height="33" /></a></td>
        <td width="554">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="22" align="left" valign="top"></td>
        <td height="22" colspan="3" align="left" valign="top"></td>
        <td height="22" align="left" valign="top"></td>
        </tr>
      <tr>
        <td height="892" align="left" valign="top"></td>
        <td height="892" colspan="3" align="left" valign="top"><form action="uploadCadastroProfessores.php" method="post" enctype="multipart/form-data" onkeypress='return SomenteMaiusculo(event)'>
          <table width="961" height="998">
            <tr>
              <td height="26" colspan="3"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">USUÁRIOS</span></td>
            </tr>
            <tr style="text-align: left">
              <td width="200" height="28" style="text-align:right">REGISTRO:</td>
              <?php 
	$sql_1 = mysql_query("SELECT * FROM idec_professores ORDER BY id DESC LIMIT 1");
	     while($res_1 = mysql_fetch_array($sql_1)){
	  $max = $res_1['code']+50741;
	  $mim = $res_1['id'];
	  $new_code = rand($max,$mim);
	   ?>
              <td width="749" colspan="3"><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $new_code?>"/>
                <input type="hidden" name="code" value="<?php echo $new_code ?>" /></td>
              <?php }?>
            </tr>
            <tr>
              <td height="27" style="text-align: right">CPF:</td>
              <td colspan="2"><span id="sprytextfield29">
              <label for="cpf"></label>
              <input name="cpf" type="text" id="cpf" onkeypress='return SomenteNumero(event)' />
              <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">RG:</td>
              <td colspan="2"><span id="sprytextfield28">
              <label for="rg"></label>
              <input name="rg" type="text" id="rg" onkeypress='return SomenteNumero(event)' />
              <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
</tr>
            <tr>
              <td height="29" style="text-align: right">Foto:</td>
              <td colspan="2"><span id="sprytextfield20">
                <label for="arquivo"></label>
                <input name="arquivo" type="file" id="arquivo" />
              </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Nome:</td>
              <td colspan="2"><span id="sprytextfield1">
              <label for="nome"></label>
              <input name="nome" type="text" id="nome" size="60" />
              <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Data de Nascimento:</td>
              <td colspan="2"><span id="sprytextfield2">
              <input name="nascimento" type="text" id="nascimento" class="data" />
              </span><span class="hht">Ex: 00/00/00</span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Sexo:</td>
              <td colspan="2"><label for="sexo"></label>
                  <select name="sexo" id="sexo">
                  <option>---- SEXO ----</option>
                  <option value="MASCULINO">MASCULINO</option>
                  <option value="FEMININO">FEMININO</option>
</select>
                </td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">Estado Civil:</td>
              <td colspan="2">
                <select name="estado_civil" id="estado_civil">
                <option>---- ESTADO CIVIL ----</option>
                  <option value="SOLTEIRO(A)">SOLTEIRO(A)</option>
                  <option value="CASADO(A)">CASADO(A)</option>
                  <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                  <option value="VIÚVO(A)">VIÚVO(A)</option>
				  <option value="OUTROS">OUTROS</option>
              </select>
               Naturalidade:
                 <label for="naturalidade"></label>
                 <select name="naturalidade" id="naturalidade">      
                <option>---- NATURALIDADE ----</option>
                <option value="ACRE">ACRE</option>
		        <option value="ALAGOAS">ALAGOAS</option>
		        <option value="AMAZONAS">AMAZONAS</option>
		        <option value="AMAPÁ">AMAPÁ</option>
		        <option value="BAHIA">BAHIA</option>
		        <option value="CEARÁ">CEARÁ</option>
		        <option value="DISTRITO FEDERAL">DISTRITO FEDERAL</option>
		        <option value="ESPÍRITO SANTO">ESPÍRITO SANTO</option>
		        <option value="GOIÁS">GOIÁS</option>
		        <option value="MARANHÃO">MARANHÃO</option>
		        <option value="MINAS GERAIS">MINAS GERAIS</option>
		        <option value="MATO GROSSO DO SUL">MATO GROSSO DO SUL</option>
		        <option value="MATO GROSSO">MATO GROSSO</option>
		        <option value="PARÁ">PARÁ</option>
		        <option value="PARAÍBA">PARAÍBA</option>
		        <option value="PERNAMBUCO">PERNAMBUCO</option>
		        <option value="PIAUÍ">PIAUÍ</option>
		        <option value="PARANÁ">PARANÁ</option>
		        <option value="RIO DE JANEIRO">RIO DE JANEIRO</option>
		        <option value="RIO GRANDE DO NORTE">RIO GRANDE DO NORTE</option>
		        <option value="RONDÔNIA">RONDÔNIA</option>
		        <option value="RORAIMA">RORAIMA</option>
		        <option value="RIO GRANDE DO SUL">RIO GRANDE DO SUL</option>
		        <option value="SANTA CATARINA">SANTA CATARINA</option>
		        <option value="SERGIPE">SERGIPE</option>
		        <option value="SÃO PAULO">SÃO PAULO</option>
		        <option value="TOCANTINS">TOCANTINS</option>
				<option value="OUTROS">OUTROS</option>
                 </select>
              </td>
</tr>
            <tr>
              <td height="28" style="text-align: right">CEP:</td>
              <td colspan="2"><span id="sprytextfield3">
              <label for="cep"></label>
              <input name="cep" type="text" class="inputs" id="cep" placeholder="Informe o CEP" onblur="getEndereco()" size="10" />
              </span><span style="text-align: right">Cidade:<span id="sprytextfield8">
              <label for="cidade"></label>
              <input name="cidade" type="text" id="cidade" style="text-transform:uppercase;"/>
              </span>Estado:
              <label for="uf"></label>
              <label for="uf"></label>
              <input name="estado" type="text" id="estado" size="1" />
              </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Bairro:</td>
              <td colspan="2"><span id="sprytextfield7">
                <label for="bairro"></label>
                <input name="bairro" type="text" id="bairro" size="40" style="text-transform:uppercase;"/>
              </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Endereço:</td>
              <td colspan="2"><input name="endereco" type="text" id="endereco" size="60" style="text-transform:uppercase;" />
                Nº <span id="sprytextfield13">
                <label for="numero_end"></label>
                <input name="numero_end" type="text" id="numero_end" size="10"/>
                </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Complemento:</td>
              <td colspan="2"><span id="sprytextfield6">
              <label for="complemento_end"></label>
              <input name="complemento_end" type="text" id="complemento_end" size="40" />
              </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Telefone Fixo:</td>
              <td colspan="2"><span id="sprytextfield9">
                <label for="tel_residencial"></label>
                <span id="sprytextfield14">
                <input name="tel_residencial" type="text" id="tel_residencial" class="tel_fixo"/>
                </span> Celular: <span id="sprytextfield16">
                <label for="celular"></label>
                <input name="celular" type="text" id="celular" class="tel_cel" />
                </span>Comercial:
                <label for="tel_comercial"></label>
                <input type="text" name="tel_comercial" id="tel_comercial" class="tel_fixo" />
              </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">E-mail:</td>
              <td colspan="2"><span id="sprytextfield10">
              <label for="email"></label>
              <input name="email" type="text" id="email" size="60" />
              <span class="textfieldRequiredMsg">Formato envalido.</span><span class="textfieldInvalidFormatMsg">e-mail envalido.</span></span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Local de Trabalho:</td>
              <td colspan="2"><span id="sprytextfield11">
              <label for="localTrabalho"></label>
              <input name="localTrabalho" type="text" id="localTrabalho" size="75" />
              </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Formação Escolar:</td>
              <td colspan="2"><span id="sprytextfield12">
              <label for="formacaoEscolar"></label>
              <input name="formacaoEscolar" type="text" id="formacaoEscolar" size="75" />
              </span></td>
</tr>
            <tr>
              <td height="55" colspan="3" valign="bottom"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DADOS BANCÁRIOS</span></td>
            </tr>
            <tr>
              <td height="45" colspan="3" valign="top"><table width="905" border="0">
                <tr>
                  <td width="56"style="text-align: right">BANCO:</td>
                  <td width="168"><input name="banco" type="text" id="banco" /></td>
                  <td width="34"style="text-align: right">AG:</td>
                  <td width="168"><input name="ag" type="text" id="ag" /></td>
                  <td width="75"style="text-align: right">CONTA:</td>
                  <td width="115" colspan="2"><input name="conta" type="text" id="conta" /></td>
                  <td width="109"style="text-align: right">TIPO:</td>
                  <td width="146"><select name="tipo_conta" size="1" id="tipo_conta">
                    <option value="CORRENTE">CORRENTE</option>
                    <option value="POUPANCA">POUPANÇA</option>
                  </select></td>
                </tr>
                <tr>
                  <td colspan="9">FAVORECIDO: 
                    <input name="favorecido" type="text" id="favorecido" size="45" />                    CONJUNTA:
                    <select name="conjunta" size="1" id="conjunta">
                      <option value="SIM">SIM</option>
                      <option value="NÃO">NAO</option>
                    </select></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="184" colspan="3" align="center" valign="top"><div id="Accordion1" class="Accordion" tabindex="0">
  <div class="AccordionPanel">
    <div class="AccordionPanelTab"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">GRADUAÇÃO:</span></div>
    <div class="AccordionPanelContent">
      <table width="95" border="0">
        <tr>
          <td width="25">1&ordf; </td>
          <td width="183" style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
          <td colspan="3"><input name="nome_graduacao1" type="text" id="nome_graduacao1" size="98" /></td>
        </tr>
        <tr>
          <td height="27" colspan="2" style="text-align: right">Curso:</td>
          <td width="337"><input name="curso_graduacao1" type="text" id="curso_graduacao1" size="45" /></td>
          <td width="164"style="text-align: right">Ano de Conclus&atilde;o:</td>
          <td width="177"><input name="ano_graduacao1" type="text" id="ano_graduacao1" size="13" /></td>
        </tr>
        <tr>
          <td height="4" colspan="5"><img src="../img/linha.png" alt="" width="900" height="2" /></td>
        </tr>
        <tr>
          <td>2&ordf; </td>
          <td style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
          <td colspan="3"><input name="nome_graduacao2" type="text" id="nome_graduacao2" size="98" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">Curso:</td>
          <td><input name="curso_graduacao2" type="text" id="curso_graduacao2" size="45" /></td>
          <td style="text-align: right">Ano de Conclus&atilde;o:</td>
          <td><input name="ano_graduacao2" type="text" id="ano_graduacao2" size="13" /></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">PÓS-GRADUAÇÃO LATO-SENSU:</span></div>
    <div class="AccordionPanelContent">
      <table width="905" border="0">
        <tr>
          <td width="25">1&ordf; </td>
          <td width="185" style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
          <td colspan="3"><input name="nome_posgraduacao1" type="text" id="nome_posgraduacao1" size="98" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">Curso:</td>
          <td width="318"><input name="curso_posgraduacao1" type="text" id="curso_posgraduacao1" size="45" /></td>
          <td width="186" style="text-align: right">Ano de Conclus&atilde;o:</td>
          <td width="174"><input name="ano_posgraduacao1" type="text" id="ano_posgraduacao1" size="13" /></td>
        </tr>
        <tr>
          <td colspan="5"><img src="../img/linha.png" alt="" width="900" height="2" /></td>
        </tr>
        <tr>
          <td>2&ordf; </td>
          <td style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
          <td colspan="3"><input name="nome_posgraduacao2" type="text" id="nome_posgraduacao2" size="98" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">Curso:</td>
          <td><input name="curso_posgraduacao2" type="text" id="curso_posgraduacao2" size="45" /></td>
          <td style="text-align: right">Ano de Conclus&atilde;o:</td>
          <td><input name="ano_posgraduacao2" type="text" id="ano_posgraduacao2" size="13" /></td>
        </tr>
        <tr>
          <td colspan="5"><img src="../img/linha.png" alt="" width="900" height="2" /></td>
        </tr>
        <tr>
          <td>3&ordf; </td>
          <td style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
          <td colspan="3"><input name="nome_posgraduacao3" type="text" id="nome_posgraduacao3" size="98" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">Curso:</td>
          <td><input name="curso_posgraduacao3" type="text" id="curso_posgraduacao3" size="45" /></td>
          <td style="text-align: right">Ano de Conclus&atilde;o:</td>
          <td><input name="ano_posgraduacao3" type="text" id="ano_posgraduacao3" size="13" /></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">PÓS-GRADUAÇÃO STRICTO - SENSU (MESTRADO):</span></div>
    <div class="AccordionPanelContent">
      <table width="905" border="0">
        <tr>
          <td width="25">1&ordf; </td>
          <td width="183" style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
          <td colspan="3"><input name="nome_mestrado1" type="text" id="nome_mestrado1" size="98" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">Curso:</td>
          <td width="322"><input name="curso_mestrado1" type="text" id="curso_mestrado1" size="45" /></td>
          <td width="181" style="text-align: right">Ano de Conclus&atilde;o:</td>
          <td width="175"><input name="ano_mestrado1" type="text" id="ano_mestrado1" size="13" /></td>
        </tr>
        <tr>
          <td colspan="5"><img src="../img/linha.png" alt="" width="900" height="2" /></td>
          </tr>
        <tr>
          <td>2&ordf; </td>
          <td style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
          <td colspan="3"><input name="nome_mestrado2" type="text" id="nome_mestrado2" size="98" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">Curso:</td>
          <td><input name="curso_mestrado2" type="text" id="curso_mestrado2" size="45" /></td>
          <td style="text-align: right">Ano de Conclus&atilde;o:</td>
          <td><input name="ano_mestrado2" type="text" id="ano_mestrado2" size="13" /></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">
      <div class="AccordionPanel"></div>
      <div class="AccordionPanel">
        <div class="AccordionPanelTab"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">PÓS-GRADUAÇÃO STRICTO - SENSU (DOUTORADO):</span></div>
      </div>
    </div>
    <div class="AccordionPanelContent">
      <table width="905" border="0">
        <tr>
          <td width="25">1&ordf; </td>
          <td width="177" style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
          <td colspan="3"><input name="nome_doutorado1" type="text" id="nome_doutorado1" size="98" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">Curso:</td>
          <td width="321"><input name="curso_doutorado1" type="text" id="curso_doutorado1" size="45" /></td>
          <td width="183" style="text-align: right">Ano de Conclus&atilde;o:</td>
          <td width="177"><input name="ano_doutorado1" type="text" id="ano_doutorado1" size="13" /></td>
        </tr>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script></td>
            </tr>
            <tr>
              <td height="26" colspan="3" valign="top"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;"><span class="CENTER">DISPONIBILIDADE PARA MINISTRAR AULA</span>S</span></td>
            </tr>
            <tr>
              <td height="46" colspan="3" valign="top"><table width="905" border="0">
                <tr>
                  <td colspan="2"style="text-align: right" >De Segunda &agrave; Sexta:</td>
                  <td width="163"><select name="disponibilidade_1" size="1" id="disponibilidade_1">
                    <option value="">--Selecione--</option>
					<option value="MANHA">MANHÃ</option>
                    <option value="TARDE">TARDE</option>
                    <option value="NOITE">NOITE</option>
                    <option value="INTEGRAL">INTEGRAL</option>
                  </select></td>
                  <td width="142" style="text-align: right">Apartir das:</td>
                  <td width="229"><input name="disponibilidade_Apartir1" type="text" id="disponibilidade_Apartir1" size="13" /></td>
                  <td width="151">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align: right">Aos Sabados:</td>
                  <td><select name="disponibilidade_2" size="1" id="disponibilidade_2">
                    <option value="">--Selecione--</option>
					<option value="MANHA">MANHÃ</option>
                    <option value="TARDE">TARDE</option>
                    <option value="NOITE">NOITE</option>
                    <option value="INTEGRAL">INTEGRAL</option>
                  </select></td>
                  <td style="text-align: right">Apartir das:</td>
                  <td><input name="disponibilidade_Apartir2" type="text" id="disponibilidade_Apartir2" size="13" /></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align: right">Aos Domingos:</td>
                  <td><select name="disponibilidade_3" size="1" id="disponibilidade_3">
                    <option value="">--Selecione--</option>
					<option value="MANHA">MANHÃ</option>
                    <option value="TARDE">TARDE</option>
                    <option value="NOITE">NOITE</option>
                    <option value="INTEGRAL">INTEGRAL</option>
                  </select></td>
                  <td style="text-align: right">Apartir das:</td>
                  <td><input name="disponibilidade_Apartir3" type="text" id="disponibilidade_Apartir3" size="13" /></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="6">OBS: Hor&aacute;rio integral Avisar com antecedencia, Prestador de servi&ccedil;o da FAB</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="26" colspan="3"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DISCIPLINAS QUE ESTA APTO A MINISTRAR:</span></td>
            </tr>
            <tr>
              <td height="36" colspan="3"><span id="sprytextfield34">
                <label for="obs2"></label>
                <textarea name="RelacaoDisciplinas" cols="115" rows="6" id="RelacaoDisciplinas"></textarea>
              </span></td>
</tr>
            <tr>
              <td height="60" colspan="3"><input type="image" src="../img/BTCadastrarEstudante.png" name="button" id="button" value="CADASTRAR" /></td>
            </tr>
          </table>
        </form></td>
        <td height="892" align="left" valign="top"></td>
        </tr>
      
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield34 = new Spry.Widget.ValidationTextField("sprytextfield34", "none", {isRequired:false});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {isRequired:false});
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20", "none", {isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "none", {isRequired:false});
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29", "none");
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {isRequired:false});
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16", "none", {isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "email");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "none", {isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "none", {isRequired:false});
</script>
</body>
</html>