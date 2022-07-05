<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website - Your Account</title>
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
        // function showAlert($error_succ, $main, $cause){
        //     echo '<div class="alert alert-'.$error_succ.' allAlerts" role="alert">
        //     <strong>'.$main.'</strong> '.$cause.'
        //   </div>';
        // }
        
        include('checkLogin.php');
        // include('navbar.php');
        include('searchCategory.php');

        function validateNumber($number){
            if(strlen($number) == 10){
                return true;
            }
            else{
                return false;
            }
        }
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

        if(accountExist($_SESSION['email']) == false){            
            // showAlert('danger', 'OOPS!!', 'Please create account first!');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['isForm'])){

            if($_POST['submitPhoto'] && isset($_FILES['profilePic'])){
                // print_r($_FILES['profilePic']);

                $picName = $_FILES['profilePic']['name'];
                $source = $_FILES['profilePic']['tmp_name'];
                
                $extArray = explode('.', $picName);
                // echo '<br>Array: '. $extArray;
                $ext = end($extArray);
                // echo '<br>Extension: '. $ext;

                $picName = 'profile'. random_int(0, 99) . '.' . $ext;
                
                $destination = "images/profile/" . $picName;
                move_uploaded_file($source, $destination);

                if((isset($_POST['name'])&& $_POST['name'] != '') && (isset($_POST['address']) && $_POST['address'] != '') && (isset($_POST['contactNumber']) && $_POST['contactNumber'] != '')){

                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $contactNumber = $_POST['contactNumber'];
                    $email = $_SESSION['email'];
    
                    // echo $name . ' and ' . $address . ' and ' . $contactNumber . ' and ' . $email;

                    if(validateNumber($contactNumber)){
                        if(accountExist($email) == false){
                            
                            include('databaseConnect.php');
                            $sql = "INSERT INTO `accounts`(`s.no`, `user_email`, `account_name`, `address`, `dp`, `contactNumber`) VALUES (NULL,'$email','$name','$address','$picName','$contactNumber')";

                            $res = mysqli_query($con, $sql);
                            if($res){
                                showAlert('success', 'SUCCESS!!', 'Your account has been created!');
                            }
                            else{
                                showAlert('danger', 'OOPS!!', 'Some error has occured!');
                            }    
                        }
                        else{
                            showAlert('danger', 'OOPS!!', 'Account already exists!');
                        }
                    }
                    else{
                        showAlert('danger', 'OOPS!!', 'Contact Number is not valid!');
                    }
                }
                else{                    
                    showAlert('danger', 'OOPS!!', 'Please fill the details first!');
                }
            }
            else{
                showAlert('danger', 'OOPS!!', 'Please select the picture first!');
            }
        }

    ?>
    
    <div class="catcontainer">
        <div class="newCon accountContainer"> 
            <div class="account">
                <?php
                    // echo $_SESSION['email'];
                    if(accountExist($_SESSION['email'])){

                        include('databaseConnect.php');
                        $email = $_SESSION['email'];

                        $accountSql = "SELECT `s.no`, `user_email`, `account_name`, `address`, `dp`, `contactNumber` FROM `accounts` WHERE `user_email` = '$email'";

                        $accountRes = mysqli_query($con, $accountSql);                    
                        if($accountRes){

                            $data = mysqli_fetch_assoc($accountRes);
                            
                            echo '<div class="namePic">
                                    <div class="name">
                                        <h3>Your Account</h3>
                                        <h1 style="display: inline-block; font-weight:bolder;">Hello! ' . $data['account_name'] . ' :)) </h1>
                                    </div>
                                    <div class="dp">
                                        <img class="dpPic" src="images/profile/' . $data['dp'] . '" alt="" style="width:auto; height: 100%; border-radius: 70%;">
                                    </div>
                                </div>
                    
                                <div class="otherInfo">
                                    <div class="otherInfo_div">
                                        <h3>Name: </h3>
                                        <h1><strong> ' . $data['account_name'] . ' </strong></h1>
                                    </div><br>
                                    <div class="otherInfo_div">
                                        <h3>Current Address: </h3>
                                        <h1><strong> ' . $data['address'] . ' </strong></h1>
                                    </div><br>
                                    <div class="otherInfo_div">
                                        <h3>Contact Number: </h3>
                                        <h1><strong> ' . $data['contactNumber'] . ' </strong></h1>
                                    </div><br>
                                </div>';
                        }

                    }
                    else{

                        echo ' <form action="" method="post" id="account_form" enctype="multipart/form-data">
                                <div class="namePic">
                                    <div class="name">
                                        <h3>Your Account</h3>
                                        <h2 style="display: inline-block; font-weight:bolder;">Hello!! User :)</h2>
                                    </div>
                                    <div class="dp">
                                        <input type="file" name="profilePic"><br>
                                    </div>
                                </div>
            
                                <div class="otherInfo">
                                    <div class="account_Info">
                                        <input type="hidden" name="isForm" id="">
                                        <h5>Name: </h5>
                                        <input type="text" name="name" placeholder="Enter your name">
                                    </div>
                                    <div class="account_Info">
                                        <h5>Address: </h5>
                                        <textarea name="address" id="" cols="30" rows="10" placeholder="Enter your address"></textarea>
                                    </div>
                
                                    <div class="account_Info">
                                        <h5>Contact Number: </h5>
                                        <input type="number" placeholder="Enter your contact number" name="contactNumber">
                                    </div>
            
                                    <div class="account_Info"><br><br>
                                        <input type="submit" class="btn-green" name="submitPhoto" value="Add Account">
                                    </div>
            
                                </div>
                            </form> ';
                    }
                ?>
            </div>
            <div class="yourOrder">
                <h1>Your Orders</h1>
                <div class="allOrders">
                    <?php
                        $email = $_SESSION['email'];

                        $ordersSql = "SELECT `s.no`, `clothId`, `quantity`, `totalPrice`, `account_email`, `size`, `methodOfPayment` FROM `placedorder` WHERE `account_email` = '$email'";

                        include('databaseConnect.php');
                        $orderRes =  mysqli_query($con, $ordersSql);

                        if($orderRes){
                            $orderRows = mysqli_num_rows($orderRes);
                            if($orderRows == 0){
                                echo '<div class="noItemContain"><h2 style="text-align: center; font-weight: bolder; color:rgb(0, 0, 102)">No order has been placed yet!!</h2>
                                <div class="noItemContain_div">
                                <a href="categories.php" class="designA"  style="font-weight:bolder; font-size: 25px;">Order Now-></a>
                                </div>
                                </div>';
                            }
                            else{
                                $var = 0;
                                if($orderRows <= 3){
                                    while($var < $orderRows){
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
        
                                            echo '<div class="eachOrder">
                                                    <div class="orderBox">
                                                        <div class="orderPic">
                                                            <img src="images/'. $imgFolder .'/'. $imgName .'" alt="">
                                                        </div>
                                                        <div class="orderInfo">
                                                            <h5 class="orderPrice">Amount: ₹' . $data['totalPrice'] . '</h5>
                                                            <h6 class="orderQuantity">Quantity: ' . $data['quantity'] . '</h6>
                                                            <h6 class="orderSize">Size: ' . $data['size'] . '</h6>
                                                            <a href="eachCloth.php?id='.$imgId.'" class="designA" orderAgain_link>Order Again-></a>
                                                        </div>
                                                    </div>
                                                </div>';
                                        
                                        }    
                                        $var = $var +1;
                                    }
                                }
                                else{
                                    while($var < 3){
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
        
                                            echo '<div class="eachOrder">
                                                    <div class="orderBox">
                                                        <div class="orderPic">
                                                            <img src="images/'. $imgFolder .'/'. $imgName .'" alt="">
                                                        </div>
                                                        <div class="orderInfo">
                                                            <h5 class="orderPrice">Amount: ₹' . $data['totalPrice'] . '</h5>
                                                            <h6 class="orderQuantity">Quantity: ' . $data['quantity'] . '</h6>
                                                            <h6 class="orderSize">Size: ' . $data['size'] . '</h6>
                                                            <a  href="eachCloth.php?id='.$imgId.'" class="designA orderAgain_link">Order Again-></a>
                                                        </div>
                                                    </div>
                                                </div>';
                                        
                                        }    
                                        $var = $var +1;
                                    }
                                }
                            }
                              
                        }
                    ?>

                </div>      
                <?php
                    if($orderRows != 0){
                        echo '<div><a href="yourOrders.php" class="designA" style="font-size: 25px;">View All --></a></div>';
                    }
                ?>
            </div>

            <div class="wishList">
                <h1>Your WishList</h1>
                <div class="allOrders">
                    <?php
                        $email = $_SESSION['email'];

                        $wishSql = "SELECT `s.no`, `clothId`, `email`, `price` FROM `wishlist` WHERE `email` = '$email'";

                        include('databaseConnect.php');
                        $wishRes =  mysqli_query($con, $wishSql);

                        if($wishRes){
                            $wishRows = mysqli_num_rows($wishRes);
                            if($wishRows == 0){
                                echo '<div class="noItemContain"><h2 style="text-align: center; color:rgb(0, 0, 102); font-weight: bolder;">No item has been wishlisted yet!!</h2>
                                <div class=""noItemContain_div>
                                <a href="categories.php" class="designA" style="font-weight:bolder; font-size: 25px;">WishList Now-></a>
                                </div>
                                </div>';
                            }
                            else{
                                $var = 0;
                                if($wishRows <= 3){
                                    while($var < $wishRows){
                                        $data = mysqli_fetch_assoc($wishRes);         
                                        $imageId = $data['clothId'];
                                        
                                        $wishImageSql = "SELECT `s.no`, `category`, `imageName`, `price`, `ratings` FROM `allimages` WHERE `s.no` = '$imageId'";
                                        include('databaseConnect.php');
                                        $wishImageRes =  mysqli_query($con, $wishImageSql);                                
    
                                        if($wishImageRes){
                                            $imgData = mysqli_fetch_assoc($wishImageRes);
    
                                            $imgFolder = $imgData['category'];
                                            $imgName = $imgData['imageName']; 
                                            $imgId = $imgData['s.no']; 
        
                                            echo '<div class="eachOrder">
                                                    <div class="orderBox">
                                                        <div class="orderPic">
                                                            <img src="images/'. $imgFolder .'/'. $imgName .'" alt="">
                                                        </div>
                                                        <div class="orderInfo">
                                                            <h5 class="orderPrice">Amount: ₹' . $data['price'] . '</h5>
                                                            <a href="eachCloth.php?id='.$imgId.'" class="designA buyNow_Link">Check Out-></a>
                                                        </div>
                                                    </div>
                                                </div>';
                                        
                                        }    
                                        $var = $var +1;
                                    }
                                }
                                else{
                                    while($var < 3){
                                        $data = mysqli_fetch_assoc($wishRes);         
                                        $imageId = $data['clothId'];
                                        
                                        $wishImageSql = "SELECT `s.no`, `category`, `imageName`, `price`, `ratings` FROM `allimages` WHERE `s.no` = '$imageId'";
                                        include('databaseConnect.php');
                                        $wishImageRes =  mysqli_query($con, $wishImageSql);                                
    
                                        if($wishImageRes){
                                            $imgData = mysqli_fetch_assoc($wishImageRes);
    
                                            $imgFolder = $imgData['category'];
                                            $imgName = $imgData['imageName']; 
                                            $imgId = $imgData['s.no'];  
        
                                            echo '<div class="eachOrder">
                                                    <div class="orderBox">
                                                        <div class="orderPic">
                                                            <img src="images/'. $imgFolder .'/'. $imgName .'" alt="">
                                                        </div>
                                                        <div class="orderInfo">
                                                            <h5 class="orderPrice">Amount: ₹' . $data['price'] . '</h5>
                                                            <a href="eachCloth.php?id='.$imgId.'" class="designA buyNow_Link">Buy Now-></a>
                                                        </div>
                                                    </div>
                                                </div>';
                                        
                                        }    
                                        $var = $var +1;
                                    }
                                }
                            }
                        }
                    ?>
                </div> 
                <?php
                    if($wishRows != 0){
                        echo '<div><a href="yourWishList.php" class="designA" style="font-size: 25px;">View All --></a></div>';
                    }
                ?>
            </div>

        </div>
    </div>

</body>
<script src="allJs/js2.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>