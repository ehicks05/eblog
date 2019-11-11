<?php include "inc/header.php"; ?>
<?php session_start(); ?>
<div class="section" id="content">
	<h2>Create Post!</h2>
	<?php
	if (isset($_SESSION['name'])) { /* make sure we're logged in */
		if (!isset($_POST["title"]) || !isset($_POST["post_content"])) {
			echo '
				<form action="create_post.php" method="post">
				<fieldset>
					<legend>Create Post</legend>
					<label for="title">Title: </label><br /><input type="text" name="title" id="title"></input><br />
					<label for="post_content">Content: </label><br /><textarea name="post_content" id="post_content"></textarea><br />
					Is This A Public Post? <br />
					<input type="radio" value="Yes" name="public" id="public"></input><label for="name">Yes </label><br />
					<input type="radio" value="No"  name="public" id="public" checked></input><label for="name">No </label><br />
					<input type="submit" name="submit" value="Submit"></input>
				</fieldset>
				</form>
			';
		}
		else {
			$name = $_SESSION['name'];
			$userid = $_SESSION['userid'];
			$title = $_POST["title"];
			$content = $_POST["post_content"];
			$public = $_POST["public"];
			$date = date('YmdHis');
			
			if(empty($title) || empty($content)) {
				die("<p class=\"centered\">One or more fields were left blank</p>");
			}
			
			if ($public === "Yes") {
				$public = 1;
			}
			else {
				$public = 0;
			}

			include "inc/db_connect.php";
			
			$query = "insert into posts set userid=\"$userid\", title=\"$title\", content=\"$content\", timeposted=\"$date\", public=\"$public\"";
			$result = mysqli_query($link, $query) or die ("<p class=\"centered\">Error in query: </p>");
			
			include "inc/db_disconnect.php";
			
			echo "<p class=\"centered\">Post Created...</p>";		
		}
	}
	else {
		echo "<p class=\"centered\">Please log in to continue.</p>";
	}
	?>
</div>
<?php include "inc/footer.php"; ?>