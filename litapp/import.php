<?php
require_once("res/Funktionen.php");

// Process uploaded file (if any)
if(isset($_POST["submit"])) {
    echo $_FILES['uploadedfile']['tmp_name'];
}
?>
<!DOCTYPE html>
<html>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    Select SQL Script to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload SQL Script" name="submit">
</form>

</body>
</html>
