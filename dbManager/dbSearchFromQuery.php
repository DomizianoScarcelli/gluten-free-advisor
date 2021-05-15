<?php

/**
 * Questo è il codice PHP che prende il valore della ricerca effettuata tramite la sidebar (nella pagina search-page o nella homepage) dalla querystring e inserisce le carte dei ristoranti
 * (nel database locale) il cui nome contiene la parola chiave cercata. 
 *  */

include 'dbConnect.php';


if (!$conn) {
  echo "<p class='primary-text'>Connessione al database locale fallita</p>";
} else {
  //currentTag contiene la lista di tag per cui deve valere currentTags <= restaurantTags
  $currentTags = parseQueryString($_GET);

  //Calcola l'ip dell'utente e ottiene le coordinate approssimative. 
  $ip = get_ip_address();
  $json = file_get_contents("http://ipinfo.io/$ip/geo");
  $json = json_decode($json, true);
  $coordinates = explode(',', $json["loc"]);

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
      $distance = get_distance($coordinates[0], $coordinates[1], $row['latitudine'], $row['longitudine'],'K');
      //Arrotonda la distanza a due cifre decimali.
      $roundedDistance = round($distance, 2);
      //Concatena la latitudine e la longitudine per inserirla all'interno del campo value della carta del ristorante, in caso possa servire senza effettuare una richiesta al server.
      $latLong = $row['latitudine'] . ',' . $row['longitudine'];
      $tagArray = json_decode($row['tags']);
      //Se è presente il campo range nella querystring lo prende, altrimenti lo setta al valore di default 50km.
      if (isset($_GET['range'])){
        $range = $_GET['range'];
      }else{
        $range=50;
      }
      //Controlla che il ristorante abbia i tag selezionati e che sia all'interno della distanza selezionata. 
      ///Se questo non si verifica, il ristorante non viene mostrato.
      if (subset($currentTags, json_decode($row['tags'])) && $distance <= $range) {
        echo "
        <div class='card mb-3' style='max-width: 50rem;' value='id' id='{$row["id"]}' value='{$row["id"]}' onclick='doEvent(this)'>
          <div class='row g-0'>
              <div class='col-md-4 card-img-container'>
                  <img class='card-img' src='../img/home-restaurants/lievito-72-home.jpg'>
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
  
                      <div class='address-container'>
                        <p class='card-text'><small class='text-muted'>{$row["indirizzo"]}</small></p>
                        <p class='card-text distance' id='restaurant-distance' value='{$latLong}'><small class='text-muted'>{$roundedDistance} km da te</small></p>
                      </div>
                      <div class='tags-container' value='{$row['tags']}'>
                      ";

        foreach ($tagArray as $tag) {
          echo "   
                        <div class='card tag'>
                          <div class='card-text'>{$tag}</div>
                        </div>
                        
                      
                      ";
        }
        echo "
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

/**
 * Ritorna true se array1 è incluso in array2
 */
function subset($array1, $array2)
{
  foreach ($array1 as $item1) {
    if (!in_array($item1, $array2)) {
      return false;
    }
  }
  return true;
}

/**
 * Trasforma un array di arrays in un array monodimensionale.
 */
function parseQueryString($queryArray)
{
  $tagArray = array();
  foreach ($queryArray as $tag => $content) {
    if ($tag != 'query' && $tag != 'range') {
      foreach ($content as $inner) {
        array_push($tagArray, str_replace('-', ' ', $inner));
      }
    }
  }
  return $tagArray;
}

/**
 * Ritorna l'ip address dell'utente. 
 */
function get_ip_address(){
  $externalContent = file_get_contents('http://checkip.dyndns.com/');
  preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
  $ip = $m[1];
  return $ip;
}
/**
 * Ritorna la distanza tra due coordinate in chilometri
 */
function get_distance($lat1, $lon1, $lat2, $lon2) {
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  return ($miles * 1.609344);
}


