<?php
$username = $_POST["username"];
$password = $_POST["password"];
$password2 = $_POST["password2"];

$db = new SQLite3('USER.sq3'); #vilken databas öppnar vi? 

$db->exec("CREATE TABLE IF NOT EXISTS USER(USERNAME text, PASSWORD text)"); #Skapa tabellen direkt i PHP... 

#$db->exec("INSERT INTO USER VALUES('".$username."','".$password."')"); #exec kör enskilda kommandon, just INSERT INTO är snällt och går bra. 

$allInputQuery = "SELECT * FROM USER"; #vilket kommando vill vi köra? 
$userList = $db->query($allInputQuery); #en ny array som innehåller all information

#skapa en cookie som lagrar vilket ID som har loggat in
#skicka till "message board"
#skriv ut användarnamnet till den som har loggat in med hjälp av cookien 

if(password == $password2)
{
  header("Location: Feed.php");
}

?>