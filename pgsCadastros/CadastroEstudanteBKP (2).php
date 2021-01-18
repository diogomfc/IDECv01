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
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../js/jquery-1.11.1/jquery-1.11.1.min"type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery.mask/jquery.mask.min.js"></script>

<script language='JavaScript'>
$(document).ready(function(){
  $('.data').mask('00/00/0000');
  $('.cep').mask('00000-000');
  $('.tel_fixo').mask('(00)0000-0000');
  $('.tel_cel').mask('(00)00000-0000'); 
});
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
<table width="985" height="1371" border="0" align="center" style="background: url(../img/imgFundoCadastroAluno1.png) no-repeat; text-align: right; font-family: Calibri; font-size: 20px;">
  <tr>
    <td width="978" height="956" align="left" valign="top"><table width="978" height="1167">
      <tr>
        <td width="1" height="121">&nbsp;</td>
        <td colspan="3" align="right" valign="top"><table width="462" style="color: #1B4871; font-family: Calibri; font-size: 18px;">
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
        <td width="210"><a href="../admin/estudante1.php"><img src="../img/BTPesquisarEstudante1.png" width="197" height="33" /></a></td>
        <td width="554"><a href="../admin/matriculas.php"><img src="../img/BTPesquisarMatricula.png" width="189" height="32" /></a></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="22" align="left" valign="top"></td>
        <td height="22" colspan="3" align="left" valign="top"></td>
        <td height="22" align="left" valign="top"></td>
        </tr>
      <tr>
        <td height="892" align="left" valign="top"></td>
        <td height="892" colspan="3" align="left" valign="top"><form action="uploadCadastroAlunos.php" method="post" enctype="multipart/form-data">
          <table width="961" height="784">
            <tr>
              <td height="26" colspan="5"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DADOS PESSOAIS</span></td>
            </tr>
            <tr style="text-align: left">
              <td width="208" height="28" style="text-align:right">RM:</td>
          <?php 
	$sql_1 = mysql_query("SELECT * FROM idec_estudantes ORDER BY id DESC LIMIT 1");
	    while($res_1 = mysql_fetch_array($sql_1)){
	  $max = $res_1['code']+20741;
	  $mim = $res_1['id'];
	  $new_code = rand($max,$mim);
	   ?>
              <td colspan="3"><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $new_code?>"/>
                <input type="hidden" name="code" value="<?php echo $new_code ?>" /></td>
              <?php }?>
            </tr>
            <tr>
              <td height="27" style="text-align: right">CPF:</td>
              <td width="719"><span id="sprytextfield29">
                <label for="cpf"></label>
                <input name="cpf" type="text" id="cpf" onkeypress='return SomenteNumero(event)' />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
              <td width="8">&nbsp;</td>
              <td width="6">&nbsp;</td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">RG:</td>
              <td><span id="sprytextfield28">
                <label for="rg"></label>
                <input name="rg" type="text" id="rg" onkeypress='return SomenteNumero(event)' />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="29" style="text-align: right">Foto:</td>
              <td><span id="sprytextfield20">
              <label for="arquivo"></label>
              <input name="arquivo" type="file" id="arquivo" />
              </span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">Nome:</td>
              <td colspan="4"><span id="sprytextfield1">
                <label for="nome"></label>
                <input name="nome" type="text" id="nome" size="75" />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Data de Nascimento:</td>
              <td colspan="4"><span id="sprytextfield2">
                <input name="nascimento" type="text" id="nascimento" class="data" />
              </span> <span class="hht">Ex: 00/00/000</span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Sexo:</td>
              <td colspan="4">               
                <label for="sexo"></label>
                <select name="sexo" id="sexo">
                  <option>---- SEXO ----</option>
                  <option value="MASCULINO">MASCULINO</option>
                  <option value="FEMININO">FEMININO</option>
