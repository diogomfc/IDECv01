<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
//Conexão e consulta ao Mysql
mysql_connect('localhost','idec','C0ncr3t0') or die(mysql_error());
mysql_select_db('cejac') or die(mysql_error());
$qry = mysql_query("select Nome as Nome, Pessoa as Representante from clientes");

//Pegando os nomes dos campos

$num_fields = mysql_num_fields($qry);//Obtém o número de campos do resultado

for($i = 0;$i<$num_fields; $i++){//Pega o nome dos campos
	$fields[] = mysql_field_name($qry,$i);
}

//Montando o cabeçalho da tabela
$table = '<table border="1"><tr>';

for($i = 0;$i < $num_fields; $i++){
	$table .= '<th>'.$fields[$i].'</th>';
}

//Montando o corpo da tabela
$table .= '<tbody>';
while($r = mysql_fetch_array($qry)){
	$table .= '<tr>';
	for($i = 0;$i < $num_fields; $i++){
		$table .= '<td>'.$r[$fields[$i]].'</td>';
	}
	$table .= '</tr>';
}

//Finalizando a tabela
$table .= '</tbody></table>';

//Imprimindo a tabela
echo $table;

?>
</body>
</html>