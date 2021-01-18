<?php require_once('Connections/ConexaoIdec.php'); ?>
<?php

// Nome do Arquivo do Excel que será gerado
$arquivo = 'dados_IDEC.xls';

// Criamos uma tabela HTML com o formato da planilha para excel
$tabela = '<table border="1">';
$tabela .= '<tr>';
$tabela .= '<td colspan="2">Tabela Turmas</tr>';
$tabela .= '</tr>';
$tabela .= '<tr>';
$tabela .= '<td><b>id</b></td>';
$tabela .= '<td><b>polos</b></td>';
$tabela .= '<td><b>status</b></td>';
$tabela .= '</tr>';

// Puxando dados do Banco de dados
$resultado = mysql_query('SELECT * FROM idec_abrirturmas');

while($dados = mysql_fetch_array($resultado))
{
$tabela .= '<tr>';
$tabela .= '<td>'.$dados['id'].'</td>';
$tabela .= '<td>'.utf8_decode($dados['polos']).'</td>';
$tabela .= '<td>'.$dados['status'].'</td>';
$tabela .= '</tr>';
}

$tabela .= '</table>';

// Força o Download do Arquivo Gerado
header ('Cache-Control: no-cache, must-revalidate');
header ('Pragma: no-cache');
header('Content-Type: application/x-msexcel');
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
echo $tabela;
?>