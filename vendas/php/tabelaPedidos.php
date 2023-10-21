<div class="table table-striped w-100">
    <table border='1'>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">preço</th>
                <th scope="col">Quantidade no estoque</th>
            </tr>
        </thead>
        <tbody>
       
<?php

    include('base.php');

    // Execute a consulta SQL para obter os clientes cadastrados
    $sql = "SELECT * FROM Produtos";
    $resultado = executar_SQL($sql);

    // Verifique se há resultados
    if (verifica_resultado($resultado)) {
        while ($row = retorna_linha($resultado)) {
            echo "<tr>";
            echo "<th scope='row'>" . $row['produto_id'] . "</th>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['descricao'] . "</td>";
            echo "<td>" . $row['preco'] . "</td>";
            echo "<td>" . $row['quantidade_estoque'] . "</td>";
            echo "</tr>";

        }
    } else {
        echo "<tr><td colspan='5'>Nenhum cliente cadastrado.</td></tr>";
    }


?>
        </tbody>
    </table>
</div>