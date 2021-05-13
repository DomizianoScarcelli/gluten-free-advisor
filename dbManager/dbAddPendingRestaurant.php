 <?php
    /**
     * Codice per l'aggiunta di un ristorante nel database.
     *Questo avviene quando l'utente compila tutti i campi necessari nel form presente nella home page.ø
     */
    include 'dbConnect.php';

    $name = $_POST['name'];

    if (isset($_POST['address'])) {
        $address = $_POST['address'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
    } else {
        $address = null;
        $latitude = null;
        $longitude = null;
    }

    if (isset($_POST['citta'])) {
        $city = $_POST['citta'];
    } else {
        $city = null;
    }

    
    if (isset($_POST['image'])) {
        $image = $_POST['image'];
    } else {
        $image = 0;
    }

    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        $description = 0;
    }

    if (isset($_POST['tags'])) {
        $tags = json_encode($_POST['tags']);
        
    } else {
        $tags = json_encode([]); //bug
    }

    $price = 0;
    
    if ($address){
          $sql = "INSERT INTO `ristoranti_da_verificare` (indirizzo, nome, latitudine, longitudine, prezzo, descrizione, listaFoto, tags, google) VALUES ('$address', '$name','$latitude','$longitude','$price','$description','$image','$tags', 0)";
    }else{
          $sql = "INSERT INTO `ristoranti_da_verificare` (citta, nome, prezzo, descrizione, listaFoto, tags, google) VALUES ('$city', '$name','$price','$description','$image','$tags', 0)";
    }

    $result = mysqli_query($conn, $sql);

    echo $result;
