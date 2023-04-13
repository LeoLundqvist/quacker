<?php
$tempUsername = $_POST["username"];
$tempPassword = $_POST["password"];

$db = new SQLite3('USER.sq3'); #vilken databas öppnar vi? 
$db->exec("CREATE TABLE IF NOT EXISTS USER(USERNAME text, PASSWORD text)"); #Skapa tabellen direkt i PHP... 

$db->exec("INSERT INTO USER VALUES('123','123')"); #exec kör enskilda kommandon, just INSERT INTO är snällt och går bra. 

if($tempUsername == "123")
{

}

?>