<link href="img/iconIdec.png" rel="shortcut icon" />
<?php 

// Tenta se conectar ao servidor MySQL
mysql_connect('localhost', 'idec', 'C0ncr3t0') or trigger_error(mysql_error());
// Tenta se conectar a um banco de dados MySQL
mysql_select_db('sistema_idec') or trigger_error(mysql_error());

?>

<?php
@session_start();

@$code = $_SESSION['code'];
@$password = $_SESSION['password'];
@$painel = $_SESSION['painel'];

if($password == ''){
	echo "<script language='javascript'>window.alert('Erro ao acessar o sistema!');window.location='../index.php';</script>";
}else if($code == ''){
	echo "<script language='javascript'>window.alert('Erro ao acessar o sistema!');window.location='../index.php';</script>";
}else{

	$login_1 = mysql_query("SELECT * FROM acesso_ao_sistema WHERE code = '$code' AND senha = '$password'");
	$conta_login_1 = mysql_num_rows($login_1);
	if($conta_login_1 == ''){	
	echo "<script language='javascript'>window.alert('Erro ao acessar o sistema!');window.location='../index.php';</script>";
	}else{

	while($mostra_dados = mysql_fetch_array($login_1)){
 		
		$code = $mostra_dados['code'];
	
	 }
	}	
  }
?>