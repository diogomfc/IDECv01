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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE idec_cursos SET cursos=%s, valores=%s, disciplinas=%s, cargaHoraria=%s, valores_matriculas=%s WHERE id_curso=%s",
                       GetSQLValueString($_POST['cursos'], "text"),
                       GetSQLValueString($_POST['valores'], "text"),
                       GetSQLValueString($_POST['disciplinas'], "text"),
                       GetSQLValueString($_POST['cargaHoraria'], "text"),
                       GetSQLValueString($_POST['valores_matriculas'], "text"),
                       GetSQLValueString($_POST['id_curso'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());

  $updateGoTo = "../admin/cursos1.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs_AlterarCursos = "-1";
if (isset($_GET['id_curso'])) {
  $colname_rs_AlterarCursos = $_GET['id_curso'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_AlterarCursos = sprintf("SELECT * FROM idec_cursos WHERE id_curso = %s", GetSQLValueString($colname_rs_AlterarCursos, "int"));
$rs_AlterarCursos = mysql_query($query_rs_AlterarCursos, $ConexaoIdec) or die(mysql_error());
$row_rs_AlterarCursos = mysql_fetch_assoc($rs_AlterarCursos);
$totalRows_rs_AlterarCursos = mysql_num_rows($rs_AlterarCursos);


// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$painel_atual = "admin";

// Verifica se não há a variável da sessão que identifica o usuário
if ($painel = $_SESSION['painel'] != $painel_atual) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../index.php"); exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="../img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body>
<table width="995" height="485" align="center" style="background: url(../img/imgFundoAlterarCuros2.png) no-repeat; font-family: Calibri; font-weight: bold; font-size: 18px;">
  <tr>
    <td valign="top"><table width="990">
      <tr>
        <td width="1" height="110">&nbsp;</td>
        <td colspan="2" align="right" valign="top"><table width="462" style="color: #1B4871; font-family: Calibri; font-size: 18px; font-weight: normal;">
          <tr>
            <td width="111" height="43">&nbsp;</td>
            <td width="131">&nbsp;</td>
            <td width="103">&nbsp;</td>
            <td width="34"><a href="#"><img src="../img/btInfo.png" alt="" width="28" height="30" title="Informação do Sistema"/></a></td>
            <td width="32"><a href="../logout.php"><img src="../img/btLogof.png" alt="" width="28" height="30" title="Logoff" /></a></td>
            <td width="23">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="5">Seja Bem Vindo:<strong> <?php echo $_SESSION['nome']; ?></strong></td>
          </tr>
        </table></td>
        <td width="1">&nbsp;</td>
        </tr>
      <tr>
        <td height="49">&nbsp;</td>
        <td width="177"><a href="../admin/index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
        <td width="794"><a href="../admin/cursos1.php"><img src="../img/btAbrirTurma1.png" width="197" height="33" /></a></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="34">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="269">&nbsp;</td>
        <td colspan="2" valign="top"><form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
          <table width="975" height="259" align="center">
            <tr>
              <td width="121" height="30" style="text-align: right"><input name="id_curso" type="hidden" id="id_curso" value="<?php echo $row_rs_AlterarCursos['id_curso']; ?>" />
                Cursos:</td>
              <td colspan="3"><span id="sprytextfield1">
                <label for="cursos"></label>
                <input name="cursos" type="text" id="cursos" value="<?php echo $row_rs_AlterarCursos['cursos']; ?>" size="90" />
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
            <tr>
              <td width="121" height="29" style="text-align: right">Disciplinas:</td>
              <td colspan="3"><span id="sprytextfield3">
                <label for="disciplinas"></label>
                <textarea name="disciplinas" cols="90" rows="8" id="disciplinas"><?php echo $row_rs_AlterarCursos['disciplinas']; ?></textarea>
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
            <tr>
              <td height="29" style="text-align: right">Carga Horária:</td>
              <td colspan="3"><span id="sprytextfield2">
                <label for="cargaHoraria"></label>
                <input name="cargaHoraria" type="text" id="cargaHoraria" value="<?php echo $row_rs_AlterarCursos['cargaHoraria']; ?>" />
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
            <tr>
              <td height="31" style="text-align: right">Valor Curso:</td>
              <td width="202"><span id="sprytextfield4">
                <label for="cargaHoraria"></label>
                <input name="valores" type="text" id="valores" value="<?php echo $row_rs_AlterarCursos['valores']; ?>" />
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
              <td width="150" style="text-align: right"><span style="text-align: right">Valor Matrícula:</span></td>
              <td width="482"><label for="valores_matriculas"></label>
                <input name="valores_matriculas" type="text" id="valores_matriculas" value="<?php echo $row_rs_AlterarCursos['valores_matriculas']; ?>" /></td>
            </tr>
</table>
        
          
            <input name="button" type="image" id="button" src="../img/BTAtualizarEstudante.png" />
            <input type="hidden" name="MM_update" value="form1" />
            </form>
        </td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
</body>
</html>
<?php
mysql_free_result($rs_AlterarCursos);
?>
