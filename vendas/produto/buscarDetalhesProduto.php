<?php
include('../base.php');

// Verifique se o ID do produto foi passado como um parâmetro na URL
if (isset($_GET['id'])) {


    $produto_id = $_GET['id'];

    // Consulta para buscar detalhes do produto com base no ID
    $sql = "SELECT * FROM produtos WHERE produto_id = $produto_id";
    $resultado = executar_SQL($sql);

    if (verifica_resultado($resultado)) {
        // Retorne os detalhes do produto no formato JSON
        $produto = retorna_linha($resultado);
        header('Content-Type: application/json');
        echo json_encode($produto);
    } else {
        // Produto não encontrado
        http_response_code(404);
    }
} else {
    // ID do produto não foi fornecido na URL
    http_response_code(400);
}
//teste 2