</select></td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">Estado Civil:</td>
              <td colspan="4"><select name="estado_civil" id="estado_civil">
                <option>---- ESTADO CIVIL ----</option>
                  <option value="SOLTEIRO">SOLTEIRO</option>
                  <option value="CASADO">CASADO</option>
                  <option value="DIVORCIADO">DIVORCIADO</option>
                  <option value="VIÚVO">VIÚVO</option>
				  <option value="OUTROS">OUTROS</option>
              </select>
                 Naturalidade:
                 <label for="naturalidade"></label>
                 <label for="naturalidade"></label>
                 <select name="naturalidade" id="naturalidade">      
                <option value="- ">---- NATURALIDADE ----</option>
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
                 </select></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Endereço:</td>
              <td colspan="4"><span id="sprytextfield5">
                <label for="endereco"></label>
                <input name="endereco" type="text" id="endereco" size="60" />
                </span>Nº <span id="sprytextfield13">
                  <label for="numero_end"></label>
                  <input name="numero_end" type="text" id="numero_end" size="10" />
                </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Complemento:</td>
              <td colspan="4"><span id="sprytextfield6">
                <label for="complemento_end"></label>
                <input name="complemento_end" type="text" id="complemento_end" size="40" />
              </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Bairro:</td>
              <td colspan="4"><span id="sprytextfield7">
                <label for="bairro"></label>
                <input name="bairro" type="text" id="bairro" size="40" />
                </span> <span style="text-align: right">CEP:</span> <span id="sprytextfield14">
                  <label for="cep"></label>
                  <input name="cep" type="text" id="cep" class="cep" />
                </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Cidade:</td>
              <td colspan="4"><span id="sprytextfield8">
                <label for="cidade"></label>
                <input name="cidade" type="text" id="cidade" />
                </span> <span style="text-align: right">Estado: 
                <select name="estado" id="estado">
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
		        <option selected="selected" value="SÃO PAULO">SÃO PAULO</option>
		        <option value="TOCANTINS">TOCANTINS</option>
                </select>
                </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Telefone Fixo:</td>
              <td colspan="4"><span id="sprytextfield9">
                <label for="tel_residencial"></label>
                <input name="tel_residencial" type="text" id="tel_residencial" class="tel_fixo"/>
                </span> Celular: <span id="sprytextfield16">
                  <label for="celular"></label>
                  <input name="celular" type="text" id="celular" class="tel_cel" />
                </span>Comercial:
                <label for="tel_comercial"></label>
                <input type="text" name="tel_comercial" id="tel_comercial" class="tel_fixo" /></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">E-mail:</td>
              <td colspan="4"><span id="sprytextfield10">
                <label for="email"></label>
                <input name="email" type="text" id="email" size="60" />
                <span class="textfieldRequiredMsg">Formato envalido.</span><span class="textfieldInvalidFormatMsg">e-mail envalido.</span></span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Local de Trabalho:</td>
              <td colspan="4"><span id="sprytextfield11">
                <label for="localTrabalho"></label>
                <input name="localTrabalho" type="text" id="localTrabalho" size="75" />
              </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Formação Escolar:</td>
              <td colspan="4"><span id="sprytextfield12">
                <label for="formacaoEscolar"></label>
                <input name="formacaoEscolar" type="text" id="formacaoEscolar" size="75" />
              </span></td>
</tr>
            <tr>
              <td height="55" colspan="5" valign="bottom"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DOCUMENTOS ENTREGUE</span></td>
            </tr>
            <tr>
              <td height="93" colspan="5" valign="top"><table width="791" border="0" align="center">
                <tr>
                  <td width="26"><input name="entrega_rg" type="checkbox" id="entrega_rg" value="RG" /></td>
                  <td width="83">Rg</td>
                  <td width="26"><input type="checkbox" id="entrega_cpf" name="entrega_cpf" value="CPF" /></td>
                  <td width="131">Cpf</td>
                  <td width="26"><input name="entrega_diploma" type="checkbox" id="entrega_diploma" value="DIPLOMA" /></td>
                  <td width="74">Diploma</td>
                  <td width="132" valign="baseline"><img src="../img/IMGAutentico.png" alt="" width="76" height="23" /></td>
                  <td width="29"><input type="checkbox" id="entrega_endereco" name="entrega_endereco" value="ENDERECO" /></td>
                  <td colspan="2">Endereco</td>
                </tr>
                <tr>
                  <td><input type="checkbox" id="entrega_titulo" name="entrega_titulo" value="TITULO" /></td>
                  <td>Titulo</td>
                  <td><input type="checkbox" id="entrega_reservista" name="entrega_reservista" value="RESERVISTA" /></td>
                  <td>Reservista</td>
                  <td><input type="checkbox" id="entrega_historico2" name="entrega_historico2" value="HISTORICO2GRAU"/> </td>
                  <td colspan="2">Histórico 2º Grau</td>
                  <td><input type="checkbox" id="entrega_historico3" name="entrega_historico3" value="HISTORICO3GRAU" /></td>
                  <td width="144">Histórico 3º Grau</td>
                  <td width="78" valign="baseline"><img src="../img/IMGAutentico.png" alt="" width="76" height="23" /></td>
                </tr>
                <tr>
                  <td><input type="checkbox" id="entrega_certidao" name="entrega_certidao" value="CERTIDAOCASAMENTO" /></td>
                  <td colspan="6">Certidao de Casamento ou Nascimento</td>
                  <td><input type="checkbox" id="entrega_foto" name="entrega_foto" value="FOTOS" /></td>
                  <td colspan="2">2 Fotos 3X4</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="26" colspan="5"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">OBSERVAÇÕES</span></td>
            </tr>
            <tr>
              <td height="36" colspan="5"><span id="sprytextfield34">
                <label for="obs2"></label>
                <textarea name="obs" cols="115" rows="6" id="obs2"></textarea>
              </span></td>
</tr>
            <tr>
              <td height="60" colspan="5"><input type="image" src="../img/BTCadastrarEstudante.png" name="button" id="button" value="CADASTRAR" /></td>
            </tr>
          </table>
        </form></td>
        <td height="892" align="left" valign="top"></td>
        </tr>
      <tr>
        <td height="65" align="left" valign="top"></td>
        <td height="65" colspan="3" align="left" valign="top">&nbsp;</td>
        <td height="65" align="left" valign="top"></td>
      </tr>
      
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield34 = new Spry.Widget.ValidationTextField("sprytextfield34", "none", {isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "none", {isRequired:false});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "none", {isRequired:false});
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16", "none", {isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "email");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14", "none", {isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "none", {isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29", "none");
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28", "none");
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20", "none", {isRequired:false});
</script>
</body>
</html>