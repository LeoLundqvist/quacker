<?php
if(!isset($_COOKIE["user"]))
{
    header("Location: LoggIn.php");
}
$profileUsername = $_POST["profileUsername"];
echo $profileUsername;

?>

<html>
<A HREF=Feed.php>Feed</A>
</html>