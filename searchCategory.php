<!-- <link rel="stylesheet" href="allCSS/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->

<?php
    include('navbar.php');

    function showAlert($error_succ, $main, $cause){
        echo '<div class="alert alert-'.$error_succ.' allAlerts" role="alert">
        <strong>'.$main.'!!</strong> '.$cause.'
      </div>';
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchCat'])){
        $searchedCat = $_POST['searchCat'];

        include('databaseConnect.php');
        $catSql = "SELECT `s.no`, `category`, `imageName` FROM `images` WHERE `category` = '$searchedCat'";
        $catRes = mysqli_query($con, $catSql);

        if(mysqli_num_rows($catRes) == 0){
            showAlert('danger', 'OOPS', 'Category does not exist!');
        }
        else if(mysqli_num_rows($catRes) == 1){
            header('location: eachCategory.php?cat='. $searchedCat);
        }
        
    }
?>