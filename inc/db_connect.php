<?php
//connect to db server and select db
$link = mysql_connect('localhost', 'root', 'e') or die ("<p class=\"centered\">Unable to connect!</p>");
mysql_select_db('treehicks') or die ("<p class=\"centered\">Unable to select database!</p>");
?>