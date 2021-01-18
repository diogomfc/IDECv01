<?php
$conexao = mysql_connect("localhost", "idec", "C0ncr3t0");
if(!$conexao) die ("ERRO AO CONECTAR:" . mysql_error());
$banco = mysql_select_db("sistema_escolar_semiautomatico",$conexao);
if(!$banco) die ("ERRO AO CONECTAR COM O BANCO DE DADOS:" . mysql_error());

//PROCURA SE EXISTE O LOGIN CADASTRADO
$query1 = "SELECT * FROM acesso_ao_sistema WHERE code = 123";
$procura = mysql_query($query1,$conexao);
//Se der erro com a busca exibir o erro
if (!$procura) die ("Execução de consulta gerou o seguinte erro no MYSQL-->" . mysql_error());
//clientes É A TABELA, login É O VALOR DE ONDE ESTÁ O LOGIN DO USUARIO

//SE ENCONTROU ALGUM RESULTADO AVISA:
if(mysql_num_rows($procura)==1)
{
echo "Esse login já está cadastrado no sistema!";
}



?>
