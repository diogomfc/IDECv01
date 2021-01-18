
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA - IDEC</title>
<link rel="shortcut icon" href="../img/iconIdec.png" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="/IDECv01/js/jquery-ui-1.10.4/development-bundle/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
  <script src="../js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui-1.10.4/development-bundle/ui/jquery-ui.js"></script>
  
  <script>
$(function() {
    $( "#dataInicio" ).datepicker({
	dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
});
		
  });
  $(function() {
    $( "#dataFinal" ).datepicker({
	dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
		
		});
  });
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
  </script>

</head>


<?php require_once('../Connections/ConexaoIdec.php'); 

date_default_timezone_set('America/Sao_Paulo');

@$di = explode("/", $_POST['dataInicio'] );
@$data_inicio = $di[2] . "-" . $di[1] . "-" . $di[0];

@$df = explode("/", $_POST['dataFinal'] );
@$data_final = $df[2] . "-" . $df[1] . "-" . $df[0];

  @$polos = $_POST['polos'];
  $data_inicio;
  $data_final;

$query = mysql_query("INSERT INTO idec_abrirturmas (polos, dataInicio, dataFinal, status)  VALUES ('$polos','$data_inicio','$data_final','Aberta')");

?>
<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$painel_atual = "admin";

// Verifica se não há a variável da sessão que identifica o usuário
if ($painel = $_SESSION['painel'] != $painel_atual) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../index.php"); exit;
}

?>
<body>

<table width="996" height="335" align="center" style="background: url(../img/imgFundoCadastroPolos1.png) no-repeat; font-family: Calibri; font-size: 18px; font-weight: bold;">
  <tr>
    <td valign="top"><table width="990">
      <tr>
        <td width="1" height="112">&nbsp;</td>
        <td colspan="2" align="right" valign="top"><table width="462" style="color: #1B4871; font-family: Calibri; font-size: 18px; font-weight: normal;">
          <tr>
            <td width="111" height="43">&nbsp;</td>
            <td width="131">&nbsp;</td>
            <td width="103">&nbsp;</td>
            <td width="34"><a href="#"><img src="../img/btInfo.png" alt="" width="28" height="30" title="Informação do Sistema"/></a></td>
            <td width="32"><a href="../logout.php"><img src="../img/btLogof.png" alt="" width="28" height="30" title="Logoff" /></a></td>
            <td width="23">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="5">Seja Bem Vindo:<strong> <?php echo $_SESSION['nome']; ?></strong></td>
          </tr>
        </table></td>
        <td width="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="50">&nbsp;</td>
        <td width="178" valign="top"><a href="../admin/index.php"><img src="../img/BTHomer2.png" width="176" height="29" /></a></td>
        <td width="789" valign="top"><a href="../admin/turmas.php"><img src="../img/BTPesquisarTurmas1.png" width="197" height="33" /></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="29">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="125">&nbsp;</td>
        <td colspan="2" valign="middle"><form action="" method="post" name="form1" id="form1">
          <table width="971" height="65" align="center">
            <tr>
              <td width="127" height="28">POLOS/TURMAS:</td>
              <td width="258"><label for="polos"></label>
                <select name="polos" id="polos">
                  <option selected="selected" value="">--- Selecione o Polo/Turma --</option>
                  <?php $sql_4 = mysql_query("SELECT * FROM idec_polos WHERE polos !=''");
       while($res_4 = mysql_fetch_array($sql_4)){
    ?>
                  <option value="<?php echo $res_4['polos']; ?>"><?php echo $res_4['polos']; ?></option>
                  <?php } ?>
                </select></td>
              <td width="117">DATA INÍCIO:</td>
              <td width="168"><label for="textfield3"></label>
                <input type="text" name="dataInicio" id="dataInicio" /></td>
              <td width="105">DATA FINAL:</td>
              <td width="168"><label for="textfield4"></label>
                <input type="text" name="dataFinal" id="dataFinal" /></td>
            </tr>
            <tr>
              <td height="29">&nbsp;</td>
              <td colspan="5"><input type="image" name="button" id="button" src="../img/BTCadastrar1.png" /></td>
            </tr>
          </table>
        </form></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>