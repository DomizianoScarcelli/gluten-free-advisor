<?php

/**
 * Questo è il codice PHP che prende il valore della ricerca effettuata tramite la sidebar (nella pagina search-page o nella homepage) dalla querystring e inserisce le carte dei ristoranti
 * (nel database locale) il cui nome contiene la parola chiave cercata. 
 * 
 * TODO: manca da implementare la ricerca tramite filtri (quelli rapidi nella homepage e quelli della sidebar nella search-page)
 */


if ($_GET) {
  include 'dbConnect.php';
  if ($_GET['query'] != '') {
    if (!$conn) {
      echo "<p class='primary-text'>Connessione al database locale fallita</p>";
    } else {
      $nome = $_GET['query'];
      //Select all rows that contains the $name inside the name value. 
      $sql = "SELECT * FROM dati_ristoranti WHERE nome LIKE '%{$nome}%'";


      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        echo "<p class='primary-text'>Risultati di ricerca per: {$nome}</p>";
        while ($row = mysqli_fetch_assoc($result)) {

          $photo = explode(',', $row['listaFoto'])[0]; //prende il primo id della foto nell'array (per semplicità)


          echo "
        <div class='card mb-3' style='width: 50rem;'>
          <div class='row g-0'>
              <div class='col-md-4 card-img-container'>
                  <img class='card-img' src='https://maps.googleapis.com/maps/api/place/photo?maxwidth=10000&photoreference={$photo}&key=AIzaSyBmqK5XJ_5rt1y9jHSZQdfq1h-Hm-4rLHk'>
              </div>
              <div class='col-md-8'>
                  <div class='card-body'>
                      <h5 class='card-title'>{$row["nome"]}</h5>
                      ";

          if ($row["descrizione"]) {
            echo "<p class='card-text'> {$row["descrizione"]} </p>";
          } else {
            echo "<p class='card-text'>Nessuna descrizione purtroppo... </p>";
          }
          echo "
                      <p class='card-text'><small class='text-muted'>{$row["indirizzo"]}</small></p>
                  </div>
              </div>
              </div>
          </div>
        ";
        }
      } else {
        echo "<p class='primary-text'>La ricerca non ha prodotto alcun risultato</p>";
      }

      mysqli_close($conn);
    }
  }
} else{
  echo "<div class='card mb-3' style='width: 50rem;'>
          <div class='row g-0'>
              <div class='col-md-4 card-img-container'>
                  <img class='card-img' src='img\home-restaurants\lievito-72-home.jpg'>
              </div>
              <div class='col-md-8'>
                  <div class='card-body'>
                      <h5 class='card-title'>Lievito 72</h5>
                      <p class='card-text'>Nessuna descrizione purtroppo... </p>
                      <p class='card-text'><small class='text-muted'>Via di marco pinello</small></p>
                  </div>
              </div>
              </div>
          </div>";
}
