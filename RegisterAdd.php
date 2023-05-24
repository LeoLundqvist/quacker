<?php
$username = $_POST["username"];
$gmail = $_POST['gmail'];
#hashar lösenorden så att de är säkrare
$password = hash('sha256', $_POST["password"]);
$password2 = hash('sha256', $_POST["password2"]);

#bools och andra variabler för att kolla ifall inlogg är tillåtet
$usernameAlreadyExists = false;
$gmailAlreadyExists = false;
$realGmail = strpos($gmail, '@gmail.com');
$minPasswordLength = 3;
$maxPasswordLength = 12;

#öppnar/skapar USER tabellen
$user_db = new SQLite3('USER.sq3'); 
$user_db->exec("CREATE TABLE IF NOT EXISTS USER(USER_ID integer primary key autoincrement, USERNAME text unique, GMAIL text unique, PASSWORD text)");
$user_AllInputQuery = "SELECT * FROM USER";
$user_UserList = $user_db->query($user_AllInputQuery);

#öppnar/skapar user_Waiting tabell 
$user_Waiting_db = new SQLite3('USER_WAITING.sq3'); 
$user_Waiting_db->exec("CREATE TABLE IF NOT EXISTS USER_WAITING(USER_ID integer primary key autoincrement, USERNAME text unique, GMAIL text unique, PASSWORD text, ACCEPTED bool)"); 
$user_Waiting_AllInputQuery = "SELECT * FROM USER_WAITING";
$user_Waiting_UserList = $user_Waiting_db->query($user_Waiting_AllInputQuery);

#kollar så namn och gmail inte redan finns i USER tabellen
while ($row = $user_UserList->fetchArray(SQLITE3_ASSOC))
{
	#om username redan finns så blir boolen true
	if($username == $row['USERNAME'])
	{
		$usernameAlreadyExists = true;
	}
	if($gmail == $row['GMAIL'])
	{
		$gmailAlreadyExists = true;
	}
}

#kollar så namn och gmail inte redan finns i USER_WAITING tabellen
while ($row = $user_Waiting_UserList->fetchArray(SQLITE3_ASSOC))
{
	#om username redan finns så blir boolen true
	if($username == $row['USERNAME'])
	{
		$usernameAlreadyExists = true;
	}
	if($gmail == $row['GMAIL'])
	{
		$gmailAlreadyExists = true;
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
#om du inte skrev ett gmail
else if(empty($gmail))
{
	echo "You didn't write a gmail";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}
#om username redan finns
else if($usernameAlreadyExists == true)
{
	echo "Username already exists";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}
#om gmail redan finns
else if($gmailAlreadyExists == true)
{
	echo "Gmail already registered on different account";
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
else if($realGmail == false)
{
	echo "Your gmail isn't real";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}
#om lösenordet är för kort
else if(strlen($_POST["password"]) < $minPasswordLength)
{
	echo "Your password needs to be at least 3 letters long";
	?>
	<html>
	<A HREF=Register.php>Försök igen</A>
	</html>
	<?php
}
#kollar så att lösenordet inte är för långt
else if(strlen($_POST["password"]) > $maxPasswordLength)
{
	echo "Your password needs to be shorter than 13 letters long";
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
	$user_Waiting_db->exec("INSERT INTO USER_WAITING(USERNAME, GMAIL, PASSWORD, ACCEPTED) VALUES('".$username."', '".$gmail."', '".$password."', false)");

	echo "Now you need to wait for the admin to accept you into the cult...";
	?>
	<html>
	<A HREF=LoggIn.php>Logga in</A>
	</html>
	<?php
	/*
	setcookie("user", $username, time()+(86400*30),'/');
	header("Location: Feed.php");
	*/
}

?>