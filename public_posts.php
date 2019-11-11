<?php include "inc\header.php"; ?>
<?php session_start(); ?>
<div class="section" id="content"> <!-- body -->
	<h2>Public Posts!</h2>
	<?php
		$name = $_POST['name'];
		
		include "inc/db_connect.php";
		//find out user id
		$query = "SELECT users.userid FROM users WHERE users.name = \"$name\"";
		$result = mysql_query($query) or die ('Error in query: ');
		$line = mysql_fetch_object($result);
		$userid = $line->userid;

		//get posts by that user
		$query = "SELECT title, content FROM posts WHERE posts.userid=\"$userid\" AND posts.public = 1";
		$result = mysql_query($query) or die ('Error in query: ');
		
		echo "<p class=\"centered\">Posts by $name:</p>";
		echo "<table>\n";
		echo "\t<tr><td>Title:</td><td>Content:</td></tr>\n";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "\t<tr>\n";
			foreach ($line as $col_value) {
				echo "\t\t<td>$col_value</td>\n";
			}
			echo "\t</tr>\n";
		}
		echo "</table>\n";
		
		include "inc\db_disconnect.php";
	?>
</div>
<?php include "inc/footer.php"; ?>