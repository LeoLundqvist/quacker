<?php
    $uploadText = $_POST["uploadText"];

    echo $uploadText.$_COOKIE["user"].date('y/m/d');
    
    #User
    $user_db = new SQLite3('USER.sq3'); 
    $user_AllInputQuery = "SELECT * FROM USER";
    $user_UserList = $user_db->query($user_AllInputQuery);

    #Post
    $post_db = new SQLite3('POST.sq3'); 
    $post_db->exec("CREATE TABLE IF NOT EXISTS POST(POST_ID integer primary key, USER_ID integer, autoincrement, UPLOADTEXT text, DATE text)");
    $post_AllInputQuery = "SELECT * FROM POST";
    $post_List = $post_db->query($post_AllInputQuery);

?>