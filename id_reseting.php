<?php
if(md5($_POST['newpw']) != md5($_POST['newpw2']))
{
	echo "New Password dos not match <br/>";
	exit();
}
include "my_db_function.php";
$conn = My_Connect_DB();

$sql ="UPDATE User SET passwd ='".md5($_POST['newpw'])."' WHERE id ='".$_POST['id']."';";

My_SQL_EXE($conn, $sql);

echo "Password changed, please click <a href =reservation.php> here</a> to login <br/>"
?>