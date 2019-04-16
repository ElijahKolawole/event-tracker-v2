<?php
session_start();
?>


<html>

<head>
  <meta charset="utf-8">
  <meta name="generator" content="AlterVista - Editor HTML"/>
  <title>Event Tracking </title>

<link href= "main.css" rel = "stylesheet">
<link rel = "icon" href= "iconlogo.png" type = "image/x-icon">
</head>

<body>
<h1>Event Tracking</h1>
<nav>
<b><a href = "EventHome.html">Home</a> &nbsp;&nbsp;
<a href = "events.php">Events</a> &nbsp;&nbsp;
<a href = "create_event.php">Create Event</a> &nbsp;&nbsp;</b>
</nav>


 <h2>Please fill in information to create event!!!</h2>
<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<!-- Organization id: <input type="text" name="organization_id"><br><br> -->
Event name: <input type="text" name="name"><font color=red>*</font><br><br>
Description <input type="text" name="description" maxlength=1000> <font color=red>(Please Describe Event)</font><br><br>
Email: <input type="text" name="email"><font color=red>*</font><br><br>
Phone: <input type="text" name="phone"><br><br>

<br><br>
<input type="submit" name="submit1" value="submit"><br>
</form>
<hr/>
<hr/>
<hr/>



<?php
echo "<br/>";

if(isset($_GET["submit1"]))
{
	if( empty($_GET["name"]))
		{
			echo "<h3>Name is required, try again.</h3>";
            die();

		}
  }  



?>            


<br/>

<?php

include "my_db_function.php";
$conn = My_Connect_DB();


if(isset($_GET["submit1"]) && !empty($_GET["name"])&& !empty($_GET["email"])&& !empty($_GET["description"]))
{


$conn = My_Connect_DB();
   
    $organization_id = ($_GET['organization_id']);
    $title = ($_GET['title']);
    $email = ($_GET['email']);
    $description = trim($_GET['description']);
    $phone = ($_GET['phone']);
    
  
 
 $sql = "INSERT INTO events ( title, description, email, phone)
    		VALUES ( '".$title."','".$description."',
            '".$email."', '".$phone."');";
            $result = My_SQL_EXE($conn, $sql);
           
 
}











mysqli_close($conn);
?>


</body>
</html>
