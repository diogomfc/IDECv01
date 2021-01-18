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

$colname_RS_relatorioEstudante = "-1";
if (isset($_GET['id'])) {
  $colname_RS_relatorioEstudante = $_GET['id'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_RS_relatorioEstudante = sprintf("SELECT * FROM idec_estudantes WHERE id = %s", GetSQLValueString($colname_RS_relatorioEstudante, "int"));
$RS_relatorioEstudante = mysql_query($query_RS_relatorioEstudante, $ConexaoIdec) or die(mysql_error());
$row_RS_relatorioEstudante = mysql_fetch_assoc($RS_relatorioEstudante);
$totalRows_RS_relatorioEstudante = mysql_num_rows($RS_relatorioEstudante);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.hht {	font-size: 18px;
}
.txt {
	font-family: Calibri;
}
</style>
</head>
<?php 
$data_inicial = date("Y-m-d");
?>
<body>
<table width="1344" align="center">
  <tr>
    <td width="1179" height="288" valign="top"><table width="1035" height="392">
      <tr>
        <td width="1" height="79">&nbsp;</td>
        <td width="971" valign="top"><table width="965">
          <tr>
            <td width="159" height="63"><img src="../img/IMGIDEC.png" width="118" height="80" /></td>
            <td width="440" valign="top"><img src="../img/IMGTEXTO.png" width="370" height="109" /></td>
            <td width="326" align="right" valign="top">Emissão: <?php echo $data_inicial ?></td>
          </tr>
        </table></td>
        <td width="143">&nbsp;</td>
      </tr>
      <tr>
        <td height="40">&nbsp;</td>
        <td><img src="../img/IMGRelatorioBarraFichaEstudante.png" width="971" height="38" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="top"><table width="961" height="868">
          <tr>
            <td height="26" colspan="5" bgcolor="#C2E1F5"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">USUÁRIOS</span></td>
            </tr>
          <tr style="text-align: left">
            <td width="203" height="28" class="txt" style="text-align:right">RM:</td>
            <td width="263"><input name="code" type="text" id="code" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['code']; ?>" size="10" readonly="readonly" /></td>
            <td width="93">&nbsp;</td>
            <td width="127" rowspan="4" valign="top"><img src="<?php echo $row_RS_relatorioEstudante['arquivo']; ?>" alt="" width="125" height="119" /></td>
            <td width="251">&nbsp;</td>
            </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right">CPF:</td>
            <td><label for="cpf"></label>
              <input type="text" name="cpf" id="cpf"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['cpf']; ?>" size="20" readonly="readonly" />              <input name="id" type="hidden" id="id" value="<?php echo $row_RS_relatorioEstudante['id']; ?>" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right">RG:</td>
            <td><input type="text" name="rg" id="rg"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['rg']; ?>" size="20" readonly="readonly" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td height="24" style="text-align: right">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td height="26" colspan="5" bgcolor="#C2E1F5"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DADOS PESSOAIS</span></td>
            </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right">Nome:</td>
            <td colspan="4"><input type="text" name="nome" id="nome"  style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['nome']; ?>" size="60" readonly="readonly" /></td>
  </tr>
          <tr>
            <td height="28" class="txt" style="text-align: right">Data de Nascimento:</td>
            <td colspan="4"><input type="text" name="nascimento" id="nascimento"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['nascimento']; ?>" size="20" readonly="readonly" /></td>
  </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right">Sexo:</td>
            <td colspan="4"><label for="sexo"></label>
              <label for="sexo">
                <input type="text" name="sexo" id="sexo"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['sexo']; ?>" size="20" readonly="readonly" />
              </label></td>
            </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right">Estado Civil:</td>
            <td colspan="4"><input type="text" name="estado_civil" id="estado_civil"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['estado_civil']; ?>" size="20" readonly="readonly" /></td>
  </tr>
          <tr>
            <td height="28" class="txt" style="text-align: right">Endereço:</td>
            <td colspan="4" class="txt"><input type="text" name="endereco" id="endereco"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['endereco']; ?>" size="50" readonly="readonly" />
              Nº 
                <input type="text" name="numero_end" id="numero_end"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['numero_end']; ?>" size="10" readonly="readonly" /></td>
  </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right">Complemento:</td>
            <td colspan="4"><input type="text" name="complemento_end" id="complemento_end"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['complemento_end']; ?>" size="60" readonly="readonly" /></td>
  </tr>
          <tr>
            <td height="28" class="txt" style="text-align: right">Bairro:</td>
            <td colspan="4" align="left" class="txt"><span style="text-align: left">
              <input type="text" name="bairro" id="bairro"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['bairro']; ?>" size="40" readonly="readonly" />
              CEP:
              <input type="text" name="cep" id="cep"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['cep']; ?>" size="20" readonly="readonly" />
            </span></td>
  </tr>
          <tr>
            <td height="28" class="txt" style="text-align: right">Cidade:</td>
            <td colspan="4" class="txt"><span style="text-align: right"><span style="text-align: left">
              <input type="text" name="cidade" id="cidade"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['cidade']; ?>" size="20" readonly="readonly" />
            </span>Estado: <span style="text-align: left">
            <input type="text" name="estado" id="estado"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['estado']; ?>" size="20" readonly="readonly" />
            </span></span></td>
  </tr>
          <tr>
            <td height="28" class="txt" style="text-align: right">Telefone Fixo:</td>
            <td colspan="4" class="txt"> <span style="text-align: left">
              <input type="text" name="tel_residencial" id="tel_residencial"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['tel_residencial']; ?>" size="20" readonly="readonly" />
            </span>Celular: <span style="text-align: left">
            <input type="text" name="celular" id="celular"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['celular']; ?>" size="20" readonly="readonly" />
            </span></td>
  </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right">E-mail:</td>
            <td colspan="4"><span style="text-align: left">
              <input type="text" name="email" id="email"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['email']; ?>" size="60" readonly="readonly" />
            </span></td>
  </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right">Local de Trabalho:</td>
            <td colspan="4"><span style="text-align: left">
              <input type="text" name="localTrabalho" id="localTrabalho"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['localTrabalho']; ?>" size="60" readonly="readonly" />
            </span></td>
  </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right">Formação Escolar:</td>
            <td colspan="4"><span style="text-align: left">
              <input type="text" name="formacaoEscolar" id="formacaoEscolar"  style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['formacaoEscolar']; ?>" size="60" readonly="readonly" />
            </span></td>
  </tr>
          <tr>
            <td height="26" colspan="5" valign="bottom"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DOCUMENTOS ENTREGUE</span></td>
            </tr>
          <tr>
            <td height="93" colspan="5" valign="top">&nbsp;</td>
            </tr>
          <tr>
            <td height="26" colspan="5"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">OBSERVAÇÕES</span></td>
            </tr>
          <tr>
            <td height="36" colspan="5">&nbsp;</td>
  </tr>
          <tr>
            <td height="60"><input type="image" src="../img/BTAtualizarEstudante.png" name="button" id="button" value="CADASTRAR" /></td>
            <td height="60"><a title='Imprimir conteúdo' href='javascript:window.print()'><img src="../img/BTImprimir.png" alt="" border="0" /></a></td>
            <td height="60">&nbsp;</td>
            <td height="60">&nbsp;</td>
            <td height="60">&nbsp;</td>
            </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          <tr> </tr>
          </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RS_relatorioEstudante);
?>
