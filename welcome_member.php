<?php
session_start(); //starts all the sessions
require_once "core_functions.php";
?>
<?php
include "my_db_function.php";
if(isset($_POST['submit']))
{
	if($_POST['passwd'] != $_POST['passwd2'])
    {
    	echo "password does not match<br/>";
		exit();
    }
    if(isset($_POST['id']) && !empty($_POST['id']) )
    {
    	$conn = My_Connect_DB();
      
        
           
        //verify if the id already exists   
        $sql = "SELECT * FROM user WHERE id='".$_POST['id']."';";
        $result = My_SQL_EXE($conn, $sql);
        if(mysqli_num_rows($result) > 0)		//duplicate id
        {
        	echo "ID already exists, please choose another one<br/>";
        	//My_Show_Table($result);
            //exit();
            die();
		}
        else
        {
        	
          
          $sql = "INSERT INTO user VALUES (".$_POST['id'].", '".md5($_POST['passwd'])."', '".$_POST['name']."',
          '".$_POST['phone']."', '".$_POST['email']."');";
          My_SQL_EXE($conn, $sql);
            echo "<hr/>";
            echo "<h1>Thank you for signing up/</h1>";
            echo "Click <a href ='log_in.php'>here</a> to log in <br/>";
        }
    }
}

?>
    


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




</body>
</html>
