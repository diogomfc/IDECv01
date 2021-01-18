<?php require_once('../Connections/Conexao1.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
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
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body>
<table width="1011" height="134" border="0" align="center" style="background: url(../img/TopoIdec.png) no-repeat; font-family: Calibri; font-size: 15px; color: #5080D8; font-weight: bold;">
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
<table width="1016" height="1012" border="0" align="center" style="background: url(../img/imgFundoCadastroAlunos.png) no-repeat; text-align: left; font-family: Calibri; font-size: 20px;">
  <tr>
    <td width="978" height="956"><table width="962" height="992" align="center">
      <tr>
        <td height="986"><form action="../pgsCadastros/upload.php" method="post" enctype="multipart/form-data">
          <table width="910" height="1059" align="center"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 18px; text-align: center;">
            <tr>
              <td width="10" height="31" rowspan="2">&nbsp;</td>
              <td width="176" height="38"><a href="indexteste.php"><img src="../img/btHomer.png" alt="" width="168" height="25" /></a></td>
              <td colspan="4"><a href="estudante.php"><img src="../img/btPesquisar.png" alt="" width="200" height="23" /></a></td>
              <td colspan="7">&nbsp;</td>
              <td width="1" rowspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="63"><a href="indexteste.php"></a></td>
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
              <td class="fonteT" style="text-align: right">Tipo:</td>
              <td colspan="4"><span id="sprytextfield18">
                <label for="text5"></label>
                <input type="text" name="text5" id="text5" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Senha:</td>
              <td colspan="4"><span id="sprytextfield19">
                <label for="text6"></label>
                <input type="text" name="text6" id="text6" />
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
              <td colspan="12" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DOCUMENTOS</span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="12"><table width="894" align="center">
                <tr>
                  <td colspan="10"><table width="221" align="center">
                    <tr>
                      <td width="307">Certidão de Nascimento</td>
                    </tr>
                  </table></td>
                  </tr>
                <tr>
                  <td width="77" class="fonteT">&nbsp;</td>
                  <td width="78" class="fonteT">Nº</td>
                  <td width="174"><span id="sprytextfield21">
                    <label for="numero_nasc"></label>
                    <input type="text" name="numero_nasc" id="numero_nasc" />
                    </span></td>
                  <td width="51" class="fonteT">Livro</td>
                  <td width="93"><span id="sprytextfield23">
                    <label for="livro_nasc"></label>
                    <input name="livro_nasc" type="text" id="livro_nasc" size="10" />
                    </span></td>
                  <td width="91" class="fonteT">Folha</td>
                  <td width="70"><span id="sprytextfield25">
                    <label for="folha_nasc"></label>
                    <input name="folha_nasc" type="text" id="folha_nasc" size="10" />
                   </span></td>
                  <td width="73" class="fonteT">Termo:</td>
                  <td width="74"><span id="sprytextfield26">
                    <label for="termo_nasc"></label>
                    <input name="termo_nasc" type="text" id="termo_nasc" size="10" />
                    </span></td>
                  <td width="71">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" class="fonteT">Cartório</td>
                  <td><span id="sprytextfield22">
                    <label for="cartorio_nasc"></label>
                    <input type="text" name="cartorio_nasc" id="cartorio_nasc" /></span></td>
                  <td class="fonteT">Cidade</td>
                  <td colspan="2"><span id="sprytextfield24">
                    <label for="cidade_nasc"></label>
                    <input type="text" name="cidade_nasc" id="cidade_nasc" />
                    </span></td>
                  <td class="fonteT">UF:</td>
                  <td><span id="sprytextfield27">
                    <label for="uf_nasc"></label>
                    <input name="uf_nasc" type="text" id="uf_nasc" size="10" />
                   </span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">RG</td>
              <td width="206"><span id="sprytextfield28">
                <label for="rg"></label>
                <input type="text" name="rg" id="rg" />
                </span></td>
              <td width="3">&nbsp;</td>
              <td colspan="2" class="fonteT">Orgão Expedidor</td>
              <td colspan="7"><span id="sprytextfield32">
                <label for="rg_expedidor"></label>
                <input type="text" name="rg_expedidor" id="rg_expedidor" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">CPF</td>
              <td><span id="sprytextfield29">
                <label for="cpf"></label>
                <input type="text" name="cpf" id="cpf" />
                </span></td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">TITULO:</td>
              <td><span id="sprytextfield30">
                <label for="titulo"></label>
                <input type="text" name="titulo" id="titulo" />
                </span></td>
              <td>&nbsp;</td>
              <td width="63" class="fonteT">Sessão:</td>
              <td width="74"><span id="sprytextfield31">
                <label for="titulo_sessao"></label>
                <input name="titulo_sessao" type="text" id="titulo_sessao" size="10" />
                </span></td>
              <td colspan="4" class="fonteT">Zona:</td>
              <td>&nbsp;</td>
              <td><span id="sprytextfield33">
                <label for="titulo_zona"></label>
                <input name="titulo_zona" type="text" id="titulo_zona" size="10" />
                </span></td>
              <td>&nbsp;</td>
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
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18", "none", {isRequired:false});
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19", "none", {isRequired:false});
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20", "none", {isRequired:false});
var sprytextfield21 = new Spry.Widget.ValidationTextField("sprytextfield21", "none", {isRequired:false});
var sprytextfield22 = new Spry.Widget.ValidationTextField("sprytextfield22", "none", {isRequired:false});
var sprytextfield23 = new Spry.Widget.ValidationTextField("sprytextfield23", "none", {isRequired:false});
var sprytextfield24 = new Spry.Widget.ValidationTextField("sprytextfield24", "none", {isRequired:false});
var sprytextfield25 = new Spry.Widget.ValidationTextField("sprytextfield25", "none", {isRequired:false});
var sprytextfield26 = new Spry.Widget.ValidationTextField("sprytextfield26", "none", {isRequired:false});
var sprytextfield27 = new Spry.Widget.ValidationTextField("sprytextfield27", "none", {isRequired:false});
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28", "none", {isRequired:false});
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29", "none", {isRequired:false});
var sprytextfield30 = new Spry.Widget.ValidationTextField("sprytextfield30", "none", {isRequired:false});
var sprytextfield31 = new Spry.Widget.ValidationTextField("sprytextfield31", "none", {isRequired:false});
var sprytextfield32 = new Spry.Widget.ValidationTextField("sprytextfield32", "none", {isRequired:false});
var sprytextfield33 = new Spry.Widget.ValidationTextField("sprytextfield33", "none", {isRequired:false});
var sprytextfield34 = new Spry.Widget.ValidationTextField("sprytextfield34", "none", {isRequired:false});
</script>
</body>
</html>