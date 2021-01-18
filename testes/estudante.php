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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_ListarEstudantes = 10;
$pageNum_ListarEstudantes = 0;
if (isset($_GET['pageNum_ListarEstudantes'])) {
  $pageNum_ListarEstudantes = $_GET['pageNum_ListarEstudantes'];
}
$startRow_ListarEstudantes = $pageNum_ListarEstudantes * $maxRows_ListarEstudantes;

$colname_ListarEstudantes = "-1";
if (isset($_POST['nome'])) {
  $colname_ListarEstudantes = $_POST['nome'];
}
$colcpf_ListarEstudantes = "-1";
if (isset($_POST['cpf'])) {
  $colcpf_ListarEstudantes = $_POST['cpf'];
}
mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_ListarEstudantes = sprintf("SELECT * FROM idec_estudantes WHERE nome LIKE %s and cpf LIKE %s", GetSQLValueString("%" . $colname_ListarEstudantes . "%", "text"),GetSQLValueString("%" . $colcpf_ListarEstudantes . "%", "text"));
$query_limit_ListarEstudantes = sprintf("%s LIMIT %d, %d", $query_ListarEstudantes, $startRow_ListarEstudantes, $maxRows_ListarEstudantes);
$ListarEstudantes = mysql_query($query_limit_ListarEstudantes, $ConexaoIdec) or die(mysql_error());
$row_ListarEstudantes = mysql_fetch_assoc($ListarEstudantes);

if (isset($_GET['totalRows_ListarEstudantes'])) {
  $totalRows_ListarEstudantes = $_GET['totalRows_ListarEstudantes'];
} else {
  $all_ListarEstudantes = mysql_query($query_ListarEstudantes);
  $totalRows_ListarEstudantes = mysql_num_rows($all_ListarEstudantes);
}
$totalPages_ListarEstudantes = ceil($totalRows_ListarEstudantes/$maxRows_ListarEstudantes)-1;

mysql_select_db($database_ConexaoIdec, $ConexaoIdec);
$query_rs_listarCursos = "SELECT * FROM idec_cursos";
$rs_listarCursos = mysql_query($query_rs_listarCursos, $ConexaoIdec) or die(mysql_error());
$row_rs_listarCursos = mysql_fetch_assoc($rs_listarCursos);
$totalRows_rs_listarCursos = mysql_num_rows($rs_listarCursos);

