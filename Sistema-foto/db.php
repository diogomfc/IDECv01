<?php
$db = mysql_select_db('sistema_idec');
$conecta = mysql_connect('localhost','idec','C0ncr3t0') or die("Não foi possível conectar ao banco MySQL");
if (!$conecta) {echo "Não foi possível conectar ao banco MySQL.
"; exit;}
else {echo "Parabéns!! A conexão ao banco de dados ocorreu normalmente!.
";}
mysql_close();
?>