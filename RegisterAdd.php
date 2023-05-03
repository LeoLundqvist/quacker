<?php
$username = $_POST["username"];
$password = $_POST["password"];
$password2 = $_POST["password2"];

#öppnar databasen USER.sq3
$db = new SQLite3('USER.sq3'); 

#Skapar tabellen direkt i PHP om den inte finns
$db->exec("CREATE TABLE IF NOT EXISTS USER(USER_ID integer primary key autoincrement, USERNAME text unique, PASSWORD text)"); 

#$db->exec("INSERT INTO USER VALUES('".$username."','".$password."')"); #exec kör enskilda kommandon, just INSERT INTO är snällt och går bra. 

$allInputQuery = "SELECT * FROM USER"; #vilket kommando vill vi köra? 
$userList = $db->query($allInputQuery); #en ny array som innehåller all information

#använder boolen när jag kollar ifall username redan finns
$sameUsername = false;

while ($row = $userList->fetchArray(SQLITE3_ASSOC))#SQLITE3_ASSOC är en funktion i SQLite3 som hämtar info från 
{ 
	#om username redan finns så blir boolen true
	if($username == $row['USERNAME'])
	{
		$sameUsername = true;
	}
}

#om du inte skrev ett username kommer en knapp som skickar dig till register.php
if(empty($username))
{
	echo "You didn't write a username";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}

#om du inte skrev ett password
else if(empty($password))
{
	echo "You didn't write a password";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}

#om username redan finns
else if($sameUsername == true)
{
	echo "Username already exists";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}

#om password inte är samma som double check password
else if($password != $password2)
{
	echo "Your password and double check password didn't match";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}
#om det inte är några problem med ditt inlogg
else 
{
	#sparar username och password i table, skapar en cookie och skickar till feed.php
	$db->exec("INSERT INTO USER(USERNAME, PASSWORD) VALUES('".$username."','".$password."')");
	setcookie("user", $username, time()+(86400*30),'/');
	header("Location: Feed.php");
}

?>