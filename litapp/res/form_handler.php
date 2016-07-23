<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once ('settings.php');
require_once ('Funktionen.php'); 
/* DATENBANK SCHREIB-FUNKTION */

$ID = $_POST['ID_Parent'];
$Eingabe = $_POST['Eingabe']; 


put_to_DB($ID, $Eingabe);
header('Location: ../index.php'); 

?>