
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="img/iconIdec.png" />
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


<?php require_once('../Connections/ConexaoIdec.php'); 

date_default_timezone_set('America/Sao_Paulo');

@$di = explode("/", $_POST['dataInicio'] );
@$data_inicio = $di[2] . "-" . $di[1] . "-" . $di[0];

@$df = explode("/", $_POST['dataFinal'] );
@$data_final = $df[2] . "-" . $df[1] . "-" . $df[0];

  @$polos = $_POST['polos'];
  $data_inicio;
  $data_final;

$query = mysql_query("INSERT INTO idec_abrirturmas (polos, dataInicio, dataFinal, status)  VALUES ('$polos','$data_inicio','$data_final','Aberta')");


?>

<body>

<form name="form1" method="post" action="">
  <label for="dataInicio"></label>
  <input type="text" name="dataInicio" id="dataInicio">
<label for="dataFinal"></label>
  <input type="text" name="dataFinal" id="dataFinal">
  <label for="polos"></label>
  <select name="polos" id="polos">
  <option selected="selected" value="">--- Selecione o Polo/Turma --</option>
	<?php $sql_4 = mysql_query("SELECT * FROM idec_polos WHERE polos !=''");
       while($res_4 = mysql_fetch_array($sql_4)){
    ?>
    <option value="<?php echo $res_4['polos']; ?>"><?php echo $res_4['polos']; ?> </option>
    <?php } ?>
  </select>
  <input name="button" type="submit" id="button" onclick="MM_goToURL('parent','../admin/turmas.php');return document.MM_returnValue" value="ABRIR TURMAS" />
</form>




</body>
</html>