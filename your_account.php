<?php include "inc/header.php"; ?>
<?php session_start(); ?>
<div class="section" id="content"> <!-- body -->
	<h2>Your Account!</h2>
	<?php
	if(empty($_POST['search_name']) && empty($_POST['public'])) {
    $userid = $_SESSION['userid'];
    include "inc/db_connect.php";
    $query = "select public from users where userid=\"$userid\"";
		$result = mysqli_query($link, $query) or die ("<p class=\"centered\">Error in query: </p>");
    // Print results in HTML
    echo "<table>\n";
    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      echo "\t<tr>\n";
      
      foreach ($line as $col_value) {
        if($col_value == 1) {
          $new_col_value = "public";
        }
        else {
          $new_col_value = "private";
        }
        echo "\t\t<td></td><td>Your account is currently $new_col_value</td>";
      }
      echo "\t</tr>\n";
    }
    echo "</table>\n";
		echo('
			<form name="name_form" action="your_account.php" method="post">
			<fieldset>
				<legend>Search for Other Users:</legend>
				<label for="search_name">Name: </label><input type="text" name="search_name" id="search_name"><br />
				<input type="submit" name="submit_name" value="Submit"></input>
			</fieldset>
			</form>
			
			<form name="public_form" action="your_account.php" method="post">
			<fieldset>
				<legend>Make Account Public or Private:</legend>
				<input type="radio" name="public" id="public" value="Public"><label for="public">Public </label>
				<input type="radio" name="public" id="private" value="Private"><label for="private">Private </label><br />
				<input type="submit" name="submit_public" value="Submit"></input>
			</fieldset>
			</form>
		');
	}
	elseif (!empty($_POST['search_name'])) {
		$name = $_POST['search_name'];
		include "inc/db_connect.php";
		
		$query = "select name from users where name like \"$name%\" and public=1";
		$result = mysqli_query($link, $query) or die ("<p class=\"centered\">Error in query: </p>");
		
		if(mysqli_num_rows($result) == 0) {
			die ("<p class=\"centered\">No users found with that name.</p>");
		}
		else {
			// Print results in HTML
			$i = 1;
			echo "<table>\n";
			while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo "\t<tr>\n";
				
				foreach ($line as $col_value) {
					echo "\t\t<td>$i</td><td>$col_value</td>";
					$i++;
					echo "
						<td><form action=\"public_posts.php\" method=\"post\">
							<input type=\"hidden\" name=\"name\" value=\"$col_value\">
							<input type=\"submit\" name=\"submit\" value=\"See Posts\">
						</form></td>\n
					";
				}
				echo "\t</tr>\n";
			}
			echo "</table>\n";
		}
		include "inc/db_disconnect.php";
	}
	elseif (isset($_POST['public'])) {
		$public = $_POST['public'];
		$userid = $_SESSION['userid'];
		include "inc/db_connect.php";
		
		if ($public === "Public") {
			$public = 1;
		}
		else {
			$public = 0;
		}
		
		$query = "update users set public=\"$public\" where userid=\"$userid\"";
		$result = mysqli_query($link, $query) or die ("<p class=\"centered\">Error in query: </p>");
		
		
		if(!$result) {
			die ("<p class=\"centered\">Error in updating account.</p>");
		}
		else {
			echo "<p class=\"centered\">Account successfully changed!</p>";
		}

		include "inc/db_disconnect.php";
    header("Refresh: 1; url=your_account.php");
	}
	?>
</div>
<?php include "inc/footer.php"; ?>