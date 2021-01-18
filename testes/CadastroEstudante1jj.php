<?php require_once('Connections/Conexao1.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 table tr td {
	font-family: Calibri;
	color: #000;
	font-weight: bold;
	font-size: 18px;
	text-align: left;
}
#form1 table tr td table tr td {
	text-align: center;
}
.fonteT {
	font-size: 20px;
	font-family: Calibri;
}
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body>
<table width="1011" height="134" border="0" align="center" style="background: url(img/TopoIdec.png)no-repeat; font-family: Calibri; font-size: 15px; color: #5080D8; font-weight: bold;">
  <tr>
    <td height="130"><table width="401" align="right">
      <tr>
        <td width="299">Olá (Administrador) Seja bem vindo(a)</td>
        <td width="90" rowspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="1016" height="1012" border="0" align="center" style="background: url(img/imgFundoCadastroAlunos.png)no-repeat; text-align: left; font-family: Calibri; font-size: 20px;">
  <tr>
    <td width="978" height="956"><table width="962" height="992" align="center">
      <tr>
        <td height="986"><form action="upload.php" method="post" enctype="multipart/form-data">
          <table width="910" height="1057" align="center"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 18px; text-align: center;">
            <tr>
              <td width="10" height="38" rowspan="2">&nbsp;</td>
              <td width="176" height="38"><a href="index.php"><img src="img/btHomer.png" alt="" width="168" height="25" /></a></td>
              <td colspan="4"><a href="estudante.php"><img src="img/btPesquisar.png" alt="" width="200" height="23" /></a></td>
              <td colspan="7">&nbsp;</td>
              <td width="1" rowspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="63"><a href="index.php"></a></td>
              <td colspan="4"><a href="estudante.php"></a></td>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="12" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">USUÁRIO</span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right"><span class="fonteT">RM</span>:</td>
                      <?php 
	$sql_1 = mysql_query("SELECT * FROM idec_estudantes ORDER BY id DESC LIMIT 1");
	    while($res_1 = mysql_fetch_array($sql_1)){
	  $new_code = $res_1['code']+$res_1['id']+741;
	   ?>
      <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $new_code?>"/><input type="hidden" name="code" value="<?php echo $new_code ?>" /></td>
      <?php }?>
              
              <td colspan="4">&nbsp;</td>
              <td colspan="7">&nbsp;</td>
              <td width="1">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">CPF:</td>
              <td colspan="4"><span id="sprytextfield29">
              <label for="cpf"></label>
              <input type="text" name="cpf" id="cpf" />
              </span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">RG:</td>
              <td colspan="4"><span id="sprytextfield28">
              <label for="rg2"></label>
              <input type="text" name="rg" id="rg2" />
              </span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Foto:</td>
              <td colspan="4"><span id="sprytextfield20">
                <label for="arquivo"></label>
                <input name="arquivo" type="file" id="arquivo" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="12" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DADOS PESSOAIS</span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Nome:</td>
              <td colspan="11"><span id="sprytextfield1">
              <label for="nome"></label>
              <input name="nome" type="text" id="nome" size="80" />
              <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Data de Nascimento:</td>
              <td colspan="4"><span id="sprytextfield2">
                <label for="nascimento"></label>
                <input type="text" name="nascimento" id="nascimento" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Sexo:</td>
              <td colspan="4"><span id="sprytextfield3">
                <label for="sexo"></label>
                <input type="text" name="sexo" id="sexo" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Estado Civil:</td>
              <td colspan="4"><span id="sprytextfield4">
                <label for="estado_civil"></label>
                <input type="text" name="estado_civil" id="estado_civil" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Endereço:</td>
              <td colspan="8"><span id="sprytextfield5">
                <label for="endereco"></label>
                <input name="endereco" type="text" id="endereco" size="60" />
</span></td>
              <td width="23">Nº</td>
              <td width="234"><span id="sprytextfield13">
                <label for="numero_end"></label>
                <input name="numero_end" type="text" id="numero_end" size="10" />
</span></td>
              <td width="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Complemento:</td>
              <td colspan="4"><span id="sprytextfield6">
                <label for="complemento_end"></label>
                <input name="complemento_end" type="text" id="complemento_end" size="40" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Bairro:</td>
              <td colspan="4"><span id="sprytextfield7">
                <label for="bairro"></label>
                <input name="bairro" type="text" id="bairro" size="40" />
</span></td>
              <td width="60" style="text-align: right">CEP:</td>
              <td colspan="5"><span id="sprytextfield14">
                <label for="cep"></label>
                <input type="text" name="cep" id="cep" />
