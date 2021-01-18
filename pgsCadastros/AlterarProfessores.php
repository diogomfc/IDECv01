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
  $updateSQL = sprintf("UPDATE idec_professores SET code=%s, cpf=%s, rg=%s, nome=%s, nascimento=%s, sexo=%s, estado_civil=%s, endereco=%s, numero_end=%s, complemento_end=%s, bairro=%s, cep=%s, cidade=%s, estado=%s, tel_residencial=%s, celular=%s, email=%s, localTrabalho=%s, formacaoEscolar=%s, banco=%s, ag=%s, conta=%s, tipo_conta=%s, favorecido=%s, conjunta=%s, nome_graduacao1=%s, curso_graduacao1=%s, ano_graduacao1=%s, nome_graduacao2=%s, curso_graduacao2=%s, ano_graduacao2=%s, nome_posgraduacao1=%s, curso_posgraduacao1=%s, ano_posgraduacao1=%s, nome_posgraduacao2=%s, curso_posgraduacao2=%s, ano_posgraduacao2=%s, nome_posgraduacao3=%s, curso_posgraduacao3=%s, ano_posgraduacao3=%s, nome_mestrado1=%s, curso_mestrado1=%s, ano_mestrado1=%s, nome_mestrado2=%s, curso_mestrado2=%s, ano_mestrado2=%s, nome_doutorado1=%s, curso_doutorado1=%s, ano_doutorado1=%s, disponibilidade_1=%s, disponibilidade_2=%s, disponibilidade_3=%s, disponibilidade_Apartir1=%s, disponibilidade_Apartir2=%s, disponibilidade_Apartir3=%s, RelacaoDisciplinas=%s, naturalidade=%s, tel_comercial=%s WHERE id=%s",
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
                       GetSQLValueString($_POST['banco'], "text"),
                       GetSQLValueString($_POST['ag'], "text"),
                       GetSQLValueString($_POST['conta'], "text"),
                       GetSQLValueString($_POST['tipo_conta'], "text"),
                       GetSQLValueString($_POST['favorecido'], "text"),
                       GetSQLValueString($_POST['conjunta'], "text"),
                       GetSQLValueString($_POST['nome_graduacao1'], "text"),
                       GetSQLValueString($_POST['curso_graduacao1'], "text"),
                       GetSQLValueString($_POST['ano_graduacao1'], "text"),
                       GetSQLValueString($_POST['nome_graduacao2'], "text"),
                       GetSQLValueString($_POST['curso_graduacao2'], "text"),
                       GetSQLValueString($_POST['ano_graduacao2'], "text"),
                       GetSQLValueString($_POST['nome_posgraduacao1'], "text"),
                       GetSQLValueString($_POST['curso_posgraduacao1'], "text"),
                       GetSQLValueString($_POST['ano_posgraduacao1'], "text"),
                       GetSQLValueString($_POST['nome_posgraduacao2'], "text"),
                       GetSQLValueString($_POST['curso_posgraduacao2'], "text"),
                       GetSQLValueString($_POST['ano_posgraduacao2'], "text"),
                       GetSQLValueString($_POST['nome_posgraduacao3'], "text"),
                       GetSQLValueString($_POST['curso_posgraduacao3'], "text"),
                       GetSQLValueString($_POST['ano_posgraduacao3'], "text"),
                       GetSQLValueString($_POST['nome_mestrado1'], "text"),
                       GetSQLValueString($_POST['curso_mestrado1'], "text"),
                       GetSQLValueString($_POST['ano_mestrado1'], "text"),
                       GetSQLValueString($_POST['nome_mestrado2'], "text"),
                       GetSQLValueString($_POST['curso_mestrado2'], "text"),
                       GetSQLValueString($_POST['ano_mestrado2'], "text"),
                       GetSQLValueString($_POST['nome_doutorado1'], "text"),
                       GetSQLValueString($_POST['curso_doutorado1'], "text"),
                       GetSQLValueString($_POST['ano_doutorado1'], "text"),
                       GetSQLValueString($_POST['disponibilidade_1'], "text"),
                       GetSQLValueString($_POST['disponibilidade_2'], "text"),
                       GetSQLValueString($_POST['disponibilidade_3'], "text"),
                       GetSQLValueString($_POST['disponibilidade_Apartir1'], "text"),
                       GetSQLValueString($_POST['disponibilidade_Apartir2'], "text"),
                       GetSQLValueString($_POST['disponibilidade_Apartir3'], "text"),
                       GetSQLValueString($_POST['RelacaoDisciplinas'], "text"),
                       GetSQLValueString($_POST['naturalidade'], "text"),
                       GetSQLValueString($_POST['tel_comercial'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$colname_rs_AlterarProfessor = "-1";
if (isset($_GET['id'])) {
  $colname_rs_AlterarProfessor = $_GET['id'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_AlterarProfessor = sprintf("SELECT * FROM idec_professores WHERE id = %s", GetSQLValueString($colname_rs_AlterarProfessor, "int"));
$rs_AlterarProfessor = mysql_query($query_rs_AlterarProfessor, $ConexaoIdec) or die(mysql_error());
$row_rs_AlterarProfessor = mysql_fetch_assoc($rs_AlterarProfessor);
$totalRows_rs_AlterarProfessor = mysql_num_rows($rs_AlterarProfessor);
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
<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
</head>

<body>
<table width="985" height="1371" border="0" align="center" style="background: url(../img/imgFundoCadastroProfessorAlterar.png) no-repeat; text-align: right; font-family: Calibri; font-size: 20px;">
  <tr>
    <td width="978" height="956" align="left" valign="top"><table width="978" height="1100">
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
        <td height="892" colspan="3" align="left" valign="top"><form name="form" action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data">
          <table width="961" height="998">
            <tr>
              <td height="26" colspan="5"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">USUÁRIOS</span></td>
            </tr>
            <tr style="text-align: left">
              <td width="207" height="28" style="text-align:right">REGISTRO:</td>
              <td width="278"> <input name="code" type="text" id="code" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " value="<?php echo $row_rs_AlterarProfessor['code']; ?>" size="10" readonly="readonly" />
               </td>
              <td width="45"><span style="text-align: right">Foto:</span></td>
              <td width="129" rowspan="4" valign="top"><img src="<?php echo $row_rs_AlterarProfessor['arquivo']; ?>" alt="" width="128" height="122" /></td>
              <td width="278">&nbsp;</td>
              
            </tr>
            <tr>
              <td height="27" style="text-align: right">CPF:</td>
              <td><span id="sprytextfield29">
                <label for="cpf"></label>
                <input name="cpf" type="text" id="cpf" value="<?php echo $row_rs_AlterarProfessor['cpf']; ?>" />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span>
                <input name="id" type="hidden" id="id" value="<?php echo $row_rs_AlterarProfessor['id']; ?>" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">RG:</td>
              <td><span id="sprytextfield28">
                <label for="rg"></label>
                <input name="rg" type="text" id="rg" value="<?php echo $row_rs_AlterarProfessor['rg']; ?>" />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="29" style="text-align: right">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">Nome:</td>
              <td colspan="4"><span id="sprytextfield1">
                <label for="nome"></label>
                <input name="nome" type="text" id="nome" value="<?php echo $row_rs_AlterarProfessor['nome']; ?>" size="75" />
                <span class="textfieldRequiredMsg">Preenchimento Obrigatório.</span></span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Data de Nascimento:</td>
              <td colspan="4"><span id="sprytextfield2">
                <input name="nascimento" type="text" id="nascimento" value="<?php echo $row_rs_AlterarProfessor['nascimento']; ?>" />
              </span> <span class="hht">Ex: 00/00/00</span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Sexo:</td>
              <td colspan="4"><label for="sexo"></label>
                <input name="sexo" type="text" id="sexo" value="<?php echo $row_rs_AlterarProfessor['sexo']; ?>" size="20" />                <label for="sexo"></label></td>
            </tr>
            <tr>
              <td height="27" style="text-align: right">Estado Civil:</td>
              <td colspan="4"><span id="sprytextfield4">
                <label for="estado_civil"></label>
                <input name="estado_civil" type="text" id="estado_civil" value="<?php echo $row_rs_AlterarProfessor['estado_civil']; ?>" />
              </span>Naturalidade: 
              <label for="naturalidade"></label>
              <input name="naturalidade" type="text" id="naturalidade" value="<?php echo $row_rs_AlterarProfessor['naturalidade']; ?>" /></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Endereço:</td>
              <td colspan="4"><span id="sprytextfield5">
                <label for="endereco"></label>
                <input name="endereco" type="text" id="endereco" value="<?php echo $row_rs_AlterarProfessor['endereco']; ?>" size="60" style="text-transform:uppercase;" />
                </span>Nº <span id="sprytextfield13">
                  <label for="numero_end"></label>
                  <input name="numero_end" type="text" id="numero_end" value="<?php echo $row_rs_AlterarProfessor['numero_end']; ?>" size="10" />
                </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Complemento:</td>
              <td colspan="4"><span id="sprytextfield6">
                <label for="complemento_end"></label>
                <input name="complemento_end" type="text" id="complemento_end" value="<?php echo $row_rs_AlterarProfessor['complemento_end']; ?>" size="40" style="text-transform:uppercase;" />
              </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Bairro:</td>
              <td colspan="4"><span id="sprytextfield7">
                <label for="bairro"></label>
                <input name="bairro" type="text" id="bairro" value="<?php echo $row_rs_AlterarProfessor['bairro']; ?>" size="40" style="text-transform:uppercase;" />
                </span> <span style="text-align: right">CEP:</span> <span id="sprytextfield14">
                  <label for="cep"></label>
                  <input name="cep" type="text" id="cep" value="<?php echo $row_rs_AlterarProfessor['cep']; ?>" />
                </span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Cidade:</td>
              <td colspan="4"><span id="sprytextfield8">
                <label for="cidade"></label>
                <input name="cidade" type="text" id="cidade" value="<?php echo $row_rs_AlterarProfessor['cidade']; ?>" style="text-transform:uppercase;" />
                </span> <span style="text-align: right">Estado: <span id="sprytextfield15">
                  <label for="estado"></label>
                  <input name="estado" type="text" id="estado" value="<?php echo $row_rs_AlterarProfessor['estado']; ?>" />
                </span></span></td>
</tr>
            <tr>
              <td height="28" style="text-align: right">Telefone Fixo:</td>
              <td colspan="4"><span id="sprytextfield9">
                <label for="tel_residencial"></label>
                <input name="tel_residencial" type="text" id="tel_residencial" value="<?php echo $row_rs_AlterarProfessor['tel_residencial']; ?>" />
                </span> Celular: <span id="sprytextfield16">
                  <label for="celular"></label>
                  <input name="celular" type="text" id="celular" value="<?php echo $row_rs_AlterarProfessor['celular']; ?>" />
                </span>Comercial: 
                <label for="tel_comercial"></label>
                <input name="tel_comercial" type="text" id="tel_comercial" value="<?php echo $row_rs_AlterarProfessor['tel_comercial']; ?>" /></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">E-mail:</td>
              <td colspan="4"><span id="sprytextfield10">
                <label for="email"></label>
                <input name="email" type="text" id="email" value="<?php echo $row_rs_AlterarProfessor['email']; ?>" size="60" />
                <span class="textfieldRequiredMsg">Formato envalido.</span><span class="textfieldInvalidFormatMsg">e-mail envalido.</span></span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Local de Trabalho:</td>
              <td colspan="4"><span id="sprytextfield11">
                <label for="localTrabalho"></label>
                <input name="localTrabalho" type="text" id="localTrabalho" value="<?php echo $row_rs_AlterarProfessor['localTrabalho']; ?>" size="75" />
              </span></td>
</tr>
            <tr>
              <td height="27" style="text-align: right">Formação Escolar:</td>
              <td colspan="4"><span id="sprytextfield12">
                <label for="formacaoEscolar"></label>
                <input name="formacaoEscolar" type="text" id="formacaoEscolar" value="<?php echo $row_rs_AlterarProfessor['formacaoEscolar']; ?>" size="75" />
              </span></td>
</tr>
            <tr>
              <td height="55" colspan="5" valign="bottom"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DADOS BANCÁRIOS</span></td>
            </tr>
            <tr>
              <td height="45" colspan="5" valign="top"><table width="905" border="0">
                <tr>
                  <td width="56"style="text-align: right">BANCO:</td>
                  <td width="168"><input name="banco" type="text" id="banco" value="<?php echo $row_rs_AlterarProfessor['banco']; ?>" /></td>
                  <td width="34"style="text-align: right">AG:</td>
                  <td width="168"><input name="ag" type="text" id="ag" value="<?php echo $row_rs_AlterarProfessor['ag']; ?>" /></td>
                  <td width="75"style="text-align: right">CONTA:</td>
                  <td width="115" colspan="2"><input name="conta" type="text" id="conta" value="<?php echo $row_rs_AlterarProfessor['conta']; ?>" /></td>
                  <td width="109"style="text-align: right">TIPO:</td>
                  <td width="146"><label for="tipo_conta"></label>
                    <input name="tipo_conta" type="text" id="tipo_conta" value="<?php echo $row_rs_AlterarProfessor['tipo_conta']; ?>" size="20" /></td>
                </tr>
                <tr>
                  <td colspan="4">FAVORECIDO: 
                    <input name="favorecido" type="text" id="favorecido" value="<?php echo $row_rs_AlterarProfessor['favorecido']; ?>" size="45" /></td>
                  <td colspan="2" style="text-align: right">CONJUNTA:</td>
                  <td><label for="conjunta"></label>
                    <input name="conjunta" type="text" id="conjunta" value="<?php echo $row_rs_AlterarProfessor['conjunta']; ?>" size="10" /></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="184" colspan="5" align="center" valign="top"><div id="Accordion1" class="Accordion" tabindex="0">
                <div class="AccordionPanel">
                  <div class="AccordionPanelTab"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">GRADUAÇÃO:</span></div>
                  <div class="AccordionPanelContent">
                    <table width="95" border="0">
                      <tr>
                        <td width="25">1&ordf; </td>
                        <td width="183" style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
                        <td colspan="3"><input name="nome_graduacao1" type="text" id="nome_graduacao1" value="<?php echo $row_rs_AlterarProfessor['nome_graduacao1']; ?>" size="98" /></td>
                      </tr>
                      <tr>
                        <td height="27" colspan="2" style="text-align: right">Curso:</td>
                        <td width="337"><input name="curso_graduacao1" type="text" id="curso_graduacao1" value="<?php echo $row_rs_AlterarProfessor['curso_graduacao1']; ?>" size="45" /></td>
                        <td width="164"style="text-align: right">Ano de Conclus&atilde;o:</td>
                        <td width="177"><input name="ano_graduacao1" type="text" id="ano_graduacao1" value="<?php echo $row_rs_AlterarProfessor['ano_graduacao1']; ?>" size="13" /></td>
                      </tr>
                      <tr>
                        <td height="4" colspan="5"><img src="../img/linha.png" alt="" width="900" height="2" /></td>
                      </tr>
                      <tr>
                        <td>2&ordf; </td>
                        <td style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
                        <td colspan="3"><input name="nome_graduacao2" type="text" id="nome_graduacao" value="<?php echo $row_rs_AlterarProfessor['nome_graduacao2']; ?>" size="98" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" style="text-align: right">Curso:</td>
                        <td><input name="curso_graduacao2" type="text" id="nome_graduacao" value="<?php echo $row_rs_AlterarProfessor['curso_graduacao2']; ?>" size="45" /></td>
                        <td style="text-align: right">Ano de Conclus&atilde;o:</td>
                        <td><input name="ano_graduacao2" type="text" id="nome_graduacao" value="<?php echo $row_rs_AlterarProfessor['ano_graduacao2']; ?>" size="13" /></td>
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
                        <td colspan="3"><input name="nome_posgraduacao1" type="text" id="nome_graduacao2" value="<?php echo $row_rs_AlterarProfessor['nome_posgraduacao1']; ?>" size="98" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" style="text-align: right">Curso:</td>
                        <td width="318"><input name="curso_posgraduacao1" type="text" id="nome_graduacao2" value="<?php echo $row_rs_AlterarProfessor['curso_posgraduacao1']; ?>" size="45" /></td>
                        <td width="186" style="text-align: right">Ano de Conclus&atilde;o:</td>
                        <td width="174"><input name="ano_posgraduacao1" type="text" id="nome_graduacao2" value="<?php echo $row_rs_AlterarProfessor['ano_posgraduacao1']; ?>" size="13" /></td>
                      </tr>
                      <tr>
                        <td colspan="5"><img src="../img/linha.png" alt="" width="900" height="2" /></td>
                      </tr>
                      <tr>
                        <td>2&ordf; </td>
                        <td style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
                        <td colspan="3"><input name="nome_posgraduacao2" type="text" id="nome_graduacao2" value="<?php echo $row_rs_AlterarProfessor['nome_posgraduacao2']; ?>" size="98" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" style="text-align: right">Curso:</td>
                        <td><input name="curso_posgraduacao2" type="text" id="nome_graduacao2" value="<?php echo $row_rs_AlterarProfessor['curso_posgraduacao2']; ?>" size="45" /></td>
                        <td style="text-align: right">Ano de Conclus&atilde;o:</td>
                        <td><input name="ano_posgraduacao2" type="text" id="nome_graduacao2" value="<?php echo $row_rs_AlterarProfessor['ano_posgraduacao2']; ?>" size="13" /></td>
                      </tr>
                      <tr>
                        <td colspan="5"><img src="../img/linha.png" alt="" width="900" height="2" /></td>
                      </tr>
                      <tr>
                        <td>3&ordf; </td>
                        <td style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
                        <td colspan="3"><input name="nome_posgraduacao3" type="text" id="nome_graduacao2" value="<?php echo $row_rs_AlterarProfessor['nome_posgraduacao3']; ?>" size="98" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" style="text-align: right">Curso:</td>
                        <td><input name="curso_posgraduacao3" type="text" id="nome_graduacao2" value="<?php echo $row_rs_AlterarProfessor['curso_posgraduacao3']; ?>" size="45" /></td>
                        <td style="text-align: right">Ano de Conclus&atilde;o:</td>
                        <td><input name="ano_posgraduacao3" type="text" id="nome_graduacao2" value="<?php echo $row_rs_AlterarProfessor['ano_posgraduacao3']; ?>" size="13" /></td>
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
                        <td colspan="3"><input name="nome_mestrado1" type="text" id="nome_graduacao3" value="<?php echo $row_rs_AlterarProfessor['nome_mestrado1']; ?>" size="98" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" style="text-align: right">Curso:</td>
                        <td width="322"><input name="curso_mestrado1" type="text" id="nome_graduacao3" value="<?php echo $row_rs_AlterarProfessor['curso_mestrado1']; ?>" size="45" /></td>
                        <td width="181" style="text-align: right">Ano de Conclus&atilde;o:</td>
                        <td width="175"><input name="ano_mestrado1" type="text" id="nome_graduacao3" value="<?php echo $row_rs_AlterarProfessor['ano_mestrado1']; ?>" size="13" /></td>
                      </tr>
                      <tr>
                        <td colspan="5"><img src="../img/linha.png" alt="" width="900" height="2" /></td>
                      </tr>
                      <tr>
                        <td>2&ordf; </td>
                        <td style="text-align: right">Nome da Institui&ccedil;&atilde;o:</td>
                        <td colspan="3"><input name="nome_mestrado2" type="text" id="nome_graduacao3" value="<?php echo $row_rs_AlterarProfessor['nome_mestrado2']; ?>" size="98" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" style="text-align: right">Curso:</td>
                        <td><input name="curso_mestrado2" type="text" id="nome_graduacao3" value="<?php echo $row_rs_AlterarProfessor['curso_mestrado2']; ?>" size="45" /></td>
                        <td style="text-align: right">Ano de Conclus&atilde;o:</td>
                        <td><input name="ano_mestrado2" type="text" id="nome_graduacao3" value="<?php echo $row_rs_AlterarProfessor['ano_mestrado2']; ?>" size="13" /></td>
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
                        <td colspan="3"><input name="nome_doutorado1" type="text" id="nome_graduacao4" value="<?php echo $row_rs_AlterarProfessor['nome_doutorado1']; ?>" size="98" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" style="text-align: right">Curso:</td>
                        <td width="321"><input name="curso_doutorado1" type="text" id="nome_graduacao4" value="<?php echo $row_rs_AlterarProfessor['curso_doutorado1']; ?>" size="45" /></td>
                        <td width="183" style="text-align: right">Ano de Conclus&atilde;o:</td>
                        <td width="177"><input name="ano_doutorado1" type="text" id="nome_graduacao4" value="<?php echo $row_rs_AlterarProfessor['ano_doutorado1']; ?>" size="13" /></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div></td>
            </tr>
            <tr>
              <td height="26" colspan="5" valign="top"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;"><span class="CENTER">DISPONIBILIDADE PARA MINISTRAR AULA</span>S</span></td>
            </tr>
            <tr>
              <td height="46" colspan="5" valign="top"><table width="905" border="0">
                <tr>
                  <td colspan="2"style="text-align: right" >De Segunda &agrave; Sexta:</td>
                  <td width="163"><input name="disponibilidade_1" type="text" id="disponibilidade_1" value="<?php echo $row_rs_AlterarProfessor['disponibilidade_1']; ?>" size="13" /></td>
                  <td width="142" style="text-align: right">Apartir das:</td>
                  <td width="229"><input name="disponibilidade_Apartir1" type="text" id="disponibilidade_Apartir1" value="<?php echo $row_rs_AlterarProfessor['disponibilidade_Apartir1']; ?>" size="13" /></td>
                  <td width="151">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align: right">Aos Sabados:</td>
                  <td><input name="disponibilidade_2" type="text" id="disponibilidade_2" value="<?php echo $row_rs_AlterarProfessor['disponibilidade_2']; ?>" size="13" /></td>
                  <td style="text-align: right">Apartir das:</td>
                  <td><input name="disponibilidade_Apartir2" type="text" id="disponibilidade_Apartir2" value="<?php echo $row_rs_AlterarProfessor['disponibilidade_Apartir2']; ?>" size="13" /></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align: right">Aos Domingos:</td>
                  <td><input name="disponibilidade_3" type="text" id="disponibilidade_3" value="<?php echo $row_rs_AlterarProfessor['disponibilidade_3']; ?>" size="13" /></td>
                  <td style="text-align: right">Apartir das:</td>
                  <td><input name="disponibilidade_Apartir3" type="text" id="disponibilidade_Apartir3" value="<?php echo $row_rs_AlterarProfessor['disponibilidade_Apartir3']; ?>" size="13" /></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="6">OBS: Hor&aacute;rio integral Avisar com antecedencia, Prestador de servi&ccedil;o da FAB</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="26" colspan="5"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DISCIPLINAS QUE ESTA APTO A MINISTRAR:</span></td>
            </tr>
            <tr>
              <td height="36" colspan="5"><span id="sprytextfield34">
                <label for="obs2"></label>
                <textarea name="RelacaoDisciplinas" cols="115" rows="6" id="obs2"><?php echo $row_rs_AlterarProfessor['RelacaoDisciplinas']; ?></textarea>
              </span></td>
</tr>
            <tr>
              <td height="60" colspan="5" valign="top"><input type="image" src="../img/BTCadastrarEstudante.png" name="button" id="button" value="CADASTRAR" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form" />
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
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
</body>
</html>
<?php
mysql_free_result($rs_AlterarProfessor);
?>
