
<?php
session_start(); //starts all the sessions
require_once "core_functions.php";
?>


<body style="background-color:	#C0C0C0;">
<h1> ORGANIZERS</h1>
<h2>Please provide the following information to register:</h2>
<form method="post" enctype="multipart/form-data" action="welcome_member.php" >
<table>
	<tr><td align=right>Type your user ID:</td><td><input type="text" name="id" value=""><font color=red>(Only digits allowed)</font></td></tr>
    <tr><td align=right>Choose your password:</td><td><input type="password" name="passwd"></td></tr>
    <tr><td align=right>Retype your password:</td><td><input type="password" name="passwd2"></td></tr>
    <tr><td align=right>Your name:</td><td><input type="text" name="name" value=""></td></tr>
    <tr><td align=right>Your Email:</td><td><input type="text" name="email" value=""></td></tr>
    <tr><td align=right>Your Phone:</td><td><input type="text" name="phone" value=""></td></tr>
    <tr><td align=right><input type="submit" name="submit" value="Sign up"></td>
    	<td><input type="reset" name="reset" value="Reset"></td></tr>
</table>
</form>


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