</span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Cidade:</td>
              <td colspan="4"><span id="sprytextfield8">
                <label for="cidade"></label>
                <input type="text" name="cidade" id="cidade" />
</span></td>
              <td style="text-align: right">Estado:</td>
              <td colspan="5"><span id="sprytextfield15">
                <label for="estado"></label>
                <input type="text" name="estado" id="estado" />
                </span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Telefone Fixo:</td>
              <td colspan="2"><span id="sprytextfield9">
                <label for="tel_residencial"></label>
                <input type="text" name="tel_residencial" id="tel_residencial" />
               </span></td>
              <td colspan="2">Celular:</td>
              <td colspan="7"><span id="sprytextfield16">
                <label for="celular"></label>
                <input type="text" name="celular" id="celular" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">E-mail:</td>
              <td colspan="11"><span id="sprytextfield10">
                <label for="email"></label>
                <input name="email" type="text" id="email" size="80" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Local de Trabalho:</td>
              <td colspan="11"><span id="sprytextfield11">
                <label for="localTrabalho"></label>
                <input name="localTrabalho" type="text" id="localTrabalho" size="80" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Formação Escolar:</td>
              <td colspan="11"><span id="sprytextfield12">
                <label for="formacaoEscolar"></label>
                <input name="formacaoEscolar" type="text" id="formacaoEscolar" size="80" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="12" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DOCUMENTOS ENTREGUE</span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td width="206" colspan="12" rowspan="4"><table width="905" border="0">
                <tr>
                  <td width="23"><input name="entregue_rg" type="checkbox" id="entregue_rg" value="RG" /></td>
                  <td width="74">Rg</td>
                  <td width="23"><input type="checkbox" id="entregue_rg" name="entrega_cpf" value="CPF" /></td>
                  <td width="117">Cpf</td>
                  <td width="23"><input type="checkbox" id="entregue_rg" name="entrega_diploma" value="DIPLOMA" /></td>
                  <td width="186">Diploma</td>
                  <td width="26"><input type="checkbox" id="entregue_rg" name="entrega_endereco" value="ENDEREÇO" /></td>
                  <td width="197">Endereco</td>
                </tr>
                <tr>
                  <td><input type="checkbox" id="entregue_rg" name="entrega_titulo" value="TITULO" /></td>
                  <td>Titulo</td>
                  <td><input type="checkbox" id="entregue_rg" name="entrega_reservista" value="RESERVISTA" /></td>
                  <td>Reservista</td>
                  <td><input type="checkbox" id="entregue_rg" name="entrega_historico2" value="HISTÓRICO 2º GRAU" /></td>
                  <td>Histórico 2º Grau</td>
                  <td><input type="checkbox" id="entregue_rg" name="entrega_historico3" value="HISTÓRICO 3º GRAU" /></td>
                  <td>Histórico 3º Grau</td>
                </tr>
                <tr>
                  <td><input type="checkbox" id="entregue_rg" name="entrega_certidao" value="CERTIDÃO CASAMENTO" /></td>
                  <td colspan="5">Certidao de Casamento ou Nascimento</td>
                  <td><input type="checkbox" id="entregue_rg" name="entrega_foto" value="FOTOS 3x4" /></td>
                  <td>2 Fotos 3X4</td>
                </tr>
              </table></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="26">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="11" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">OBSERVAÇÕES</span></td>
              <td>&nbsp;</td>
              <td rowspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="36">&nbsp;</td>
              <td colspan="12"><span id="sprytextfield34">
                <label for="obs"></label>
                <textarea name="obs" cols="119" rows="6" id="obs"></textarea>
                </span></td>
              </tr>
            <tr>
              <td height="36">&nbsp;</td>
              <td colspan="5"><input type="submit" name="button" id="button" value="CADASTRAR" /></td>
              <td>&nbsp;</td>
              <td width="3">&nbsp;</td>
              <td width="3">&nbsp;</td>
              <td width="3">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="36">&nbsp;</td>
              <td colspan="5">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="148" align="center">
  <tr>
    <td width="140" class="rodape">AVANTE INFORMÀTICA</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {isRequired:false});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {isRequired:false}); 
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "none", {isRequired:false});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "none", {isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "none", {isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14", "none", {isRequired:false});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "none", {isRequired:false});
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16", "none", {isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "none", {isRequired:false});
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20", "none", {isRequired:false});
var sprytextfield34 = new Spry.Widget.ValidationTextField("sprytextfield34", "none", {isRequired:false});
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29", "none", {isRequired:false});
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28", "none", {isRequired:false});
</script>
</body>
</html>