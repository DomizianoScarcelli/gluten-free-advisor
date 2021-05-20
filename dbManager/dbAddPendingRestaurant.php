 <?php
    /**
     * Codice per l'aggiunta di un ristorante nel database.
     *Questo avviene quando l'utente compila tutti i campi necessari nel form presente nella home page.ø
     */
    include 'dbConnect.php';
    if (isset($_FILES['file'])) {
        $total = count($_FILES['file']['name']);
        $fileArray = array();
        // Loop through each file
        for ($i = 0; $i < $total; $i++) {
            //Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
            //Make sure we have a file path
            if ($tmpFilePath != "") {
                //Setup our new file path
                $newFilePath = "../img/pendingUpload/" . $_FILES['file']['name'][$i];
                //Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    //Handle other code here
                }
            }
            array_push($fileArray, $_FILES['file']['name'][$i]);
        }
        $encodedFileArray = json_encode($fileArray);
    } else {
        $encodedFileArray = json_encode([]);
    }



    $name = str_replace("'", "''",$_POST['name']);

    if (isset($_POST['address'])) {
        $address = str_replace("'", "''", $_POST['address']);
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
    } else {
        $address = null;
        $latitude = null;
        $longitude = null;
    }

    if (isset($_POST['citta'])) {
        $city = str_replace("'", "''", $_POST['citta']);
    } else {
        $city = null;
    }


    if (isset($_POST['image'])) {
        $image = $_POST['image'];
    } else {
        $image = 0;
    }

    if (isset($_POST['description'])) {
        $description = str_replace("'", "''", $_POST['description']);
    } else {
        $description = 0;
    }

    if (isset($_POST['tags'])) {
        $tags = json_encode($_POST['tags']);
    } else {
        $tags = json_encode([]);
    }

    $price = 0;

    if ($address) {
        $sql = "INSERT INTO `ristoranti_da_verificare` (indirizzo, nome, latitudine, longitudine, descrizione, listaFoto, tags, google) VALUES ('$address', '$name','$latitude','$longitude','$description','$encodedFileArray','$tags', 0)";
    } else {
        $sql = "INSERT INTO `ristoranti_da_verificare` (citta, nome, descrizione, listaFoto, tags, google) VALUES ('$city', '$name','$description','$encodedFileArray','$tags', 0)";
    }

    $result = mysqli_query($conn, $sql);

    echo $result;
