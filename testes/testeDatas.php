<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="/IDECv01/js/jquery-ui-1.10.4/development-bundle/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src="../js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"></script>
 





<script>

$(function() {
    $( "#data" ).datepicker({
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
<form id="form1" name="form1" method="post" action="">
  <label for="data"></label>
  <input type="text" name="data" id="data" />
</form>
</body>
</html>