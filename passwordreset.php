<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

include 'db.php';

if(isset($_POST['btn-reset'])){
    $email = strip_tags($_POST['email']);
    $newpass1 = strip_tags($_POST['newpass1']);
    $newpass2 = strip_tags($_POST['newpass2']);

   $email = $conn->real_escape_string($email);
    $newpass1 = $conn->real_escape_string($newpass1);
    $newpass2 = $conn->real_escape_string($newpass2);
    
    $sql = $conn->query("SELECT * FROM users WHERE email = '$email'");
    
    if(!$sql){
        $error = "<div class='container'>
        <div class='alert alert-danger bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>An error occurred</strong>
        </div>
      </div>";
    
                }

            if($newpass1==$newpass2){
                $data = $conn->query("UPDATE users SET password = '$newpass1' WHERE email ='$email'");
                        if($data){
                            $error = "<div class='container'>
                                    <div class='alert alert-success bg'>
                                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                    <strong class='select_plan'>Password changed successfully</strong>
                                    </div>
                                </div>";
                                header("refresh:1.5; signin.php");

                        }
            }
            else{
                $error = "<div class='container'>
                <div class='alert alert-danger bg'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  <strong class='select_plan'>New passwords do not match</strong>
                </div>
              </div>";
            
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

    <title>Password Reset</title>
</head>
<body>
    <div class="container wrapper">
        <header>
            <span>Change your password</span>
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
                <label for="password" class="col-sm-2 col-form-label"> New Password</label>
                <div class="col-sm-6">
                <input type="password" id='password' required class="form-control" name='newpass1' placeholder="Password">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label"> Retype Password</label>
                <div class="col-sm-6">
                <input type="password" id='password' required class="form-control" name='newpass2' placeholder="Password">
                </div>
            </div>


            <div class="form-group row">
                <button class='btn btn-success btn-lg' name='btn-reset'>CHANGE PASSWORD</button>
            </div>
        </form>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>