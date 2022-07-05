<?php
        include('checkLogin.php');
        // include('navbar.php');
        include('searchCategory.php');
        $cat = $_GET['cat'];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website - <?php echo $cat; ?></title>
    <link rel="stylesheet" href="allCSS/style.css">
    <link rel="stylesheet" href="allCSS/style2.css">
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Baloo+Bhaijaan+2:wght@500;700&family=Bitter&family=Lobster&family=Sacramento&family=Titan+One&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <lisnk href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Baloo+Bhaijaan+2:wght@500;700&family=Bitter&family=Lobster&family=Sacramento&family=Titan+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Baloo+Bhaijaan+2:wght@500;700&family=Bitter&family=Lobster&family=Sacramento&family=Shadows+Into+Light&family=Titan+One&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    
    <div class="catcontainer">
        <div class="anotherCon particularCategory">

            <?php
                if(isset($_GET['cat'])){
                    
                    include('databaseConnect.php');
                    $cat = $_GET['cat'];
                    $sql = "SELECT `s.no`, `category`, `imageName`, `price`, `ratings` FROM `allimages` WHERE `category` = '$cat'";
                    $res = mysqli_query($con, $sql);

                    if($res){
                        
                        if(mysqli_num_rows($res) != 0){

                            $total =  mysqli_num_rows($res);
                            $var = 1;

                            while($var <= $total){
                                $data = mysqli_fetch_assoc($res);

                                $ratingsStar = $data['ratings'];
                                $left = 5-$ratingsStar;

                                echo '<div class="eachcatElem">
                                        <div class="imageCat">
                                            <img src="images/'.$data['category'].'/'.$data['imageName'].'" alt="">
                                        </div>
                                        <div class="priceRat">
                                            <h1>₹'. $data['price'] .'</h1>
                                            <div class="ratings">';

                                while($ratingsStar > 0){
                                    echo '<span style="font-size:200%;color:rgb(204, 204, 0);">&starf; </span>';

                                    $ratingsStar = $ratingsStar-1;
                                }
                                while($left > 0){
                                    echo '<span style="font-size:200%;color:rgb(204, 204, 0);">&star;</span>';

                                    $left = $left-1;
                                }

                                echo '<a href="eachCloth.php?id='.$data['s.no'].'" class="designA"><strong><h5>Check out-></h5></strong></a>
                                        </div>
                                    </div>
                                </div>';

                                $var = $var +1;
                            }
                        }
                    }
                }
                else{
                    // echo 'There is no category';                    
                }
            ?>
        </div>
    </div>

</body>
<!-- APNI JS -->
<script src="allJs/js2.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>