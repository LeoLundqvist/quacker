<?php
$USER_ID = $_POST["User_ID"];
$Accepted = $_POST["Accepted"];


#fixa hash lösenord genom 
#lösen ord längd krav
#bättre lösen ord utan tecken



#öppnar databasen USER.sq3
$user_db = new SQLite3('USER.sq3'); 
#Skapar tabellen direkt i PHP om den inte finns
$user_db->exec("CREATE TABLE IF NOT EXISTS USER(USER_ID integer primary key autoincrement, USERNAME text unique, GMAIL text unique, PASSWORD text)");
#Kommandot jag använder
$user_AllInputQuery = "SELECT * FROM USER";
$user_UserList = $user_db->query($user_AllInputQuery); #en ny array som innehåller all information

#User Waiting tabellen
$user_Waiting_db = new SQLite3('USER_WAITING.sq3'); 
$user_Waiting_db->exec("CREATE TABLE IF NOT EXISTS USER_WAITING(USER_ID integer primary key autoincrement, USERNAME text unique, GMAIL text unique, PASSWORD text, ACCEPTED bool)"); 
$user_Waiting_AllInputQuery = "SELECT * FROM USER_WAITING"; #vilket kommando vill vi köra? 
$user_Waiting_UserList = $user_Waiting_db->query($user_Waiting_AllInputQuery); #en ny array som innehåller all information

$i = 0;
echo "blbalalbla";
while ($row = $user_Waiting_UserList->fetchArray(SQLITE3_ASSOC))#SQLITE3_ASSOC är en funktion i SQLite3 som hämtar info från 
{
    $i++;
    echo "loop nr:".$i."<br>";
    if($USER_ID ==  $row["USER_ID"])
    {
        echo $USER_ID." stämmer med user_ID".$row["USER_ID"]." i loop".$i."<br>";

        if($Accepted == "yes")
        {
            $user_db->exec("INSERT INTO USER(USERNAME, GMAIL, PASSWORD) VALUES('".$row["USERNAME"]."', '".$row["GMAIL"]."', '".$row["PASSWORD"]."')");
            $user_Waiting_db->exec("DELETE FROM USER_WAITING WHERE USER_ID == $USER_ID");
            #skicka mail

            echo "accepterar user_ID ".$row["USER_ID"]."<br>";

            break;
            #header("Location: Admin.php");
        }
        else if($Accepted == "no")
        {
            $user_Waiting_db->exec("DELETE FROM USER_WAITING WHERE USER_ID == $USER_ID");
            echo "tar bort user_ID ".$row["USER_ID"]."<br>";

        }
    }
    echo "<br>";
}
?>