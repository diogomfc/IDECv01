<?php
$conect = mysql_connect("localhost", "idec", "C0ncr3t0");
mysql_select_db("sistema_idec",$conect);

$sqlTurmas = mysql_query ("SELECT * FROM idec_abrirturmas WHERE id = '60'");

mysql_fetch_object($sqlTurmas);


// Define os valores a serem usados
//$data_inicial = date("Y-m-d"); 
$data_inicial = 'dataInicio'; 
$data_final = 'dataFinal';

// Usa a função strtotime() e pega o timestamp das duas datas:
$time_inicial = strtotime($data_inicial);
$time_final = strtotime($data_final);

// Calcula a diferença de segundos entre as duas datas:
$diferenca = $time_final - $time_inicial; // 19522800 segundos

// Calcula a diferença de dias
$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

// Exibe uma mensagem de resultado:
echo "A diferença entre as datas ".$data_inicial." e ".$data_final." é de <strong>".$dias."</strong> dias";

// A diferença entre as datas 23/03/2009 e 04/11/2009 é de 225 dias

if ($dias == 0) {
echo "Fechada";
}else{
echo "Aberta";
}

?>