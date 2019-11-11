<?php include "inc\header.php"; ?>
<div class="section" id="content">
	<h2>Your Posts!</h2>
	<?php
	if (isset($_SESSION['name'])) {
		$name = $_SESSION['name'];
		$userid = $_SESSION['userid'];

		include "inc\db_connect.php";
		
		$query = "select title, content, timeposted, public from posts where userid=\"$userid\"";
		$result = mysql_query($query) or die ("<p class=\"centered\">Error in query: </p>");
		
		// Printing results in HTML
		echo "<table>\n";
		echo "\t<tr><td>Title:</td><td>Content:</td><td>Timestamp:</td><td>Public:</td></tr>\n";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "\t<tr>\n";
			foreach ($line as $col_value) {
				echo "\t\t<td>$col_value</td>\n";
			}
			echo "\t</tr>\n";
		}
		echo "</table>\n";
		
		include "inc\db_disconnect.php";
	}
	else {
		echo "<p class=\"centered\">Please log in to view your postings.</p>";
		echo "<p class=\"centered\">We hope you enjoy your stay.</p>";
	}
	?>
</div>
<?php include "inc/footer.php"; ?>