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

$colname_rs_estudantes = "-1";
if (isset($_GET['code'])) {
  $colname_rs_estudantes = $_GET['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_estudantes = sprintf("SELECT * FROM idec_estudantes WHERE code = %s", GetSQLValueString($colname_rs_estudantes, "text"));
$rs_estudantes = mysql_query($query_rs_estudantes, $ConexaoIdec) or die(mysql_error());
$row_rs_estudantes = mysql_fetch_assoc($rs_estudantes);
$totalRows_rs_estudantes = mysql_num_rows($rs_estudantes);

$maxRows_rs_matriculas = 10;
$pageNum_rs_matriculas = 0;
if (isset($_GET['pageNum_rs_matriculas'])) {
  $pageNum_rs_matriculas = $_GET['pageNum_rs_matriculas'];
}
$startRow_rs_matriculas = $pageNum_rs_matriculas * $maxRows_rs_matriculas;

$colname_rs_matriculas = "-1";
if (isset($_GET['code'])) {
  $colname_rs_matriculas = $_GET['code'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_matriculas = sprintf("SELECT * FROM idec_matriculas WHERE estudante_id = %s", GetSQLValueString($colname_rs_matriculas, "text"));
$query_limit_rs_matriculas = sprintf("%s LIMIT %d, %d", $query_rs_matriculas, $startRow_rs_matriculas, $maxRows_rs_matriculas);
$rs_matriculas = mysql_query($query_limit_rs_matriculas, $ConexaoIdec) or die(mysql_error());
$row_rs_matriculas = mysql_fetch_assoc($rs_matriculas);

if (isset($_GET['totalRows_rs_matriculas'])) {
  $totalRows_rs_matriculas = $_GET['totalRows_rs_matriculas'];
} else {
  $all_rs_matriculas = mysql_query($query_rs_matriculas);
  $totalRows_rs_matriculas = mysql_num_rows($all_rs_matriculas);
}
$totalPages_rs_matriculas = ceil($totalRows_rs_matriculas/$maxRows_rs_matriculas)-1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="file:///D|/xampp/htdocs/css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../img/iconIdec.png" />
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
.AA {
	color: #1A476F;
	font-weight: bold;
	text-align: center;
}
.CC {
	text-align: center;
}
</style>
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
<table width="1526" height="1012" border="0" align="center" style="background: url(../img/#) no-repeat; text-align: left; font-family: Calibri; font-size: 20px;">
  <tr>
    <td width="1520" height="956"><table width="1520" height="992" align="center">
      <tr>
        <td width="1512" height="986"><form action="../upload.php" method="post" enctype="multipart/form-data">
          <table width="1450" height="1064" align="center"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 18px; text-align: center;">
            <tr>
              <td width="12" height="38" rowspan="2">&nbsp;</td>
              <td height="38" colspan="2"><a href="file:///D|/xampp/htdocs/index.php"><img src="../img/btHomer.png" alt="" width="168" height="25" /></a></td>
              <td colspan="3"><a href="file:///D|/xampp/htdocs/estudante.php"><img src="../img/btPesquisar.png" alt="" width="200" height="25" /></a></td>
              <td colspan="7"><input name="hiddenField" type="hidden" id="hiddenField" value="<?php echo $row_rs_estudantes['code']; ?>" />
                <input name="hiddenField2" type="hidden" id="hiddenField2" value="<?php echo $row_rs_matriculas['estudante_id']; ?>" /></td>
              <td width="3" rowspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="63" colspan="2"><a href="file:///D|/xampp/htdocs/index.php"></a></td>
              <td colspan="3"><a href="file:///D|/xampp/htdocs/estudante.php"></a></td>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="14" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">USUÁRIO</span></td>
              <td width="1">&nbsp;</td>
              </tr>
            <tr>
              <td height="34">&nbsp;</td>
              <td width="200" rowspan="7" style="text-align: right"><table width="152" height="154">
                <tr>
                  <td><img src="../img/FOTO.png" width="146" height="186" /></td>
                </tr>
              </table></td>
              <td width="61" style="text-align: right">&nbsp;</td>
                      <?php 
	$sql_1 = mysql_query("SELECT * FROM idec_estudantes ORDER BY id DESC LIMIT 1");
	    while($res_1 = mysql_fetch_array($sql_1)){
	  $new_code = $res_1['code']+$res_1['id']+741;
	   ?>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <?php }?>
              
              <td width="1">&nbsp;</td>
            </tr>
            <tr>
              <td height="26">&nbsp;</td>
              <td class="fonteT" style="text-align: right"><strong>Nome:</strong></td>
              <td><?php echo $row_rs_estudantes['nome']; ?></td>
              <td colspan="2">&nbsp;</td>
              <td colspan="6"><strong>Data de Nascimento: <?php echo $row_rs_estudantes['nascimento']; ?></strong></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="26">&nbsp;</td>
              <td class="fonteT" style="text-align: right"><strong>RG:</strong></td>
              <td><?php echo $row_rs_estudantes['rg']; ?></td>
              <td colspan="2">&nbsp;</td>
              <td colspan="6"><strong>Sexo: <?php echo $row_rs_estudantes['sexo']; ?></strong></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td rowspan="4">&nbsp;</td>
              <td height="26" class="fonteT" style="text-align: right"><strong>CPF:</strong></td>
              <td colspan="3"><?php echo $row_rs_estudantes['cpf']; ?></td>
              <td colspan="7"><strong>Estado Civil: <?php echo $row_rs_estudantes['estado_civil']; ?></strong></td>
              <td rowspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td class="fonteT" style="text-align: right"><span class="fonteT" style="text-align: right"><strong>RM</strong><strong>:</strong></span></td>
              <td colspan="3"><?php echo $row_rs_estudantes['code']; ?></td>
              <td colspan="7"><strong>Endereço: <?php echo $row_rs_estudantes['endereco']; ?> Nº <?php echo $row_rs_estudantes['numero_end']; ?></strong></td>
            </tr>
            <tr>
              <td class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td colspan="7"><strong>Complemento: <?php echo $row_rs_estudantes['complemento_end']; ?></strong></td>
            </tr>
            <tr>
              <td height="26" class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr bgcolor="#FFFFFF">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><strong>Cidade:</strong></td>
              <td colspan="9"><?php echo $row_rs_estudantes['cidade']; ?> <strong>Bairro: <?php echo $row_rs_estudantes['bairro']; ?></strong></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right"><strong>CEP:</strong></td>
              <td colspan="11"><span style="text-align: left"><?php echo $row_rs_estudantes['cep']; ?> <strong>Estado: <?php echo $row_rs_estudantes['estado']; ?></strong></span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td colspan="7"><label for="sexo"></label></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="5">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="4">&nbsp;</td>
              <td width="3">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="39">&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td colspan="7">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td width="102" style="text-align: right">&nbsp;</td>
              <td width="356" style="text-align: left">&nbsp;</td>
              <td colspan="5">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: left">&nbsp;</td>
              <td colspan="5">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right">&nbsp;</td>
              <td width="370"><?php echo $row_rs_estudantes['tel_residencial']; ?></td>
              <td width="67"><strong>Celular:</strong></td>
              <td colspan="7"><?php echo $row_rs_estudantes['celular']; ?></td>
              <td width="3">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right"><strong>E-mail:</strong></td>
              <td colspan="11"><?php echo $row_rs_estudantes['email']; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right"><strong>Local de Trabalho:</strong></td>
              <td colspan="11"><?php echo $row_rs_estudantes['localTrabalho']; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="fonteT" style="text-align: right"><strong>Formação Escolar:</strong></td>
              <td colspan="11"><?php echo $row_rs_estudantes['formacaoEscolar']; ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="14" bgcolor="#7BCAFF"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">DOCUMENTOS ENTREGUE</span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="13" rowspan="4"><table width="905" border="0">
                <tr>
                  <td width="23"><input name="entrega_rg" type="checkbox" id="entrega_rg" value="RG" /></td>
                  <td width="74">Rg</td>
                  <td width="23"><input type="checkbox" id="entrega_cpf" name="entrega_cpf" value="CPF" /></td>
                  <td width="117">Cpf</td>
                  <td width="23"><input type="checkbox" id="entrega_diploma" name="entrega_diploma" value="DIPLOMA" /></td>
                  <td width="186">Diploma</td>
                  <td width="26"><input type="checkbox" id="entrega_endereco" name="entrega_endereco" value="ENDERECO" /></td>
                  <td width="197">Endereco</td>
                </tr>
                <tr>
                  <td><input type="checkbox" id="entrega_titulo" name="entrega_titulo" value="TITULO" /></td>
                  <td>Titulo</td>
                  <td><input type="checkbox" id="entrega_reservista" name="entrega_reservista" value="RESERVISTA" /></td>
                  <td>Reservista</td>
                  <td><input type="checkbox" id="entrega_historico2" name="entrega_historico2" value="HISTORICO2GRAU" /></td>
                  <td>Histórico 2º Grau</td>
                  <td><input type="checkbox" id="entrega_historico3" name="entrega_historico3" value="HISTORICO3GRAU" /></td>
                  <td>Histórico 3º Grau</td>
                </tr>
                <tr>
                  <td><input type="checkbox" id="entrega_certidao" name="entrega_certidao" value="CERTIDAOCASAMENTO" /></td>
                  <td colspan="5">Certidao de Casamento ou Nascimento</td>
                  <td><input type="checkbox" id="entrega_foto" name="entrega_foto" value="FOTOS" /></td>
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
              <td height="26" colspan="14" bgcolor="#7BCAFF" class="CC"><span style="font-family: Calibri; font-weight: bold; color: #000000; font-size: 20px; text-align: center;">HISTÓRICO MATRICULAS:</span></td>
              <td rowspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td height="36" colspan="14"><table width="1208" border="0">
                  <tr>
                    <td bgcolor="#BBCBDE" class="AA">MATRICULA:</td>
                    <td bgcolor="#BBCBDE" class="AA">INICIO CURSO:</td>
                    <td bgcolor="#BBCBDE" class="AA">FINAL CURSO:</td>
                    <td bgcolor="#BBCBDE" class="AA">CURSOS:</td>
                    <td bgcolor="#BBCBDE" class="AA">DISCIPLINAS:</td>
                    <td bgcolor="#BBCBDE" class="AA">VALOR:</td>
                    <td bgcolor="#BBCBDE" class="AA">PAGAMENTO:</td>
                    </tr>
                  <?php do { ?>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="CC"><?php echo $row_rs_matriculas['inicioCurso']; ?></td>
                      <td class="CC"><?php echo $row_rs_matriculas['terminoCurso']; ?></td>
                      <td class="CC"><?php echo $row_rs_matriculas['curso']; ?></td>
                      <td class="CC"><?php echo $row_rs_matriculas['disciplinas']; ?></td>
                      <td class="CC"><?php echo $row_rs_matriculas['valor']; ?></td>
                      <td class="CC"><?php echo $row_rs_matriculas['formaPagamento']; ?></td>
                    </tr>
                    <?php } while ($row_rs_matriculas = mysql_fetch_assoc($rs_matriculas)); ?>
                </table></td>
              </tr>
            <tr>
              <td height="36">&nbsp;</td>
              <td colspan="5">&nbsp;</td>
              <td>&nbsp;</td>
              <td width="356">&nbsp;</td>
              <td width="3">&nbsp;</td>
              <td width="3">&nbsp;</td>
              <td width="3">&nbsp;</td>
              <td width="198">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
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
          </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="249" align="center">
  <tr>
    <td width="140" class="rodape">AVANTE INFORMÀTICA</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_estudantes);

mysql_free_result($rs_matriculas);
?>
