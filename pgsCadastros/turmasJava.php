  <?php
$conect = mysql_connect("localhost", "idec", "C0ncr3t0");
mysql_select_db("sistema_idec",$conect);

$id = $_POST['idturma'];
$sqlTurmas = mysql_query ("SELECT * FROM idec_abrirturmas WHERE id = '$id'");
$polos = mysql_fetch_object($sqlTurmas);

$data_inicial = date("Y-m-d");

$di = explode("-", $polos->dataInicio ); 
$data_inicio = $di[2] . "-" . $di[1] . "-" . $di[0];

$df = explode("-", $polos->dataFinal ); 
$data_final = $df[2] . "-" . $df[1] . "-" . $df[0];

$status = $polos->status;
$status2 = 'TURMA ENCERRADA';
$status1 = 'TURMA ABERTA';
 
$d1 = strtotime("$data_inicial");
$d2 = strtotime("$data_final");

$data =($d2 - $d1)/86400;


if ($data < 0) {
     $dados = $data_inicio."/".$data_final."/".$status2;	
     }else{
     $dados = $data_inicio."/".$data_final."/".$status1;
  }
echo $dados;

	?>








