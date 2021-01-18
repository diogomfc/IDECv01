<?php
$conect = mysql_connect("localhost", "idec", "C0ncr3t0");
mysql_select_db("sistema_idec",$conect);

$id = $_POST['idPesRepresentante'];
$sqlRepre = mysql_query ("SELECT * FROM ide_representantes WHERE id = '$id'");
$PesRepre = mysql_fetch_object($sqlRepre);

$dadosRepre =  $PesRepre->celular."/".$PesRepre->tel_residencial."/".$PesRepre->tel_comercial."/".$PesRepre->tel1;
echo $dadosRepre;
?>

