<?php
#dubbelkollar att user fortfarande är inloggad
if(!isset($_COOKIE['user']))
{
header("Location: LoggIn.php");
}
echo $_COOKIE['user']."'s feed<br>";
?>

<html>
<!-- Sökruta -->
<form action="Search.php" method="POST">
Sök på användare: <input type="text" name="searchUsername">
<input type="submit">
<br><br>
</form>
<!-- Posta eller logga ut -->
<A HREF=Post.php>Post</A><br>
<A HREF=LoggOut.php>Logg Out</A><br>
</html>

<?php

?>