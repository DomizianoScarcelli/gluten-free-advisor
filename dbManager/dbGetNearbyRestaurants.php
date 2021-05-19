<?php

include 'dbConnect.php';
include 'functions.php';

$coordinates = get_user_coordinates();


$order = "order by pow((t.latitudine - $coordinates[0]),2) + pow((t.longitudine - $coordinates[1]),2);";
//Select all rows
$sql = "SELECT * FROM dati_ristoranti t $order";



$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    $count = 0;
    //Itera sulle righe risultato della query
    while (($row = mysqli_fetch_assoc($result)) && $count < 6) {
        $photoArray = json_decode($row["listaFoto"]);
        $distance = get_distance($coordinates[0], $coordinates[1], $row['latitudine'], $row['longitudine']);
        if ($distance < 10) {
            $count++;
            echo "
                        <div class='col'>
                            <div class='card' id='{$row['id']}' onclick='redirectRestaurant(this)'>
                                <img class='card-image' src='img/upload/{$photoArray[0]}'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$row["nome"]}</h5>
                                    <p class='card-address'>{$row["indirizzo"]}</p>
                                </div>
                            </div>
                        </div>
            
            ";
        }
    }
}