$queryString_ListarEstudantes = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_ListarEstudantes") == false && 
        stristr($param, "totalRows_ListarEstudantes") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_ListarEstudantes = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_ListarEstudantes = sprintf("&totalRows_ListarEstudantes=%d%s", $totalRows_ListarEstudantes, $queryString_ListarEstudantes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../img/iconIdec.png" />

<script language="javascript" src="file:///D|/xampp/htdocs/lightbox/js/jquery-1.10.2.min.js"></script>
<script src="../js/lightbox/js/lightbox-2.6.min.js"></script>
<link href="../js/lightbox/css/lightbox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../js/jquery.superbox.css" type="text/css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.superbox-min.js"></script>

  <style>
  .SSS {
	font-family: Calibri;
	font-size: 18px;
}
  </style>


<script type="text/javascript">

		$(function(){

			$.superbox.settings = {

				closeTxt: "Fechar",

				loadTxt: "Carregando...",

				nextTxt: "Next",

				prevTxt: "Previous"

			};

			$.superbox();

		});

	</script>



</head>

<body>
<table width="1327" align="center">
  <tr>
    <th colspan="6" scope="col"><img src="../img/TopoIdec.png" width="1008" height="124" /></th>
  </tr>
  <tr>
    <td width="164">&nbsp;</td>
    <td width="169"><a href="../index.php"><img src="../img/btHomer.png" width="168" height="25" /></a></td>
    <td width="200"><a href="CadastroEstudante1.php"><img src="../img/btNovoAluno.png" alt="" width="200" height="23" /></a></td>
    <td width="290"><a href="../admin/matriculas.php"><img src="../img/btMatriculaAluno.png" alt="" width="200" height="25" /></a></td>
    <td width="236">&nbsp;</td>
    <td width="240">&nbsp;</td>
  </tr>
  <tr>
    <td height="185" colspan="6" align="center"><table width="364" align="center">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table align="center">
        <tr>
          <td bgcolor="#BBCBDE"><span style="font-family: Calibri; font-weight: bold; color: #B7302A; font-size: 18px; text-align: center;">CÓDIGO:</span></td>
          <td bgcolor="#BBCBDE"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px; text-align: center;">CPF:</span></td>
          <td width="500" bgcolor="#BBCBDE"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px; text-align: center;">NOME:</span></td>
          <td bgcolor="#BBCBDE"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px; text-align: center;">TELEFONE:</span></td>
          <td width="" bgcolor="#BBCBDE"><span style="font-family: Calibri; color: #B7302A; font-weight: bold; font-size: 18px;">GERÊNCIAR</span></td>
        </tr>
        <?php do { ?>
        <tr>
          <td width="" bgcolor="#D3DBE3"><span style="text-align: center; color: #1B4871; font-family: Calibri; font-size: 18px;"><?php echo $row_ListarEstudantes['code']; ?></span></td>
          <td width="" bgcolor="#D3DBE3"><span style="text-align: center; color: #1B4871; font-family: Calibri; font-size: 18px;"><?php echo $row_ListarEstudantes['cpf']; ?></span></td>
          <td width="" bgcolor="#D3DBE3"><span style="font-weight: bold; text-align: center; color: #1B4871; font-family: Calibri; font-size: 18px;"><?php echo $row_ListarEstudantes['nome']; ?></span></td>
          <td width="" bgcolor="#D3DBE3" class="SSS"><?php echo $row_ListarEstudantes['celular']; ?></td>
          <td bgcolor="#D3DBE3">
          <span style="font-weight: bold; font-family: Calibri; color: #F00;">
          <a href="../pgsExcluir/ExcluirEstudante.php?id=<?php echo $row_ListarEstudantes['id']; ?>"><img src="../img/Delete.png" alt="" title="EXCLUIR ESTUDANTE" width="24" height="24" /></a>
          <a href="AlterarEstudante1.php?id=<?php echo $row_ListarEstudantes['id']; ?>"><img src="../img/Modify.png" alt="" title="ALTERAR CADASTRO DO ESTUDANTE" width="24" height="24" /></a>
          <a href="#"><img src="../img/Profile.png" alt="" title="PERFIL DO ESTUDANTE" width="24" height="24" /></a><a href="../pgsCadastros/CadastroMatriculas.php?id_estudantes=<?php echo $row_ListarEstudantes['id']; ?>"><img src="../img/Add.png" alt="" title="EFETUAR MATRICULA" width="24" height="24" /><a class="a" rel="superbox[iframe][1200x500]" href="pgsCadastros/historicoMatriculas.php?code=<?php echo $row_ListarEstudantes['code']; ?>"><img title="HISTÓRICO MATRICULA ESTUDANTE" src="../img/visualizar16.gif" width="22" height="23" border="0"/></a></span></td>
        </tr>
        <?php } while ($row_ListarEstudantes = mysql_fetch_assoc($ListarEstudantes)); ?>
      </table>
    </p></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>
<table width="989" height="717" align="center" style="background: url(../img/imgFundoAlunos1.png) no-repeat;">
  <tr>
    <td valign="top"><table width="981">
      <tr>
        <td width="10" height="121">&nbsp;</td>
        <td width="945">&nbsp;</td>
        <td width="10">&nbsp;</td>
      </tr>
      <tr>
        <td height="39">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="75">&nbsp;</td>
        <td><form id="form1" name="form1" method="post" action="">
          <table width="984" height="50" align="center">
            <tr>
              <td width="126" height="11">&nbsp;</td>
              <td width="171"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">CPF:</span></td>
              <td width="420"><span style="font-family: Calibri; color: #000000; font-weight: bold; font-size: 18px; text-align: center;">NOME:</span></td>
              <td width="128"><img src="../img/BT2localizar.png" width="154" height="32" /></td>
              <td width="115">&nbsp;</td>
            </tr>
            <tr>
              <td height="31"><label for="rm"></label></td>
              <td height="31"><label for="cpf"></label>
                <input type="text" name="cpf" id="cpf" /></td>
              <td height="31"><label for="nome"></label>
                <input name="nome" type="text" id="nome" size="60" /></td>
              <td height="31"><label for="matricula">
                <input type="image" name="button" id="button" src="../img/BT2localizar.png" />
              </label></td>
              <td height="31">&nbsp;</td>
            </tr>
          </table>
        </form></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="33">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="396">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32">&nbsp;</td>
        <td>&nbsp;</td>
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
mysql_free_result($ListarEstudantes);

mysql_free_result($rs_listarCursos);
?>
