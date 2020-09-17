<?php

//Include connection file
include 'db.php';

error_reporting(E_ERROR | E_PARSE);

//start session
session_start();

if($_SESSION['active'] == true){
    $status = "<div class='container'>
            <div class='alert alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
            <strong>Logged in as </strong>".$_SESSION['first_name'] .  ' ' .$_SESSION['last_name'].
            "</div>
            </div>";
}

if(isset($_POST['btn-logout'])){
    session_destroy();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Blog App with CRUD Functionalities</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <span>Nkemjika's Blog</span>
        </header>
        <section class='mb-4 row'>
            <div class="col-md-9">
            <a href='create.php' class='btn btn-primary'>Create Post</a>
            </div>
            
            <div class='col-md-3'>
            <a href='signup.php' class='btn btn-outline-primary round'>SIGN UP</a>
            <a href='signin.php' class='btn btn-info round'>SIGN IN</a>
            <form id='log-out' action="" method='post'>
                <a href='logout.php' name='btn-logout' class='btn btn-danger round'>SIGN OUT</a>
            </form>
            
            </div>
           
        </section>

        <?php
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                }
                if(isset($status)){
                    echo $status;
                    }
        ?>

        <section>
            <?php
                //Prepared statement to get all blogs
                $stmt = $conn->prepare("SELECT * FROM blogs ORDER BY id DESC");
                $stmt->execute();
                $result = $stmt->get_result();

                //Loop through all the blogs
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="card mt-4">
                <div class="card">
                <a href='view.php?id=<?php echo $row['id']; ?>'>
                    <div class="card-header">
                        <?php echo $row['title']; ?>
                    </div>
                </a>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                        <p>Authored by <?php echo $row['author']; ?></p>
                        <footer class="blockquote-footer">Posted on <em><?php echo $row['time']; ?></em></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
            <?php } ?>
        </section>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>