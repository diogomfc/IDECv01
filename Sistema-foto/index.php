<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	 $('#imagem').live('change',function(){
		 $('#visualizar').html('<img src="ajax-loader.gif" alt="Enviando..."/> Enviando...');
		 /* Efetua o Upload */
		 $('#formulario').ajaxForm({
			target:'#visualizar' // o callback será no elemento com o id #visualizar
		 }).submit();
	 });
 })
</script>
<title>Upload sem Refresh</title>
</head>
<body>
<form id="formulario" method="post" enctype="multipart/form-data" action="">
Foto
<input type="file" id="imagem" name="imagem" />
<input type="submit" name="button" id="button" value="Submit" />
</form>
<div id="visualizar"></div>
</body>
</html>
