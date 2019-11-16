<?php
//connect to db server and select db
$link = mysqli_connect('mysql', 'root', 'e', 'treehicks', '3306') or die ("<p class=\"centered\">Unable to connect!</p>");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


// Create database
$sql = "CREATE DATABASE IF NOT EXISTS treehicks";
if (mysqli_query($link, $sql)) {
//    echo "DATABASE treehicks created successfully";
} else {
    echo "Error creating database: " . mysqli_error($link);
}

mysqli_select_db($link, 'treehicks') or die ("<p class=\"centered\">Unable to select database!</p>");

$sql = "create table if not exists users(userid int not null auto_increment, 
                    name varchar(40) not null, 
                    password varchar(40) not null, 
                    email varchar(40) not null, 
                    public bool not null, 
                    primary key(userid))";

if (mysqli_query($link, $sql)) {
//    echo "Table users created successfully";
} else {
    echo "Error creating table: " . mysqli_error($link);
}


$sql = "create table if not exists posts(postid int not null auto_increment, 
                    userid int not null, 
                    title varchar(40) not null, 
                    content text not null, 
                    timeposted timestamp not null, 
                    public bool not null, 
                    primary key(postid))";

if (mysqli_query($link, $sql)) {
//    echo "Table posts created successfully";
} else {
    echo "Error creating table: " . mysqli_error($link);
}

$sql = "create table if not exists comments(commentid int not null auto_increment, 
                      userid int not null, 
                      content text not null, 
                      timeposted timestamp not null, 
                      primary key(commentid))";

if (mysqli_query($link, $sql)) {
//    echo "Table comments created successfully";
} else {
    echo "Error creating table: " . mysqli_error($link);
}

?>