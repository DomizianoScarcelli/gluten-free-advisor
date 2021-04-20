 <?php

    include 'dbConnect.php';

    $name = $_POST['name'];
    $city = $_POST['city'];

    $sql = "INSERT INTO `ristoranti_da_verificare` (nome, citta) VALUES ('$name', '$city')";

    mysqli_query($conn, $sql);
