<?php
#kollar att man fortfarande är inloggad
if(!isset($_COOKIE['admin']))
{
header("Location: LoggIn.php");
}
echo 'Users waiting to be accepted: <br>';

#user_Waiting tabell 
$user_Waiting_db = new SQLite3('USER_WAITING.sq3'); 
#skapar tabel ifall den inte redan finns
$user_Waiting_db->exec("CREATE TABLE IF NOT EXISTS USER_WAITING(USER_ID integer primary key autoincrement, USERNAME text unique, GMAIL text unique, PASSWORD text)"); 
$user_Waiting_AllInputQuery = "SELECT * FROM USER_WAITING";
$user_Waiting_UserList = $user_Waiting_db->query($user_Waiting_AllInputQuery);
$i = 0;

while ($row = $user_Waiting_UserList->fetchArray(SQLITE3_ASSOC))
{
    $i++;
    echo "<br>User ".$i.": ".$row["USERNAME"].", Gmail: ".$row["GMAIL"];
    ?>
        <html>
            <form action ="AdminAccept.php" method=post> 
            <!-- skickar USER_ID på profilen du klickar på till nästa sida (profile.php) -->
            <input type = "hidden" name = "User_ID" value = "<?php echo $row['USER_ID'];?>" method="POST">
            <input type = "hidden" name = "Accepted" value = "yes" method="POST">
            <input type = "submit" value = "Acceptera">
            </form>

            <form action ="AdminAccept.php" method=post> 
            <!-- skickar USER_ID på profilen du klickar på till nästa sida (profile.php) -->
            <input type = "hidden" name = "User_ID" value = "<?php echo $row['USER_ID'];?>" method="POST">
            <input type = "hidden" name = "Accepted" value = "no" method="POST">
            <input type = "submit" value = "Inte Acceptera">
            </form>

        </html>
    <?php
    echo "<br>";
}
#om det inte finns något värde i USER_WAITING tabellen
if($i == 0)
{
    echo "Noone is waiting to be accepted<br>";
}
?>

<html>
<A HREF=LoggOut.php>Logg Out</A><br>
</html>