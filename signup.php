<?php

error_reporting(E_ERROR | E_PARSE);
session_start();

include 'db.php';

if(isset($_POST['btn-submit'])){

    //Get all the post values
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm =$_POST['password_confirm'];

    if($password_confirm == $password){
        $stmt = $conn->prepare("INSERT INTO users(first_name,last_name,email,password) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);
        $output =  $stmt->execute();

        if($output){
            $message = "<div class='container'>
            <div class='alert alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Account Created</strong>
            </div>
            </div>";
            header("refresh:1.5; signin.php");
        }
        else{
            $message = "<div class='container'>
            <div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Account could not be created</strong>
            </div>
            </div>";
        }
    }
    else{
        $message = "<div class='container'>
            <div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Passwords don't match</strong>
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

    <title>Register</title>
</head>
<body>
    <div class="container wrapper">
        <header>
            <span>Register your account</span>
        </header>

        <!--<div class="alert alert-danger" role="alert">-->
            <span class='message'></span>
       <!-- </div>-->

       <?php  if(isset($message)){ echo $message;} ?>

        <form action='' method='POST'>
            <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" required name='first_name'  placeholder="John">
                </div>
            </div>

            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" required name='last_name' placeholder="Doe">
                </div>
            </div>

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
                <label for="password_confirm" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-6">
                <input type="password" class="form-control" required name='password_confirm'  placeholder="Re-enter password">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                <button type="submit" class="btn btn-primary btn-lg send" name='btn-submit'>REGISTER</button>
                <a href='index.php' class='btn btn-outline-info btn-lg'>HOME</a>
                <a href='signin.php' class='btn btn-outline-info btn-lg'>LOGIN</a>
                </div>
            </div>
        </form>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>