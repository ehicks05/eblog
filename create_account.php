<?php include "inc/header.php"; 
	include "inc/check_email.php";
?>
<?php session_start(); ?>
<div class="section" id="content"> <!-- body -->
	<h2>Create Account!</h2>
	<?php
	if (!isset($_POST["name"]) || !isset($_POST["password"]) || !isset($_POST["email"])) {
		echo "
			<form action=\"create_account.php\" method=\"post\">
			<fieldset>
				<legend>Create Account</legend>
				<label for=\"name\">User Name: </label><input type=\"text\" name=\"name\" id=\"name\"><br />
				<label for=\"password\">Password: </label><input type=\"password\" name=\"password\" id=\"password\"><br />
				<label for=\"email\">Email Address: </label><input type=\"text\" name=\"email\" id=\"email\"><br />
				<input type=\"submit\" name=\"submit\" value=\"Submit\">
			</fieldset>
			</form>
		";
	}
	else {
		$name = $_POST['name']; 
		$password = $_POST['password'];
		$email = $_POST['email'];
		
		if (check_email($email) == 0 || check_email($email) == false) {
			die ("<p class=\"centered\">Email address was not valid.</p>");
		}
		//die if any fields were left blank
		if (empty($name) || empty($password) || empty($email)) {
			die("<p class=\"centered\">One or more fields were left blank</p>");
		}
		
		include "inc/db_connect.php";
		
		$query = "select * from users where name=\"$name\" or email=\"$email\"";
		$result = mysqli_query($link, $query) or die (mysqli_error($link));
		
		if (mysqli_num_rows($result) > 0) {
			die ("<p class=\"centered\">User with the same name or email already exists.</p>");
		}
		else {
			echo "<p class=\"centered\">Information Accepted</p><br />";
		}
		$query = "insert into users set name=\"$name\", password=\"$password\", email=\"$email\", public=0";
		$result = mysqli_query($link, $query) or die (mysqli_error($link));
		include "inc/db_disconnect.php";
		
		echo "<p class=\"centered\">Account Creation Successful!</p>";
	}
	?>
</div>
<?php include "inc/footer.php"; ?>