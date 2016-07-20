<?php
/**********
**
** In dieser Datei werden die Parameter gesetzt.
**
*****/

////
// SCHREIBEN
///

define ('ANZAHL_BAEUME', 0); //0 = mehrere Bäume; 1 = nur ein Baum.

////
// DATENBANKSETTINGS
///

error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank
define ( 'MYSQL_HOST', 'localhost' );

// bei XAMPP ist der MYSQL_Benutzer: root
define ( 'MYSQL_BENUTZER',  'root' );
define ( 'MYSQL_KENNWORT',  '' );
// für unser Bsp. nennen wir die DB adressverwaltung
define ( 'MYSQL_DATENBANK', 'LitAppDB' );
define ( 'MYSQL_TABELLE', 'Sentences');


////
// AUSGABE
///

define('SENTENCE_SEPERATOR', " | ");
define('STORY_SEPERATOR', '<br><br>');



?>
