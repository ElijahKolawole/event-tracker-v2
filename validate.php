
<?php
session_start();
?>


<?php



include "my_db_function.php";
$_SESSION["email"] =$_POST["email"];
if(isset($_POST['submit']))
{
    
    $_SESSION["email"] =$_POST["email"];

	if (!empty($_POST['email']))
    {
    	$conn = My_Connect_DB();
        $sql = "SELECT * FROM User WHERE email = '".$_POST['email']."'
        		AND passwd = '".md5($_POST['passwd'])."';";
                
         $result = My_SQL_EXE($conn, $sql);
         if (mysqli_num_rows($result) <=0) //empty
         {
         	echo "Your id or password is wrong, try again <br/>";
         }
         else
         {
         	
         	Show_User($conn, $_POST['email']);
             echo '<script>window.location.href = "welcome_user.php";</script>';
            echo "Click here to log off";
            $_SESSION ["email"]= $_POST["email"];
         }
       }
       }
         
         	function Show_User($conn, $email)
{
	$sql = "SELECT * FROM User WHERE email = ".$email.";";
    $result =  My_SQL_EXE($conn, $sql);
    if ($row = mysqli_fetch_row($result))
    {
    	echo "Your information for ". $email. " is as follows.<br/>";
    	echo "ID: ".$row[0]."<br/>";
        echo "Name: ".$row[2]."<br/>";
        echo "Phone: ".$row[3]. "<br/>";
        echo "Email: ".$row[4]. "<br/>";
        
    }
    else
    {
    	echo "No such ID: $id <br/>";
    }
    

         }
    
?>