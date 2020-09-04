<?php

//Include connection file
include 'db.php';


//When the Create Post button is clicked
if(isset($_POST['btn-create'])){

    //Get the user inputs
    $title = $_POST['title'];
    $body = $_POST['body'];
    $author = $_POST['author'];

    //Handle Image Upload
    $filename = $_FILES["image"]["name"]; 
    $tempname = $_FILES["image"]["tmp_name"];     
    $folder = "image/".$filename; 

    //Default Image if user doesn't supply any
    if($_FILES['image']['name'] == "") {
        $filename = "noimage.jpg";
    }

    //Prepared Statement to store user inputs
    $stmt = $conn->prepare("INSERT INTO posts(title,body,author,image) VALUES(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $body, $author, $filename);
    $output = $stmt->execute();
    $stmt->close();

    //Store the images temporarily in a folder
    move_uploaded_file($tempname, $folder);

    //Display appropriate feedback to user
    if($output){
        $message = "<div class='container'>
        <div class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Post Created</strong>
        </div>
        </div>";
        header("refresh:1.5; index.php");
    }
    else{
        $message = "<div class='container'>
        <div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Post could not be added</strong>
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
    <title>Create Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <header>
            <span>Create your blog post</span>
        </header>
        <?php
            if(isset($message)){
            echo $message;
            }
        ?>
        <form action=''  method='POST' enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" required name="title" id="title" placeholder="Enter a title for you post">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" required name="body" placeholder='Enter the body of your post here...'  rows="7"></textarea>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" required  name="author" id="author" placeholder="Enter the author of the post">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file"  name="image" id="image">
            </div>
            <div class="form-group">
                <input type="submit" value="Create Post" name='btn-create' class='btn btn-primary'>
                <a href='index.php' class='btn btn-info'>Go Back</a>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>