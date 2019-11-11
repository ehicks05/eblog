<?php
// free result set memory
mysql_free_result($result);
// close connection
mysql_close($link);
?>