<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nome = "Diego";


// Verifica se não há a variável da sessão que identifica o usuário
if ($_SESSION['nome'] != $nome ) {
	
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../index.php"); exit;
}
?>

<h1>Página restrita</h1>
<p>Olá, <?php echo $_SESSION['nome']; ?>!</p>