 <?php
    /**
     * Codice per l'aggiunta di un ristorante nel database.
     *Questo avviene quando l'utente compila tutti i campi necessari nel form presente nella home page.ø
     */
    include 'dbConnect.php';

    $name = $_POST['name'];
    $address = $_POST['address'];

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

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
        $tags = json_encode(['niente']); //bug
    }

    $price = 0;

    $sql = "INSERT INTO `dati_ristoranti` (indirizzo, nome, latitudine, longitudine, prezzo, descrizione, listaFoto, tags, google) VALUES ('$address', '$name','$latitude','$longitude','$price','$description','$image','$tags', 0)";

    $result = mysqli_query($conn, $sql);

    echo $result;
