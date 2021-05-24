<?php
include 'dbConnect.php';

$name = str_replace("'", "''", $_POST['name']);
$subject = str_replace("'", "''", $_POST['subject']);
$email = str_replace("'", "''", $_POST['email']);
$message = str_replace("'", "''", $_POST['message']);


$sql = "INSERT INTO `messaggi` (`nome`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message')";

$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

echo $result;