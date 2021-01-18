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
if (isset($_GET['code'])) {
  $colname_RS_relatorioEstudante = $_GET['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_RS_relatorioEstudante = sprintf("SELECT * FROM idec_estudantes WHERE code = %s", GetSQLValueString($colname_RS_relatorioEstudante, "text"));
$RS_relatorioEstudante = mysql_query($query_RS_relatorioEstudante, $ConexaoIdec) or die(mysql_error());
$row_RS_relatorioEstudante = mysql_fetch_assoc($RS_relatorioEstudante);
$totalRows_RS_relatorioEstudante = mysql_num_rows($RS_relatorioEstudante);

$maxRows_RSMAT = 10;
$pageNum_RSMAT = 0;
if (isset($_GET['pageNum_RSMAT'])) {
  $pageNum_RSMAT = $_GET['pageNum_RSMAT'];
}
$startRow_RSMAT = $pageNum_RSMAT * $maxRows_RSMAT;

$colname_RSMAT = "-1";
if (isset($_GET['code'])) {
  $colname_RSMAT = $_GET['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_RSMAT = sprintf("SELECT * FROM idec_matriculas WHERE estudante_id = %s  ORDER BY idec_matriculas.id DESC", GetSQLValueString($colname_RSMAT, "text"));
$query_limit_RSMAT = sprintf("%s LIMIT %d, %d", $query_RSMAT, $startRow_RSMAT, $maxRows_RSMAT);
$RSMAT = mysql_query($query_limit_RSMAT, $ConexaoIdec) or die(mysql_error());
$row_RSMAT = mysql_fetch_assoc($RSMAT);

if (isset($_GET['totalRows_RSMAT'])) {
  $totalRows_RSMAT = $_GET['totalRows_RSMAT'];
} else {
  $all_RSMAT = mysql_query($query_RSMAT);
  $totalRows_RSMAT = mysql_num_rows($all_RSMAT);
}
$totalPages_RSMAT = ceil($totalRows_RSMAT/$maxRows_RSMAT)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/iconIdec.png" />
<title>Relatório Estudantes</title>
<style type="text/css">
.hht {	font-size: 18px;
}
.txt {
	font-family: Calibri;
	font-weight: bold;
	font-size: 20px;
}
.fonte {
	font-size: 22px;
}
.fonteA {
	font-weight: bold;
}
.txtA {
	font-weight: bold;
}
.ASS {
	font-family: Calibri;
}
.aass {
	font-family: "Calibri Light";
}
.FOnte {
	font-size: 22px;
}
.AA {
	font-family: Calibri;
}
</style>
</head>
<?php 
$data_inicial = date("Y-m-d");
?>
<body>
<table width="994" align="center">
  <tr>
    <td width="1179" height="288" valign="top"><table width="988" height="392">
      <tr>
        <td width="1" height="79">&nbsp;</td>
        <td width="971" valign="top"><table width="965">
          <tr>
            <td width="159" height="63"><img src="../img/logoidec.png" width="157" height="107" /></td>
            <td width="440" valign="top"><img src="../img/IMGTEXTO.png" width="370" height="109" /></td>
            <td width="326" align="right" valign="top" class="txt">Emissão: <?php echo date('d/m/Y', strtotime($data_inicial));?></td>
            </tr>
        </table></td>
        </tr>
      <tr>
        <td height="40">&nbsp;</td>
        <td><img src="../img/IMGRelatorioBarraFichaEstudante.png" width="980" height="38" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="top"><table width="961" height="835">
          <tr>
            <td height="26" colspan="5" bgcolor="#C2E1F5"><img src="../img/IMG RELATORIOS/IMGBarraDadosPessoaisEstudante.png" width="963" height="24" /></td>
          </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right; font-size: 20px; font-weight: bold;">Nome:</td>
            <td colspan="4"><input type="text" name="nome" id="nome"  style="font-family:Calibri; font-size:20px; color:#0000CC; font-weight:bold; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['nome']; ?>" size="60" readonly="readonly" /></td>
            </tr>
          <tr style="text-align: left">
            <td width="203" height="28" class="txt" style="text-align: right; font-size: 20px; font-weight: bold;">RM:</td>
            <td width="263"><input name="code" type="text" id="code" style="font-family:Calibri; font-size:20px; color:#0000CC; font-weight:bold; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['code']; ?>" size="10" readonly="readonly" />
              <input name="code" type="hidden" id="code" value="<?php echo $row_RS_relatorioEstudante['code']; ?>" /></td>
            <td width="93">&nbsp;</td>
            <td width="127" rowspan="4" valign="top"><img src="<?php echo $row_RS_relatorioEstudante['arquivo']; ?>" alt="" width="125" height="120" /></td>
            <td width="251">&nbsp;</td>
            </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right; font-size: 20px; font-weight: bold;">CPF:</td>
            <td><label for="cpf"></label>
              <input type="text" name="cpf" id="cpf"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['cpf']; ?>" size="20" readonly="readonly" />              <input name="code" type="hidden" id="code" value="<?php echo $row_RS_relatorioEstudante['code']; ?>" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td height="27" class="txt" style="text-align: right; font-size: 20px; font-weight: bold;">RG:</td>
            <td><input type="text" name="rg" id="rg"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['rg']; ?>" size="20" readonly="readonly" /></td>
          <tr>
            <td height="28" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Data de Nascimento:</td>
            <td colspan="4"><input type="text" name="nascimento" id="nascimento"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['nascimento']; ?>" size="20" readonly="readonly" /></td>
            </tr>
          <tr>
            <td height="27" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Sexo:</td>
            <td colspan="4"><label for="sexo"></label>
              <label for="sexo">
                <input type="text" name="sexo" id="sexo"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['sexo']; ?>" size="20" readonly="readonly" />
                </label></td>
            </tr>
          <tr>
            <td height="27" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Estado Civil:</td>
            <td colspan="4"><input type="text" name="estado_civil" id="estado_civil"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['estado_civil']; ?>" size="20" readonly="readonly" /><span style="text-align: left; font-family: Calibri; font-weight: bold; font-size: 20px;">Naturalidade: </span>
                <input type="text" name="naturalidade" id="naturalidade"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['naturalidade']; ?>" size="10" readonly="readonly" /></td>
            </tr>
          <tr>
            <td height="28" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Endereço:</td>
            <td colspan="4" class="txt"><input type="text" name="endereco" id="endereco"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; text-transform:uppercase; " value="<?php echo $row_RS_relatorioEstudante['endereco']; ?>" size="50" readonly="readonly" />
              Nº 
              <input type="text" name="numero_end" id="numero_end"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['numero_end']; ?>" size="10" readonly="readonly" /></td>
            </tr>
          <tr>
            <td height="27" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Complemento:</td>
            <td colspan="4"><input type="text" name="complemento_end" id="complemento_end"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['complemento_end']; ?>" size="60" readonly="readonly" /></td>
            </tr>
          <tr>
            <td height="28" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Bairro:</td>
            <td colspan="4" align="left" class="txt"><span style="text-align: left">
              <input type="text" name="bairro" id="bairro"  style="text-transform:uppercase; font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['bairro']; ?>" size="40" readonly="readonly" />
              CEP:
              <input type="text" name="cep" id="cep"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['cep']; ?>" size="20" readonly="readonly" />
              </span></td>
            </tr>
          <tr>
            <td height="28" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Cidade:</td>
            <td colspan="4" class="txt"><span style="text-align: right"><span style="text-align: left">
              <input type="text" name="cidade" id="cidade"  style="text-transform:uppercase; font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['cidade']; ?>" size="20" readonly="readonly" />
              </span>Estado: <span style="text-align: left">
                <input type="text" name="estado" id="estado"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['estado']; ?>" size="20" readonly="readonly" />
                </span></span></td>
            </tr>
          <tr>
            <td height="28" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Telefone Fixo:</td>
            <td colspan="4" class="txt"><span style="text-align: left">
              <input type="text" name="tel_residencial" id="tel_residencial"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['tel_residencial']; ?>" size="13" readonly="readonly" />
              </span>Celular: <span style="text-align: left">
                <input type="text" name="celular" id="celular"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['celular']; ?>" size="13" readonly="readonly" />
                </span>Comercial: <span style="text-align: left">
                <input type="text" name="tel_comercial" id="tel_comercial"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['tel_comercial']; ?>" size="13" readonly="readonly" />
                </span></td>
            </tr>
          <tr>
            <td height="27" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">E-mail:</td>
            <td colspan="4"><span style="text-align: left">
              <input type="text" name="email" id="email"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['email']; ?>" size="60" readonly="readonly" />
              </span></td>
            </tr>
          <tr>
            <td height="27" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Local de Trabalho:</td>
            <td colspan="4"><span style="text-align: left">
              <input type="text" name="localTrabalho" id="localTrabalho"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['localTrabalho']; ?>" size="60" readonly="readonly" />
              </span></td>
            </tr>
          <tr>
            <td height="27" class="AA" style="text-align: right; font-family: Calibri; font-weight: bold; font-size: 20px;">Formação Escolar:</td>
            <td colspan="4"><span style="text-align: left">
              <input type="text" name="formacaoEscolar" id="formacaoEscolar"  style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; " value="<?php echo $row_RS_relatorioEstudante['formacaoEscolar']; ?>" size="60" readonly="readonly" />
              </span></td>
            </tr>
            <tr> </tr>
            <tr> </tr>
            <tr> </tr>
          <tr>
            <td height="26" colspan="5" valign="bottom" bgcolor="#C2E1F5"><img src="../img/IMG RELATORIOS/IMGBarraMatriculasEstudante.png" width="963" height="24" /></td>
            </tr>
           
          <tr>
           
            <td height="93" colspan="5" valign="top"><table border="0">
                <?php do { ?>
                
                <?php 
		
		$data_inicial = date("Y-m-d");  
        $data_final = $row_RSMAT['terminoCurso'];

        $d1 = strtotime("$data_inicial");
        $d2 = strtotime("$data_final");

        $data =($d2 - $d1)/86400;
		
		       ?>
                
                <tr>
                <input name="input" type="hidden" value="<?php echo $curso = $row_RSMAT['id_curso']; ?>" />
              <input name="input" type="hidden" value="<?php echo $polo = $row_RSMAT['polo']; ?>" />
               <input name="input" type="hidden" value="<?php echo $certificados = $row_RSMAT['certificadosSim']; ?>" />
                  <td class="AA" width="172" span style="text-align: right; font-size: 20px; font-weight: bold;">Matrícula:</td>
                  <td width="793" style="font-family:Calibri; font-weight:bold; font-size:18px; color:#0000CC; border:none; background-color: transparent; "><?php echo $row_RSMAT['cod']; ?></td>
                  </tr>
                <tr>
                <?php $sql_2 = mysql_query("SELECT * FROM idec_cursos WHERE id_curso = '$curso'"); ?>
              <?php while($res_2 = mysql_fetch_array($sql_2)){ ?>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;"">Curso:</td>
                  <td style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; "><?php echo $res_2['cursos']; ?></td>
                  <?php } ?>
                  </tr>
                <tr>
                  <?php $sql_3 = mysql_query("SELECT * FROM idec_abrirturmas WHERE id = '$polo'"); ?>
              <?php while($res_3 = mysql_fetch_array($sql_3)){ ?>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;">Polo:</td>
                  <td style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; "><?php echo $res_3['polos']; ?></td>
                  <?php } ?>
                  </tr>
                <tr>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;">Carga Horária:</td>
                  <td style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; "><?php echo $row_RSMAT['cargaHoraria']; ?></td>
                  </tr>
                <tr>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;">Início:</td>
                  <td style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; "><?php echo date('d/m/Y', strtotime($row_RSMAT['inicioCurso']));?></td>
                  </tr>
                <tr>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;">Término:</td>
                  <td style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; "><?php echo date('d/m/Y', strtotime($row_RSMAT['terminoCurso']));?></td>
                  </tr>
                    <tr>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;">Valor Matrícula:</td>
                  <td style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; "><?php echo $row_RSMAT['valores_matriculas']; ?></td>
                  </tr>
                  <tr>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;">Status:</td>
                  <td><?php  if ($data < 0) { echo "<b><font size='4'><font color='#FF0000'>Encerrado</font></b>"; }else{ echo "<b><font size='4'><font color='#009900'>Em Andamento</font></b>";}?></td>
                </tr>
                <tr>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;">Valor:</td>
                  <td style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; "><?php echo $row_RSMAT['valor']; ?></td>
                  </tr>
                <tr>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;">Diploma:</td>
                  <td><?php  if ($certificados != 'SIM') { echo "<b><font size='4'><font color='#FF0000'>Pendente</font></b>"; }else{ echo "<b><font size='4'><font color='#009900'>Entregue</font></b>";}?> <span style="font-family:Calibri; font-size:15px;"><?php echo $row_RSMAT['dataEntrega']; ?> - <?php echo $row_RSMAT['representante']; ?></span></td>
                  </tr>
                <tr>
                  <td class="AA" span style="text-align: right; font-size: 20px; font-weight: bold;">Representante:</td>
                  <td style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent; "><?php echo $row_RSMAT['representante']; ?></td>
                  </tr>
                <tr>
                  <td colspan="2"><img src="../img/linha.png" width="969" height="2" /></td>
                  </tr>
                
                  <?php } while ($row_RSMAT = mysql_fetch_assoc($RSMAT)); ?>
                  <MM_REPEATEDREGION SOURCE="@@rs@@"><MM:DECORATION OUTLINE="Repeat" OUTLINEID=1></tr></MM:DECORATION></MM_REPEATEDREGION>
              </table></td>
            </tr>
          <tr>
            <td height="26" colspan="5" bgcolor="#C2E1F5"><img src="../img/IMG RELATORIOS/IMGBarraObsEstudante.png" width="963" height="24" /></td>
            </tr>
          <tr>
            <td height="36" colspan="5"><label for="obs"></label>
<textarea name="obs" cols="100" rows="6" readonly="readonly" id="obs" style="font-family:Calibri; font-size:18px; color:#0000CC; border:none; background-color: transparent;"><?php echo $row_RS_relatorioEstudante['obs']; ?></textarea>
                </td>
            </tr>
              <tr>
            <td height="26" colspan="5"><img src="../img/linha.png" width="969" height="2" /></td>
            </tr>
          <tr> 
          <td height="27"><a title='Imprimir conteúdo' href='javascript:window.print()'><img src="../img/BTImprimir.png" alt="" border="0" /></a></td>
            <td width="27"><a href="../admin/index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
            <td width="27"><a href="../admin/estudante1.php"><img src="../img/BTPesquisarEstudante1.png" width="197" height="33" /></a></td>
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
        </table></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
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

mysql_free_result($RSMAT);
?>
