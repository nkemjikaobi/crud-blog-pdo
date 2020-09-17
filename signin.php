<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

include 'db.php';

if(isset($_POST['btn-login'])){

    //Get all the post values
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Create the query and number of rows returned from the query
$query = mysqli_query($conn, "SELECT * FROM users where email= '".$email."' ");
$numrows = mysqli_num_rows($query);



//Create condition to check if there is 1 row with that email
    if($numrows != 0){

//Grab the email and password from that row returned before
    
        while($row = mysqli_fetch_array($query)){
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['dbemail'] = $row['email'];
            $_SESSION['dbpass'] = $row['password'];
            $_SESSION['id'] = $row['id'];
        }
    
//Create condition to check if email and password are equal to the returned row
        if($email == $_SESSION['dbemail']){
            if($password == $_SESSION['dbpass']){
                $message = "<div class='container'>
                    <div class='alert alert-success'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Login Successful</strong>
                    </div>
                    </div>";
                header("refresh:1.5; index.php");
                $_SESSION['active'] = true;
            }
            else{
                $message = "<div class='container'>
				<div class='alert alert-danger bg'>
				  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				  <strong class='select_plan'>Check your email or password again</strong>
				</div>
			  </div>";
            }
        }
        else{
            $message = "<div class='container'>
				<div class='alert alert-danger bg'>
				  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				  <strong class='select_plan'>Check your email or password again</strong>
				</div>
			  </div>";

        }
    }
    else{
        $message = "<div class='container'>
        <div class='alert alert-danger bg'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong class='select_plan'>User not found</strong>
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

    <title>Login</title>
</head>
<body>
    <div class="container wrapper">
        <header>
            <span>Login to  your account</span>
        </header>

        <!--<div class="alert alert-danger" role="alert">-->
            <span class='message'></span>
       <!-- </div>-->

       <?php  if(isset($message)){ echo $message;} ?>

        <form action='' method='POST'>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                <input type="email" class="form-control" required name='email' placeholder="hello@exmaple.com">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-6">
                <input type="password" id='password' required class="form-control" name='password' placeholder="Password">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-6">
                <a href='index.php' class='btn btn-outline-info btn-lg'>HOME</a>
                <button class='btn btn-info btn-lg' name='btn-login'>LOGIN</button>
                <a href='reset.php' class='btn btn-lg btn-danger'>FORGOT PASSWORD</a>
                </div>
            </div>
        </form>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>