<?php require_once('../Connections/ConexaoIdec.php'); ?>
<?php 
date_default_timezone_set('America/Sao_Paulo');

$id = $_GET['id'];

$sql_1 = mysql_query("SELECT * FROM idec_matriculas WHERE id = '$id'");

 while($res_1 = mysql_fetch_array($sql_1)){

}?>

<?php if (@$_GET['func']== 'SIM'){
@$certificadosSim = 'SIM';

$sql_2 = mysql_query("UPDATE idec_matriculas SET certificadosSim = '$certificadosSim' WHERE id = '$id'")OR DIE(mysql_error()); 
echo "<script> window.location ='../pgsMsgn/MensagemCertificadoEntregue.php?pg=sim&id=$id';</script>";
}?>

<?php if (@$_GET['func']== 'NAO'){
@$certificadosSim = 'NAO';
@$dataEntrega = '';

$sql_2 = mysql_query("UPDATE idec_matriculas SET certificadosSim = '$certificadosSim', dataEntrega = '$dataEntrega' WHERE id = '$id'")OR DIE(mysql_error()); 
echo "<IMG SRC='../img/imgCertificadoEntreguePendente.png'>";
}?>