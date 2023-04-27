<?php
if(!isset($_COOKIE['user']))
{
header("Location: LoggIn.php");
}


echo $_COOKIE['user'];
?>
<html>

<form action="Search.php" method="POST">
Sök på användare: <input type="text" name="searchUsername">
<input type="submit">
<br><br>
</form>

<A HREF=Post.php>Post</A><br>
<A HREF=LoggOut.php>Logg Out</A><br>
</html>

<?php


?>