<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
function updatepicture(pic){
	document.getElementById("image").setAttribute("src",pic);
}
</script>
</head>

<body>
<form action="preview.php" method="post"  enctype="multipart/form-data" name="form" id="form" target="iframe">
  <table width="415">
    <tr>
      <td width="72">Arquivo:</td>
      <td width="254"><label for="arquivo"></label>
      <input type="file" name="file" id="file" /></td>
      <td width="73"><input type="submit" name="submit" id="submit" value="ENVIAR" /></td>
    </tr>
  </table>
</form>
<p id="message"> Testes testes. </p>
<img style="min-height:120; min-width:200; max-height:120px;" id="image" /><br>
<iframe style="display:name;" name="iframe"> </iframe>

</body>
</html>