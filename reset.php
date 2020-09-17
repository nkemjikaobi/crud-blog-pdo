<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

include 'db.php';

if(isset($_POST['btn-reset']))
{
    ini_set("smtp_port","25");
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
    {
        $error = "<div class='container'>
        <div class='alert alert-danger bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>Invalid email address</strong>
        </div>
      </div>";
    }
    else
    {
        $query = "SELECT id FROM users where email='".$email."'";
        $result = mysqli_query($conn,$query);
        $Results = mysqli_fetch_array($result);
 
        if(count($Results)>=1)
        {
            $encrypt = md5(1290*3+$Results['id']);
            $error = "<div class='container'>
				<div class='alert alert-success bg'>
				  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				  <strong class='select_plan'>A pasword reset link has been sent to your email</strong>
				</div>
			  </div>";
            $to=$email;
            $subject="NkemjikasBlog Password Recovery";
            $from = 'support@nkemjikasblog.com';
            $body='<b>Password Recovery</b>, <br/> <br/> <br><br>You have received this e-mail because you used the "Password Recovery" section on NkemjikasBlog to set a new password. If you did not request a password recovery, or if you do not have an account with Nkemjikasblog, please ignore this message.

To complete password change, please click on the link  or copy it into your browser https://nkemjika-crud-blog.herokuapp.com/passwordreset.php?encrypt='.$encrypt.'&action=reset   <br/> <br/>--<br>';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n"; 
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
            mail($to,$subject,$body,$headers);
            //ini_set($to,$subject,$body,$headers);
           
        }
        else
        {
           
            $error = "<div class='container'>
            <div class='alert alert-danger bg'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              <strong class='select_plan'>User not found</strong>
            </div>
          </div>";
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Links to bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Reset Password</title>
</head>
<body>
    <div class="container wrapper">
        <header>
            <h3>Reset Password</h3>
        </header>

        <!--<div class="alert alert-danger" role="alert">-->
            <span class='message'></span>
       <!-- </div>-->

       <?php  if(isset($error)){ echo $error;} ?>

        <form action='' method='POST'>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                <input type="email" class="form-control" required name='email' placeholder="hello@exmaple.com">
                </div>
            </div>

            <div class="form-group row">
                <button href='reset.php' name='btn-reset' class='btn btn-lg btn-primary'>SEND PASSWORD RESET LINK</button>
            </div>
        </form>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>