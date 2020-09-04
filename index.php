<?php

//Include connection file
include 'db.php';

//start session
session_start();

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

        <section class='mb-4'>
            <a href='create.php' class='btn btn-primary'>Create Post</a>
        </section>

        <?php
            if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                }
        ?>

        <section>
            <?php
                //Prepared statement to get all posts
                $stmt = $conn->prepare("SELECT * FROM posts ORDER BY id DESC");
                $stmt->execute();
                $result = $stmt->get_result();

                //Loop through all the posts
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