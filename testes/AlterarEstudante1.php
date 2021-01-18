<?php require_once('../Connections/conexao.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE idec_estudantes SET complemento_end=%s, nome=%s, cpf=%s, rg=%s, nascimento=%s, formacaoEscolar=%s, localTrabalho=%s, estado=%s, cidade=%s, bairro=%s, endereco=%s, cep=%s, tel_residencial=%s, celular=%s, obs=%s, sexo=%s, estado_civil=%s, numero_end=%s, email=%s, entrega_rg=%s, entrega_cpf=%s, entrega_diploma=%s, entrega_endereco=%s, entrega_certidao=%s, entrega_titulo=%s, entrega_reservista=%s, entrega_historico2=%s, entrega_historico3=%s, entrega_foto=%s WHERE id=%s",
                       GetSQLValueString($_POST['complemento_end'], "text"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['rg'], "text"),
                       GetSQLValueString($_POST['nascimento'], "text"),
                       GetSQLValueString($_POST['formacaoEscolar'], "text"),
                       GetSQLValueString($_POST['localTrabalho'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['cidade'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['cep'], "text"),
                       GetSQLValueString($_POST['tel_residencial'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['obs'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['estado_civil'], "text"),
                       GetSQLValueString($_POST['numero_end'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString(isset($_POST['entrega_rg']) ? "true" : "", "defined","'RG'","'N'"),
                       GetSQLValueString(isset($_POST['entrega_cpf']) ? "true" : "", "defined","'CPF'","'N'"),
                       GetSQLValueString(isset($_POST['entrega_diploma']) ? "true" : "", "defined","'DIPLOMA'","'N'"),
                       GetSQLValueString(isset($_POST['entrega_endereco']) ? "true" : "", "defined","'ENDERECO'","'N'"),
                       GetSQLValueString(isset($_POST['entrega_certidao']) ? "true" : "", "defined","'CERTIDAOCASAMENTO'","'N'"),
                       GetSQLValueString(isset($_POST['entrega_titulo']) ? "true" : "", "defined","'TITULO'","'N'"),
                       GetSQLValueString(isset($_POST['entrega_reservista']) ? "true" : "", "defined","'RESERVISTA'","'N'"),
                       GetSQLValueString(isset($_POST['entrega_historico2']) ? "true" : "", "defined","'HISTORICO2GRAU'","'N'"),
                       GetSQLValueString(isset($_POST['entrega_historico3']) ? "true" : "", "defined","'HISTORICO3GRAU'","'N'"),
                       GetSQLValueString(isset($_POST['entrega_foto']) ? "true" : "", "defined","'FOTOS'","'N'"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_RecordsetAlterar = "-1";
if (isset($_GET['id'])) {
  $colname_RecordsetAlterar = $_GET['id'];
}
mysql_select_db($database_conexao, $conexao);
$query_RecordsetAlterar = sprintf("SELECT * FROM idec_estudantes WHERE id = %s", GetSQLValueString($colname_RecordsetAlterar, "int"));
$RecordsetAlterar = mysql_query($query_RecordsetAlterar, $conexao) or die(mysql_error());
$row_RecordsetAlterar = mysql_fetch_assoc($RecordsetAlterar);
$totalRows_RecordsetAlterar = mysql_num_rows($RecordsetAlterar);
?>
<?php require_once('../Connections/Conexao1.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../pgsCadastros/img/iconIdec.png" />
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
        <td height="986"><form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST" enctype="multipart/form-data">
          <table width="910" height="1049" align="center"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 18px; text-align: center;">
            <tr>
              <td width="10" height="38" rowspan="2">&nbsp;</td>
              <td width="206" height="38"><a href="indexteste.php"><img src="../img/btHomer.png" alt="" width="168" height="25" /></a></td>
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
              <td colspan="13" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">USUÁRIO</span></td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td style="text-align: right"><span class="fonteT">RM</span>:</td>
      <td><input name="code" type="text" disabled="" id="textfield" value="<?php echo $row_RecordsetAlterar['code']; ?>"/></td>
              <td>&nbsp;</td>
              <td><input name="id" type="hidden" id="id" value="<?php echo $row_RecordsetAlterar['id']; ?>" /></td>
              <td>&nbsp;</td>
              <td colspan="5" rowspan="4"><table width="141" height="119">
                <tr>
                  <td><img src="<?php echo $row_RecordsetAlterar['../pgsCadastros/arquivo']; ?>" width="127" height="111" /></td>
                </tr>
              </table></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td width="1">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">CPF:</td>
              <td colspan="4"><span id="sprytextfield29">
                <label for="cpf"></label>
                <input name="cpf" type="text" id="cpf" value="<?php echo $row_RecordsetAlterar['cpf']; ?>" />
              </span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">RG:</td>
              <td colspan="4"><span id="sprytextfield28">
                <label for="rg2"></label>
                <input name="rg" type="text" id="rg2" value="<?php echo $row_RecordsetAlterar['rg']; ?>" />
              </span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="4"><span id="sprytextfield20">
                <label for="arquivo"></label>
              </span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="13" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DADOS PESSOAIS</span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Nome:</td>
              <td colspan="11"><span id="sprytextfield1">
              <label for="nome"></label>
              <input name="nome" type="text" id="nome" value="<?php echo $row_RecordsetAlterar['nome']; ?>" size="80" />
              <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Data de Nascimento:</td>
              <td colspan="4"><span id="sprytextfield2">
                <label for="nascimento"></label>
                <input name="nascimento" type="text" id="nascimento" value="<?php echo $row_RecordsetAlterar['nascimento']; ?>" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Sexo:</td>
              <td colspan="4"><span id="sprytextfield3">
                <label for="sexo"></label>
                <input name="sexo" type="text" id="sexo" value="<?php echo $row_RecordsetAlterar['sexo']; ?>" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Estado Civil:</td>
              <td colspan="4"><span id="sprytextfield4">
                <label for="estado_civil"></label>
                <input name="estado_civil" type="text" id="estado_civil" value="<?php echo $row_RecordsetAlterar['estado_civil']; ?>" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Endereço:</td>
              <td colspan="8"><span id="sprytextfield5">
                <label for="endereco"></label>
                <input name="endereco" type="text" id="endereco" value="<?php echo $row_RecordsetAlterar['endereco']; ?>" size="60" />
</span></td>
              <td width="23">Nº</td>
              <td width="234"><span id="sprytextfield13">
                <label for="numero_end"></label>
                <input name="numero_end" type="text" id="numero_end" value="<?php echo $row_RecordsetAlterar['numero_end']; ?>" size="10" />
</span></td>
              <td width="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Complemento:</td>
              <td colspan="4"><span id="sprytextfield6">
                <label for="complemento_end"></label>
                <input name="complemento_end" type="text" id="complemento_end" value="<?php echo $row_RecordsetAlterar['complemento_end']; ?>" size="40" />
</span></td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Bairro:</td>
              <td colspan="4"><span id="sprytextfield7">
                <label for="bairro"></label>
                <input name="bairro" type="text" id="bairro" value="<?php echo $row_RecordsetAlterar['bairro']; ?>" size="40" />
</span></td>
              <td width="60" style="text-align: right">CEP:</td>
              <td colspan="5"><span id="sprytextfield14">
                <label for="cep"></label>
                <input name="cep" type="text" id="cep" value="<?php echo $row_RecordsetAlterar['cep']; ?>" />
</span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Cidade:</td>
              <td colspan="4"><span id="sprytextfield8">
                <label for="cidade"></label>
                <input name="cidade" type="text" id="cidade" value="<?php echo $row_RecordsetAlterar['cidade']; ?>" />
</span></td>
              <td style="text-align: right">Estado:</td>
              <td colspan="5"><span id="sprytextfield15">
                <label for="estado"></label>
                <input name="estado" type="text" id="estado" value="<?php echo $row_RecordsetAlterar['estado']; ?>" />
                </span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Telefone Fixo:</td>
              <td colspan="2"><span id="sprytextfield9">
                <label for="tel_residencial"></label>
                <input name="tel_residencial" type="text" id="tel_residencial" value="<?php echo $row_RecordsetAlterar['tel_residencial']; ?>" />
               </span></td>
              <td colspan="2">Celular:</td>
              <td colspan="7"><span id="sprytextfield16">
                <label for="celular"></label>
                <input name="celular" type="text" id="celular" value="<?php echo $row_RecordsetAlterar['celular']; ?>" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">E-mail:</td>
              <td colspan="11"><span id="sprytextfield10">
                <label for="email"></label>
                <input name="email" type="text" id="email" value="<?php echo $row_RecordsetAlterar['email']; ?>" size="80" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Local de Trabalho:</td>
              <td colspan="11"><span id="sprytextfield11">
                <label for="localTrabalho"></label>
                <input name="localTrabalho" type="text" id="localTrabalho" value="<?php echo $row_RecordsetAlterar['localTrabalho']; ?>" size="80" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="fonteT" style="text-align: right">Formação Escolar:</td>
              <td colspan="11"><span id="sprytextfield12">
                <label for="formacaoEscolar"></label>
                <input name="formacaoEscolar" type="text" id="formacaoEscolar" value="<?php echo $row_RecordsetAlterar['formacaoEscolar']; ?>" size="80" />
                </span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="13" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DOCUMENTOS ENTREGUE</span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td width="206" colspan="12" rowspan="4"><table width="905" border="0">
                <tr>
                  <td width="23"><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_rg'],"RG"))) {echo "checked=\"checked\"";} ?> name="entrega_rg" type="checkbox" id="entrega_rg" value="RG" /></td>
                  <td width="74">Rg</td>
                  <td width="23"><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_cpf'],"CPF"))) {echo "checked=\"checked\"";} ?> type="checkbox" id="entrega_cpf" name="entrega_cpf" value="CPF" /></td>
                  <td width="117">Cpf</td>
                  <td width="23"><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_diploma'],"DIPLOMA"))) {echo "checked=\"checked\"";} ?> type="checkbox" id="entrega_diploma" name="entrega_diploma" value="<?php echo $row_RecordsetAlterar['arquivo']; ?>" /></td>
                  <td width="186">Diploma</td>
                  <td width="26"><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_endereco'],"ENDERECO"))) {echo "checked=\"checked\"";} ?> type="checkbox" id="entrega_endereco" name="entrega_endereco" value="ENDERECO" /></td>
                  <td width="197">Endereco</td>
                </tr>
                <tr>
                  <td><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_titulo'],"TITULO"))) {echo "checked=\"checked\"";} ?> type="checkbox" id="entrega_titulo" name="entrega_titulo" value="TITULO" /></td>
                  <td>Titulo</td>
                  <td><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_reservista'],"RESERVISTA"))) {echo "checked=\"checked\"";} ?> type="checkbox" id="entrega_reservista" name="entrega_reservista" value="RESERVISTA" /></td>
                  <td>Reservista</td>
                  <td><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_historico2'],"HISTORICO2GRAU"))) {echo "checked=\"checked\"";} ?> type="checkbox" id="entrega_historico2" name="entrega_historico2" value="HISTORICO2GRAU"/> </td>
                  <td>Histórico 2º Grau</td>
                  <td><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_historico3'],"HISTORICO3GRAU"))) {echo "checked=\"checked\"";} ?> type="checkbox" id="entrega_historico3" name="entrega_historico3" value="HISTORICO3GRAU" /></td>
                  <td>Histórico 3º Grau</td>
                </tr>
                <tr>
                  <td><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_certidao'],"CERTIDAOCASAMENTO"))) {echo "checked=\"checked\"";} ?> type="checkbox" id="entrega_certidao" name="entrega_certidao" value="CERTIDAOCASAMENTO" /></td>
                  <td colspan="5">Certidao de Casamento ou Nascimento</td>
                  <td><input <?php if (!(strcmp($row_RecordsetAlterar['entrega_foto'],"FOTOS"))) {echo "checked=\"checked\"";} ?> type="checkbox" id="entrega_foto" name="entrega_foto" value="FOTOS" /></td>
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
              <td height="26" colspan="13" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">OBSERVAÇÕES</span></td>
              <td rowspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="36" colspan="13"><span id="sprytextfield34">
              <label for="obs2"></label>
              <textarea name="obs" cols="119" rows="6" id="obs2"><?php echo $row_RecordsetAlterar['sexo']; ?></textarea>
              </span></td>
              </tr>
            <tr>
              <td height="36">&nbsp;</td>
              <td colspan="5"><input type="submit" name="button" id="button" value="ATUALIZAR CADASTRO" /></td>
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
          <input type="hidden" name="MM_update" value="form1" />
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="148" align="center">
  <tr>
    <td width="140" class="rodape">AVANTE INFORMÁTICA</td>
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
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29", "none", {isRequired:false});
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28", "none", {isRequired:false});
var sprytextfield34 = new Spry.Widget.ValidationTextField("sprytextfield34", "none", {isRequired:false});
</script>
</body>
</html>
<?php
mysql_free_result($RecordsetAlterar);
?>
