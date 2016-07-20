<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once ('settings.php');

/* DATENBANK SCHREIB-FUNKTION */
function put_to_DB() {
	$Text = $_POST["Input_Text"];
	$ID_Parent = $_POST["ID_Parent"];
	
	 
	$db_link = mysqli_connect (
		MYSQL_HOST, 
		MYSQL_BENUTZER, 
		MYSQL_KENNWORT, 
		MYSQL_DATENBANK);
	if ($ID_Parent != 0) {	
	$sql = "INSERT INTO Sentences 
		(ID, ID_Parent, Text, HasChildren) VALUES (NULL, '$ID_Parent', '$Text', 0); UPDATE Sentences SET HasChildren = 1 WHERE ID = $ID_Parent;";
		$db_erg = mysqli_multi_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());	
	} else {
	$sql = "INSERT INTO Sentences 
		(ID, ID_Parent, Text, HasChildren) VALUES (NULL, '$ID_Parent', '$Text', 0);";
		$db_erg = mysqli_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());			
	}
		
		mysqli_close($db_link);
}

put_to_DB();
header('Location: ../index.php');
?>