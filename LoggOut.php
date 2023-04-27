<?php
setcookie("user", "", time() - 10, '/');
header("Location: LoggIn.php");
?>