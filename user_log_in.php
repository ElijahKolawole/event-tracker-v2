
<?php
session_start(); //starts all the sessions
require_once "core_functions.php";
?>

<div class="container">
        <h2>User Log In</h2>

        <form class="form-horizontal" method = "post" action = "validate.php">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="passwd">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="passwd" placeholder="Enter password" name="passwd">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember"> Remember me</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                </div>
            </div>
        </form>
        <hr/>
Want to sign up, click <a href = "user_sign_up.php">here</a>.
Forget your password? click <a href = "reset.php">here</a> to reset.
    </div>
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