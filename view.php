<?php

//Include connection file
include 'db.php';

session_start();

//Get the id from the url
$id = $_GET['id'];

$_SESSION['id'] =  $id;

$sess_id = $_SESSION['id'];

//When the delete button is clicked
if(isset($_POST['btn-delete'])){
    $stmt= $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param('i', $id);
    $output = $stmt->execute();
    $stmt->close();

    //Display appropriate feedback to user
    if($output){
        $_SESSION['message'] = "<div class='container'>
        <div class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Post Deleted</strong>
        </div>
    </div>";
    header("Location:index.php");
    }
    else{
        $_SESSION['message'] = "<div class='container'>
        <div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Post could not be deleted</strong>
        </div>
    </div>";
    header("Location:index.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <span>Blog Details</span>
        </header>

        <section>
            <a href='edit.php?id=<?php echo $_SESSION['id']; ?>' class='btn btn-primary'>Edit Post</a>
            <form action="" method='POST' class='mt-4'>
                <button type='submit' name='btn-delete' class='btn btn-danger'>Delete Post</button>
            </form>
        </section>

        <section>
            <?php

                $stmt = $conn->prepare("SELECT * FROM posts where id='$id'");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="card mb-3 mt-4">
                <div class="row no-gutters">
                    <div class="col-md-4">
                    <img src="image/<?php echo $row['image']; ?>" class="card-img img-fluid img-thumbnail" alt="Image Unavailable">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title"> <?php echo $row['title']; ?></h3> <hr>
                        <p class="card-text"><?php echo $row['body']; ?></p>
                        <blockquote class="blockquote mb-0">
                            <small><strong>Authored by </strong><span style='color:brown;'><?php echo $row['author']; ?></span></small>
                            <footer class="blockquote-footer">Posted on <em><?php echo $row['time']; ?></em></footer>
                        </blockquote>
                    </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </section>
        <a href="index.php" class='btn btn-info mt-4'>Go Back</a>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>