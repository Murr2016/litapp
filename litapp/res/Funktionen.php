<?php
require_once("settings.php");

// FUNKTIONEN ALLE STORIES

//  Funktion array_multi_search von https://sklueh.de/2012/11/mit-php-ein-mehrdimensionales-array-durchsuchen/
// Funktion zur Bestimmung der letzten Kinder


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

//  Funktion get_all_stories ()


function get_all_stories ()
{
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


	// ENDPUNKT VON DEM AUSGEHEND DER BAUM ERSTELLT WIRD
	$All_Stories = "";
	$Anzahl_Sentences = count($Sentences)-1;

	foreach($ID_Endpunkte as $Select) {

		$ii = $Select;
		for ($i = $Anzahl_Sentences; $i >= 0; $i--)
		{
			if ($Sentences[$i]["ID"] == $ii)
			{
				$Zwischenspeicher = $Sentences[$i]["Text"].SENTENCE_SEPERATOR.$All_Stories;
				$All_Stories = $Zwischenspeicher;
				$Zwischenspeicher = "";
				$ii = $Sentences[$i]["ID_Parent"];
			} {
			// ELSE
			// MUSS LEER BLEIBEN
			}

		}
		$All_Stories = STORY_SEPERATOR.$All_Stories;  //Abstand zwischen den einzelnen Stories
	}

	return($All_Stories);
}


/****************
** 	Funktion get_random_Text
**	Funktion: Wählt einen Ast des Baumes aus und gibt ihn zurück
**
****/

function get_random_story ()
{
	$Story_chronologisch = "";
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

	$max = count($ID_Endpunkte) -1;
	$random = mt_rand(ANZAHL_BAEUME, $max);

	// ENDPUNKT VON DEM DER BAUM ERSTELLT WERDEN MUSS ->
	$Selected_Endpunkt = $ID_Endpunkte[$random];
	$Anzahl_Sentences = count($Sentences)-1;
	$ii = $Selected_Endpunkt;
	$Random_Story = "";

	for ($i = $Anzahl_Sentences; $i >= 0; $i--)
	{
		if ($Sentences[$i]["ID"] == $ii)
		{
			$Zwischenspeicher = $Sentences[$i]["Text"]."<br>".$Random_Story;
			$Random_Story = $Zwischenspeicher;
			$Zwischenspeicher = "";
			$ii = $Sentences[$i]["ID_Parent"];
		}
	}
	return($Random_Story);
}


//einen einzelnen zufälligen Post
function get_random_post () {


	$db_link = mysqli_connect (
		MYSQL_HOST,
		MYSQL_BENUTZER,
		MYSQL_KENNWORT,
		MYSQL_DATENBANK);

	$sql = "SELECT MAX(ID) FROM Sentences";
		$row = mysqli_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());
		$ret = mysqli_fetch_array($row);
		$Anzahl = $ret["MAX(ID)"];
		if($Anzahl == 0)
		{
			$Parent_Node['ID'] = 0;
		}else {
			$Parent_Node['ID'] = mt_rand(ANZAHL_BAEUME, $Anzahl);
		}

	$sql = "SELECT * FROM Sentences WHERE ID = ".$Parent_Node['ID'].";";
		$row = mysqli_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());
		$ret = mysqli_fetch_array($row);
		$Parent_Node['Text'] = $ret["Text"];
		mysqli_close($db_link);

		return($Parent_Node);


}

// Chronologisch - Einfach
function get_all_sentences ()
{
	$Story_chronologisch = "";
	require_once("../res/settings.php");
	$db_link = mysqli_connect (
		MYSQL_HOST,
		MYSQL_BENUTZER,
		MYSQL_KENNWORT,
		MYSQL_DATENBANK);

	$sql = "SELECT Text FROM Sentences;";

	$output = mysqli_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());

	while ($sentence = mysqli_fetch_array($output, MYSQL_ASSOC)) {
    $Story_chronologisch = $Story_chronologisch."<br>".$sentence["Text"];
	}
	mysqli_close($db_link);
	return($Story_chronologisch);
}
// TABELLARISCH
function get_all_sentences_table ()
{
	$Story_chronologisch = "";
	require_once("../res/settings.php");
	$db_link = mysqli_connect (
		MYSQL_HOST,
		MYSQL_BENUTZER,
		MYSQL_KENNWORT,
		MYSQL_DATENBANK);

	$sql = "SELECT * FROM Sentences;";

	$output = mysqli_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());

	$Story_Tabelle = '<table border="1">';
		while ($zeile = mysqli_fetch_array( $output, MYSQL_ASSOC))
		{
		  $Story_Tabelle .= "<tr>";
		  $Story_Tabelle .= "<td>". $zeile["ID"] . "</td>";
		  $Story_Tabelle .= "<td>". $zeile["ID_Parent"] . "</td>";
		  $Story_Tabelle .= "<td>". $zeile["Text"]. "</td>";
		  $Story_Tabelle .= "<td>". $zeile["HasChildren"] . "</td>";
		  $Story_Tabelle .= "</tr>";
	}
	$Story_Tabelle .= "</table>";
	return($Story_Tabelle);

	mysqli_free_result( $output );
}

// Exports all sentences into a re-importable .sql script (insert statements)
function export_sentences () {
  // connect to db and fetch all sentences
  $db_link = mysqli_connect (MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);
  $sql = "SELECT * FROM Sentences;";
  $result = mysqli_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());
  // init new sql script
  $sql_export = "INSERT INTO Sentences(`ID`, `ID_Parent`, `Text`, `HasChildren`) VALUES";
  while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    $sql_export .= "\n(" . $row['ID'] . ", " . $row['ID_Parent'] . ', "'.$row['Text'].'", ' . $row['HasChildren'] . "),";
  }
  $sql_export = rtrim($sql_export, ','); // remove trailing row separator
  $sql_export .= ";";
  // output sql script
  echo $sql_export;
  // close connection and free result
  mysqli_free_result($result);
}

// Executes @param sql in the database
function sql_execute ($sql) {
  // connect to db and fetch all sentences
  $db_link = mysqli_connect (MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);
  $result = mysqli_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());
  mysqli_free_result($result);
}

// Schreibt in die DB (form_handler)
function put_to_DB($ID_Parent, $Text) {
	
	$db_link = mysqli_connect (
		MYSQL_HOST, 
		MYSQL_BENUTZER, 
		MYSQL_KENNWORT, 
		MYSQL_DATENBANK);
	if ($ID_Parent != 0) {	
	$esc_Text = mysqli_escape_string($db_link, $Text);
	$sql = "INSERT INTO Sentences 
		(ID, ID_Parent, Text, HasChildren) VALUES (NULL, '$ID_Parent','$esc_Text', 0); UPDATE Sentences SET HasChildren = 1 WHERE ID = $ID_Parent;";
		$db_erg = mysqli_multi_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());	
	} else {
	$esc_Text = mysqli_escape_string($db_link, $Text);
	$sql = "INSERT INTO Sentences 
		(ID, ID_Parent, Text, HasChildren) VALUES (NULL, '$ID_Parent', '$esc_Text', 0);";
		$db_erg = mysqli_query($db_link, $sql) or die("Anfrage fehlgeschlagen: " . mysqli_error());			
	}
		
		mysqli_close($db_link);
}


?>
