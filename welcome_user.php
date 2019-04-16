
<?php
session_start();

 //starts all the sessions
//echo " Welcome " . $_SESSION['email'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <title>Events Tracking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href= "event.css" rel = "stylesheet">
    <style>
            /* Remove the navbar's default margin-bottom and rounded borders */ 
            .navbar {
              margin-bottom: 0;
              border-radius: 0;
            }
            
            /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
            .row.content {height: 450px}
            
            /* Set gray background color and 100% height */
            .sidenav {
              padding-top: 20px;
              background-color: #f1f1f1;
              height: 100%;
            }
            
            /* Set black background color, white text and some padding */
            footer {
              background-color: #555;
              color: white;
              padding: 15px;
            }
            
            /* On small screens, set height to 'auto' for sidenav and grid */
            @media screen and (max-width: 767px) {
              .sidenav {
                height: auto;
                padding: 15px;
              }
              .row.content {height:auto;} 
            }
          </style>


</head>
<body>

    <nav class="navbar navbar-inverse" >
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Events Tracking</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="wobble-top"><a href="welcome_user.php"><img src="image/homeIcon.png " alt="Home Icon">Home</a></li>
                <li class="wobble-top"><a href="" ><img src="image/calendarIcon.png" alt="Calendar Icon">Calendar</a></li>

               <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="image/EventsIcon.png" alt="Events Icon">Events <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">Create Events</a></li>
                        <li><a href="event_sign_up.php">Sign Up for Events</a></li>
                        <li><a href="events.php">Upcomming Events</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="image/searchIcon.png" alt="Search Icon">Search <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="search.php">Event by ID</a></li>
                        <li><a href="#">Event by Name</a></li>
                        <li><a href="#">Event by Organizer</a></li>


                    </ul>

        <li class="wobble-top"><a href="" ><img src="image/envelopeIcon.png" alt="Envelope Icon">Contact</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="user_profile.php"><img src="image/userIcon.png" alt="UserIcon"><?php echo $_SESSION['email'];?></a></li>
                <li><a href="log_out.php"><img src="image/logOutIcon.png" alt="Log In Icon"> Log Out</a></li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid text-center">    
            <div class="row content" >
              <div class="col-sm-2 sidenav" style="background-color:grey">
              <div class="well"> <p><a href="#">About</a></p></div>
              <div class="well">  <p><a href="#">Services</a></p></div>
              <div class="well">   <p><a href="#">Clients</a></p></div>
              <div class="well">   <p><a href="#">Contacts</a></p></div>

              </div>
              <div class="col-sm-8 text-left"> 
                <h1> Welcome <?php echo $_SESSION['email'];?>
                    </h1>
                <p style="color:blue;font: size 2;0px;"></p>
                <hr>
               
                
              </div>
              <div class="col-sm-2 sidenav" style="background-color:grey">
                <div class="well" >
                  <img src="image/eventtracking.jpg" width="140" height="70">
                  <p>Ads</p>

                </div>
                <div class="well">
                  <img src="image/events.jpg" width="140" height="70">

                  <p><a href="events.php">Upcomming Events</a></p>
                </div>
              </div>
            </div>
          </div>
          

    

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
