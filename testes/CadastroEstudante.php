<?php require_once('../Connections/ConexaoIdec.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO idec_estudantes (complemento_end, nome, cpf, rg, nascimento, mae, pai, estado, cidade, bairro, rg_expedidor, cep, tel_residencial, celular, obs, sexo, estado_civil, numero_end, email, titulo, titulo_sessao, titulo_zona, numero_nasc, livro_nasc, folha_nasc, termo_nasc, cartorio_nasc, cidade_nasc, uf_nasc) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['complemento_end'], "text"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['rg'], "text"),
                       GetSQLValueString($_POST['nascimento'], "text"),
                       GetSQLValueString($_POST['mae'], "text"),
                       GetSQLValueString($_POST['pai'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['cidade'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['rg_expedidor'], "text"),
                       GetSQLValueString($_POST['cep'], "text"),
                       GetSQLValueString($_POST['tel_residencial'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['obs'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['estado_civil'], "text"),
                       GetSQLValueString($_POST['numero_end'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['titulo_sessao'], "text"),
                       GetSQLValueString($_POST['titulo_zona'], "text"),
                       GetSQLValueString($_POST['numero_nasc'], "text"),
                       GetSQLValueString($_POST['livro_nasc'], "text"),
                       GetSQLValueString($_POST['folha_nasc'], "text"),
                       GetSQLValueString($_POST['termo_nasc'], "text"),
                       GetSQLValueString($_POST['cartorio_nasc'], "text"),
                       GetSQLValueString($_POST['cidade_nasc'], "text"),
                       GetSQLValueString($_POST['uf_nasc'], "text"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($insertSQL, $ConexaoIdec) or die(mysql_error());

  $insertGoTo = "estudante.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
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
<table width="1016" height="1012" border="0" align="center" style="background:url(../img/imgFundoCadastroAlunos.png) no-repeat">
  <tr>
    <td width="978" height="956"><table width="962" height="992" align="center">
      <tr>
        <td height="986"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
          <table width="910" height="820" align="center">
            <tr>
              <td width="1" height="31">&nbsp;</td>
              <td width="178">&nbsp;</td>
              <td colspan="4">&nbsp;</td>
              <td colspan="7">&nbsp;</td>
              <td width="1">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="12" bgcolor="#7BCAFF">USUÁRIO</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">RM:</td>
              <td colspan="4"><span id="sprytextfield17">
                <label for="text4"></label>
                <input type="text" name="text4" id="text4" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Tipo:</td>
              <td colspan="4"><span id="sprytextfield18">
                <label for="text5"></label>
                <input type="text" name="text5" id="text5" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Senha:</td>
              <td colspan="4"><span id="sprytextfield19">
                <label for="text6"></label>
                <input type="text" name="text6" id="text6" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Foto:</td>
              <td colspan="4"><span id="sprytextfield20">
                <label for="arquivo"></label>
                <input name="arquivo" type="file" id="arquivo" /> 
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="12" bgcolor="#7BCAFF">DADOS PESSOAIS</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Nome:</td>
              <td colspan="11"><span id="sprytextfield1">
              <label for="nome"></label>
              <input name="nome" type="text" id="nome" size="80" />
              <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Data de Nascimento:</td>
              <td colspan="4"><span id="sprytextfield2">
                <label for="nascimento"></label>
                <input type="text" name="nascimento" id="nascimento" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Sexo:</td>
              <td colspan="4"><span id="sprytextfield3">
                <label for="sexo"></label>
                <input type="text" name="sexo" id="sexo" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Estado Civil:</td>
              <td colspan="4"><span id="sprytextfield4">
                <label for="estado_civil"></label>
                <input type="text" name="estado_civil" id="estado_civil" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Endereço:</td>
              <td colspan="8"><span id="sprytextfield5">
                <label for="enderreco"></label>
                <input name="enderreco" type="text" id="enderreco" size="60" />
</span></td>
              <td width="20">Nº</td>
              <td width="241"><span id="sprytextfield13">
                <label for="numero_end"></label>
                <input name="numero_end" type="text" id="numero_end" size="10" />
</span></td>
              <td width="1">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Complemento:</td>
              <td colspan="4"><span id="sprytextfield6">
                <label for="complemento_end"></label>
                <input name="complemento_end" type="text" id="complemento_end" size="40" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Bairro:</td>
              <td colspan="4"><span id="sprytextfield7">
                <label for="bairro"></label>
                <input name="bairro" type="text" id="bairro" size="40" />
</span></td>
              <td width="59" style="text-align: right">CEP:</td>
              <td colspan="5"><span id="sprytextfield14">
                <label for="cep"></label>
                <input type="text" name="cep" id="cep" />
</span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Cidade:</td>
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
              <td style="text-align: right">Telefone Fixo</td>
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
              <td style="text-align: right">E-mail</td>
              <td colspan="11"><span id="sprytextfield10">
                <label for="email"></label>
                <input name="email" type="text" id="email" size="80" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Nome do Pai</td>
              <td colspan="11"><span id="sprytextfield11">
                <label for="pai"></label>
                <input name="pai" type="text" id="pai" size="80" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">Nome da Mãe</td>
              <td colspan="11"><span id="sprytextfield12">
                <label for="mae"></label>
                <input name="mae" type="text" id="mae" size="80" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="12" bgcolor="#7BCAFF">DOCUMENTOS</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="12"><table width="894" align="center">
                <tr>
                  <td colspan="10">Certidão de Nascimento</td>
                  </tr>
                <tr>
                  <td width="77">&nbsp;</td>
                  <td width="78">Nº</td>
                  <td width="174"><span id="sprytextfield21">
                    <label for="numero_nasc"></label>
                    <input type="text" name="numero_nasc" id="numero_nasc" />
                    </span></td>
                  <td width="51">Livro</td>
                  <td width="93"><span id="sprytextfield23">
                    <label for="livro_nasc"></label>
                    <input name="livro_nasc" type="text" id="livro_nasc" size="10" />
                    </span></td>
                  <td width="91">Folha</td>
                  <td width="70"><span id="sprytextfield25">
                    <label for="folha_nasc"></label>
                    <input name="folha_nasc" type="text" id="folha_nasc" size="10" />
                   </span></td>
                  <td width="73">Termo:</td>
                  <td width="74"><span id="sprytextfield26">
                    <label for="termo_nasc"></label>
                    <input name="termo_nasc" type="text" id="termo_nasc" size="10" />
                    </span></td>
                  <td width="71">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2">Cartório</td>
                  <td><span id="sprytextfield22">
                    <label for="cartorio_nasc"></label>
                    <input type="text" name="cartorio_nasc" id="cartorio_nasc" /></span></td>
                  <td>Cidade</td>
                  <td colspan="2"><span id="sprytextfield24">
                    <label for="cidade_nasc"></label>
                    <input type="text" name="cidade_nasc" id="cidade_nasc" />
                    </span></td>
                  <td>UF</td>
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
              <td style="text-align: right">RG</td>
              <td width="219"><span id="sprytextfield28">
                <label for="rg"></label>
                <input type="text" name="rg" id="rg" />
                </span></td>
              <td width="3">&nbsp;</td>
              <td colspan="2">Orgão Expedidor</td>
              <td colspan="7"><span id="sprytextfield32">
                <label for="rg_expedidor"></label>
                <input type="text" name="rg_expedidor" id="rg_expedidor" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right">CPF</td>
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
              <td style="text-align: right">TITULO:</td>
              <td><span id="sprytextfield30">
                <label for="titulo"></label>
                <input type="text" name="titulo" id="titulo" />
                </span></td>
              <td>&nbsp;</td>
              <td width="59">Sessão:</td>
              <td width="73"><span id="sprytextfield31">
                <label for="titulo_sessao"></label>
                <input name="titulo_sessao" type="text" id="titulo_sessao" size="10" />
                </span></td>
              <td colspan="5">Zona:</td>
              <td><span id="sprytextfield33">
                <label for="titulo_zona"></label>
                <input name="titulo_zona" type="text" id="titulo_zona" size="10" />
                </span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="11" bgcolor="#7BCAFF">OBSERVAÇÕES</td>
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
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
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
          <input type="hidden" name="MM_insert" value="form1" />
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
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17", "none", {isRequired:false});
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