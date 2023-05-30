<?php
if(!isset($_COOKIE['user']))
{
header("Location: LoggIn.php");
}
$searchUsername = $_POST["searchUsername"];

$db = new SQLite3('USER.sq3'); #vilken databas öppnar vi? 
$allInputQuery = "SELECT * FROM USER"; #vilket kommando vill vi köra? 
$userList = $db->query($allInputQuery); #en ny array som innehåller all information

$found = false;

while ($row = $userList->fetchArray(SQLITE3_ASSOC))#SQLITE3_ASSOC är en funktion i SQLite3 som hämtar info från 
{ 
    #kollar ifall användarnamnet stämmer överens med det du sökte på och så att du inte söker på dig själv
    if($searchUsername == $row['USERNAME'] && $searchUsername != $_COOKIE['user'])
    {
        $found = true;
        echo $row['USERNAME'];
        ?>
        <html>
        <!-- skickar username på profilen du klickar på till nästa sida (profile.php) -->
            <form action ="Profile.php" method=post> 
            <input type = "hidden" name = "profileUsername" value = "<?php echo $row['USERNAME'];?>" method="POST">
            <input type = "submit">
            </form>
            <br>
        </html>
        <?php
        break;
    }
}
#om man inte hittar profilen eller om den är samma som ditt namn
if($found == false)
{
    echo 'The user "'.$searchUsername.'" does not exist<br>';
}
?>

<html>
<A HREF=Feed.php>Feed</A>
</html>
