<html>
<body style="background-color:	#C0C0C0;">

<h1>Reset your password:</h1>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
<input type ="radio" name =resetby value ="id" checked>ID<br/>
<input type ="radio" name =resetby value="email" checked>Email<br/>
Type your ID or Email here: <input type="text" name="idORemail"><br/>
<input type="submit" name = "submit" value ="reset passwd">
</form>
<?php
include "my_db_function.php";
$conn = My_Connect_DB();
if($_POST['resetby'] == "id")
{
	$sql = "SELECT * FROM User WHERE id='".$_POST['idORemail']."';";
    
 }
else if($_POST['resetby']== "email")
{	
	$sql = "SELECT * FROM User WHERE email='".$_POST['idORemail']."';";
}   
    $result= My_SQL_EXE($conn, $sql);
    if($row = mysqli_fetch_row($result)) // if true, found the id or email
    {
    	$to = $row[4];
        $subject = "Reset Password!!!";
        $txt = "You requested to reset your password.\r\n".
        		"Your Login ID is: ".$row[0]."\r\n\r\n".
                "Click the following link to reset your password. \r\n\r\n".
                "reseting_page.php".$row[0]."&sand=".md5($row[1]);
   		$headers = "From: webmaster@EventTracking.com\r\n"."CC: someone@EventTracking.com";
        
        mail($to, $subject, $txt, $headers);
        echo "Please check your email to reset your password </br>";
   
   }
    else
    {
    	echo "ID or Email is not correct, try again</br>";
    }
  
?>

</body>


</html>