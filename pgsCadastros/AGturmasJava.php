<?php
$conect = mysql_connect("localhost", "idec", "C0ncr3t0");
mysql_select_db("sistema_idec",$conect);

$id = $_POST['idturma'];
$sqlTurmas = mysql_query ("SELECT * FROM idec_abrirturmas WHERE id = '$id'");
$polos = mysql_fetch_object($sqlTurmas);

$dadosCursos =$polos->status;
echo $dadosCursos;
?>

