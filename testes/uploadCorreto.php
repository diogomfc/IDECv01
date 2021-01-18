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
  $cidade  = $_POST['cidade'];
  $bairro  = $_POST['bairro'];
  $endereco  = $_POST['endereco'];
  $rg_expedidor  = $_POST['rg_expedidor'];
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
  $titulo  = $_POST['titulo'];
  $titulo_sessao  = $_POST['titulo_sessao'];
  $titulo_zona  = $_POST['titulo_zona'];
  $numero_nasc  = $_POST['numero_nasc'];
  $livro_nasc  = $_POST['livro_nasc'];
  $folha_nasc  = $_POST['folha_nasc'];
  $termo_nasc  = $_POST['termo_nasc'];
  $cartorio_nasc  = $_POST['cidade_nasc'];
  $cidade_nasc  = $_POST['cidade_nasc'];
  $uf_nasc  = $_POST['uf_nasc'];

$query = mysql_query("INSERT INTO idec_estudantes (complemento_end, code, status, nome, cpf, rg, nascimento, formacaoEscolar, localTrabalho, estado, cidade, bairro, endereco, rg_expedidor, cep, tel_residencial, celular, obs, sexo, estado_civil, arquivo, data_atual, numero_end, email, titulo, titulo_sessao, titulo_zona, numero_nasc, livro_nasc, folha_nasc, termo_nasc, cartorio_nasc, cidade_nasc, uf_nasc)  VALUES ('$complemento_end','$code','Ativo','$nome','$cpf','$rg','$nascimento','$formacaoEscolar','$localTrabalho','$estado','$cidade','$bairro','$endereco','$rg_expedidor','$cep','$tel_residencial','$celular','$obs','$sexo','$estado_civil','$arquivo_nome','$data_atual','$numero_end','$email','$titulo','$titulo_sessao','$titulo_zona','$numero_nasc','$livro_nasc','$folha_nasc','$termo_nasc','$cartorio_nasc','$cidade_nasc','$uf_nasc')"); 

if ($query  == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um errro, ao cadastrar!');</script>";
}else{
    mysql_query("INSERT INTO acesso_ao_sistema (status, code, senha, nome, painel) VALUES ('Ativo', '$code', '$cpf', '$nome', 'estudante')");

 }

}
?>

<?php echo "<center><font size='3'>Cadastrado com sucesso<br>$nome<br>$cpf";
echo "<center><br>";
echo  "<img src='$arquivo_nome' width='250'>";
?>
</td>
  </tr>
  <tr>
    <td width="79"><form id="form1" name="form1" method="post" action="">
      <label>
        <input name="Cosultar" type="submit" id="Cosultar" onclick="MM_goToURL('parent','estudante.php');return document.MM_returnValue" value="COSULTAR" />
      </label>
    </form></td>
    <td width="88"><form id="form2" name="form2" method="post" action="">
      <label>
        <input name="Cadastrar" type="submit" id="Cadastrar" onclick="MM_goToURL('parent','CadastroEstudante1.php');return document.MM_returnValue" value="CADASTRAR" />
      </label>
    </form></td>
    <td width="721"><form id="form3" name="form3" method="post" action="">
    </form></td>
  </tr>
</table>
<table width="936" border="0">
  <tr>
    <td><img src="../Imagem/BarraRodapeAvante.png" width="1008" height="113" /></td>
    </tr>
</table></td>
  </tr>
</table>
