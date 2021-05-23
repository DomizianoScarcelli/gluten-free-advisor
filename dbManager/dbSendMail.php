<?php
include 'dbConnect.php';

$name = htmlspecialchars ($_POST['name']);
$subject = htmlspecialchars ($_POST['subject']);
$email = htmlspecialchars ($_POST['email']);
$message = htmlspecialchars ($_POST['message']);


$sql = "INSERT INTO `messaggi` (`nome`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message')";

$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

echo $result;