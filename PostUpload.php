<?php
    if(!isset($_COOKIE["user"]))
    {
        header("Location: LoggIn.php");
    }
    $uploadComplete = true;

    #Post
    $post_db = new SQLite3('POST.sq3'); 
    $post_db->exec("CREATE TABLE IF NOT EXISTS POST(POST_ID integer primary key autoincrement, USERNAME text, UPLOADTEXT text, DATE text)");
    $post_db->exec("INSERT INTO POST(USERNAME, UPLOADTEXT, DATE) VALUES('".$_COOKIE["user"]."', '".$_POST["uploadText"]."', '".date('y/m/d')."')");

    if($uploadComplete)
    {
        header("Location: Feed.php");
    }
?>