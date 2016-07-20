<?php
/***************
**
** Funktionen LitApp
**
**
*****/


/**************** 
**
** FUNKTIONEN ALLE STORIES
** 
****/

/*
**  Funktion array_multi_search von https://sklueh.de/2012/11/mit-php-ein-mehrdimensionales-array-durchsuchen/
*/

function array_multi_search($mSearch, $aArray, $sKey = "")
{
    $aResult = array();
   
    foreach( (array) $aArray as $aValues)
    {
        if($sKey === "" && in_array($mSearch, $aValues)) $aResult[] = $aValues;
        else
        if(isset($aValues[$sKey]) && $aValues[$sKey] == $mSearch) $aResult[] = $aValues;
    }
   
    return $aResult;
}

/*
**  Funktion get_all_stories ()
*/

function get_all_stories () 
{
	// $Story_chronologisch = "";
	require_once("../res/settings.php");
	$db_link = mysqli_connect (
		MYSQL_HOST, 
		MYSQL_BENUTZER, 
		MYSQL_KENNWORT, 
		MYSQL_DATENBANK);
		
	$sql = "SELECT * FROM Sentences;";
	$output = mysqli_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());
	
	
	while ($zeile = mysqli_fetch_array( $output, MYSQL_ASSOC)) {

		 $Sentences[] = $zeile;
		}
	
	mysqli_free_result( $output );
	
	$Endpunkte = array_multi_search(0, $Sentences, "HasChildren");
	
	foreach($Endpunkte as $Value)
	{
		$ID_Endpunkte[] = $Value["ID"]; 
	}
	
	
	// ENDPUNKT VON DEM AUSGEHEND DER BAUM ERSTELLT WIRD ->
	$All_Stories = "";
	$Anzahl_Sentences = count($Sentences)-1;  
	
	foreach($ID_Endpunkte as $Select) {
	
		$ii = $Select;
		for ($i = $Anzahl_Sentences; $i >= 0; $i--) 
		{
			if ($Sentences[$i]["ID"] == $ii) 
			{
				$Zwischenspeicher = $Sentences[$i]["Text"].$Sentence_Seperator.$All_Stories;
				$All_Stories = $Zwischenspeicher; 
				$Zwischenspeicher = ""; 
				$ii = $Sentences[$i]["ID_Parent"];
			}
		}
		$All_Stories = $Story_Seperator.$All_Stories;  //Abstand zwischen den einzelnen Stories 
	}
	return($All_Stories); 
}



?>