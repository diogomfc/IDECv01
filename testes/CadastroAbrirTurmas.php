<?php require_once('../Connections/ConexaoIdec.php'); 

date_default_timezone_set('America/Sao_Paulo');

 //data ninicial curso 
//echo $_POST['dataInicio'];
//"01/12/2012" // Array [0] => 25 [1] => 07 [2] => 2014
@$di = explode("/", $_POST['dataInicio'] );
$data_inicio = $di[2] . "-" . $di[1] . "-" . $di[0];
//echo "<br>";
//echo $data_Inicio;

//data final curso
@$df = explode("/", $_POST['dataFinal'] );
$data_final = $df[2] . "-" . $df[1] . "-" . $df[0];

  $polos = $_POST['polos'];
  $data_inicio;
  $data_final;

$query = mysql_query("INSERT INTO idec_abrirturmas (polos, dataInicio, dataFinal, status)  VALUES ('$polos','$data_inicio','$data_final','Aberta')");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="../pgsCadastros/img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="/IDECv01/js/jquery-ui-1.10.4/development-bundle/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src="../js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"></script>
  
  <script>
$(function() {
    $( "#dataInicio" ).datepicker({
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
  $(function() {
    $( "#dataFinal" ).datepicker({
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
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
  </script>
  
</head>

<body>
<table width="1052" align="center">
  <tr>
    <th colspan="6" scope="col"><img src="../img/TopoIdec.png" width="1008" height="124" /></th>
  </tr>
  <tr>
    <td width="23" height="34">&nbsp;</td>
    <td width="169"><a href="indexteste.php"><img src="../img/btHomer.png" width="168" height="25" /></a></td>
    <td width="249"><a href="../admin/turmas.php"><img src="../img/btPesquisar.png" width="200" height="25" /></a></td>
    <td width="220">&nbsp;</td>
    <td width="179">&nbsp;</td>
    <td width="184">&nbsp;</td>
  </tr>
  <tr>
    <td height="102" colspan="6" align="center"><table width="996" height="234" border="0" align="center" style="background: url(../img/imgFundoCadastroPolos.png) no-repeat; font-family: Calibri; font-weight: bold; font-size: 18px;">
      <tr>
        <td height="230"><form id="form1" name="form1" method="POST" action="">
        <table width="971" height="94" align="center">
<tr>
<td width="134" height="28">POLOS/TURMAS:</td>
<td width="254"><label for="textfield"></label>
  <label for="polos"></label>
  <select name="polos" id="polos">
    <option selected="selected" value="">--- Selecione o Polo/Turma --</option>
	<?php $sql_4 = mysql_query("SELECT * FROM idec_polos WHERE polos !=''");
       while($res_4 = mysql_fetch_array($sql_4)){
    ?>
    <option value="<?php echo $res_4['polos']; ?>"><?php echo $res_4['polos']; ?> </option>
    <?php } ?>
  </select></td>
<td width="104">DATA INÍCIO:</td>
<td width="170"><label for="dataInicio"></label>
  <input type="text" name="dataInicio" id="dataInicio" value="<?php echo date('d/m/Y')?>" /></td>
<td width="101">DATA FINAL:</td>
<td width="180"><label for="dataFinal"></label>
  <input type="text" name="dataFinal" id="dataFinal" /></td>
</tr>
<tr>
  <td height="27">&nbsp;</td>
  <td colspan="5">&nbsp;</td>
</tr>
<tr>
  <td height="29">&nbsp;</td>
  <td colspan="5"><input name="button" type="submit" id="button" onclick="MM_goToURL('parent','../admin/turmas.php');return document.MM_returnValue" value="ABRIR TURMAS" /></td>
</tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" /> 
        
        </form>
        </td>
      </tr>
    </table>      </p></td>
  </tr>
  <tr>
    <td height="31" colspan="6"></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
