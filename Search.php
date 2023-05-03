<?php
$searchUsername = $_POST["searchUsername"];

$db = new SQLite3('USER.sq3'); #vilken databas öppnar vi? 

$db->exec("CREATE TABLE IF NOT EXISTS USER(USER_ID integer primary key autoincrement, USERNAME text unique, PASSWORD text)"); #Skapa tabellen direkt i PHP... 

$allInputQuery = "SELECT * FROM USER"; #vilket kommando vill vi köra? 
$userList = $db->query($allInputQuery); #en ny array som innehåller all information

while ($row = $userList->fetchArray(SQLITE3_ASSOC))#SQLITE3_ASSOC är en funktion i SQLite3 som hämtar info från 
{ 
    #kollar ifall användarnamnet och lösenordet stämmer överens med user tabell rowen
    if($searchUsername == $row['USERNAME'])
    {
        #skapar user cookie som sparar användarnamnet
        echo $row['USERNAME'];
        ?>
        <html>
        <!-- skickar username på profilen du klickar på till nästa sida (profile.php) -->
            <form action ="Profile.php" method=post> 
            <input type = "hidden" name = "profileUsername" value = "<?php echo $row['USERNAME'];?>">
            <input type = "submit">
            </form>
        </html>
        <?php
    }
}

?>