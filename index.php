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


    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/forum/img/img3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/forum/img/img2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/forum/img/img1.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <div class="container my-4  ">
        <h1 class="text-center">iDiscuss-Categorie</h1>
        <div class="row my-4">
        <?php 

        $sql="select * from `categorie`; ";
        $result=mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_assoc($result)) {
            $decription=$row['categorie_desc'];
            
            if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true") {
                echo '
               <div class="col-md-4 my-4">
                   <div class="card" style="width: 18rem;">
                   <a href="threadlist.php?id='. $row['categorie_id'].'&&loginsuccess=true" >
                    <img src="https://source.unsplash.com/500x400/?'. $row['categorie_name'].',coding" class="card-img-top" alt="...">
                   </a>
                       
                       <div class="card-body">
                           <h5 class="card-title" ><a class="text-decoration-none"href="threadlist.php?loginsuccess=true&&id='. $row['categorie_id'].'">'. $row['categorie_name'].'</a></h5>
                           <p class="card-text">
                           '. substr($decription,0,85).'...</p>
                           <a href="threadlist.php?loginsuccess=true&&id='. $row['categorie_id'].'" class="btn btn-primary">View Thread</a>
                       </div>
                   </div>
               </div>
               ';
            }else {
                echo '
               <div class="col-md-4 my-4">
                   <div class="card" style="width: 18rem;">
                   <a href="threadlist.php?discussion=false&&id='. $row['categorie_id'].'" >
                    <img src="https://source.unsplash.com/500x400/?'. $row['categorie_name'].',coding" class="card-img-top" alt="...">
                   </a>
                       
                       <div class="card-body">
                           <h5 class="card-title" ><a class="text-decoration-none"href="threadlist.php?discussion=false&&id='. $row['categorie_id'].'">'. $row['categorie_name'].'</a></h5>
                           <p class="card-text">
                           '. substr($decription,0,85).'...</p>
                           <a href="threadlist.php?discussion=false&&id='. $row['categorie_id'].'" class="btn btn-primary">View Thread</a>
                       </div>
                   </div>
               </div>
               ';
            }
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
