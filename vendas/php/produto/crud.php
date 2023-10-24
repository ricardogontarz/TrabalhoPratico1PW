<?php
include('../base.php');

// Função para adicionar um produto
function adicionarProduto($nome, $descricao, $preco, $qtd)
{
    $sql = "UPDATE produtos SET nome = '$nome',descricao = '$descricao', preco = '$preco', quantidade_estoque = $qtd  WHERE produto_id = $produto_id";
    echo $sql; // Adicione esta linha para imprimir a consulta SQL
    $resultado = executar_SQL($sql);

}
// Função para editar um produto
function editarProduto($produto_id, $nome, $preco, $qtd, $descricao)
{
    $sql = "UPDATE produtos SET nome = '$nome', preco = '$preco', quantidade_estoque = $qtd, descricao = '$descricao' WHERE produto_id = $produto_id";
    $resultado = executar_SQL($sql);
}

// Função para excluir um produto
function excluirProduto($produto_id)
{
    $sql = "DELETE FROM produtos WHERE produto_id = $produto_id";
    $resultado = executar_SQL($sql);
}


// Verificar ação do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add_product') {
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $preco = $_POST['preco'];
            $qtd = $_POST['qtd'];
            adicionarProduto($nome, $descricao, $preco, $qtd);
        } elseif ($_POST['action'] === 'edit_product') {
            $produto_id = $_POST['produto_id'];
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $preco = $_POST['preco'];
            $qtd = $_POST['quantidade_estoque'];
            editarProduto($produto_id, $nome, $preco, $qtd, $descricao);
        } elseif ($_POST['action'] === 'delete_product') {
            $produto_id = $_POST['produto_id'];
            excluirProduto($produto_id);
        }
    }
}
header("Location: index.php");
exit;


?>