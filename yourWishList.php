<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website - Your WishList</title>
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

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['itemId'])){
                $itemId = $_POST['itemId'];

                include('databaseConnect.php');
                $deleteSql = "DELETE FROM `wishlist` WHERE `clothId` = '$itemId'";
                $deleteRes = mysqli_query($con, $deleteSql);

                if($deleteRes){
                    showAlert('success', 'SUCCESS', 'Item has been removed from WishList!');
                }
                else{
                    showAlert('danger', 'OOPS', 'Some error has occured!');
                }
            }
        }
    ?>
    
    <div class="catcontainer">
        <div class="newCon"> 
            <div class="smallCon yourWishList_Con">
            <div class="yourAllList">
                <h1 style="text-align:center; font-weight: bolder;">Your WishList</h1>
                <div class="sareItems">
                    <?php
                        $email = $_SESSION['email'];

                        include('databaseConnect.php');
                        $wishItemSql = "SELECT `s.no`, `clothId`, `email`, `price` FROM `wishlist` WHERE `email` = '$email'";

                        $wishItemRes =  mysqli_query($con, $wishItemSql);

                        if($wishItemRes){
                            $rows = mysqli_num_rows($wishItemRes);

                            $var = 0;
                            while($var < $rows){
                                $data = mysqli_fetch_assoc($wishItemRes);         
                                $imageId = $data['clothId'];
                                
                                $wishItemImageSql = "SELECT `s.no`, `category`, `imageName`, `price`, `ratings` FROM `allimages` WHERE `s.no` = '$imageId'";
                                include('databaseConnect.php');
                                $wishItemImageRes =  mysqli_query($con, $wishItemImageSql);

                                if($wishItemImageRes){
                                    $imgData = mysqli_fetch_assoc($wishItemImageRes);

                                    $imgFolder = $imgData['category'];
                                    $imgName = $imgData['imageName'];                                    
                                    $imgRate = $imgData['ratings'];        
                                    $imgId = $imgData['s.no'];        
                                    $left = 5 - $imgRate;   

                                    echo '<div class="everyItem">
                                            <div class="everyWishBox">
                                                <div class="orderPic">
                                                    <img src="images/'. $imgFolder .'/'. $imgName .'" alt="">
                                                </div>
                                                <div class="orderInfo">
                                                    <h5 class="orderPrice">Amount: ₹' . $data['price'] . '</h5>
                                                    <div>';
                                    
                                    while($imgRate > 0){
                                        echo '<span style="font-size:200%;color:rgb(204, 204, 0); display: inline-block;">&starf; </span>';

                                        $imgRate = $imgRate -1;
                                    }
                                    while($left > 0){
                                        echo '<span style="font-size:200%;color:rgb(204, 204, 0); display: inline-block;">&star;</span>';

                                        $left = $left - 1;
                                    }
                                    echo    '</div>
                                                    <a href="eachCloth.php?id='.$imgId.'" class="designA">Buy Now-></a>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="itemId" value="'.$imgId.'">  
                                                        <button class="btn-red" type="submit" id="removeFromList">Remove From List</button>
                                                    </form>
                                                </div>
                                            </div>                                            
                                        </div>';
                                
                                }    
                                $var = $var +1;
                            }                          
                        }
                    ?>     
                    <!-- <input type="hidden" name="id" value="id">                -->
                </div>
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