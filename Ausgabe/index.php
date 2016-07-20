<?php
session_start();
require_once("../res/settings.php"); 
require_once("../res/Funktionen.php");  

if (isset($_GET['Ausgabe'])) {
		$Ausgabe = $_GET['Ausgabe'];
	} else
	{
		$Ausgabe = "";
	}

 
switch ($Ausgabe) {
	
	case "random_story":
	$output = get_random_story();
	break;
	
	case "all_stories":
	$output = get_all_stories();
	break;
	
	case "chronological_table":
	$output = get_all_sentences_table ();
	break;
	
	case "chronologically":
	$output = get_all_sentences (); 
	break;
	
	default:
	$output = "Choose your Weapons!"; 
	
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<p><?=nl2br($output)?></p>
</body>
</html>