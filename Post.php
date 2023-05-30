<?php
if(!isset($_COOKIE['user']))
{
    header("Location: LoggIn.php");
}
?>

<html>
<body>
<head><title>Posta</title></head>
<form action="PostUpload.php" method="POST">
Upload text:<br><textarea rows = "5" cols = "80" name = "uploadText">
</textarea><br>

<input type="submit" value="Submit">
<br><br>

</form>
</body>
</html>
