<?php
  require('pdf.php'); // Verifique se o arquivo 'pdf.php' está no diretório correto
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $pdf->AddPage();
  $html = '
  <!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.104.2">
      <title>Projeto de um Sistema de Vendas</title>
  
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       
      <!-- Custom styles for this template -->
      <link href="../css/dashboard.css" rel="stylesheet">
    </head>
    <body>
      <h2>Lista com todos os produtos cadastrados no sistema:</h2>
      <div class="table table-striped w-100">
        <table border="1">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Descrição</th>
              <th scope="col">Preço</th>
              <th scope="col">Quantidade no estoque</th>
            </tr>
          </thead>
          <tbody>';

  include('base.php');

  // Execute a consulta SQL para obter os produtos cadastrados
  $sql = "SELECT * FROM Produtos";
  $resultado = executar_SQL($sql);

  // Verifique se há resultados
  if (verifica_resultado($resultado)) {
    while ($row = retorna_linha($resultado)) {
      $html .= "<tr>";
      $html .= "<th scope='row'>" . $row['produto_id'] . "</th>";
      $html .= "<td>" . $row['nome'] . "</td>";
      $html .= "<td>" . $row['descricao'] . "</td>";
      $html .= "<td>" . $row['preco'] . "</td>";
      $html .= "<td>" . $row['quantidade_estoque'] . "</td>";
      $html .= "</tr>";
    }
  } else {
    $html .= "<tr><td colspan='5'>Nenhum produto cadastrado.</td></tr>";
  }

  $html .= '
        </tbody>
      </table>
    </div>
    </body>
  </html>';

  $pdf->writeHTML($html, true, false, true, false, '');
  $pdf->Output('relatorio-produtos.pdf', 'I');
?>
