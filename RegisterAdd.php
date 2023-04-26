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

#skapa en cookie som lagrar vilket ID som har loggat in
#skicka till "message board"
#skriv ut användarnamnet till den som har loggat in med hjälp av cookien 

$sameUsername = false;

while ($row = $userList->fetchArray(SQLITE3_ASSOC))#SQLITE3_ASSOC är en funktion i SQLite3 som hämtar info från 
{ 
	if($username == $row['USERNAME'])
	{
		$sameUsername = true;
	}
}

if(empty($username))
{
	echo "You didn't write a username";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}
else if(empty($password))
{
	echo "You didn't write a password";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}
else if($sameUsername == true)
{
	echo "Username already exists";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}
else if($password != $password2)
{
	echo "Your password and double check password didn't match";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}
else 
{
	$db->exec("INSERT INTO USER(USERNAME, PASSWORD) VALUES('".$username."','".$password."')");
	setcookie("user", $username, time()+(86400*30),'/');
	header("Location: Feed.php");
}

?>