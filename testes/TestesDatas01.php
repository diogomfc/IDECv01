<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php require_once('../Connections/ConexaoIdec.php'); ?>

<?php 
$sql_1 = mysql_query("SELECT * FROM idec_abrirturmas");

 if (mysql_num_rows($sql_1) == ''){
	  echo "<br><br><h2>No momento não exixte nenhum aluno cadastrado!</h2>";
}else{
 
 ?>

<table width="900" border="0">
<tr>
   <td width="142">id</td>
    <td width="184">polos</td>
    <td width="184">turma</td>
    <td width="121">dataInicio</td>
    <td width="114">dataFinal</td>
    <td width="44">status</td>
    <td width="653">&nbsp;</td>  
  <td>  
</tr>
 <?php while($res_1 = mysql_fetch_array($sql_1)){?>
<tr>
  <<td><?php echo $res_1['id']; ?></td>
      <td><?php echo $res_1['polos']; ?></td>
      <td><?php echo $res_1['turma']; ?></td>
      <td><?php echo $data_inicial = $res_1['dataInicio']; ?></td>
      <td><?php echo $data_final = $res_1['dataFinal']; ?></td>
      <td><?php if ($dias == 0) {
echo "Fechada";
}else{
echo "Aberta";
}?></td>
      <td><?php 
	  echo "A diferença entre as datas ".$data_inicial." e ".$data_final." é de <strong>".$dias."</strong> dias"?>;</td>

</tr>
<?php } ?>
</table>
<br />
<?php } // aqui é o fechamento da PG todos ?>

<?php // aqui é o fechamento da PG cadastra ?>
</body>
</html>