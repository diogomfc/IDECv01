<?php 
//Pasta onde o arquivo vai ser salvo
$_UP['pasta'] 'fotos/';

//Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] 1024 * 1024 * 2; // 2Mb

//Array com extensões permitidas
$_UP['extensoes'] array('jpg' , 'png' , 'gif');

//Renomeia o arquivo? (se true, o arquivo será salvo como .jpg e um nome único)
$_UP['renomeia'] false;


//Array com os tipos de erros de upload do PHP
$_UP['erros'][0] 'Não houve erro';
$_UP['erros'][1] 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] 'O arquivo ultrapassa o limite de tamanho especificado no PHP';
$_UP['erros'][3] 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] 'Não foi feito o upload do arquivo';

if ($_FILES['arquivo']['erro'] !=0) {
	die("Não foi possivel fazer o upload, erro:<br />" .$_UP['erros'][$_FILES['arquivo']['error']]);
	exit; //para a execução do escript
}
// Caso script chegue a esse ponto, não hove erro com o opload e o PHP pode continuar

// Faz a verificação da extensão do arquivo
$extensao = strtolower(end(explode('-' , $_FILES['arquivo']['nome'])));
if (array_search($extensao, $_UP['extensoes']) === false) {
	echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";	
}

//Faz a verificação do tamnaho do arquivo
else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
	echo "O arquivo enviado é muito grande, envie arquivos de até 2mb.";
}

else {
// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
$nome_final = time()-'.jpg';
}else{
	//mantem o nome original do arquivo
$nome_final = $_FILES['arquivo']['nome'];
}
//Depois verifica se é possivel mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILE['arquivo']['tmp_nome'], $_UP['pasta'] . $nome_final)) {
	//Upload efetuado com sucesso, exibe uma mensagem de um link para o arquivo
echo "Upload efetuado com sucesso!";
echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
}else{
// Não foi possivel fazer o upload, provavelmente a pasta está incorreta
echo "não foi possivel enviar o arquivo , tente novamente";
}

}

$nome = $nome_final;
include ('conecta.php');
$Query = "INSERT INTO $tabela VALUES ($foto')";
       
	   if (mysql_db_query($base_dados,$Query,$link)){
		   print("<p class=titulo_big>A insersão foi execultada com sucesso!</p>");
		  // print "<meta http-equiv='refresh' content= &:URL=index.php'>";
	   }
	   mysql_close($link);
	   
?>