<?php require_once('../Connections/ConexaoIdec.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE ide_representantes SET code=%s, cpf=%s, rg=%s, nome=%s, nascimento=%s, sexo=%s, estado_civil=%s, endereco=%s, numero_end=%s, complemento_end=%s, bairro=%s, cep=%s, cidade=%s, estado=%s, tel_residencial=%s, celular=%s, email=%s, localTrabalho=%s, formacaoEscolar=%s, obs=%s WHERE id=%s",
                       GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['rg'], "text"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['nascimento'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['estado_civil'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['numero_end'], "text"),
                       GetSQLValueString($_POST['complemento_end'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['cep'], "text"),
                       GetSQLValueString($_POST['cidade'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['tel_residencial'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['localTrabalho'], "text"),
                       GetSQLValueString($_POST['formacaoEscolar'], "text"),
                       GetSQLValueString($_POST['obs'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());

  $updateGoTo = "../admin/vendedores.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs_AlterarVendedores = "-1";
if (isset($_GET['id'])) {
  $colname_rs_AlterarVendedores = $_GET['id'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_AlterarVendedores = sprintf("SELECT * FROM ide_representantes WHERE id = %s", GetSQLValueString($colname_rs_AlterarVendedores, "int"));
$rs_AlterarVendedores = mysql_query($query_rs_AlterarVendedores, $ConexaoIdec) or die(mysql_error());
$row_rs_AlterarVendedores = mysql_fetch_assoc($rs_AlterarVendedores);
$totalRows_rs_AlterarVendedores = mysql_num_rows($rs_AlterarVendedores);
?>
<?php require_once('../Connections/Conexao1.php'); ?>
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
</head>

<body>
<table width="985" height="1371" border="0" align="center" style="background: url(../img/imgFundoCadastroVendedor.png) no-repeat; text-align: right; font-family: Calibri; font-size: 20px;">
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
        <td width="210"><a href="../admin/vendedores.php"><img src="../img/BTPesquisarVendedores.png" width="197" height="33" /></a></td>
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
        <td height="892" colspan="3" align="left" valign="top"><form name="form" action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data">
          <table width="961" height="675">
            <tr>
              <td height="26" colspan="6"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">USUÁRIOS</span></td>
            </tr>
            <tr style="text-align: left">
              <td width="208" height="28" style="text-align:right">REGISTRO:</td>
       
              <td width="259"><input name="code" type="text" id="code" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " value="<?php echo $row_rs_AlterarVendedores['code']; ?>" size="10" readonly="readonly" />
              <td width="43">Foto:</td>
              <td width="131" rowspan="4" valign="top"><img src="<?php echo $row_rs_AlterarVendedores['arquivo']; ?>" alt="" width="131" height="121" /></td>
              <td>&nbsp;</td>
             
            </tr>
            <tr>
              <td height="27" style="text-align: right">CPF:</td>
              <td colspan="2"><span id="sprytextfield29">
                <label for="cpf"></label>
                <input name="cpf" type="text" id="cpf" value="<?php echo $row_rs_AlterarVendedores['cpf']; ?>" />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span>
                <input name="id" type="hidden" id="id" value="<?php echo $row_rs_AlterarVendedores['id']; ?>" /></td>
              <td width="296">&nbsp;</td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">RG:</td>
              <td colspan="2"><span id="sprytextfield28">
                <label for="rg"></label>
                <input name="rg" type="text" id="rg" value="<?php echo $row_rs_AlterarVendedores['rg']; ?>" />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="29" style="text-align: right">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="41" colspan="6"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DADOS PESSOAIS</span></td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">Nome:</td>
              <td colspan="5"><span id="sprytextfield1">
                <label for="nome"></label>
                <input name="nome" type="text" id="nome" value="<?php echo $row_rs_AlterarVendedores['nome']; ?>" size="75" />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Data de Nascimento:</td>
              <td colspan="5"><span id="sprytextfield2">
                <input name="nascimento" type="text" id="nascimento" value="<?php echo $row_rs_AlterarVendedores['nascimento']; ?>" />
              </span> <span class="hht">Ex: 00/00/00</span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Sexo:</td>
              <td colspan="5"><label for="sexo"></label>
                <input name="sexo" type="text" id="sexo" value="<?php echo $row_rs_AlterarVendedores['sexo']; ?>" />                
                <label for="sexo"></label></td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">Estado Civil:</td>
              <td colspan="5"><span id="sprytextfield4">
                <label for="estado_civil"></label>
                <input name="estado_civil" type="text" id="estado_civil" value="<?php echo $row_rs_AlterarVendedores['estado_civil']; ?>" />
              </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Endereço:</td>
              <td colspan="5"><span id="sprytextfield5">
                <label for="endereco"></label>
                <input name="endereco" type="text" id="endereco" value="<?php echo $row_rs_AlterarVendedores['endereco']; ?>" size="60" />
                </span>Nº <span id="sprytextfield13">
                  <label for="numero_end"></label>
                  <input name="numero_end" type="text" id="numero_end" value="<?php echo $row_rs_AlterarVendedores['numero_end']; ?>" size="10" />
                </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Complemento:</td>
              <td colspan="5"><span id="sprytextfield6">
                <label for="complemento_end"></label>
                <input name="complemento_end" type="text" id="complemento_end" value="<?php echo $row_rs_AlterarVendedores['complemento_end']; ?>" size="40" />
              </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Bairro:</td>
              <td colspan="5"><span id="sprytextfield7">
                <label for="bairro"></label>
                <input name="bairro" type="text" id="bairro" value="<?php echo $row_rs_AlterarVendedores['bairro']; ?>" size="40" />
                </span> <span style="text-align: right">CEP:</span> <span id="sprytextfield14">
                  <label for="cep"></label>
                  <input name="cep" type="text" id="cep" value="<?php echo $row_rs_AlterarVendedores['cep']; ?>" />
                </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Cidade:</td>
              <td colspan="5"><span id="sprytextfield8">
                <label for="cidade"></label>
                <input name="cidade" type="text" id="cidade" value="<?php echo $row_rs_AlterarVendedores['cidade']; ?>" />
                </span> <span style="text-align: right">Estado: <span id="sprytextfield15">
                  <label for="estado"></label>
                  <input name="estado" type="text" id="estado" value="<?php echo $row_rs_AlterarVendedores['estado']; ?>" />
                </span></span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Telefone Fixo:</td>
              <td colspan="5"><span id="sprytextfield9">
                <label for="tel_residencial"></label>
                <input name="tel_residencial" type="text" id="tel_residencial" value="<?php echo $row_rs_AlterarVendedores['tel_residencial']; ?>" />
                </span> Celular: <span id="sprytextfield16">
                  <label for="celular"></label>
                  <input name="celular" type="text" id="celular" value="<?php echo $row_rs_AlterarVendedores['celular']; ?>" />
                </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">E-mail:</td>
              <td colspan="5"><span id="sprytextfield10">
                <label for="email"></label>
                <input name="email" type="text" id="email" value="<?php echo $row_rs_AlterarVendedores['email']; ?>" size="60" />
                <span class="textfieldRequiredMsg">Formato envalido.</span><span class="textfieldInvalidFormatMsg">e-mail envalido.</span></span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Região de Trabalho:</td>
              <td colspan="5"><span id="sprytextfield11">
                <label for="localTrabalho"></label>
                <input name="localTrabalho" type="text" id="localTrabalho" value="<?php echo $row_rs_AlterarVendedores['localTrabalho']; ?>" size="75" />
              </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Formação Escolar:</td>
              <td colspan="5"><span id="sprytextfield12">
                <label for="formacaoEscolar"></label>
                <input name="formacaoEscolar" type="text" id="formacaoEscolar" value="<?php echo $row_rs_AlterarVendedores['formacaoEscolar']; ?>" size="75" />
              </span></td>
</tr>
            <tr>
              <td height="26" colspan="6"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">OBSERVAÇÕES</span></td>
            </tr>
            <tr>
              <td height="36" colspan="6"><span id="sprytextfield34">
                <label for="obs2"></label>
                <textarea name="obs" cols="115" rows="6" id="obs2"><?php echo $row_rs_AlterarVendedores['obs']; ?></textarea>
              </span></td>
</tr>
            <tr>
              <td height="60" colspan="6"><input type="image" src="../img/BTAtualizarEstudante.png" name="button" id="button" value="CADASTRAR" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form" />
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
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29", "none");
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28", "none");
</script>
</body>
</html>
<?php
mysql_free_result($rs_AlterarVendedores);
?>
