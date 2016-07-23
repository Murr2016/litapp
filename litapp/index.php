<?php
session_start();
require_once("res/settings.php"); 
require_once("res/Funktionen.php"); 

// Zufällige Hintergrundfarbe
$Hintergrund_Farben = array ( 0 => "#F60", 1 => "#CF0", 2 => "#3CF", 3 => "#09F", 4 => "#3C0", 5 => "#F90", 6 => "#3CC", 7 => "#69F", 8 => "#F3C", 9 => "#FFF", 10 => "#C3C3C3", 11 => "#F03"); 

$Hintergrund = $Hintergrund_Farben[mt_rand(0,11)];



?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<script src="res/stretchy.js" async> </script>
<script>
function setFocusToTextBox(){
    document.getElementById("Input_Text").focus();
}

</script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>LitApp</title>
<style>

@font-face { font-family: 'Akzidenz'; src: url('res/AkzidenzGroteskLight.otf') format('opentype'); }

Html, body {
	margin:0;
	padding:0;
	font-family: Akzidenz;
	font-size:20px;
	background:<?=$Hintergrund?>;
	
	}
#Eingabe {
	font-family: Akzidenz;
	font-size:20px;
	font-weight:lighter;
	width:100%;
	background-color:<?=$Hintergrund?>;
	border:none;
	}
p {
	width:80%;
	text-align:justify;
	margin-left:10%;
	margin-top:20px;
	}
	
#Descr {
	font-size:10px;
	text-align:left;
	margin-top:10px;
	}	


#Header {
	width:100%;
	top:0px;
	height:50px;
	}
	
#Logo {
	position:relative;
	left:10%;
	top:30px;
	width:50px;
	height:auto;
	}
</style>

<?php $random = get_random_post(); ?>
</head>

<body onload="setFocusToTextBox();" onmousemove="setFocusToTextBox();" onclick="setFocusToTextBox();">
<Div id="Header"><img src="res/Logo.png" id="Logo"/></Div>
<p onmouseover="setFocusToTextBox();" onmousemove="setFocusToTextBox();" onmouseup="setFocusToTextBox();"><?=$random['Text']?></p>
<form name="LitApp" Id="LitApp" method="post" action="res/form_handler.php">
  <p>
    <textarea name="Eingabe" id="Eingabe"></textarea> 
	<script type="text/javascript">
document.getElementById('Eingabe').onkeydown = function(e){
      e = e || window.event;
      var key = e.keyCode || e.which || e.charCode, shift = e.modifiers ? e.modifiers & Event.SHIFT_MASK : e.shiftKey;
      if(key == 13 && !shift){
        if(document.getElementById('Eingabe').value != "") {
		document.LitApp.submit.click();
		}else {
			return false;
			}
        return false;
      }
    }
	</script>
  </p>
  <p id="Descr">Save with ENTER | Add a new line with SHIFT+ENTER.</p>
  <p>
    <input type="text" name="ID_Parent" id="ID_Parent" value="<?=$random['ID']?>" style="visibility:hidden;"/>
  </p>
  <p>
    <input type="submit" name="Submit" id="submit" value="Submit" style="visibility:hidden;" readonly="readonly"/>
  </p>
</form>

</body>
</html>