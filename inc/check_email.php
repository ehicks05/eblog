<?php
	function check_email($email) {
		$pattern = "/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\\.[A-Z]{2,6}$/i";
		$return_value = preg_match ($pattern, $email);
		return $return_value;
	}
?>