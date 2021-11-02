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
    <?php require "_dbconnect.php"; ?>
    <?php require "_navbar.php"; ?>
    <div class="container my-4">
        <h1>Search results for <em>'<?php echo $_GET['search'];?>'</em></h1>
        <?php 
            $query=$_GET['search'];
            $sql="SELECT * FROM `thread` WHERE match (thread_title,thread_desc) against ('$query');";
            $result=mysqli_query($conn,$sql);
            $noresults=true;
                while ($row=mysqli_fetch_assoc($result)) {
                    $title=$row['thread_title'];
                    $desc=$row['thread_desc'];
                    $id=$row['thread_id'];
                    $url="../discussion.php?thread_id=".$id;
                    echo '<div class="result my-4 ">
                            <h3> <a class="text-dark " href="'.$url.'">
                            '.$title.'</a></h3>
                                '.$desc.'
                            </div>';
                    $noresults=false;
                }
            
            if($noresults) {
                echo '
                <div class=" my-4 ">
                <div class="card mb-3 bg-light">
                    <div class="card-body">
                        <h5 class="card-title h1 display-4">No search results Found</h5>
                        <p class="lead">Suggestions:</p>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                            <li>Try fewer keywords.</li>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
                ';            }
            
            
            ?>

    </div>
    </div>
    <?php require "footer.php"; ?>
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
</body>---

</html>