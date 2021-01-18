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
  $insertSQL = sprintf("INSERT INTO idec_disciplinas (disciplinas) VALUES (%s)",
                       GetSQLValueString($_POST['disciplinas'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

  $insertGoTo = "../testes/disciplinas.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexao, $conexao);
$query_Recordset1 = "SELECT * FROM idec_disciplinas";
$Recordset1 = mysql_query($query_Recordset1, $conexao) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
<table width="1052" align="center">
  <tr>
    <th colspan="6" scope="col"><img src="../img/TopoIdec.png" width="1008" height="124" /></th>
  </tr>
  <tr>
    <td width="23">&nbsp;</td>
    <td width="267"><a href="../testes/indexteste.php"><img src="../img/btHomer.png" width="168" height="25" /></a></td>
    <td width="151">&nbsp;</td>
    <td width="220">&nbsp;</td>
    <td width="179">&nbsp;</td>
    <td width="184">&nbsp;</td>
  </tr>
  <tr>
    <td height="65" colspan="6" align="center"><table width="996" height="127" border="0" align="center" style="background: url(../img/imgFundoCadastroDisciplinas.png) no-repeat; font-family: Calibri; font-weight: bold;">
      <tr>
        <td><table width="738" height="64" align="center">
<tr>
<td width="100" height="58">Disciplinas:</td>
<td width="626"><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<span id="sprytextfield1">
<label for="disciplinas"></label>
<input name="disciplinas" type="text" id="disciplinas" size="60" />
<span class="textfieldRequiredMsg">A value is required.</span></span>
<input type="submit" name="button" id="button" value="Cadastrar" />
<input type="hidden" name="MM_insert" value="form1" />
</form></td>
</tr>
        </table> </td>
      </tr>
    </table>      </p></td>
  </tr>
  <tr>
    <td height="2" colspan="6"></td>
  </tr>
</table>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
