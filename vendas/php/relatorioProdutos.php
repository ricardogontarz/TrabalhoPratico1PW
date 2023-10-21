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
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="../html/dashboard.html">Sistemas de Vendas</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sair</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">      
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file" class="align-text-bottom"></span>
              Pedidos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Produtos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users" class="align-text-bottom"></span>
              Clientes
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="../html/form_cadastro_usuario.html">
              <span data-feather="users" class="align-text-bottom"></span>
              Usuários
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../html/relatorios.html">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Relatórios
            </a>
          </li>         
        </ul>      
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Relatório pedidos</h1>       
      </div>

      <!--<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

      <h2>Lista com todos os pedidos cadastrados no sistema:</h2>
      <form method="post" action="relatorioPedidos.php">
            <div class="form-group">
                <label for="data_inicial">Data Inicial:</label>
                <input type="date" id="data_inicial" name="data_inicial">
            </div>
            <div class="form-group">
                <label for="data_final">Data Final:</label>
                <input type="date" id="data_final" name="data_final">
            </div>
            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
        </form>

        <!-- Inserir a tabela aqui -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID do Pedido</th>
                    <th>ID do Cliente</th>
                    <th>Data do Pedido</th>
                    <!-- Adicione mais colunas aqui, se necessário -->
                </tr>
            </thead>
            <tbody>
                <?php
                include('base.php');

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $data_inicial = $_POST['data_inicial'];
                    $data_final = $_POST['data_final'];

                    // Execute a consulta SQL para obter os pedidos dentro do período especificado
                    $sql = "SELECT * FROM pedidos WHERE data_pedido BETWEEN '$data_inicial' AND '$data_final'";
                    $resultado = executar_SQL($sql);

                    // Verifique se há resultados
                    if (retorna_linha($resultado) > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . $row['pedido_id'] . "</td>";
                            echo "<td>" . $row['cliente_id'] . "</td>";
                            echo "<td>" . $row['data_pedido'] . "</td>";
                            // Adicione mais colunas para outros campos do pedido, se necessário
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Nenhum pedido realizado no período especificado.</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>

<p><a href="../html/relatorios.html" class="link">Voltar</a></p>

    </main>
  </div>
</div>

  
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
	  
	 
  </body>
</html>


