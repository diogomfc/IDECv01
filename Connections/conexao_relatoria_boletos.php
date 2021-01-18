<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexao_relatoria_boletos = "localhost";
$database_conexao_relatoria_boletos = "cejac";
$username_conexao_relatoria_boletos = "idec";
$password_conexao_relatoria_boletos = "C0ncr3t0";
$conexao_relatoria_boletos = mysql_pconnect($hostname_conexao_relatoria_boletos, $username_conexao_relatoria_boletos, $password_conexao_relatoria_boletos) or trigger_error(mysql_error(),E_USER_ERROR); 
?>