<?php

/**
 * Questo è il codice PHP che prende il valore della ricerca effettuata tramite la sidebar (nella pagina search-page o nella homepage) dalla querystring e inserisce le carte dei ristoranti
 * (nel database locale) il cui nome contiene la parola chiave cercata. 
 * 
 * TODO: manca da implementare la ricerca tramite filtri (quelli rapidi nella homepage e quelli della sidebar nella search-page)
 */


/**
 * Calculates the great-circle distance between two points, with
 * the Vincenty formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 * 
 * Source: https://stackoverflow.com/questions/10053358/measuring-the-distance-between-two-coordinates-in-php
 */
function vincentyGreatCircleDistance(
  $latitudeFrom,
  $longitudeFrom,
  $latitudeTo,
  $longitudeTo,
  $earthRadius = 6371000
) {
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}


if ($_GET) {
  include 'dbConnect.php';
  if ($_GET['query'] != '') {
    if (!$conn) {
      echo "<p class='primary-text'>Connessione al database locale fallita</p>";
    } else {
      $nome = $_GET['query'];

      //Select all rows that contains the $name inside the name value. 
      $sql = "SELECT * FROM dati_ristoranti WHERE (nome LIKE '%{$nome}%') OR (indirizzo LIKE '%{$nome}%') OR (descrizione LIKE '%{$nome}%') ";




      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        echo "<p class='primary-text'>Risultati di ricerca per: {$nome}</p>";
        while ($row = mysqli_fetch_assoc($result)) {

          $photo = explode(',', $row['listaFoto'])[0]; //prende il primo id della foto nell'array (per semplicità)

          //  $currentLat = $_POST['latitudine'];
          //   $currentLng = $_POST['longitudine'];
          //   $destLat = $row['latitudine'];
          //   $destLng = $row['longitudine'];
          //   $distance = vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000);

          $latLong = $row['latitudine'] . ',' . $row['longitudine'];
          $tagArray = json_decode($row['tags']);
          echo "
        <div class='card mb-3' style='width: 50rem;' id='{$row["id"]}'>
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
                        <p class='card-text distance' id='restaurant-distance' value='{$latLong}'><small class='text-muted'></small></p>
                      </div>
                      <div class='tags-container' value='{$row['tags']}'>
                      ";
                      
                      foreach($tagArray as $tag){
                      echo"   
                        <div class='card tag'>
                          <div class='card-text'>{$tag}</div>
                        </div>
                        
                      
                      ";
                      }
                      echo"
                    </div>
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
} else {
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
