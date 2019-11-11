<?php include "inc/header.php"; ?>
<?php session_start(); ?>
<div class="section" id="content">
	<h2>Log In!</h2>
	<?php
		if((!isset($_POST["name"]) || !isset($_POST["password"])) && !isset($_SESSION["name"])) {
			echo "
			<form action=\"login.php\" method=\"post\">
			<fieldset>
				<legend>Log In</legend>
				<label for=\"name\">Name: </label><input type=\"text\" name=\"name\" id=\"name\"><br />
				<label for=\"password\">Password: </label><input type=\"password\" name=\"password\" id=\"password\"><br />
				<input type=\"submit\" name=\"submit\" value=\"Submit\">
			</fieldset>
			</form>
			<br>
			<p class=\"centered\"><a href=\"create_account.php\"><em>Register</em></a>: If you would like to register an account</p><br>
			";
		}
		elseif(!isset($_SESSION["name"])) {
			$name = $_POST['name'];
			$password = $_POST['password']; 
			//die if any fields were left blank
			if(empty($name) || empty($password)) {
				die("<p class=\"centered\">One or more fields were left blank</p>");
			}
			include "inc/db_connect.php";
			
			$query = "select * from users where name=\"$name\" and password=\"$password\"";
			$result = mysqli_query($link, $query) or die ('Error in query: ');
			
			if(mysqli_num_rows($result) != 1) {
				die ("<p class=\"centered\">No matches with that name and password.</p>");
			}
			else {
				$_SESSION['name'] = $name;
				echo "<p class=\"centered\">user logged in as $name </p><br />";
			}
			
			$query = "select userid from users where name=\"$name\"";
			$result = mysqli_query($link, $query) or die ('Error in query: ');
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$userid = $row['userid'];
			
			$_SESSION['userid'] = $userid;
			
			include "inc/db_disconnect.php";

			header("Refresh: 0; url=login.php");
		}
		else {
			echo "<p class=\"centered\">Thank you for logging in!</p>";
		}
	?>
</div>
<?php include "inc/footer.php"; ?>