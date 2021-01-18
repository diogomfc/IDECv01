<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php
  $colname_matriculas = $_GET['code'];

  $sql_2 = mysql_query("SELECT * FROM idec_matriculas WHERE estudante_id ='$colname_matriculas'");
     while($res_2 = mysql_fetch_array($sql_2)){
	   
	   $cursos = $res_2['id_curso'];

$sql_3 = mysql_query("SELECT * FROM idec_cursos WHERE id_curso = '$cursos'");
while($res_3 = mysql_fetch_array($sql_3)){
 
  ?>
<?php echo $res_3['cursos']; ?><br> 
<?php }} ?>

