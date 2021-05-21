<?php
    
    /* Codice per l'aggiunta di informazioni e foto per il ristorante */
    
    include 'dbConnect.php';

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

    $sql = "UPDATE recensioni SET descrizione = $description, listaFoto = $encodedFileArray, tags = $tags WHERE id = id_ristorante";

    $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

    echo $result;
