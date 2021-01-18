<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php require_once('../Connections/ConexaoIdec.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO idec_matriculas (ano, estudante_id, curso, disciplinas, polo, nomeEstudante, inicioCurso, terminoCurso, valor, formaPagamento, representante, cod, posGraduacao, extensao, aperfeicoamento, outros) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ano'], "date"),
                       GetSQLValueString($_POST['estudante_id'], "text"),
                       GetSQLValueString($_POST['curso'], "text"),
                       GetSQLValueString($_POST['disciplinas'], "text"),
                       GetSQLValueString($_POST['polo'], "text"),
                       GetSQLValueString($_POST['nomeEstudante'], "text"),
                       GetSQLValueString($_POST['inicioCurso'], "date"),
                       GetSQLValueString($_POST['terminoCurso'], "date"),
                       GetSQLValueString($_POST['valor'], "text"),
                       GetSQLValueString($_POST['formaPagamento'], "text"),
                       GetSQLValueString($_POST['representante'], "text"),
                       GetSQLValueString($_POST['cod'], "text"),
                       GetSQLValueString(isset($_POST['posGraduacao']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['extensao']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['aperfeicoamento']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString(isset($_POST['outros']) ? "true" : "", "defined","'Y'","'N'"));

  mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
  $Result1 = mysql_query($insertSQL, $ConexaoIdec) or die(mysql_error());
}

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_RS_MATRICULA = "SELECT * FROM idec_matriculas";
$RS_MATRICULA = mysql_query($query_RS_MATRICULA, $ConexaoIdec) or die(mysql_error());
$row_RS_MATRICULA = mysql_fetch_assoc($RS_MATRICULA);
$totalRows_RS_MATRICULA = mysql_num_rows($RS_MATRICULA);

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
$query_rs_turmas = "SELECT * FROM idec_abrirturmas";
$rs_turmas = mysql_query($query_rs_turmas, $ConexaoIdec) or die(mysql_error());
$row_rs_turmas = mysql_fetch_assoc($rs_turmas);
$totalRows_rs_turmas = mysql_num_rows($rs_turmas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.11.1/jquery-1.11.1.min"></script>
<script type="text/javascript">
  function nomesPolo(id){
	$.post("turmasJava.php", {idturma:id}, function(retorno){ 
	  dados = retorno.split("/");
	  $('#inicioCurso').val(dados[0]);
	  $('#terminoCurso').val(dados[1]);
	  });
  }
</script>
</head>

<body>
<table width="1052" align="center">
  <tr>
    <th colspan="6" scope="col"><img src="../img/TopoIdec.png" width="1008" height="124" /></th>
  </tr>
  <tr>
    <td width="23">&nbsp;</td>
    <td width="267"><a href="indexteste.php"><img src="../img/btHomer.png" width="168" height="25" /></a></td>
    <td width="151">&nbsp;</td>
    <td width="220">&nbsp;</td>
    <td width="179">&nbsp;</td>
    <td width="184">&nbsp;</td>
  </tr>
  <tr>
    <td height="65" colspan="6" align="center"><table width="996" height="127" border="0" align="center" style="background: url(../img/imgFundoMatriculas.png) no-repeat; font-family: Calibri;">
      <tr>
        <td><form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST"><table width="738" height="403" align="center">
<tr>
<td height="13" colspan="2" style="text-align: right">Matricula:</td>
<?php 
	$sql_1 = mysql_query("SELECT * FROM idec_matriculas ORDER BY id DESC LIMIT 1");
	    while($res_1 = mysql_fetch_array($sql_1)){
	  $new_code = $res_1['cod']+$res_1['id']+741;
	   ?>
<td>
<input name="cod" type="text" disabled="disabled" id="cod" value="<?php echo $new_code?>" size="10"/>
<input name="cod" type="hidden" value="<?php echo $new_code ?>" /></td>
  
  <?php }?>
 
</tr>
<tr>
  <td height="6" colspan="2" style="text-align: right">Aluno:</td>
  <td colspan="3"><input name="nomeEstudante" type="text" disabled="disabled" id="nomeEstudante" value="<?php echo $row_rs_estudantes['nome']; ?>" size="60" />
  <input name="nomeEstudante" type="hidden" value="<?php echo $row_rs_estudantes['nome']; ?>" />
    RM:
    <label for="estudante_id"></label>
    <input name="estudante_id" type="text" disabled="disabled" id="estudante_id" value="<?php echo $row_rs_estudantes['code']; ?>" size="10" />
    <input name="estudante_id" type="hidden" value="<?php echo $row_rs_estudantes['code']; ?>" /></td>
</tr>
<tr>
  <td height="7" colspan="2" style="text-align: right">Ano:</td>
  <td colspan="3"><input name="ano" type="text" id="ano" size="5" />
    Ex.2014 </td>
</tr>
<tr>
  <td height="12" colspan="2" style="text-align: right">Curso:</td>
  <td colspan="3"><label for="curso"></label>
    <select name="curso" size="1" id="curso">
      <?php
do {  
?>
      <option value="<?php echo $row_rs_cursos['cursos']?>"<?php if (!(strcmp($row_rs_cursos['cursos'], $row_rs_cursos['cursos']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_cursos['cursos']?></option>
      <?php
} while ($row_rs_cursos = mysql_fetch_assoc($rs_cursos));
  $rows = mysql_num_rows($rs_cursos);
  if($rows > 0) {
      mysql_data_seek($rs_cursos, 0);
	  $row_rs_cursos = mysql_fetch_assoc($rs_cursos);
  }
?>
      </select></td>
</tr>
<tr>
  <td height="12" colspan="2" style="text-align: right">&nbsp;</td>
  <td colspan="3"><input type="checkbox" name="posGraduacao" id="posGraduacao" />
    Pós-Graduação <input type="checkbox" name="extensao" id="extensao" />
    Extensão 
    <input type="checkbox" name="aperfeicoamento" id="aperfeicoamento" />
    <label for="aperfeicoamento">Aperfeiçoamento 
      <input type="checkbox" name="outros" id="outros" />
      Outros</label></td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">Disciplina:</td>
  <td colspan="3"><label for="disciplinas"></label>
    <select name="disciplinas" size="1" id="disciplinas">
      <?php
do {  
?>
      <option value="<?php echo $row_rs_disciplinas['disciplinas']?>"<?php if (!(strcmp($row_rs_disciplinas['disciplinas'], $row_rs_disciplinas['disciplinas']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_disciplinas['disciplinas']?></option>
      <?php
} while ($row_rs_disciplinas = mysql_fetch_assoc($rs_disciplinas));
  $rows = mysql_num_rows($rs_disciplinas);
  if($rows > 0) {
      mysql_data_seek($rs_disciplinas, 0);
	  $row_rs_disciplinas = mysql_fetch_assoc($rs_disciplinas);
  }
?>
    </select></td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">Polo:</td>
  <td colspan="3">
    <select name="polo" onchange="nomesPolo(this.value)">
      <?php
do {  
?>
      <option value="<?php echo $row_rs_turmas['id']?>"<?php if (!(strcmp($row_rs_turmas['id'], $row_rs_turmas['polos']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_turmas['polos']?></option>
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
  <td height="29" colspan="2" style="text-align: right">&nbsp;</td>
  <td colspan="3"><label for=""></label></td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">Inicio do Curso:</td>
  <td width="185"><label for="inicioCurso"></label>
    <input type="text" name="inicioCurso" id="inicioCurso" /></td>
  <td width="187"><span style="text-align: right">Término do Curso:</span></td>
  <td width="190"><label for="terminoCurso"></label>
    <input type="text" name="terminoCurso" id="terminoCurso" /></td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">Valor:</td>
  <td><label for="textfield3">
    <input type="text" name="valor" id="valor" />
  </label></td>
  <td>Forma de Pagamento:</td>
  <td><label for="formaPagamento"></label>
    <input type="text" name="formaPagamento" id="formaPagamento" /></td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">Representante:</td>
  <td colspan="3"><label for="representante"></label>
    <select name="representante" id="representante">
      <?php
do {  
?>
      <option value="<?php echo $row_rs_representantes['nome']?>"<?php if (!(strcmp($row_rs_representantes['nome'], $row_rs_representantes['nome']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_representantes['nome']?></option>
      <?php
} while ($row_rs_representantes = mysql_fetch_assoc($rs_representantes));
  $rows = mysql_num_rows($rs_representantes);
  if($rows > 0) {
      mysql_data_seek($rs_representantes, 0);
	  $row_rs_representantes = mysql_fetch_assoc($rs_representantes);
  }
?>
    </select>    <label for="valor"></label></td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
  <td height="26" colspan="2" style="text-align: right">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
</tr>
<tr>
  <td width="54" height="26" style="text-align: right"><input name="id_estudantes" type="hidden" id="id_estudantes" value="<?php echo $row_rs_estudantes['id']; ?>" /></td>
  <td width="98" height="26" style="text-align: right">&nbsp;</td>
  <td colspan="3"><input type="submit" name="button" id="button" value="Matricular" /></td>
</tr>
        </table>
            <input type="hidden" name="MM_insert" value="form1" />
        </form> </td>
      </tr>
    </table>      </p></td>
  </tr>
  <tr>
    <td height="2" colspan="6"></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($RS_MATRICULA);

mysql_free_result($rs_estudantes);

mysql_free_result($rs_polos);

mysql_free_result($rs_cursos);

mysql_free_result($rs_representantes);

mysql_free_result($rs_disciplinas);

mysql_free_result($rs_turmas);
?>
