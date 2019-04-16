<?php
//session_start(); //starts all the sessions
require_once "logged_in_core.php";
?>

<h2>Upcoming Events</h2>
<style>
            .footer {
               position: fixed;
               left: 0;
               bottom: 0;
               width: 100%;
               background-color: rgb(7, 9, 26);
               color: white;
               text-align: center;
            }
</style>

<div class="footer">
    <p><small><i>Copyright &copy; 2018 Event Tracking</i></small><br>
    <small><i><a href ="mailto:ymai@ggc.edu">ymai@ggc.edu</a></i></small><br></p>
</div>

<?php

include "my_db_function.php";
$conn = My_Connect_DB();

$sql = "SELECT * FROM events;";
$result = My_SQL_EXE($conn, $sql);
My_Show_Table($result);
die();

mysqli_close($conn);
?>

<?php
session_destroy;
?>

</body>
</html>
