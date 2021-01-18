<?php
$conect = mysql_connect("localhost", "idec", "C0ncr3t0");
mysql_select_db("sistema_idec",$conect);

$id = $_POST['idcursos'];
$sqlCursos = mysql_query ("SELECT * FROM idec_cursos WHERE id_curso = '$id'");
$cursos = mysql_fetch_object($sqlCursos);
$dadosCursos = $cursos->cargaHoraria."/".$cursos->disciplinas."/".$cursos->valores;
echo $dadosCursos;
?>
