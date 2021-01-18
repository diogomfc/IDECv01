<?php
$conect = mysql_connect("localhost", "idec", "C0ncr3t0");
mysql_select_db("sistema_idec",$conect);

$id = $_POST['idRepresentante'];
$sqlRepre = mysql_query ("SELECT * FROM ide_representantes WHERE id = '$id'");
$representantes = mysql_fetch_object($sqlRepre);

$dadosCursos = $representantes->celular."/".$representantes->tel_residencial."/".$representantes->tel_comercial."/".$representantes->tel1;
echo $dadosCursos;
?>

