<?php
//connect to db server and select db
$link = mysqli_connect('mysql', 'root', 'e', 'treehicks', '3306') or die ("<p class=\"centered\">Unable to connect!</p>");


// Create database
$sql = "CREATE DATABASE IF NOT EXISTS treehicks";
if (mysqli_query($link, $sql)) {

} else {
    echo "Error creating database: " . mysqli_error($link);
}

$sql = "create table users(userid int not null auto_increment, 
                    name varchar(40) not null, 
                    password varchar(40) not null, 
                    email varchar(40) not null, 
                    public bool not null, 
                    primary key(userid))";

if ($result = $link->query("SHOW TABLES LIKE 'users'")) {

} else {
    if (mysqli_query($link, $sql)) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($link);
    }
}


$sql = "create table posts(postid int not null auto_increment, 
                    userid int not null, 
                    title varchar(40) not null, 
                    content text not null, 
                    timeposted timestamp not null, 
                    public bool not null, 
                    primary key(postid))";

if ($result = $link->query("SHOW TABLES LIKE 'users'")) {

} else {
    if (mysqli_query($link, $sql)) {
        echo "Table posts created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($link);
    }
}

$sql = "create table comments(commentid int not null auto_increment, 
                      userid int not null, 
                      content text not null, 
                      timeposted timestamp not null, 
                      primary key(commentid))";

if ($result = $link->query("SHOW TABLES LIKE 'users'")) {

} else {
    if (mysqli_query($link, $sql)) {
        echo "Table comments created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($link);
    }
}

mysqli_select_db($link, 'treehicks') or die ("<p class=\"centered\">Unable to select database!</p>");
?>