<!DOCTYPE html>
<html>

<body>

<?php

$id = $_GET['id'];
$sand = $_GET['sand'];
if ($id != NULL && $sand != NULL)
{

	include "my_db_function.php";
	$conn = My_Connect_DB();

	$sql = "SELECT * FROM User WHERE id ='".$id."';";

	$result = My_SQL_EXE($conn, $sql);
	if($row=mysql_fetch_row($result))
	{
		if($sand==md5($row[1]))
		{
?>
<form method="post" action="id_reseting.php">
<?php
	echo "Your ID is: ".$row[0]."<br/>";
	echo "<input type='hidden' name='id' value='".$row[0]."'>";

?>
Your new password: <input type="password" name="newpw"><br/>
Retype your new password: <input type="password" name="newpw2"><br/>
<input type="submit" name="submit"><br/>

</form>
<?php			
		}
		else echo "Wrong sand provided <br/>";

	}
	else echo "Wrong id provided <br/>";
}
else echo "Wrong link <br/>";

?>

</body>
</html>