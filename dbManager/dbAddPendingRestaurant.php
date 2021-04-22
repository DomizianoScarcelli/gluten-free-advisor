 <?php
   /**
    * Codice per l'aggiunta di una segnalazione di un ristorante
    *(fatta nella home page compilando il form che viene mostrato premendo il pulsante in fondo alla pagina)
    *all'interno del database.
    */
   include 'dbConnect.php';

   $name = $_POST['name'];
   $city = $_POST['city'];

   $sql = "INSERT INTO `ristoranti_da_verificare` (nome, citta) VALUES ('$name', '$city')";

   mysqli_query($conn, $sql);
