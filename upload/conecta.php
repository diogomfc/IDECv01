<?php

$host       = "localhost";
$base_dados = "sistema_idec";
$login      = "idec";
$password   = "C0ncr3t0";
$tabela     = "idec_estudantes";
$link       = mysql_pconnect($host, $login, $password) or die ("Erro ao tentar conectar"); 

?>