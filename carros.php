<?php
include("conexaoCarros.php");
include('protect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>carros</title>
</head>
<body>
  <div>
  <h1>buscar carros</h1>
  <a href="logout.php"><?php echo $_SESSION['nome']; ?> | Sair</a>
  </div>
  <form method="POST" action="">
    <input name="busca" type="text">
    <button type="submit">Pesquisar</button>
  </form>
  <table width="400px" border="1">
    <tr>
      <th>Marca</th>
      <th>veiculo</th>
      <th>modelo</th>
    </tr>
    <?php
    if(!isset($_POST['busca'])) {
      ?>
    <tr>
      <td colspan="3">Digite algo para pesquisar</td>
    </tr>
    <?php 
      } else {
        $pesquisa = $mysqli->real_escape_string($_POST['busca']);
        $sql_code = "SELECT * FROM veiculo WHERE Fabricante LIKE '%$pesquisa%' OR modelo LIKE '%$pesquisa%'  OR veiculo LIKE '%$pesquisa%'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error); 
        
        
        if($sql_query->num_rows == 0) {
          ?>
          <tr>
            <td colspan="3">Nenhum Resultado encontrado</td>
          <tr>
        <?php 
          } else {
            while($dados = $sql_query->fetch_assoc()) {
              ?>
              <tr>
                <td><?php echo $dados['Fabricante'] ?></td>
                <td><?php echo $dados['veiculo'] ?></td>
                <td><?php echo $dados['modelo'] ?></td>
              </tr>
              <?php
            }

          }           
        ?>
    <?php 
     }
    ?>
  </table>
</body>
</html>