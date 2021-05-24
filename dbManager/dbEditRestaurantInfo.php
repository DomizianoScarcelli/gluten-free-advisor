<?php
    
    /* Codice per l'aggiunta di informazioni e foto per il ristorante */

    include 'dbConnect.php';

    $id_ristorante = $_POST['id_ristorante'];

    $fotoquery = "SELECT listaFoto FROM dati_ristoranti WHERE id = '$id_ristorante'";  //Seleziona la lista delle foto del ristorante corrente (serve per nome e indirizzo)
    $resultquery = mysqli_query($conn, $fotoquery);
    while ($row = mysqli_fetch_assoc($resultquery)) {
   
        //print_r($row);
        //print_r(($row['listaFoto']));
        //Prende il valore corrispondente alla chiave listaFoto nell'oggetto risultato della query e lo converte in un array associativo di php
        $fotoarray = json_decode($row['listaFoto']);

        if (empty($_FILES)) {

            /*Ramo senza caricamento di immagini*/

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
                $tags = json_encode(['niente']);
            }

            $query2 = "UPDATE dati_ristoranti SET descrizione = '$description', tags = '$tags' WHERE id = '$id_ristorante'";
            
        }
        else {

            /*Ramo con caricamento di immagini*/

            //Loop per il corretto caricamento dei file delle immagini
            $total = count($_FILES['file']['name']);
            $fileArray = array();
            for ($i = 0; $i < $total; $i++) {
                $tmpFilePath = $_FILES['file']['tmp_name'][$i];
                if ($tmpFilePath != "") {
                    $newFilePath = "../img/upload/" . $_FILES['file']['name'][$i];
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        //...
                    }
                }
                array_push($fileArray, $_FILES['file']['name'][$i]);
            }
            //print_r($fileArray);
            $merge = array_merge($fotoarray, $fileArray);
            //print_r($merge);
            $encodedFileArray = json_encode($merge); 
            //print_r($encodedFileArray);      

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
                $tags = json_encode(['niente']);
            }

            $query2 = "UPDATE dati_ristoranti SET descrizione = '$description', listaFoto = '$encodedFileArray', tags = '$tags' WHERE id = '$id_ristorante'";

            }
    }

    $result = mysqli_query($conn, $query2) or trigger_error(mysqli_error($conn));
            //or die (mysqli_error($conn))
    
    echo $result;

?>