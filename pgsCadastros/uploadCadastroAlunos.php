<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastro Efetuado Com Sucesso</title>

<br>
<table width="682" border="0" align="center">
  <tr>
    <td><table width="200" border="0">
  <tr>
    <td><img src="../img/TopoIdec.png" width="1008" height="124" /></td>
  </tr>
</table>
      <table width="938" border="0">
  <tr>
    <td colspan="3"><style type="text/css">
<!--
body {
	background-image: url();
}
-->
</style><?php //Fabyo Guimaraes
//require("../Connections/ConexaoIdec.php");
//require_once('../Connections/ConexaoIdec.php');
require_once('../Connections/Conexao1.php');
//require("../Connections/testeConexao.php");
//se existir o arquivo
if(isset($_FILES["arquivo"])){

$arquivo = $_FILES["arquivo"];

$pasta_dir = "arquivos/";//diretorio dos arquivos
//se nao existir a pasta ele cria uma
if(!file_exists($pasta_dir)){
mkdir($pasta_dir);
}

$arquivo_nome = $pasta_dir . $arquivo["name"];

// Faz o upload da imagem
move_uploaded_file($arquivo["tmp_name"], $arquivo_nome);

//conecta no banco

  
  $complemento_end  = $_POST['complemento_end'];
  $code  = $_POST['code'];
  $nome  = $_POST['nome'];
  $cpf  = $_POST['cpf'];
  $rg  = $_POST['rg'];
  $nascimento  = $_POST['nascimento'];
  $formacaoEscolar  = $_POST['formacaoEscolar'];
  $localTrabalho  = $_POST['localTrabalho'];
  $estado  = $_POST['estado'];
  $cidade  = addslashes($_POST['cidade']);
  $bairro  = addslashes($_POST['bairro']);
  $endereco  = addslashes($_POST['endereco']);
  $cep  = $_POST['cep'];
  $tel_residencial  = $_POST['tel_residencial'];
  $celular  = $_POST['celular'];
  $obs = $_POST['obs'];
  $sexo  = $_POST['sexo'];
  $estado_civil  = $_POST['estado_civil'];
  @$arquivo  = $_POST['arquivo'];
  @$data_atual  = $_POST['data_atual'];
  $numero_end  = $_POST['numero_end'];
  $email  = $_POST['email'];
  @$entrega_rg = $_POST['entrega_rg'];
  @$entrega_cpf = $_POST['entrega_cpf'];
  @$entrega_diploma = $_POST['entrega_diploma'];
  @$entrega_endereco = $_POST['entrega_endereco'];
  @$entrega_certidao = $_POST['entrega_certidao'];
  @$entrega_titulo = $_POST['entrega_titulo'];
  @$entrega_reservista = $_POST['entrega_reservista'];
  @$entrega_historico2 = $_POST['entrega_historico2'];
  @$entrega_historico3 = $_POST['entrega_historico3'];
  @$entrega_foto = $_POST['entrega_foto'];
  $naturalidade = $_POST['naturalidade'];
  $tel_comercial = $_POST['tel_comercial'];
  
$re = mysql_query("select count(*) as total from idec_estudantes where code = '$code' OR cpf = '$cpf'");

$total = mysql_result($re, 0, "total");

if ($total == 0) {

$query = mysql_query("INSERT INTO idec_estudantes (complemento_end, code, status, nome, cpf, rg, nascimento, formacaoEscolar, localTrabalho, estado, cidade, bairro, endereco, cep, tel_residencial, celular, obs, sexo, estado_civil, arquivo, data_atual, numero_end, email, entrega_rg, entrega_cpf, entrega_diploma, entrega_endereco, entrega_certidao, entrega_titulo, entrega_reservista, entrega_historico2, entrega_historico3, entrega_foto, naturalidade, tel_comercial)  VALUES ('$complemento_end','$code','Ativo','$nome','$cpf','$rg','$nascimento','$formacaoEscolar','$localTrabalho','$estado','$cidade','$bairro','$endereco','$cep','$tel_residencial','$celular','$obs','$sexo','$estado_civil','$arquivo_nome','$data_atual','$numero_end','$email','$entrega_rg','$entrega_cpf','$entrega_diploma','$entrega_endereco','$entrega_certidao','$entrega_titulo','$entrega_reservista','$entrega_historico2','$entrega_historico3','$entrega_foto','$naturalidade','$tel_comercial')");

$query2= mysql_query("INSERT INTO acesso_ao_sistema (status, code, senha, nome, painel) VALUES ('Ativo', '$code', '$cpf', '$nome', 'estudante')");


echo "<center><font size='3'>Cadastrado com sucesso<br>$nome<br>$cpf<br>$code";
echo "<center><br>";
echo  "<img src='$arquivo_nome' width='250'>";


 }
else{

echo"<script language='javascript'>window.location='../pgsMsgn/CadastroNegadoEstudante.php';</script>";

}

}
?>

  <input name="id" type="hidden" id="id" value="<?php echo $code; ?>" /></td>
  </tr>
  <tr>
    <td width="79"><form id="form1" name="form1" method="post" action="">
      <label>
        <input name="Cosultar" type="image" src="../img/BTPesquisarEstudante1.png" id="Cosultar" onclick="MM_goToURL('parent','../admin/estudante1.php');return document.MM_returnValue"/>
      </label>
    </form></td>
    <td width="88"><form id="form2" name="form2" method="post" action="">
      <label>
        <input name="Cadastrar" type="image" src="../img/BTNovoAluno2.png" id="Cadastrar" onclick="MM_goToURL('parent','../testes/CadastroEstudante1.php');return document.MM_returnValue"/>
      </label>
    </form></td>
    <td width="721"><form id="form3" name="form3" method="post" action="">
      <a href="CadastroMatriculas.php?estudante_id=<?php echo $code; ?>"><img src="../img/BTMatricular.png" width="176" height="29" /></a>
    </form></td>
  </tr>
</table>
<table width="936" border="0">
  <tr>
    <td><img src="../img/IMGbarraRodape.png" width="1008" height="32" /></td>
    </tr>
</table></td>
  </tr>
</table>
