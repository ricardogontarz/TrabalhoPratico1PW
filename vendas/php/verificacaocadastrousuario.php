<?php
// Inicia a se��o
session_start();

// Verifica se o usu�rio est� logado e se � o diretor
//require "logadodiretor.php";

// Importa p�gina base para opera��es com o banco de dados
include ('base.php');

// Atribui os valores digitados no formul�rio aos campos correspondentes
$nomeusuario = $_POST["tf_nome"] ?? '';
$email = $_POST["tf_nomeusuario"] ?? '';
$senha = isset($_POST["tf_senha"]) ? md5(trim($_POST["tf_senha"])) : '';
$confirmasenha = isset($_POST["tf_confirmasenha"]) ? md5(trim($_POST["tf_confirmasenha"])) : '';





// Se os valores dos campos senha e confirma��o de senha forem diferentes
if($senha != $confirmasenha){
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=../html/form_cadastro_usuario.html'>
            <script type=\"text/javascript\">
                alert(\"A senha digitada n�o � igual a confirmada!\");
            </script>"; 
	header("Location: form_cadastro_usuario.php");
	//header("Location: form_cadastro_usuario.php?erro=1");
	exit;
}

/*
// Se o usu�rio n�o preencheu um dos campos � redirecionado � pagina de login
if(!$nomeusuario || !$senha || !$confirmasenha || !$nome || !$sobrenome){
	header("Location: cadastrousuario.php?erro=0");
	exit;
}
*/

// Procura por um usu�rio com o mesmo nome de usu�rio
$usuario = executar_SQL("SELECT usuario_id FROM Usuario WHERE email = '$email'");

// Verifica se n�o existe outro usu�rio com esse nome
if(!verifica_resultado($usuario)){
	// Libera a consulta
	libera_consulta($usuario);

	// Executa a consulta de inser��o
	$inserir = executar_SQL("INSERT INTO Usuario(nome_usuario, email, senha) VALUES ('$nomeusuario', '$email', '$senha')");
}
// Se j� existe usu�rio com esse nome
else{
	header("Location: cadastrousuario.php?erro=2");
	exit;
}

// Redireciona para a p�gina de confirma��o de Login (Dashboard)
echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=../html/dashboard.html'>
            <script type=\"text/javascript\">
                alert(\"Usu�rio Cadastrado com Sucesso!\");
            </script>"; 
?>
