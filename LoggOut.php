<?php
#tar bort cookies och skickar till LoggIn.php
setcookie("user", "", time() - 10, '/');
setcookie("admin", "", time() - 10, '/');
header("Location: LoggIn.php");
?>