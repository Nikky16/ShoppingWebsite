<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['wishlist'])){
            echo 'WishList';
        }
        else if(isset($_POST['firstOrder'])){
            echo 'First order';
        }
        else if(isset('orderAgain')){
            echo 'Order Again';
        }
    }
?>