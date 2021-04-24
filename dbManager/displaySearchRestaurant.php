 <?php
   /**
    * Codice per l'aggiunta di una segnalazione di un ristorante
    *(fatta nella home page compilando il form che viene mostrato premendo il pulsante in fondo alla pagina)
    *all'interno del database.
    */
   include 'dbConnect.php';



   $sql = $conn->query('SELECT * FROM dati_ristoranti');

   while ($data = $sql->fetch_array()) {
      echo "
         <div class='card mb-3' style='max-width: 50rem;'>
            <div class='row g-0'>
               <div class='col-md-4 card-img-container'>
                     <img class='card-img' src='img/home-restaurants/lievito-72-home.jpg'>
               </div>
               <div class='col-md-8'>
                     <div class='card-body'>
                        <h5 class='card-title'> {$data['nome']} </h5>
                        <p class='card-text'> {$data['latitudine']} <br> {$data['longitudine']} </p>
                        <p class='card-text'><small class='text-muted'>  {$data['indirizzo']} </small></p>
                     </div>
               </div>
            </div>
         </div>
      ";
   }

   mysqli_query($conn, $sql);
