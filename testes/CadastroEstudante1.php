<?php require_once('../Connections/Conexao1.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="../pgsCadastros/img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.hht {
	font-size: 18px;
}
</style>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
</head>

<body>
<table width="985" height="1371" border="0" align="center" style="background: url(../img/imgFundoCadastroAluno1.png) no-repeat; text-align: right; font-family: Calibri; font-size: 20px;">
  <tr>
    <td width="978" height="956" align="left" valign="top"><table width="978" height="1167">
      <tr>
        <td width="1" height="121">&nbsp;</td>
        <td colspan="3" align="right" valign="top"><table width="462">
          <tr>
            <td width="111" height="43">&nbsp;</td>
            <td width="131">&nbsp;</td>
            <td width="103">&nbsp;</td>
            <td width="34"><a href="#"><img src="../img/btInfo.png" alt="" width="28" height="30" title="Informação do Sistema"/></a></td>
            <td width="32"><a href="../admin/index.php"><img src="../img/btLogof.png" alt="" width="28" height="30" title="Logoff" /></a></td>
            <td width="23">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4">&nbsp;</td>
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
        <td height="892" colspan="3" align="left" valign="top"><form action="../pgsCadastros/uploadCadastroAlunos.php" method="post" enctype="multipart/form-data">
          <table width="961" height="1346">
            <tr>
              <td height="26" colspan="3"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">USUÁRIOS</span></td>
            </tr>
            <tr style="text-align: left">
              <td width="200" height="28" style="text-align:right">REGISTRO:</td>
              <?php 
	$sql_1 = mysql_query("SELECT * FROM idec_estudantes ORDER BY id DESC LIMIT 1");
	    while($res_1 = mysql_fetch_array($sql_1)){
	  $new_code = $res_1['code']+$res_1['id']+741;
	   ?>
              <td width="749" colspan="3"><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $new_code?>"/>
                <input type="hidden" name="code" value="<?php echo $new_code ?>" /></td>
              <?php }?>
            </tr>
            <tr>
              <td height="27" style="text-align: right">CPF:</td>
              <td colspan="2"><span id="sprytextfield29">
                <label for="cpf"></label>
                <input type="text" name="cpf" id="cpf" />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">RG:</td>
              <td colspan="2"><span id="sprytextfield28">
                <label for="rg"></label>
                <input type="text" name="rg" id="rg" />
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
              <td height="41" colspan="3"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DADOS PESSOAIS</span></td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">Nome:</td>
              <td colspan="2"><span id="sprytextfield1">
                <label for="nome"></label>
                <input name="nome" type="text" id="nome" size="75" />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Data de Nascimento:</td>
              <td colspan="2"><span id="sprytextfield2">
                <input type="text" name="nascimento" id="nascimento" />
              </span> <span class="hht">Ex: 00/00/00</span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Sexo:</td>
              <td colspan="2"><select name="sexo" id="sexo">
                <option value="" selected="selected"></option>
                <option value="MASCULINO" selected="selected">Masculino</option>
                <option value="FEMININO">Feminino</option>
              </select>
                <label for="sexo"></label></td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">Estado Civil:</td>
              <td colspan="2"><span id="sprytextfield4">
                <label for="estado_civil"></label>
                <input type="text" name="estado_civil" id="estado_civil" />
              </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Endereço:</td>
              <td colspan="2"><span id="sprytextfield5">
                <label for="endereco"></label>
                <input name="endereco" type="text" id="endereco" size="60" />
                </span>Nº <span id="sprytextfield13">
                  <label for="numero_end"></label>
                  <input name="numero_end" type="text" id="numero_end" size="10" />
                </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Complemento:</td>
              <td colspan="2"><span id="sprytextfield6">
                <label for="complemento_end"></label>
                <input name="complemento_end" type="text" id="complemento_end" size="40" />
              </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Bairro:</td>
              <td colspan="2"><span id="sprytextfield7">
                <label for="bairro"></label>
                <input name="bairro" type="text" id="bairro" size="40" />
                </span> <span style="text-align: right">CEP:</span> <span id="sprytextfield14">
                  <label for="cep"></label>
                  <input type="text" name="cep" id="cep" />
                </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Cidade:</td>
              <td colspan="2"><span id="sprytextfield8">
                <label for="cidade"></label>
                <input type="text" name="cidade" id="cidade" />
                </span> <span style="text-align: right">Estado: <span id="sprytextfield15">
                  <label for="estado"></label>
                  <input type="text" name="estado" id="estado" />
                </span></span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Telefone Fixo:</td>
              <td colspan="2"><span id="sprytextfield9">
                <label for="tel_residencial"></label>
                <input type="text" name="tel_residencial" id="tel_residencial" />
                </span> Celular: <span id="sprytextfield16">
                  <label for="celular"></label>
                  <input type="text" name="celular" id="celular" />
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
                  <td width="56">BANCO:</td>
                  <td width="168"><input name="banco" type="text" id="banco" /></td>
                  <td width="34">AG:</td>
                  <td width="168"><input name="ag" type="text" id="ag" /></td>
                  <td width="75">CONTA:</td>
                  <td width="115" colspan="2"><input name="conta" type="text" id="conta" /></td>
                  <td width="109">TIPO:</td>
                  <td width="146"><select name="tipo_conta" size="1" id="tipo_conta">
                    <option value="Corrente">Corrente</option>
                    <option value="Poupança">Poupanca</option>
                  </select></td>
                </tr>
                <tr>
                  <td colspan="2">FAVORECIDO: </td>
                  <td colspan="2"><input name="favorecido" type="text" id="favorecido" /></td>
                  <td colspan="2">CONJUNTA:</td>
                  <td><select name="conjunta" size="1" id="conjunta">
                    <option value="SIM">SIM</option>
                    <option value="NÃO">NAO</option>
                  </select></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="200" colspan="3" valign="top"><div id="Accordion1" class="Accordion" tabindex="0">
