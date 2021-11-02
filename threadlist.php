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
    $id=$_GET['id'];
        $sql="SELECT * FROM `categorie` WHERE `categorie_id`='$id'; ";
        $result=mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_assoc($result)) {
            $name=$row['categorie_name'];
            $desc=$row['categorie_desc'];
        }
    ?>

    <?php 
        $method=$_SERVER['REQUEST_METHOD'];
        $showAlert=false;
        if (!isset($_GET['discussion'])) {
            if ($method=='POST') {
                $th_title=htmlentities($_POST['title']);
                $th_desc=htmlentities($_POST['desc']);
                $th_user_id=$_SESSION['user_id'];
                $sql="INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamlp`) VALUES ( '$th_title', '$th_desc', '$id', '$th_user_id', current_timestamp());
                ";
            $result=mysqli_query($conn,$sql);
            $showAlert=true;
            }
        }
        else{
            if ($method=='POST') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> You need to login in ordre to start a discussion.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        }
        
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been successfully submitted.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        
        ?>
    <div class="container my-4  ">
        <div class="card mb-3 bg-light">
            <img src="https://source.unsplash.com/500x100/?<?php echo $name; ?>,programming" class="card-img-top"
                alt="...">
            <div class="card-body">
                <h5 class="card-title h1 display-4"><?php echo $name; ?></h5>
                <p class="card-text blockquote my-4"><?php echo $desc; ?></p>
                <hr class="my-4">
                <p>No Spam / Advertising / Self-promote in the forums.
                    Do not post copyright-infringing material.
                    Do not post “offensive” posts, links or images.
                    Do not cross post questions.
                    Do not PM users asking for help.
                    Remain respectful of other members at all times.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>





        <?php 
        require "partials/loginmodal.php";

        if (isset($_GET['discussion'])) {
            $showAlert="You need to login to start a discussion";
                echo '<form action="'. $_SERVER['REQUEST_URI'].'" method="post">
                <div class="mb-3">
                    <h2 class="my-4">Start a Discussion</h2>
                    <label for="title" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        placeholder="Describe your problem to the point and make it as short as possible">
                </div>
                <div class="form-floating">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc"
                            style="height: 100px"></textarea>
                        <label for="desc">Elaborate Your Problem</label>
                    </div>
                    <button class="btn btn-primary my-3" type="submit">submit</button>';
                    
        }
        else {  
                echo '
                <div class="container">
                    <h1 class="py-3 mb-0">Start a Discussion</h1>
                    <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Problem Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Describe your problem to the point and make it as short as possible">
                        </div>
                        <div class="form-floating">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc"
                                    style="height: 100px"></textarea>
                                <label for="desc">Elaborate Your Problem</label>
                            </div>
                            <button class="btn btn-primary my-3">Submit</button>';
        }
        
        ?>

        </form>
    </div>
    <div class="container mb-5">
        <h1 class="py-3 mb-0">Browse Questions</h1>

        <?php 
            $id=$_GET['id'];
            $sql="SELECT * FROM `thread` WHERE `thread_cat_id`='$id'; ";
            $result=mysqli_query($conn,$sql);
            $noResult=true;
            while ($row=mysqli_fetch_assoc($result)) {
                $id=$row['thread_id'];
                $title=$row['thread_title'];
                $desc=$row['thread_desc'];
                $th_user_id=$row['thread_user_id'];

                $sql2="SELECT * FROM `user` WHERE `user_id`='$th_user_id'; ";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                $username=$row2['user_username'];
                
            if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true") {
                echo '
                <div class="d-flex my-5 align-items-center">
                <div class="flex-shrink-0">
                    <img src="img/user.jpg" width="80px" class="rounded-circle" alt="...">
                    <p class="text-center">'.$username.'</p>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="mt-0"><a class="text-dark text-decoration-none"href="discussion.php?loginsuccess=true&&thread_id='.$id.'">'.$title.'</a></h5>
                    '.$desc.'
                </div>
            </div>';
            
        }
            else{
                echo '
                <div class="d-flex my-5 align-items-center">
                <div class="flex-shrink-0">
                    <img src="img/user.jpg" width="80px" class="rounded-circle" alt="...">
                    <p class="text-center">'.$username.'</p>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="mt-0"><a class="text-dark text-decoration-none"href="discussion.php?thread_id='.$id.'">'.$title.'</a></h5>
                    '.$desc.'
                </div>
            </div>';
            } 
                
            $noResult=false;
        }
        if ($noResult) {
            echo '
            <div class=" my-4 ">
            <div class="card mb-3 bg-light">
                <div class="card-body">
                    <h5 class="card-title h1 display-4">No Thread Found</h5>
                    <p class="card-text blockquote my-4">Be the first person to ask a question</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
            ';
        }

?>
    </div>

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