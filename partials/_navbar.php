<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?php 
                        if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true") {
                            echo '<a class="nav-link active" aria-current="page" href="/forum/index.php?loginsuccess=true">Home</a>';
                        }
                        else {
                            echo '<a class="nav-link active" aria-current="page" href="/forum/index.php">Home</a>';
                        }
                    
                    ?>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Top Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                        $sql="select categorie_name,categorie_id from `categorie`; ";
                        $result=mysqli_query($conn,$sql);
                        while ($row=mysqli_fetch_assoc($result)) {
                            $cat_id=$row['categorie_id'];
                            $cat_name=$row['categorie_name'];
                            if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true") {
                                echo '<li><a class="dropdown-item" href="/forum/threadlist.php?loginsuccess=true&&id='.$cat_id.'">'.$cat_name.'</a></li>';
                            }
                            else {
                                echo '<li><a class="dropdown-item" href="/forum/threadlist.php?discussion=false&&id='.$cat_id.'">'.$cat_name.'</a></li>';
                            }
                        }
                        
                        ?>
                        <li><a class="dropdown-item" href="/forum/threadlist.php?discussion=false&&id=1">Python</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>

            </ul>
            <form class="d-flex" action="/forum/partials/search.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary mx-3" type="submit">Search</button>
            </form>
            

            <?php 
            session_start();
            if (!isset($_SESSION)) {
                echo "you are loggen in";
            }
                if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true") {
                    echo '<p class="text-light my-0">Welcome '.$_SESSION['username'].'</p>
                    <button class="btn btn-outline-primary mx-3" type="submit" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>';
                }else {
                    echo '<button class="btn btn-primary mx-3" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</button>
                    <button class="btn btn-primary ml-3" type="submit" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Login</button>'; 
                }
            ?>

        </div>
    </div>
</nav>
<?php 
require "loginmodal.php";
require "signupmodal.php";
require "logoutmodal.php";
require "postmodal.php";

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
    echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account has been successfully created now you can login.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true") {
    if (isset($_GET['showAlert']) ) {

        $showAlert=$_GET['showAlert'];
        echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong>'.$showAlert.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}
else{
    if (isset($_GET['showError'])) {
    $showError=$_GET['showError'];
    echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error! </strong>'.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
    if (isset($_GET['showAlert'])) {
    $showError=$_GET['showAlert'];
    echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Success! </strong>'.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
}




?>