<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php require_once('../Connections/conexao.php'); ?>
<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php require_once('../Connections/ConexaoIdec.php'); ?>

<?php

date_default_timezone_set('America/Sao_Paulo');

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
  $insertSQL = sprintf("INSERT INTO idec_matriculas (ano, estudante_id, id_curso, disciplinas, polo, nomeEstudante, inicioCurso, terminoCurso, valor, formaPagamento, representante, cod, posGraduacao, extensao, aperfeicoamento, outros, dataPagamento, cargaHoraria, valores_matriculas, graduacao) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ano'], "date"),
                       GetSQLValueString($_POST['estudante_id'], "text"),
                       GetSQLValueString($_POST['id_curso'], "text"),
                       GetSQLValueString($_POST['disciplinas'], "text"),
                       GetSQLValueString($_POST['polo'], "text"),
                       GetSQLValueString($_POST['nomeEstudante'], "text"),
                       GetSQLValueString($data_inicio1 = $_POST['inicioCurso'], "date"),
                       GetSQLValueString($data_final1 = $_POST['terminoCurso'], "date"),
                       GetSQLValueString($_POST['valor'], "text"),
                       GetSQLValueString($_POST['formaPagamento'], "text"),
                       GetSQLValueString($_POST['representante'], "text"),
                       GetSQLValueString($code = $_POST['cod'], "text"),
                       GetSQLValueString(isset($_POST['posGraduacao']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['extensao']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['aperfeicoamento']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['outros']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['dataPagamento'], "text"),
                       GetSQLValueString($_POST['cargaHoraria'], "text"),
					   GetSQLValueString($_POST['valores_matriculas'], "text"),
					   GetSQLValueString(isset($_POST['graduacao']) ? "true" : "", "defined","'Y'","'N'"));
					   
  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

 
 echo "<script language='javascript'>window.location='../pgsMsgn/MatriculaConfirmadaEstudante.php?code=$code ';</script>";
  
}
$colname_rs_estudantes = "-1";
if (isset($_GET['id_estudantes'])) {
  $colname_rs_estudantes = $_GET['id_estudantes'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_estudantes = sprintf("SELECT * FROM idec_estudantes WHERE id = %s ORDER BY nome ASC", GetSQLValueString($colname_rs_estudantes, "int"));
$rs_estudantes = mysql_query($query_rs_estudantes, $ConexaoIdec) or die(mysql_error());
$row_rs_estudantes = mysql_fetch_assoc($rs_estudantes);
$totalRows_rs_estudantes = mysql_num_rows($rs_estudantes);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_polos = "SELECT * FROM idec_polos";
$rs_polos = mysql_query($query_rs_polos, $ConexaoIdec) or die(mysql_error());
$row_rs_polos = mysql_fetch_assoc($rs_polos);
$totalRows_rs_polos = mysql_num_rows($rs_polos);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_cursos = "SELECT * FROM idec_cursos";
$rs_cursos = mysql_query($query_rs_cursos, $ConexaoIdec) or die(mysql_error());
$row_rs_cursos = mysql_fetch_assoc($rs_cursos);
$totalRows_rs_cursos = mysql_num_rows($rs_cursos);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_representantes = "SELECT * FROM ide_representantes";
$rs_representantes = mysql_query($query_rs_representantes, $ConexaoIdec) or die(mysql_error());
$row_rs_representantes = mysql_fetch_assoc($rs_representantes);
$totalRows_rs_representantes = mysql_num_rows($rs_representantes);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_disciplinas = "SELECT * FROM idec_disciplinas";
$rs_disciplinas = mysql_query($query_rs_disciplinas, $ConexaoIdec) or die(mysql_error());
$row_rs_disciplinas = mysql_fetch_assoc($rs_disciplinas);
$totalRows_rs_disciplinas = mysql_num_rows($rs_disciplinas);

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_turmas = "SELECT * FROM idec_abrirturmas WHERE polos != ''";
$rs_turmas = mysql_query($query_rs_turmas, $ConexaoIdec) or die(mysql_error());
$row_rs_turmas = mysql_fetch_assoc($rs_turmas);
$totalRows_rs_turmas = mysql_num_rows($rs_turmas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="../img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="/IDECv01/js/jquery-ui-1.10.4/development-bundle/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src="../js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"></script>
  

 
 <style type="text/css">
.ss {
	font-size: 14px;
}
.Nome {
	font-family: Calibri;
}
</style>
 
 <script>

$(function() {
    $( "#dataPagamento" ).datepicker({
	dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
		
		});
  });

  function nomesPolo(id){
	$.post("turmasJava.php", {idturma:id}, function(retorno){ 
	  dados = retorno.split("/");
	  $('#inicioCurso').val(dados[0]);
	  $('#terminoCurso').val(dados[1]);
	  $statusAlerta = $('#status').val(dados[2]);
	  
	  });
  }
  function nomesCurso(id){
	$.post("cursosJava.php", {idcursos:id}, function(retornoCuros){ 
	  dadosCuros = retornoCuros.split("/");
	  $('#cargaHoraria').val(dadosCuros[0]);
	  $('#disciplinas').val(dadosCuros[1]);
	  $('#valor').val(dadosCuros[2]);
	  });
  }
</script>
    


</head>

<body>
<table width="1000" height="642" align="center" style="background: url(../img/imgFundoCadastroMatriculas2.png) no-repeat; font-family: Calibri; font-size: 20px;">
  <tr>
    <td height="636" valign="top"><table width="1000">
      <tr>
        <td width="3" height="115">&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td width="1">&nbsp;</td>
      </tr>
      <tr>
        <td height="43">&nbsp;</td>
        <td width="168"><a href="../admin/index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
        <td width="200"><a href="../admin/estudante1.php"><img src="../img/BTPesquisarEstudante1.png" alt="" width="197" height="33" /></a></td>
        <td width="200"><a href="../admin/turmas.php"><img src="../img/BTPesquisarTurmas1.png" width="197" height="33" /></a></td>
        <td width="200"><a href="../admin/cursos1.php"><img src="../img/btAbrirTurma1.png" width="197" height="33" /></a></td>
        <td width="200">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="35">&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="426" colspan="7" valign="top"><form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="post">
          <table width="976" height="232" align="center">
            <tr>
              <td height="13" colspan="2" style="text-align: right; font-size: 20px; font-family: Calibri;">Matricula:</td>
              <?php 
	$sql_1 = mysql_query("SELECT * FROM idec_matriculas ORDER BY id DESC LIMIT 1");
	    while($res_1 = mysql_fetch_array($sql_1)){
	 $max = $res_1['cod']+30741;
	  $mim = $res_1['id'];
	  $new_code = rand($max,$mim);
	   ?>
              <td><input name="cod" type="text" id="cod" style="font-family:Calibri; font-size:20px; color:#099; border:none; background-color: transparent; " value="<?php echo $new_code?>" size="10" readonly="readonly"/>
                <input name="cod" type="hidden" value="<?php echo $new_code ?>" /></td>
              <?php }?>
              </tr>
            <tr>
              <td height="6" colspan="2" style="text-align: right; font-size: 20px;">Aluno:</td>
              <td colspan="3"><input name="nomeEstudante" type="text" id="nomeEstudante" style="font-family:Calibri; font-size:20px; color:#000; font-weight:bold; border:none; background-color: transparent; " value="<?php echo $row_rs_estudantes['nome']; ?>" size="50" readonly="readonly" />
                <input name="nomeEstudante" type="hidden" value="<?php echo $row_rs_estudantes['nome']; ?>" />
                RM:
                <label for="estudante_id"></label>
                <input name="estudante_id" type="text" id="estudante_id" style="font-family:Calibri; font-size:20px; color:#099; border:none; background-color: transparent; " value="<?php echo $row_rs_estudantes['code']; ?>" size="10" readonly="readonly" />
                <input name="estudante_id" type="hidden" value="<?php echo $row_rs_estudantes['code']; ?>" /></td>
              </tr>
            <tr>
              <td height="7" colspan="2" style="text-align: right; font-size: 20px;">Ano:</td>
              <td colspan="3"><input name="ano" type="text" id="ano" style="font-family:Calibri; font-size:18px; color:#000;" size="5" />
                <span class="Nome"><span class="ss">Ex.2014</span></span></td>
              </tr>
            <tr>
              <td height="12" colspan="2"  style="text-align: right; font-size: 20px; font-family: Calibri;">Curso:</td>
              <td colspan="3"><select name="id_curso" size="1" style="font-family:Calibri; font-size:18px; color:#000;" onchange="nomesCurso(this.value)">
                <option selected="selected" value="" style="font-family:Calibri; font-size:18px; color:#000;">--- Selecione o Curso --</option>
                <?php
do {  ?>
                <option value="<?php echo $row_rs_cursos['id_curso']?>"><?php echo $row_rs_cursos['cursos']?></option>
                <?php
} while ($row_rs_cursos = mysql_fetch_assoc($rs_cursos));
  $rows = mysql_num_rows($rs_cursos);
  if($rows > 0) {
      mysql_data_seek($rs_cursos, 0);
	  $row_rs_cursos = mysql_fetch_assoc($rs_cursos);
  }
?>
                </select>
                <span  style="text-align: right; font-size: 20px; font-family: Calibri;">C.H:
                  <label for="cargaHoraria"></label>
                  <input name="cargaHoraria" type="text" id="cargaHoraria" style="font-family:Calibri; font-size:18px; color:#000; border:none; background-color: transparent;" value="<?php echo $row_rs_cursos['cargaHoraria']; ?>" size="10" />
                  </span></td>
              </tr>
            <tr>
              <td height="12" colspan="2" style="text-align: right">&nbsp;</td>
			  <td colspan="3"><input type="checkbox" name="graduacao" id="graduacao" />
			    Graduação
			      <input type="checkbox" name="posGraduacao" id="posGraduacao" />
                Pós-Graduação
                <input type="checkbox" name="extensao" id="extensao" />
                Extensão
                <input type="checkbox" name="aperfeicoamento" id="aperfeicoamento" />
                <label for="aperfeicoamento">Aperfeiçoamento
                  <input type="checkbox" name="outros" id="outros" />
                  Outros</label></td>
              </tr>
            <tr>
              <td height="26" colspan="2"  style="text-align: right; font-size: 20px; font-family: Calibri;">Disciplina:</td>
              <td colspan="3"><label for="disciplinas"></label>
                <textarea name="disciplinas" cols="80" rows="3" readonly="readonly" id="disciplinas" style="font-family:Calibri; font-size:18px; color:#000;"></textarea></td>
              </tr>
            <tr>
              <td height="26" colspan="2"  style="text-align: right; font-size: 20px; font-family: Calibri;">Polo/Turma:</td>
              <td colspan="3"><select name="polo" size="1" style="font-family:Calibri; font-size:18px; color:#000;" onchange="nomesPolo(this.value)">
                <option selected="selected" value="" style="text-align: right; font-size: 20px; font-family: Calibri;">--- Selecione o Polo/Turma --</option>
                <?php
do {  
?>
                <option value="<?php echo $nomePolo = $row_rs_turmas['id']?><?php echo $row_rs_turmas['polos']?>"><?php echo $row_rs_turmas['polos']?></option>
                <?php
} while ($row_rs_turmas = mysql_fetch_assoc($rs_turmas));
  $rows = mysql_num_rows($rs_turmas);
  if($rows > 0) {
      mysql_data_seek($rs_turmas, 0);
	  $row_rs_turmas = mysql_fetch_assoc($rs_turmas);
  }
?>
                </select></td>
              </tr>
            <tr>
              <td height="26" colspan="2"  style="text-align: right; font-size: 20px; font-family: Calibri;">Início:</td>
              <td width="100"><label for="inicioCurso"></label>
                <input name="inicioCurso" type="text" id="inicioCurso" size="10"  style="font-family:Calibri; font-size:18px; color:#000;" readonly="readonly" /></td>
              <td colspan="2"><span  style="text-align: right; font-size: 20px; font-family: Calibri;"> Término:
                <input name="terminoCurso" type="text" id="terminoCurso" size="10" style="font-family:Calibri; text-align:center; font-size:18px; color:#000;" readonly="readonly" />
                </span>
                <label for="terminoCurso"  style="text-align: right; font-size: 20px; font-family: Calibri;"> Status:
                  <input name="status" type="text" id="status" size="18" style="font-family:Calibri; font-size:18px; color:#00f; border:none; background-color: transparent;" readonly="readonly" />
                  </label></td>
              </tr>
            <tr>
              <td height="26" colspan="2"  style="text-align: right; font-size: 20px; font-family: Calibri;">Valor:</td>
              <td><label for="textfield3">
                <input name="valor" type="text" id="valor" style="font-family:Calibri; font-size:18px; color:#000;" size="10" readonly="readonly" />
                </label></td>
              <td colspan="2" align="left" style="text-align: left; font-size: 20px; font-family: Calibri;">Valor Matrícula:
                <span style="text-align: right;">
                <input name="valores_matriculas" type="text" id="valores_matriculas" style="font-family:Calibri; font-size:18px; color:#000;" size="10" />
                </span><span style="text-align: right;">
                <label for="valores_matriculas"></label>
                Data 1ª Pagamento:
                
                <input name="dataPagamento" type="text" id="dataPagamento" size="10" style="font-family:Calibri; font-size:18px; color:#000;" />
                </span></td>
              </tr>
            <tr>
              <td height="26" colspan="2"  style="text-align: left; font-size: 20px; font-family: Calibri;">Representante:</td>
              <td colspan="3"><label for="representante"></label>
                <select name="representante" size="1" id="representante" style="font-family:Calibri; font-size:18px; color:#000;">
                  <option value="" style="font-family:Calibri; font-size:18px; color:#000;">--- Selecione o Representante --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_rs_representantes['nome']?>"><?php echo $row_rs_representantes['nome']?></option>
                  <?php
} while ($row_rs_representantes = mysql_fetch_assoc($rs_representantes));
  $rows = mysql_num_rows($rs_representantes);
  if($rows > 0) {
      mysql_data_seek($rs_representantes, 0);
	  $row_rs_representantes = mysql_fetch_assoc($rs_representantes);
  }
?>
                  </select>
                <span style="text-align: left; font-size: 20px; font-family: Calibri;">
                <label for="formaPagamento2"></label>
                Forma Pagamento:</span>                <span style="text-align: right;">
                  <label for="dataPagamento"></label>
                  <span style="text-align: left; font-size: 20px; font-family: Calibri;">
                  <input name="formaPagamento" type="text" id="formaPagamento" style="font-family:Calibri; font-size:18px; color:#000;" size="20"/>
                  </span></span></td>
              </tr>
            <tr>
              <td width="35" height="26" style="text-align: right"><input name="id_estudantes" type="hidden" id="id_estudantes" value="<?php echo $row_rs_estudantes['id']; ?>" /></td>
              <td width="93" height="26" style="text-align: right">&nbsp;</td>
              <td colspan="2"><input type="image" name="button" id="button" src="../img/BTMatricular2.png" /></td>
              <td width="460">&nbsp;</td>
              </tr>
            </table>
          <input type="hidden" name="MM_insert" value="form1" />
          <input type="hidden" name="MM_insert" value="form1" />
        </form></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php

mysql_free_result($rs_estudantes);

mysql_free_result($rs_polos);

mysql_free_result($rs_cursos);

mysql_free_result($rs_representantes);

mysql_free_result($rs_disciplinas);

mysql_free_result($rs_turmas);
?>
