<?php
// Inicia a se��o
session_start();

// Importa p�gina base para opera��es com o banco de dados
//require "/php/base.php";
include ('base.php');

// Atribui os valores digitados no formul�rio aos campos correspondentes
function validar_dados_formulario($campo) {
    return isset($_POST[$campo]) ? addslashes(trim($_POST[$campo])) : '';
}

$email = validar_dados_formulario("tf_email");
$senha = validar_dados_formulario("tf_senha");



// Procura pelo usu�rio no banco de dados
$usuario = executar_SQL("SELECT usuario_id, nome_usuario, email FROM Usuario WHERE email = '$email' AND Senha = '$senha'");

// Verifica se o usuário existe
if (verifica_resultado($usuario)) {
    //Joga o resultado em um array associativo
   $us = retorna_linha($usuario);

    // Libera o resultado da consulta
   libera_consulta($usuario);

     //Atribui o nome e a id de usuário às variáveis de sessão
    $_SESSION["usuario_id"] = $us["usuario_id"];
	$_SESSION["email"] = $us["email"];
    $_SESSION["nome_usuario"] = $us["nome_usuario"];
} else {
    //Se não, recarrega a página com erro de usuário ou senha incorretos.
   header("Location: ../index.html?error=0");
   exit;
}
// Redireciona para a p�gina de confirma��o de Login (Dashboard)
echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=../html/dashboard.html'>
            <script type=\"text/javascript\">
                alert(\"Login Efetuado com Sucesso!\");
            </script>"; 

?>