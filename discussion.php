<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <?php require "partials/_dbconnect.php"; ?>
    <?php require "partials/_navbar.php"; ?>


    <?php 
    $id=$_GET['thread_id'];
        $sql="SELECT * FROM `thread` WHERE `thread_id`='$id'; ";
        $result=mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_assoc($result)) {
            $name=$row['thread_title'];
            $desc=$row['thread_desc'];
            $th_user_id=$row['thread_user_id'];
                $sql2="SELECT * FROM `user` WHERE `user_id`='$th_user_id'; ";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $posted_by=$row2['user_username'];
        }
    ?>

<?php 
        $method=$_SERVER['REQUEST_METHOD'];
        $showAlert=false;
        if (isset($_GET['loginsuccess'])&& $_GET['loginsuccess']==true ) {
            if ($method=='POST') {
                $comment=htmlentities($_POST['comment']);
                $comment_by=$_SESSION['user_id'];
                $sql="INSERT INTO `comment` ( `comment_content`, `comment_by`, `thread_id`, `comment_time`) VALUES ('$comment', '$comment_by', '$id', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            $showAlert=true;
            }
        }
        else {
            if ($method=='POST') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> You need to login in order to comment.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            }
        }
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    ?>
    <div class="container my-4  ">
        <div class="card mb-3 bg-light">
            <img src="https://source.unsplash.com/500x100/?coding,programming" class="card-img-top"
                alt="...">
            <div class="card-body">
                <h5 class="card-title h1 display-4"><?php echo $name; ?></h5>
                <p class="card-text blockquote my-4 "><?php echo $desc; ?></p>
                <p class="card-text  ">Posted By - <b><?php echo $posted_by; ?></b></p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div>

        <div class="container">
        <h1 class="py-3 mb-0">Post a comment</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            
            <div class="form-floating">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment"
                        style="height: 100px"></textarea>
                    <label for="desc">Type your comment here</label>
                </div>
                <button class="btn btn-primary my-3">Post</button>
        </form>
    </div>

        <div class="container">
            <h1 class="py-3 mb-0">Discussion</h1>
            <?php 
            // session_start();
            $id=$_GET['thread_id'];
            $sql="SELECT * FROM `comment` WHERE `thread_id`='$id'; ";
            $result=mysqli_query($conn,$sql);
            $noResult=true;
            while ($row=mysqli_fetch_assoc($result)) {
                $id=$row['comment_id'];
                $content=$row['comment_content'];
                $noResult=false;
                $comment_by=$row['comment_by'];

                $sql2="SELECT * FROM `user` WHERE `user_id`='$comment_by'; ";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $username=$row2['user_username'];
                echo '<div class="d-flex my-5 align-items-center">
                <div class="flex-shrink-0">
                    <img src="img/user.jpg" width="80px" class="rounded-circle" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="mt-0">'.$username.'</h5>
                    '.$content.'
                </div>
            </div>';
        }
        if ($noResult) {
            echo '
            <div class=" my-4 ">
            <div class="card mb-3 bg-light">
                <div class="card-body">
                    <h5 class="card-title h1 display-4">No comment Found</h5>
                    <p class="card-text blockquote my-4">Be the first person to post a comment</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
            ';
        }

?>
            
        </div> 

    </div>


    <?php require "partials/footer.php"; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>