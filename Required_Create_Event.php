<?php
session_start(); //starts all the sessions
require_once "core_functions.php";
?>

&nbsp;

    <div class="container">
    <div class="alert alert-danger">
  <strong>Authorization Required!</strong> You must be an Organization and logged in to create event.
</div>
        <p>
            Click <a href =""> here</a> to log in.

        </p>
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
