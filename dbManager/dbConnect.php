<?php

/**
 * Codice per la connessione al database phpMyAdmin in localhost
 */
$dbServername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'ristoranti';

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
