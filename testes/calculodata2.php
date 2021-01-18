<?php
//defino data 1
$ano1 = 2014;
$mes1 = 05;
$dia1 = 25;

//defino data 2
$ano2 = 2015;
$mes2 = 05;
$dia2 = 25;

//calculo timestam das duas datas
$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);

//diminuo a uma data a outra
$segundos_diferenca = $timestamp1 - $timestamp2;
//echo $segundos_diferenca;

//converto segundos em dias
$dias_diferenca = $segundos_diferenca / (60 * 60 * 24);

//obtenho o valor absoluto dos dias (tiro o possível sinal negativo)
$dias_diferenca = abs($dias_diferenca);

//tiro os decimais aos dias de diferenca
$dias_diferenca = floor($dias_diferenca);

echo $dias_diferenca;
?> 