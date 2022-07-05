<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website - Your Orders</title>
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

        function reviewExist($author, $itemId){
            include('databaseConnect.php');
            $checkReview = "SELECT * FROM `review` WHERE `author_name` = '$author' AND `clothId` = '$itemId'";
            $checkReviewRes = mysqli_query($con, $checkReview);

            if(mysqli_num_rows($checkReviewRes) > 0){
                return true;
            }
            else{
                return false;
            }
        }
    ?>

    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reviewBtn'])){

            if((isset($_POST['review_Heading']) && $_POST['review_Heading'] != '') && (isset($_POST['review_Heading']) && $_POST['review_Heading'] != '')){
                
                $reviewHead = $_POST['review_Heading'];
                $reviewCon = $_POST['review_Content'];
                $itemId = $_POST['itemId'];
                // $email = $_SESSION['email']; 

                include('databaseConnect.php');
                $authorSql = "SELECT `s.no`, `user_email`, `account_name`, `address`, `dp`, `contactNumber` FROM `accounts` WHERE `user_email` = '$email'";
                $authorRes = mysqli_query($con, $authorSql);

                if($authorRes){
                    $authorData = mysqli_fetch_assoc($authorRes);
                    $authorName = $authorData['account_name'];
                    
                    // echo $reviewHead . ' and ' . $reviewCon . ' and ' . $itemId . ' and ' . $authorName . ' and ' . $email;

                    if(reviewExist($authorName, $itemId)){
                        showAlert('danger', 'OOPS', 'You have already reviewd the item!');
                    }
                    else{
                        $reviewSql = "INSERT INTO `review`(`s.no`, `email`, `clothId`, `author_name`, `review_heading`, `review_content`) VALUES (NULL,'$email','$itemId','$authorName','$reviewHead','$reviewCon')";
    
                        $reviewres = mysqli_query($con, $reviewSql);
                        if($reviewres){
                            showAlert('success', 'SUCCESS', 'Your review has been registered!');    
                        }
                        else{
                            showAlert('danger', 'OOPS', 'Some error has occured!');
                        }
                    }
                }

            }
            else{
                showAlert('danger', 'OOPS', 'Write a review first!');
            }
        }

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
            <div class="smallCon yourOrder_Con">
            <div class="yourallOrder">
                <h1 style="text-align:center; font-weight: bolder;">Your Orders</h1>
                <div class="sareOrders">
                    <?php
                        $email = $_SESSION['email'];

                        $ordersSql = "SELECT `s.no`, `clothId`, `quantity`, `totalPrice`, `account_email`, `size`, `methodOfPayment` FROM `placedorder` WHERE `account_email` = '$email'";

                        include('databaseConnect.php');
                        $orderRes =  mysqli_query($con, $ordersSql);

                        if($orderRes){
                            $rows = mysqli_num_rows($orderRes);

                            $var = 0;
                            while($var < $rows){
                                $data = mysqli_fetch_assoc($orderRes);         
                                $imageId = $data['clothId'];
                                
                                $OrderImageSql = "SELECT `s.no`, `category`, `imageName`, `price`, `ratings` FROM `allimages` WHERE `s.no` = '$imageId'";
                                include('databaseConnect.php');
                                $OrderImageRes =  mysqli_query($con, $OrderImageSql);

                                if($OrderImageRes){
                                    $imgData = mysqli_fetch_assoc($OrderImageRes);

                                    $imgFolder = $imgData['category'];
                                    $imgName = $imgData['imageName'];                                    
                                    $imgId = $imgData['s.no'];                                    

                                    echo '<div class="everyOrder">
                                            <div class="everyorderBox">
                                                <div class="orderPic">
                                                    <img src="images/'. $imgFolder .'/'. $imgName .'" alt="">
                                                </div>
                                                <div class="orderInfo">
                                                    <h5 class="orderPrice">Amount: ₹' . $data['totalPrice'] . '</h5>
                                                    <h6 class="orderQuantity">Quantity: ' . $data['quantity'] . '</h6>
                                                    <h6 class="orderSize">Size: ' . $data['size'] . '</h6>
                                                    <a href="eachCloth.php?id='.$imgId.'" class="designA linkDesign">Order Again-></a>
                                                </div>
                                            </div>
                                            <div class="yourReview">';

                                        if(reviewExist($authorInfoName, $imgId)){

                                            $getReviewSql = "SELECT `s.no`, `email`, `clothId`, `author_name`, `review_heading`, `review_content`, `dateTime` FROM `review` WHERE `author_name` = '$authorInfoName' AND `clothId` = '$imgId'";

                                            $getReviewRes = mysqli_query($con, $getReviewSql);
                                            if($getReviewRes){

                                                $reviewData = mysqli_fetch_assoc($getReviewRes);
                                                $revHead = $reviewData['review_heading'];
                                                $revCon = $reviewData['review_content'];
                                                $revAuthor = $reviewData['author_name'];
                                                $revTime= $reviewData['dateTime'];
                                            }

                                            echo '<div class="reviewBox">
                                                        <div class="reviewHeading">
                                                            <h4 id="reviewHeading"><strong>'. $revHead .'</strong></h4>
                                                        </div>
                                                        <div class="reviewContent">
                                                            <p id="reviewContent">'. $revCon .'</p>
                                                        </div>
                                                        <div class="reviewAuthor">
                                                            <p class="review_Author"><strong>~'. $revAuthor .' </strong></p>
                                                            <p class="review_Author"><em><strong>  (' . $revTime . ')</strong></em></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                        }
                                        else{
                                                echo    '<form action="" method="post" id="review_form">
                                                        <h5><strong>Leave a review: </strong></h5>
                                                        <input type="hidden" name="itemId" value="' . $imgId . '"></input>
                                                        <input type="hidden" name="itemId" value="' . $imgId . '"></input>
                                                        <textarea name="review_Heading" id="review_Heading" placeholder="Write Review Heading..."></textarea>
                                                        <textarea name="review_Content" id="review_Content" placeholder="Write Review Content..."></textarea>
                                                        <button class="btn-blue" id="submit_review" name="reviewBtn" type="submit">Add Review</button>
                                                    </form>
                                                </div>
                                            </div>';
                                        }

                                
                                }    
                                $var = $var +1;
                            }
                        }
                    ?>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- <div class="reviewBox">
        <div class="reviewHeading">
            <h3>Heading</h3>
        </div>
        <div class="reviewContent">
            <p>Content</p>
        </div>
    </div> -->

</body>
<script src="allJs/js2.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>