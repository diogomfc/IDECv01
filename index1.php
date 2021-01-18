<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>IDEC -  Intermedia&ccedil;&atilde;o da Educa&ccedil;&atilde;o Cultural</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="Img/iconIdec.png" />

<?php 

// Tenta se conectar ao servidor MySQL
mysql_connect('localhost', 'idec', 'C0ncr3t0') or trigger_error(mysql_error());
// Tenta se conectar a um banco de dados MySQL
mysql_select_db('sistema_idec') or trigger_error(mysql_error());

?>

</head>

<body>
<div id="logo">
<img src="Img/logoidec.png">
</div>

<div id="caixa_login">

<?php if(isset($_POST['button'])){
	 
$nome = $_POST['nome'];
$password = $_POST['password'];

if ($nome == ''){
    echo "<h2>Por favor, digite o numéro do cartão.</h2>";
}else if ($password == ''){
 echo "<h2>Por favor, digite sua senha!</h2>";
}else{

$sql_1 = mysql_query("SELECT * FROM acesso_ao_sistema WHERE nome = '$nome' AND senha = '$password'");
$conta_sql_1 = mysql_num_rows($sql_1);


 if ($conta_sql_1 == ''){
	 echo "<h2>O código de acesso ou a senha não corresponde!</h2>";
 }else{
	 
	 while($res_1 = mysql_fetch_array($sql_1)){
		 $status = $res_1['status'];
		 $code = $res_1['code'];
		 $senha = $res_1['senha'];
		 $nome = $res_1['nome'];
		 $painel = $res_1['painel'];
	
	if($status == 'inativo'){
		echo "<h2> Você esta inativo.</h2>";
	}else{
		 
		 session_start();
		 $_SESSION['code']= $code;
		 $_SESSION['senha']=$senha;
		 $_SESSION['nome']= $nome;
		 $_SESSION['painel']= $painel;
		 
		 if($painel == 'admin'){
			 echo "<script language='javascript'>window.location='admin';</script>";	 
		 }else if ($painel == 'alunos'){
			 echo "<script language='javascript'>window.location='alunos';</script>";	
		 }else if ($painel == 'professores'){
			 echo "<script language='javascript'>window.location='professores';</script>";	
	     }else if ($painel == 'financeiro'){
			 echo "<script language='javascript'>window.location='financeiro';</script>";
    }else{
		echo "<h2>Seu acesso está correto, porém não stamos conseguindo acessar o seu painel!</h2>";
	 }
	}
   } 
  }
 }
}?>

<form name="form" method="post" action="" enctype="multipart/form-data" >
<table> 
  <tr>
   <td>Nome de Usu&aacute;rio:</h1></td>
  </tr>
  <tr>
  <td><input type="text" name="nome" id="nome" /></td>
  </tr>
    <tr>
   <td>Senha:</h1></td>
  </tr>
  <tr>
  <td><input type="password" name="password" /></td>
  </tr>
<tr> 
<td><input class="input" type="submit" name="button" value="ENTRAR" /> </td>
</tr>
</table>
</form>
</div>

 
</body>
</html>
