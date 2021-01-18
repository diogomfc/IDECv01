<?php
$conect = mysql_connect("localhost", "idec", "C0ncr3t0");
mysql_select_db("sistema_idec",$conect);

$idp = $_POST['idpolos'];
$sqlTurmas = mysql_query ("SELECT * FROM idec_polos WHERE id = '$idp'");
$polosAG = mysql_fetch_object($sqlTurmas);


$idRepre = $polosAG->representante;

$sqlRepre = mysql_query ("SELECT * FROM ide_representantes WHERE id = '$idRepre'");
$NomeRepre= mysql_fetch_object($sqlRepre);


$dadosPolos =  $NomeRepre->nome."/".$polosAG->cel."/".$polosAG->tel1."/".$polosAG->tel2."/".$polosAG->tel3."/".$polosAG->endereco."/".$polosAG->numero."/".$polosAG->cep."/".$polosAG->cidade."/".$polosAG->bairro."/".$polosAG->estado."/".$polosAG->referencia;
echo $dadosPolos;
?>

