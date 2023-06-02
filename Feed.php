<?php
#dubbelkollar att user fortfarande är inloggad
if(!isset($_COOKIE['user']))
{
    header("Location: LoggIn.php");
}

echo $_COOKIE['user']."'s feed<br>";
?>

<html>
<!-- Sökruta -->
<form action="Search.php" method="POST">
Sök på användare: <input type="text" name="searchUsername">
<input type="submit">
<br><br>
</form>
<!-- Posta eller logga ut -->
<A HREF=Post.php>Post</A><br>
<A HREF=LoggOut.php>Logg Out</A><br>
</html>

<?php
    $post_db = new SQLite3('POST.sq3'); 
    $post_db->exec("CREATE TABLE IF NOT EXISTS POST(POST_ID integer primary key, USERNAME text, UPLOADTEXT text, DATE text)");

    $allInputQuery = "SELECT * FROM POST"; #vilket kommando vill vi köra? 
    $postList = $post_db->query($allInputQuery); #en ny array som innehåller all information
    $postCount = 0;

    #skriver ut alla posts
    while ($row = $postList->fetchArray(SQLITE3_ASSOC))
    {
        echo "POSTED BY ".$row["USERNAME"].":<br>".$row["UPLOADTEXT"]."<br>POSTED AT ".$row["DATE"]."<br><br><br>";
    }

?>