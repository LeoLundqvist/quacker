<?php
$username = $_POST["username"];
$password = hash('sha256', $_POST["password"]);

$db = new SQLite3('USER.sq3'); #vilken databas öppnar vi? 

$db->exec("CREATE TABLE IF NOT EXISTS USER(USER_ID integer primary key autoincrement, USERNAME text unique, GMAIL text unique, PASSWORD text)"); #Skapa tabellen direkt i PHP... 

$allInputQuery = "SELECT * FROM USER"; #vilket kommando vill vi köra? 
$userList = $db->query($allInputQuery); #en ny array som innehåller all information

#om någon loggar in på admin
if($username == 'admin' && $_POST["password"] == 123)
{
    setcookie("admin", true, time()+(86400*30),'/');
    header("Location: Admin.php");
}

while ($row = $userList->fetchArray(SQLITE3_ASSOC))#SQLITE3_ASSOC är en funktion i SQLite3 som hämtar info från 
{ 
    #kollar ifall användarnamnet och lösenordet stämmer överens med user tabell rowen
    if($username == $row['USERNAME'] || $username == $row['GMAIL'])
    {
        if($password == $row['PASSWORD'])
        {
            #skapar user cookie som sparar användarnamnet
            setcookie("user", $username, time()+(86400*30),'/');
            header("Location: Feed.php");
        }
        
    }
}
echo "Finns inte";
?>
<html>
<A HREF=LoggIn.php>Försök igen</A>
</html>
