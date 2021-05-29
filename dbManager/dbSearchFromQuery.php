<?php

/**
 * Questo è il codice PHP che prende il valore della ricerca effettuata tramite la searchbar (nella pagina search-page o nella homepage) dalla querystring e inserisce le carte dei ristoranti
 * (nel database locale) il cui nome contiene la parola chiave cercata. 
 *  */

include 'dbConnect.php';
include 'functions.php';



if (!$conn) {
  echo "<p class='primary-text'>Connessione al database locale fallita</p>";
} else {
  //currentTag contiene la lista di tag per cui deve valere currentTags <= restaurantTags
  $currentTags = parseQueryString($_GET);

  //Calcola le coordinate dell'utente tramite l'indirizzo IP
  $coordinates = get_user_coordinates();

  if (isset($_GET['query'])) {
    $nome = $_GET['query'];
    //Define the order by distance
    $order = "order by pow((t.latitudine - $coordinates[0]),2) + pow((t.longitudine - $coordinates[1]),2);";
    //Select all rows that contains the $name inside the name value.
    $sql = "SELECT * FROM dati_ristoranti t WHERE (nome LIKE '%{$nome}%') OR (indirizzo LIKE '%{$nome}%') OR (descrizione LIKE '%{$nome}%') $order ";
    echo "<p class='primary-text'>Risultati di ricerca per: {$nome}</p>";
  } else {
    //Define the order by distance
    $order = "order by pow((t.latitudine - $coordinates[0]),2) + pow((t.longitudine - $coordinates[1]),2);";
    //Select all rows
    $sql = "SELECT * FROM dati_ristoranti t $order";
    echo "<p class='primary-text'>Risultati della ricerca</p>";
  }
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    //Itera sulle righe risultato della query
    while ($row = mysqli_fetch_assoc($result)) {
      $photo = explode(',', $row['listaFoto'])[0]; //prende il primo id della foto nell'array (per semplicità)
      //Calcola la distanza dal ristorante alla posizione attuale dell'utente. 
      $distance = get_distance($coordinates[0], $coordinates[1], $row['latitudine'], $row['longitudine']);
      //Arrotonda la distanza a due cifre decimali.
      $roundedDistance = round($distance, 2);
      //Concatena la latitudine e la longitudine per inserirla all'interno del campo value della carta del ristorante, in caso possa servire senza effettuare una richiesta al server.
      $latLong = $row['latitudine'] . ',' . $row['longitudine'];
      $tagArray = explode(',', str_replace('"', '', $row['tags']));
      $photoArray = json_decode($row["listaFoto"]);
      //Se è presente il campo range nella querystring lo prende, altrimenti lo setta al valore di default 50km.
      if (isset($_GET['range'])) {
        $range = $_GET['range'];
      } else {
        $range = 50;
      }
      //Controlla che il ristorante abbia i tag selezionati e che sia all'interno della distanza selezionata. 
      ///Se questo non si verifica, il ristorante non viene mostrato.
      if (subset($currentTags, $tagArray) && $distance <= $range) {

        $priceSymbol = getPriceSymbol($tagArray);

        echo "
        <div class='card mb-3' style='max-width: 50rem;' >
          <div class='row g-0' id='{$row["id"]}' value='{$row["nome"]}' onclick='redirectRestaurant(this)'>
              <div class='col-md-4 card-img-container'>
                  <img class='card-img' src='img/upload/{$photoArray[0]}'>
              </div>
              <div class='col-md-8'>
                  <div class='card-body'>
                    <div class='title-container'>
                      <h5 class='card-title'>{$row["nome"]}</h5>
                      <div class='card-text'><small class='text-muted'>{$priceSymbol}</small></div>
                    </div>
                      ";

        if ($row["descrizione"]) {
          echo "<p class='card-text'> {$row["descrizione"]} </p>";
        } else {
          echo "<p class='card-text'>Nessuna descrizione purtroppo... </p>";
        }
        echo "
        	          <div class='bottom-container'>
                      <div class='address-container'>
                        <p class='card-text'><small class='text-muted'>{$row["indirizzo"]}</small></p>
                        <p class='card-text distance' id='restaurant-distance' value='{$latLong}'><small class='text-muted'>{$roundedDistance} km da te</small></p>
                      </div>
                      <div class='tags-container' value='{$row['tags']}'>
                      ";
        //Inserisce per primi i tag che sono stati selezionati
        foreach ($tagArray as $tag) {
          if (!in_array($tag, ['Economico', 'Nella media', 'Raffinato'])) {
            if (in_array($tag, $currentTags)) {
              echo "   
                        <button class='card tag black' value='{$tag}' onclick='tagClick(event, this)'>
                          <div class='card-text white' >{$tag}</div>
                        </button>
                      ";
            }
          }
        }
        //Inserisce dopo i tag che non sono stati selezionati
        foreach ($tagArray as $tag) {
          if (!in_array($tag, ['Economico', 'Nella media', 'Raffinato'])) {
            if (!in_array($tag, $currentTags)) {
              echo "   
                        <button class='card tag' id='{$tag}-card-tag' value='{$tag}' onclick='tagClick(event, this)'>
                          <div class='card-text' >{$tag}</div>
                        </button>
                        
                      
                      ";
            }
          }
        }
        echo "
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        ";
      }
    }
  } else {
    echo "<p class='primary-text'>La ricerca non ha prodotto alcun risultato</p>";
  }


  mysqli_close($conn);
}
