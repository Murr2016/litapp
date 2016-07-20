<?php
session_start();
require_once("res/settings.php"); 
require_once("res/Funktionen.php"); 
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
<title>CortonaDairy Machine</title>
<style>

@font-face { font-family: 'Akzidenz'; src: url('res/AkzidenzGroteskLight.otf') format('opentype'); }
@font-face { font-family: 'Logo'; src: url('res/AkzidenzGroteskMedium.otf') format('opentype'); }

Html, body {
	margin:0;
	padding:0;
	font-family: Akzidenz;
	font-size:20px;
	background:#CF0;
	
	}
#Input_Text {
	font-family: Akzidenz;
	font-size:20px;
	font-weight:lighter;
	width:100%;
	background-color:#CF0;
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
    <textarea name="Input_Text" id="Input_Text"></textarea> 
	<script type="text/javascript">
document.getElementById('Input_Text').onkeydown = function(e){
      e = e || window.event;
      var key = e.keyCode || e.which || e.charCode, shift = e.modifiers ? e.modifiers & Event.SHIFT_MASK : e.shiftKey;
      if(key == 13 && !shift){
        if(document.getElementById('Input_Text').value != "") {
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