<?php
$USER_ID = $_POST["User_ID"];
$Accepted = $_POST["Accepted"];

#öppnar databasen USER.sq3
$user_db = new SQLite3('USER.sq3'); 
$user_db->exec("CREATE TABLE IF NOT EXISTS USER(USER_ID integer primary key autoincrement, USERNAME text unique, GMAIL text unique, PASSWORD text)");
$user_AllInputQuery = "SELECT * FROM USER";
$user_UserList = $user_db->query($user_AllInputQuery);

#User Waiting tabellen
$user_Waiting_db = new SQLite3('USER_WAITING.sq3'); 
$user_Waiting_db->exec("CREATE TABLE IF NOT EXISTS USER_WAITING(USER_ID integer primary key autoincrement, USERNAME text unique, GMAIL text unique, PASSWORD text)"); 
$user_Waiting_AllInputQuery = "SELECT * FROM USER_WAITING";
$user_Waiting_UserList = $user_Waiting_db->query($user_Waiting_AllInputQuery); 

while ($row = $user_Waiting_UserList->fetchArray(SQLITE3_ASSOC))
{
    if($USER_ID ==  $row["USER_ID"])
    {
        #om man blir accepterad
        if($Accepted == "yes")
        {
            $message = "Your account named ".$row["USERNAME"]." got accepted into quacker!";
            #maila funkar inte i Apache så jag kommenterar bara ut mail koden
            #mail($row["GMAIL"], "AdminGmailExample@gmail.com", $message);

            #sätter in användar informationen i USER tabellen och sedan tas det bort från USER_WAITING tabellen
            $user_db->exec("INSERT INTO USER(USERNAME, GMAIL, PASSWORD) VALUES('".$row["USERNAME"]."', '".$row["GMAIL"]."', '".$row["PASSWORD"]."')");
            $user_Waiting_db->exec("DELETE FROM USER_WAITING WHERE USER_ID == $USER_ID");
        }
        #om man inte är accepterad
        else if($Accepted == "no")
        {
            $message = "Your account named ".$row["USERNAME"]." got accepted into quacker!";
            #maila funkar inte i Apache så jag kommenterar bara ut mail koden
            #$emailStatus = mail($row["GMAIL"], "AdminGmailExample@gmail.com", $message);
            
            #tar bort användarens information från USER_WAITING tabellen
            $user_Waiting_db->exec("DELETE FROM USER_WAITING WHERE USER_ID == $USER_ID");
        }
        header("Location: Admin.php");
    }
}
?>