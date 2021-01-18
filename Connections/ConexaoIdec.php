<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_ConexaoIdec = "localhost";
$database_ConexaoIdec = "sistema_idec";
$username_ConexaoIdec = "idec";
$password_ConexaoIdec = "C0ncr3t0";
@$ConexaoIdec = mysql_pconnect($hostname_ConexaoIdec, $username_ConexaoIdec, $password_ConexaoIdec) or trigger_error(mysql_error(),E_USER_ERROR); 
?>