<?php
    $clothId = $_GET['id'];

    include('databaseConnect.php');
    $gettingCat_sql = "SELECT * FROM `allimages` WHERE `s.no` = '$clothId'";
    $gettingCat_res = mysqli_query($con, $gettingCat_sql);

    if($gettingCat_res){
        $data = mysqli_fetch_assoc($gettingCat_res);
        $clothCategory = $data['category'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website - <?php echo $clothCategory ?></title>
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

        // function showAlert($error_succ, $main, $cause){
        //     echo '<div class="alert alert-'.$error_succ.' allAlerts orderAlert" role="alert">
        //     <strong>'.$main.'</strong> '.$cause.'
        //   </div>';
        // }
        function accountExist($email){
            include('databaseConnect.php');

            $accsql = "SELECT * FROM `accounts` WHERE `user_email` = '$email'";
            $accRes = mysqli_query($con, $accsql);

            if(mysqli_num_rows($accRes) == 1){
                return true;
            }
            else{
                return false;
            }
        }
        function alreadyPlacedOrder($email, $clothId){
            include('databaseConnect.php');

            $orderSql = "SELECT * FROM `placedorder` WHERE `account_email` = '$email' AND `clothId` = '$clothId'";
            $orderRes = mysqli_query($con, $orderSql);

            if(mysqli_num_rows($orderRes) >= 1){
                return true;
            }
            else{
                return false;
            }
        }
        function sameItemOrder($clothId, $size, $quantity, $pay){
            include('databaseConnect.php');

            $order_Sql = "SELECT * FROM `placedorder` WHERE `clothId` = '$clothId' AND `size` = '$size' AND `quantity` = '$quantity' AND `methodOfPayment` = '$pay'";
            $order_Res = mysqli_query($con, $order_Sql);

            if(mysqli_num_rows($order_Res) >= 1){
                return true;
            }
            else{
                return false;
            }
        }
        function wishListed($id){
            include('databaseConnect.php');

            $wishSql = "SELECT * FROM `wishlist` WHERE `clothId` = '$id'";
            $wishRes = mysqli_query($con, $wishSql);

            if(mysqli_num_rows($wishRes) == 1){
                return true;
            }
            else{
                return false;
            }
        }

        // echo $_SESSION['logged'];
        // echo $_SESSION['email'];
    ?>

    <!-- CHECKING PLACED ORDER -->
    <?php

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            if(isset($_POST['wishlist'])){
                // echo 'WishList';
                if(wishListed($clothId)){
                    showAlert('danger', 'OOPS', 'Item is already wishlisted!');
                }
                else{

                    include('databaseConnect.php');
                    $sql3 = "SELECT `s.no`, `category`, `imageName`, `price`, `ratings` FROM `allimages` WHERE `s.no` = '$clothId'";
                    $res3 = mysqli_query($con, $sql3);

                    if($res3){
                        $data = mysqli_fetch_assoc($res3);
                        $price = $data['price'];

                        $wishListSql = "INSERT INTO `wishlist`(`s.no`, `clothId`, `email`, `price`) VALUES (NULL,'$clothId','$email', '$price')";
    
                        $wishListRes = mysqli_query($con, $wishListSql);
                        if($wishListRes){                        
                            showAlert('success', 'SUCCESS', 'Item has been wishlisted!');
                        }
                        else{                        
                            showAlert('danger', 'OOPS', 'Some error has occured!');
                        }                
                    }
                }
            }
            else if(isset($_POST['firstOrder']) || isset($_POST['orderAgain'])){
                if(accountExist($email)){
                    
                    if(isset($_POST['firstOrder'])){

                        if(isset($_POST['size']) && isset($_POST['pay'])){
                            $orderSize = $_POST['size'];
                            $orderQuantity = $_POST['quantity'];
                            $orderPayMehod = $_POST['pay'];

                            if($orderQuantity > 0){

                                if(sameItemOrder($clothId, $orderSize, $orderQuantity, $orderPayMehod)){
                                    showAlert('danger', 'OOPS', 'Already ordered!');
                                }
                                else{
                                    include('databaseConnect.php');
                                    $amountsql = "SELECT `price` FROM `allimages` WHERE `s.no` = '$clothId'";
                                    $amountRes = mysqli_query($con, $amountsql);
                    
                                    if($amountRes){
                                        $amountdata = mysqli_fetch_assoc($amountRes);
                
                                        $totalAmount = $orderQuantity*($amountdata['price']);
                                    }
                                    // echo $orderSize . ' and ' . $orderQuantity . ' and ' . $orderPayMehod . ' and ' . $clothId . ' and ' . $totalAmount;
                
                                    $order_again_sql = "INSERT INTO `placedorder`(`s.no`, `clothId`, `quantity`, `totalPrice`, `account_email`, `size`, `methodOfPayment`) VALUES (NULL,'$clothId','$orderQuantity','$totalAmount','$email','$orderSize','$orderPayMehod')";
                    
                                    $order_again_res = mysqli_query($con, $order_again_sql);
                                    if($order_again_res){
                                        showAlert('success', 'SUCESS!!', 'Order has been successfully!');
                                    }
                                    else{                
                                        showAlert('danger', 'OOPS!!', 'Some error has occurred!');
                                    }                                    
                                }                                
                            }
                            else{
                                showAlert('danger', 'OOPS', 'Cannot place order!!');
                            }
                        }
                        else{
                            showAlert('danger', 'OOPS', 'Please fill the details first!!');
                        }
                    }
                    else if(isset($_POST['orderAgain'])){

                        if(($_POST['sizeAgain'] != 'undefined') && ($_POST['payAgain'] != 'undefined')){
                            $orderSize = $_POST['sizeAgain'];
                            $orderQuantity = $_POST['quantityAgain'];
                            $orderPayMehod = $_POST['payAgain'];

                            if($orderQuantity > 0){
                                
                                if(sameItemOrder($clothId, $orderSize, $orderQuantity, $orderPayMehod)){
                                    showAlert('danger', 'OOPS', 'Already ordered!');
                                }
                                else{
                                    include('databaseConnect.php');
                                    $amountsql = "SELECT `price` FROM `allimages` WHERE `s.no` = '$clothId'";
                                    $amountRes = mysqli_query($con, $amountsql);
                    
                                    if($amountRes){
                                        $amountdata = mysqli_fetch_assoc($amountRes);
                
                                        $totalAmount = $orderQuantity*($amountdata['price']);
                                    }
                                    // echo $orderSize . ' and ' . $orderQuantity . ' and ' . $orderPayMehod . ' and ' . $clothId . ' and ' . $totalAmount;
                
                                    $order_again_sql = "INSERT INTO `placedorder`(`s.no`, `clothId`, `quantity`, `totalPrice`, `account_email`, `size`, `methodOfPayment`) VALUES (NULL,'$clothId','$orderQuantity','$totalAmount','$email','$orderSize','$orderPayMehod')";
                    
                                    $order_again_res = mysqli_query($con, $order_again_sql);
                                    if($order_again_res){
                                        showAlert('success', 'SUCESS!!', 'Order has been successfully!');
                                    }
                                    else{                
                                        showAlert('danger', 'OOPS!!', 'Some error has occurred!');
                                    }
                                }
                            }
                            else{
                                showAlert('danger', 'OOPS', 'Cannot place order!!');
                            }
                        }
                        else{
                            showAlert('danger', 'OOPS', 'Please fill the details first!!');
                        }
                    }
                }
                else{
                    header('location: account.php');
                }
            }
        }
    ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Again?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color: rgb(242, 242, 242);">
                    <form action="" id="changePass" method="post">                        
                        <h6>You have already ordered this!!</h6>
                        <h5><strong>You sure wanna order this again?</strong></h5>
                        
                        <div class="modal-footer">
                            <input type="hidden" name="sizeAgain" id="sizeAgain">
                            <input type="hidden" name="quantityAgain" id="quantityAgain">
                            <input type="hidden" name="payAgain" id="payAgain">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn-green" style="width:auto; border-radius: 5px;" name="orderAgain" type="submit">Order Again</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    
    <div class="catcontainer">
        <div class="newCon">
            <?php 

                include('databaseConnect.php');
                if(isset($_GET['id'])){

                   $id = $_GET['id'];
                   $sql = "SELECT `s.no`, `category`, `imageName`, `price`, `ratings` FROM `allimages` WHERE `s.no` = '$id'";

                   $res = mysqli_query($con, $sql);

                   $data = mysqli_fetch_assoc($res);
                }
                else{
                    // echo 'No id';
                }
            ?>
            <div class="aboutPicture">
                <img src="images/<?php echo $data['category'] ?>/<?php echo $data['imageName'] ?>" alt="">
                <div class="addList">

                    <?php
                        if(wishListed($clothId)){                  
                            echo '<h1 style="font-weight: bolder;">WishListed!!</h1>';
                        }
                        else{                        
                            echo '<form action="" method="post">
                                    <input type="hidden" name="wishlist" id="">
                                    <button class="btn-red" id="wishButton" type="submit" name="">Add to WishList</button>
                                </form>';
                        }
                    ?>
                    <!-- <form action="" method="post">
                        <div class="addWishButton">
                            <input type="radio" name="wishlist" id="">
                        </div>
                        <button class="btn-blue" type="submit" name="" style="width:70%;">Add to WishList</button>
                    </form> -->
                </div>
            </div>
            <div class="aboutCloth">
                <h1 class="orderDiv_h1">Amount: ₹ <strong><?php echo $data['price'] ?></strong></h1>
                <div class="rating_div">
                    <h2 class="orderDiv_rate">Ratings:    </h2>
                    <?php 
                        $ratingsStar = $data['ratings'];
                        $left = 5-$ratingsStar;

                        while($ratingsStar != 0){
                            echo '<span style="font-size:200%;color:rgb(204, 204, 0);">&starf; </span>';
                            
                            $ratingsStar = $ratingsStar -1;
                        }
                        while($left != 0){
                            echo '<span style="font-size:200%;color:rgb(204, 204, 0);;">&star;</span>';
                            
                            $left = $left -1;
                        }
                    ?> 
                </div>
                
                <?php 
                    if(alreadyPlacedOrder($email, $clothId)){
                        // echo 'ALREADY placed';
                        echo '<form action="" method="post" class="orderForm" id="orderForm">
                                <h2 class="orderDiv_rate">Size: </h2>
                                <div>
                                    <h5 class="subChoice"> XS (Extra Small): </h5> <input type="radio" name="size_again" id="extraSmall" value="extraSmall"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> S (Small): </h5> <input type="radio" name="size_again" id="small" value="small"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> M (Medium): </h5> <input type="radio" name="size_again" id="medium" value="medium"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> L (Large): </h5> <input type="radio" name="size_again" id="large" value="large"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> XL (Extra Large): </h5> <input type="radio" name="size_again" id="extraLarge" value="extraLarge"><br>
                                </div>
                                <h2 class="orderDiv_rate">Quantity: </h2>
                                <input type="number" name="quantity_again" id="quantity_again" value="1"><br>
                                <h2 class="orderDiv_rate">Payment: </h2>
                                <div>
                                    <h5 class="subChoice"> UPI/Net Banking: </h5> <input type="radio" name="pay_again" id="upi" value="upi"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> Pay on delivery: </h5> <input type="radio" name="pay_again" id="cod" value="cod"><br> 
                                </div>   
                                <input type="hidden" name="orderAgain">
                                <button class="btn-green" type="button" id="orderAgainModal" name="orderAgainModal" data-toggle="modal" data-target="#exampleModal">Place Order</button><br>
                                </form>';
                                // <button class="btn-green" type="submit" name="orderAgain">Order Again</button><br>
                    }
                    else{
                        // echo 'Not placed';
                        echo '<form action="" method="post" class="orderForm" id="orderForm">
                                <h2 class="orderDiv_rate">Size: </h2>
                                <div>
                                    <h5 class="subChoice"> XS (Extra Small): </h5> <input type="radio" name="size" id="extraSmall_" value="extraSmall"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> S (Small): </h5> <input type="radio" name="size" id="small_" value="small"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> M (Medium): </h5> <input type="radio" name="size" id="medium_" value="medium"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> L (Large): </h5> <input type="radio" name="size" id="large_" value="large"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> XL (Extra Large): </h5> <input type="radio" name="size" id="extraLarge_" value="extraLarge"><br>
                                </div>
                                <h2 class="orderDiv_rate">Quantity: </h2>
                                <input type="number" id="quantity_" name="quantity" value="1"><br>
                                <h2 class="orderDiv_rate">Payment: </h2>
                                <div>
                                    <h5 class="subChoice"> UPI/Net Banking: </h5> <input type="radio" name="pay" id="upi_" value="upi"><br>
                                </div>
                                <div>
                                    <h5 class="subChoice"> Pay on delivery: </h5> <input type="radio" name="pay" id="cod_" value="cod"><br> 
                                </div>   
                                <input type="hidden" name="firstOrder">
                                <button class="btn-green" type="submit" id="orderBtn" name="orderBtn">Place Order</button><br>
                            </form>';
                    }
                ?>
            </div>
            <?php
                // REVIEW EXISTS?

                function reviewExist($itemId){
                    include('databaseConnect.php');
                    $checkReview = "SELECT * FROM `review` WHERE `clothId` = '$itemId'";
                    $checkReviewRes = mysqli_query($con, $checkReview);
        
                    if(mysqli_num_rows($checkReviewRes) > 0){
                        return true;
                    }
                    else{
                        return false;
                    }
                }

                // GRABING AUTHORS NAME
                include('databaseConnect.php');
                $email = $_SESSION['email'];

                $authorInfoSql = "SELECT `s.no`, `user_email`, `account_name`, `address`, `dp`, `contactNumber` FROM `accounts` WHERE `user_email` = '$email'";
                $authorInfoRes = mysqli_query($con, $authorInfoSql);

                if($authorInfoRes){
                    $authorInfoData = mysqli_fetch_assoc($authorInfoRes);
                    $authorInfoName = $authorInfoData['account_name'];
                }
            ?>            
            <div class="aboutReview">
                <div class="revHeading">
                        <h1 style="font-weight: bolder; text-align:center;">Customer Reviews</h1>
                </div>
                <div class="selectedReviews">
                    <?php
                        include('databaseConnect.php');
                        if(reviewExist($clothId)){

                            include('databaseConnect.php');
                            $getReview_Sql = "SELECT `s.no`, `email`, `clothId`, `author_name`, `review_heading`, `review_content`, `dateTime` FROM `review` WHERE `clothId` = '$clothId'";
                            
                            $getReview_Res = mysqli_query($con, $getReview_Sql);

                            if($getReview_Res){
                                $rows = mysqli_num_rows($getReview_Res);
                                
                                if($rows <= 2){

                                    while($rows > 0){
                                        $reviewData = mysqli_fetch_assoc($getReview_Res);

                                        $revHead = $reviewData['review_heading'];
                                        $revCon = $reviewData['review_content'];
                                        $revAuthor = $reviewData['author_name'];
                                        $revTime= $reviewData['dateTime'];

                                        echo '<div class="eachReview">
                                                <div class="reviewHeading">
                                                    <h4><strong>' . $revHead . '</strong></h4>
                                                </div>
                                                <div class="reviewContent">
                                                    <p>' . $revCon . '</p>
                                                </div>
                                                <div class="reviewAuthor">
                                                    <p><strong>~' . $revAuthor . ' <em>(' . $revTime . ')</em> </strong></p>
                                                </div>
                                            </div>';

                                            // </div>
                                            // <div class="allReviewLink">
                                            //     <a href="allReview.php?itemId='. $clothId .'" class="designA" style="font-size: 25px;">See all Review-></a>
                                            // </div>';

                                        $rows = $rows-1;
                                    }
                                    echo '</div>';
                                }
                                else{
                                    $var = 1;
                                    while($var <= 2){
                                        $reviewData = mysqli_fetch_assoc($getReview_Res);

                                        $revHead = $reviewData['review_heading'];
                                        $revCon = $reviewData['review_content'];
                                        $revAuthor = $reviewData['author_name'];
                                        $revTime = $reviewData['dateTime'];

                                        echo '<div class="eachReview">
                                                <div class="reviewHeading">
                                                    <h4><strong>' . $revHead . '</strong></h4>
                                                </div>
                                                <div class="reviewContent">
                                                    <p>' . $revCon . '</p>
                                                </div>
                                                <div class="reviewAuthor">
                                                    <p><strong>~' . $revAuthor . ' <em>(' . $revTime . ')</em> </strong></p>
                                                </div>
                                            </div>';

                                        $var = $var+1;
                                    }

                                    echo '</div>
                                        <div class="allReviewLink">
                                            <a href="allReview.php?itemId='. $clothId .'" class="designA" style="font-size: 25px;">See all Review-></a>
                                        </div>';
                                }
                            }                                
                        }
                        else{
                            echo '<h2 style="font-weight: bolder; color:rgb(0, 0, 102);">No reviews yet!!</h2>
                            ';
                            // echo '<h2 style="font-weight: bolder; color:rgb(0, 0, 102);">No reviews yet!!</h2>
                            //     <div class="allReviewLink">
                            //         <a href="allReview.php?itemId='. $clothId .'" class="designA" style="font-size: 25px;">See all Review-></a>
                            //     </div>';
                        }
                    ?>
            </div>
        </div>
    </div>

</body>
<!-- APNI JS -->
<script src="allJs/js3.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>