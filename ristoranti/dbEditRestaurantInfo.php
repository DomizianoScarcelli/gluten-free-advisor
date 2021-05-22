<?php
    
    /* Codice per l'aggiunta di informazioni e foto per il ristorante */
    
    //Debugging
    echo "arrivato fin qui";

    include '../dbManager/dbConnect.php';

    /*
    $total = count($_FILES['file']['name']);
    
    $fileArray = array();
    // Loop through each file
    for ($i = 0; $i < $total; $i++) {
        //Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'][$i];
        //Make sure we have a file path
        if ($tmpFilePath != "") {
            //Setup our new file path
            $newFilePath = "../img/upload/" . $_FILES['file']['name'][$i];
            //Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                //Handle other code here
            }
        }
        array_push($fileArray, $_FILES['file']['name'][$i]);
    }
    $encodedFileArray = json_encode($fileArray); 


    if (isset($_POST['image'])) {
        $image = $_POST['image'];
    } else {
        $image = 0;
    }*/

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

    $id_ristorante = $_POST['id_ristorante'];

    //Debugging
    echo "arrivato fin qui";

    $query2 = "UPDATE dati_ristoranti SET descrizione = '$description', tags = '$tags' WHERE id = '$id_ristorante'";

    //listaFoto = $encodedFileArray

    $result = mysqli_query($conn, $query2) or trigger_error(mysqli_error($conn));
    //or die (mysqli_error($conn))

    echo $result;
