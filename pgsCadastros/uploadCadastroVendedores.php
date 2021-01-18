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

  
  $code = $_POST['code'];
  $cpf = $_POST['cpf'];
  $rg = $_POST['rg'];
  @$arquivo = $_POST['arquivo'];
  $nome = $_POST['nome'];
  $nascimento = $_POST['nascimento'];
  $sexo = $_POST['sexo'];
  $estado_civil = $_POST['estado_civil'];
  $endereco = $_POST['endereco'];
  $numero_end = $_POST['numero_end'];
  $complemento_end = $_POST['complemento_end'];
  $bairro = $_POST['bairro'];
  $cep = $_POST['cep'];
  $cidade = $_POST['cidade'];
  $estado = $_POST['estado'];
  $tel_residencial = $_POST['tel_residencial'];
  $celular = $_POST['celular'];
  $email = $_POST['email'];
  $localTrabalho = $_POST['localTrabalho'];
  $formacaoEscolar = $_POST['formacaoEscolar'];
  $obs = $_POST['obs'];
  $tel_comercial = $_POST['tel_comercial'];
  $tel1 = $_POST['tel1'];
  $tel2 = $_POST['tel2'];
 
  
$re = mysql_query("select count(*) as total from ide_representantes where code = '$code' OR cpf = '$cpf'");

$total = mysql_result($re, 0, "total");

if ($total == 0) {

$query = mysql_query("INSERT INTO ide_representantes(code, cpf, rg, arquivo, nome, nascimento, sexo, estado_civil, endereco, numero_end, complemento_end, bairro, cep, cidade, estado, tel_residencial, celular, email, localTrabalho, formacaoEscolar, obs, tel_comercial, tel1, tel2)  VALUES ('$code','$cpf','$rg','$arquivo_nome','$nome','$nascimento','$sexo','$estado_civil','$endereco','$numero_end','$complemento_end','$bairro','$cep','$cidade','$estado','$tel_residencial','$celular','$email','$localTrabalho','$formacaoEscolar','$obs','$tel_comercial','$tel1','$tel2')");

$query2= mysql_query("INSERT INTO acesso_ao_sistema (status, code, senha, nome, painel) VALUES ('Ativo', '$code', '$cpf', '$nome', 'vendedor')");

echo "<center><font size='3'>Cadastrado com sucesso<br>$nome<br>$cpf";
echo "<center><br>";
echo  "<img src='$arquivo_nome' width='250'>";


}
else{

echo"<script language='javascript'>window.location='../pgsMsgn/CadastroNegadoVendedor.php';</script>";

}

}
?>

</td>
  </tr>
  <tr>
    <td width="79"><form id="form1" name="form1" method="post" action="">
      <label>
        <input name="Cosultar" type="image" src="../img/BTPesquisarVendedores.png" id="Cosultar" onclick="MM_goToURL('parent','../admin/vendedores.php');return document.MM_returnValue"/>
      </label>
    </form></td>
    <td width="88"><form id="form2" name="form2" method="post" action="">
      <label>
        <input name="Cadastrar" type="image" src="../img/BTNovoVendedor.png" id="Cadastrar" onclick="MM_goToURL('parent','../testes/CadastroVendedores.php');return document.MM_returnValue"/>
      </label>
    </form></td>
    <td width="721"><form id="form3" name="form3" method="post" action="">
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
