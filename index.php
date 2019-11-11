<?php include "inc/header.php"; ?>
<div class="section" id="content"> <!-- begin content -->
	<h2>Welcome to E-Blog!</h2>
	<?php
	if (isset($_SESSION['name'])) {
		unset($name);
		include "inc\db_connect.php";
		
		$query = "select users.name, posts.title, posts.content, posts.timeposted from users, posts where posts.public=1 and posts.userid = users.userid";
		$result = mysql_query($query) or die ('Error in query: ');
		
		// Printing results in HTML
		echo "<table><caption>All Public Posts:</caption>\n";
		echo "\t<tr><td>Name:</td><td>Title:</td><td>Content:</td><td>Timestamp:</td></tr>\n";
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
		echo "<p class=\"centered\">Log in to view postings. We hope you enjoy your stay.
				<br /><br />Please note that while the site is functional, it is only a learning project.
				Do not register an account using a real email account or any passwords you use for anything else!</p>";
	}
	?>
</div> <!-- end content -->
<?php include "inc/footer.php"; ?>