<?php
include('../base.php');

// Função para adicionar um produto
function adicionarCliente($nome, $endereco, $telefone, $email)
{
    $sql = "INSERT INTO clientes (nome, endereco, telefone, email) VALUES ('$nome', '$endereco', '$telefone', '$email')";

    $resultado = executar_SQL($sql);

    // Verifique o resultado da execução
    if ($resultado) {
        echo "Cliente adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar o cliente.";
    }
}
// Função para editar um produto
function editarCliente($cliente_id, $nome, $endereco, $telefone, $email)
{
    $sql = "UPDATE clientes SET nome = '$nome', endereco = '$endereco', telefone = '$telefone', email = '$email' WHERE cliente_id = $cliente_id";
    $resultado = executar_SQL($sql);
}

// Função para excluir um produto
function excluirCliente($cliente_id)
{
    $sql = "DELETE FROM clientes WHERE cliente_id = $cliente_id";
    $resultado = executar_SQL($sql);
}


// Verificar ação do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add_client') {
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            adicionarCliente($nome, $endereco, $telefone, $email);
        } elseif ($_POST['action'] === 'edit_client') {
            $cliente_id = $_POST['cliente_id'];
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $endereco = $_POST['endereco'];
            $email = $_POST['email'];
            editarCliente($cliente_id, $nome, $endereco, $telefone, $email);
        } elseif ($_POST['action'] === 'delete_client') {
            $cliente_id = $_POST['cliente_id'];
            excluirCliente($cliente_id);
        }
    }
}
header("Location: index.php");
exit;


?>