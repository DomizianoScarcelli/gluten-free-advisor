<?php
include 'dbConnect.php';

$nome = $_GET['query'];

$sql = "SELECT * FROM dati_ristoranti WHERE nome LIKE '%{$nome}%'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "Nome: " . $row["nome"] . '<br>';
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>