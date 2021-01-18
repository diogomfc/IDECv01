<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<script type="text/javascript">
function preview(foto) {
if(document.form.arquivo.value!="") {
var imagem = "<img src='"+foto+"'>";
imagem = imagem.replace(/C:/, "file:///C:");
document.getElementById("foto").innerHTML=imagem;
}
}
</script>

<form name="form">
<input type="file" name="arquivo" onchange="preview(this.value)">
<div id="foto"></div>
</form>


</body>
</html>