<div class="AccordionPanel">
  <div class="AccordionPanelTab"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">GRADUAÇÃO:</span></div>
                  <div class="AccordionPanelContent">
                    <table width="905" border="0">
                      <tr>
                        <td colspan="3">1&ordf; </td>
                        <td width="201">Nome da Institui&ccedil;&atilde;o:</td>
                        <td colspan="3"><input name="nome_graduacao1" type="text" id="nome_graduacao1" /></td>
                      </tr>
                      <tr>
                        <td width="6">&nbsp;</td>
                        <td width="6">&nbsp;</td>
                        <td width="3">&nbsp;</td>
                        <td>Curso:</td>
                        <td width="272"><input name="curso_graduacao1" type="text" id="curso_graduacao1" /></td>
                        <td width="215">Ano de Conclus&atilde;o:</td>
                        <td width="172"><input name="ano_graduacao1" type="text" id="ano_graduacao1" /></td>
                      </tr>
                      <tr>
                        <td colspan="3">2&ordf; </td>
                        <td>Nome da Institui&ccedil;&atilde;o:</td>
                        <td colspan="3"><input name="nome_graduacao2" type="text" id="nome_graduacao" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Curso:</td>
                        <td><input name="curso_graduacao2" type="text" id="nome_graduacao" /></td>
                        <td>Ano de Conclus&atilde;o:</td>
                        <td><input name="ano_graduacao2" type="text" id="nome_graduacao" /></td>
                      </tr>
                    </table>
                  </div>
              </div>
                <div class="AccordionPanel">
                  <div class="AccordionPanelTab"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">PÓS-GRADUAÇÃO LATO-SENSU:</span></div>
                  <div class="AccordionPanelContent">Content 2</div>
                </div>
                <div class="AccordionPanel">
                  <div class="AccordionPanelTab"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">PÓS-GRADUAÇÃO STRICTO - SENSU (MESTRADO):</span></div>
                  <div class="AccordionPanelContent">Content 3</div>
            </div>
<div class="AccordionPanel">
  <div class="AccordionPanelTab"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">PÓS-GRADUAÇÃO STRICTO - SENSU (DOUTORADO):</span></div>
                  <div class="AccordionPanelContent">Content 4</div>
              </div>
</div></td>
            </tr>
            <tr>
              <td height="93" colspan="3" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td height="26" colspan="3"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">OBSERVAÇÕES</span></td>
            </tr>
            <tr>
              <td height="36" colspan="3"><span id="sprytextfield34">
                <label for="obs2"></label>
                <textarea name="obs" cols="115" rows="6" id="obs2"></textarea>
              </span></td>
</tr>
            <tr>
              <td height="60" colspan="3"><input type="image" src="../img/BTCadastrarEstudante.png" name="button" id="button" value="CADASTRAR" /></td>
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
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "none", {isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14", "none", {isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "none", {isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20", "none", {isRequired:false});
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29", "none");
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28", "none");
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
</body>
</html>