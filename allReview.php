<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website - Customer Reviews</title>
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
    <?php
        include('checkLogin.php');
        // include('navbar.php');
        include('searchCategory.php');
        $email = $_SESSION['email'];

        function reviewExist($item_Id){
            include('databaseConnect.php');
            $checkReview = "SELECT * FROM `review` WHERE `clothId` = '$item_Id'";
            $checkReviewRes = mysqli_query($con, $checkReview);

            if(mysqli_num_rows($checkReviewRes) > 0){
                return true;
            }
            else{
                return false;
            }
        }

        $itemId = $_GET['itemId'];
    ?>

    <?php

        // GRABING AUTHORS NAME
        include('databaseConnect.php');
        $authorInfoSql = "SELECT `s.no`, `user_email`, `account_name`, `address`, `dp`, `contactNumber` FROM `accounts` WHERE `user_email` = '$email'";
        $authorInfoRes = mysqli_query($con, $authorInfoSql);

        if($authorInfoRes){
            $authorInfoData = mysqli_fetch_assoc($authorInfoRes);
            $authorInfoName = $authorInfoData['account_name'];
            
            // echo $reviewHead . ' and ' . $reviewCon . ' and ' . $itemId . ' and ' . $authorInfoName . ' and ' . $email;
        }
    ?>
    
    <div class="catcontainer">
        <div class="newCon"> 
            <div class="smallCon">
                <div class="rev_Heading">
                    <h1 style="font-weight: bolder;">Customer Reviews</h1>
                </div>
                <div class="saareReview">
                    <?php
                        if(reviewExist($itemId)){
                
                            include('databaseConnect.php');
                            $getAllReview_Sql = "SELECT * FROM `review` WHERE `clothId` = '$itemId'";
                            $getAllReview_Res = mysqli_query($con, $getAllReview_Sql);
                
                            if($getAllReview_Res){
                                $rows = mysqli_num_rows($getAllReview_Res);
                
                                while($rows > 0){
                                    $data = mysqli_fetch_assoc($getAllReview_Res);                
                                    $rev_heading = $data['review_heading'];
                                    $rev_content = $data['review_content'];
                                    $rev_author = $data['author_name'];
                                    $rev_time = $data['dateTime'];
                    
                                    echo '<div class="harReview">
                                            <div class="reviewHeading">
                                                <h4><strong>' . $rev_heading . '</strong></h4>
                                            </div>
                                            <div class="reviewContent">
                                                <p>' . $rev_content . '</p>
                                            </div>
                                            <div class="reviewAuthor">
                                                <p><strong>~' . $rev_author . '</strong></p>
                                                <p><strong><em>(' . $rev_time . ')</em></strong></p>
                                            </div>
                                        </div>';

                                    $rows = $rows-1;
                                }
                            }
                        }
                    ?>
                    <!-- <div class="harReview">
                        <div class="reviewHeading">
                            <h4><strong>' . $revHead . '</strong></h4>
                        </div>
                        <div class="reviewContent">
                            <p>This is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is contentThis is content</p>
                        </div>
                        <div class="reviewAuthor">
                            <p><strong>~' . $revAuthor . '</strong></p>
                            <p><strong><em>' . $revTime . '</em></strong></p>
                        </div>
                    </div>   -->
                </div>
                <div class="itemLink">
                    <a href="eachCloth.php?id=<?php echo $itemId ?>" class="designA" style="font-size: 25px;">Visit Product-></a>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="allJs/js2.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>