<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website - Home</title>
    <link rel="stylesheet" href="allCSS/style.css">
    <link rel="stylesheet" href="allCSS/style2.css">
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Baloo+Bhaijaan+2:wght@500;700&family=Bitter&family=Lobster&family=Sacramento&family=Titan+One&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Baloo+Bhaijaan+2:wght@500;700&family=Bitter&family=Lobster&family=Sacramento&family=Titan+One&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Baloo+Bhaijaan+2:wght@500;700&family=Bitter&family=Lobster&family=Sacramento&family=Shadows+Into+Light&family=Titan+One&display=swap" rel="stylesheet">

<!-- bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<body>
    <?php 
        include('checkLogin.php');
        // include('navbar.php');
        include('searchCategory.php');
    ?>
    <div class="homeContainer">
        <!-- CARAOUSEL -->
        <div class="hamariCaraosel">

            <div id="carouselExampleCaptions" class="carousel slide itemHai" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
                </ol>
                <div class="carousel-inner">
                    <!-- <?php
                        include('databaseConnect.php');
                        $sql = "SELECT * FROM `images`";
                        $res = mysqli_query($con, $sql);

                        if($res){
                            if(mysqli_num_rows($res) != 0){

                                $ans =  mysqli_num_rows($res);
                                $var = 1;

                                while($var <= $ans){
                                    $data = mysqli_fetch_assoc($res);

                                    echo '<div class="carousel-item active">
                                            <img src="categoriesImg/'.$data['imageName'].'" class="itemHai " alt="..." style="height: 650px;">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 style="font-size: 30px;"><strong>'. strtoupper($data['category']) .'</strong></h5>
                                            </div>
                                        </div>';

                                    $var = $var+1;
                                }
                            }
                        }

                    ?> -->
                    <div class="carousel-item active">
                        <img src="images/denim/denim22.jpeg" class="itemHai " alt="..." style="height: 650px; width: 100%">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 style="font-size: 30px;"><strong>DENIMS</strong></h5>
                        </div>
                    </div>
                    <div class="carousel-item itemHai">
                    <img src="images/dress/dress8.jpeg" class="itemHai" alt="..." style="height: 650px; width: 100%">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="font-size: 30px;"><strong>DRESSES</strong></h5>
                    </div>
                    </div>
                    <div class="carousel-item itemHai">
                    <img src="images/nightwear/nightwear31.webp" class="itemHai" alt="..." style="height: 650px; width: 100%">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="font-size: 30px;"><strong>NIGHT_WEARS</strong></h5>
                    </div>
                    </div>
                    <div class="carousel-item itemHai">
                    <img src="images/tops/top2.jpg" class="itemHai" alt="..." style="height: 650px; width: 100%">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="font-size: 30px;"><strong>TOPS</strong></h5>
                    </div>
                    </div>
                    <div class="carousel-item itemHai">
                    <img src="images/traditional/traditional8.webp" class="itemHai" alt="..." style="height: 650px; width: 100%">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="font-size: 30px;"><strong>TRADITIONALS</strong></h5>
                    </div>
                    </div>
                    <div class="carousel-item itemHai">
                    <img src="images/jeans/jeans13.jpeg" class="itemHai" alt="..." style="height: 650px; width: 100%">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="font-size: 30px;"><strong>JEANS</strong></h5>
                    </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>

        <div class="otherCon">
            <h1 class="homeH1" style="font-family: 'Shadows Into Light', cursive; font-weight:bolder;">Come On!!</h1>
            <h1 class="homeH1" style="font-family: 'Shadows Into Light', cursive; font-weight:bolder;">What are you waiting for?</h1>
            <h1 class="homeH1" style="font-family: 'Shadows Into Light', cursive; font-weight:bolder;">Choose Your Style!!</h1>
        </div>
    </div>

</body>
<!-- APNI JS -->
<script src="allJs/js2.js"></script>
<!-- BOOTSTRAP SCRIPT -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>