<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My first site</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?
session_start();
include_once "pages/function.php";
?>
    <div class="container">
        <div class="row">
            <header class="col-sm-12 col-md-12 col-lg-12">
                <? if(!isset($_POST['authbtn']) && !isset($_SESSION['isAuth'])) {?>
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <label for="loginAuth">Login:</label>
                            <input type="text" class="form-control" name="loginAuth">
                        </div>
                        <div class="form-group">
                            <label for="passwordAuth">Password:</label>
                            <input type="password" class="form-control" name="passwordAuth">
                        </div>
                        <button type="submin" class="btn btn-primary" name="authbtn" value="y">Athorize</button>
                    </form>
                    <? } if(isset($_POST['authbtn'])){
                        if(login($_POST['loginAuth'], $_POST['passwordAuth'])){
                            $_SESSION['isAuth'] = 'Y';
                        } else {
                            echo '<script>window.location = "index.php?page=4";</script>';
                        }
                    }
                    if (isset($_SESSION['isAuth'])) {
                        echo '<a href="index.php?exit=yes" class="btn btn-primary">Quit</a>';
                    }
                    if(isset($_GET['exit']) && $_GET['exit'] == 'yes'){
                        unset($_SESSION['isAuth']);
                    }
                    ?>
            </header>
        </div>
        <div class="row">
            <nav class="col-sm-12 col-md-12 col-lg-12">
                <?php
                    include_once "pages/menu.php";
                ?>
            </nav>
        </div>
        <div class="row">
            <section class="col-sm-12 col-md-12 col-lg-12">
                <?php
                    if (isset($_GET["page"])){
                        $page = $_GET["page"];
                        if($page == 1) include_once "pages/home.php";
                        if($page == 2) include_once "pages/upload.php";
                        if($page == 3) include_once "pages/gallery.php";
                        if($page == 4) include_once "pages/registration.php";
                    }
                ?>
            </section>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>