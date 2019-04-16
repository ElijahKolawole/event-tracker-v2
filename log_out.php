<?php
session_start();
session_destroy(); //starts all the sessions
echo '<script>window.location.href = "EventHome.php";</script>';
?>
