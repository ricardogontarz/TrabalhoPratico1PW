<?php
include('../base.php');

// Verifique se o ID do produto foi passado como um parâmetro na URL

if (isset($_GET['id'])) {
    $cliente_id = $_GET['id'];

    // Consulta para buscar detalhes do cliente com base no ID
    $sql = "SELECT * FROM clientes WHERE cliente_id = $cliente_id";
    $resultado = executar_SQL($sql);

    if (verifica_resultado($resultado)) {
        // Retorne os detalhes do cliente no formato JSON
        $cliente = retorna_linha($resultado);
        header('Content-Type: application/json');
        echo json_encode($cliente);
    } else {
        // Cliente não encontrado
        http_response_code(404);
    }

} else {
    // ID do produto não foi fornecido na URL
    http_response_code(400);
}
//teste 2