<?php
if(!isset($_COOKIE['admin']))
{
header("Location: LoggIn.php");
}
echo 'Admin inloggad';

?>