<?php
header("Content-disposition: attachment; filename=export.sql");
require_once("res/Funktionen.php");
export_sentences();
?>
