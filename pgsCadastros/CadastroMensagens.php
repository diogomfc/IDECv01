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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO idec_mensagem (paraPessoa, mensagem, codeUsuario) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['paraPessoa'], "text"),
                       GetSQLValueString($_POST['mensagem'], "text"),
                       GetSQLValueString($_POST['codeUsuario'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

  $insertGoTo = "../pgsMsgn/MensagemConfirma.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_mensagem = "SELECT * FROM idec_mensagem";
$rs_mensagem = mysql_query($query_rs_mensagem, $ConexaoIdec) or die(mysql_error());
$row_rs_mensagem = mysql_fetch_assoc($rs_mensagem);
$totalRows_rs_mensagem = mysql_num_rows($rs_mensagem);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="521" height="129" align="center">
    <tr>
      <td width="1" rowspan="5" style="text-align: right">&nbsp;</td>
      <td height="14" valign="bottom" style="text-align: left"><span style="text-align: right"><span style="text-align: right; font-family: Calibri; font-weight: bold;">Para Pessoa:</span></span></td>
      <td width="88" rowspan="3" style="text-align: left"><span style="text-align: right"><img src="../img/imgInformacao.png" alt="" width="87" height="107" /></span></td>
    </tr>
    <tr>
      <td width="420" height="14"><span id="sprytextfield1">
        <label for="cursos6"></label>
        <input name="paraPessoa" type="text" id="cursos6" size="60" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td height="29" valign="bottom"><span style="text-align: right; font-family: Calibri; font-weight: bold;">Mensagem:</span></td>
    </tr>
    <tr>
      <td colspan="2"><span id="sprytextfield3">
      <label for="mensagem"></label>
      <textarea name="mensagem" cols="60" rows="8" id="mensagem"></textarea>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td height="29" colspan="2"><input type="submit" name="button" id="button" value="Cadastrar" />
        <span style="text-align: right">
        <input type="hidden" name="codeUsuario" id="codeUsuario" />
      </span></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
</body>
</html>
<?php
mysql_free_result($rs_mensagem);
?>
