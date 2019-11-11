<?php include "inc/header.php"; ?>
<div class="section" id="content">
	<h2>Logging Out!</h2>
	<?php
		if(isset($_SESSION['name'])) {
			$_SESSION = array();
			session_destroy();
			header("Refresh: 0; url=logout.php");
		}
		else {
			echo "<p class=\"centered\">You are logged out.</p>";
		}
	?>
</div>
<?php include "inc/footer.php"; ?>