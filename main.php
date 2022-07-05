<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping!!</title>
    <link rel="stylesheet" href="allCSS/style.css">
    <link rel="stylesheet" href="allCSS/style2.css">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Baloo+Bhaijaan+2:wght@500;700&family=Bitter&family=Lobster&family=Sacramento&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Baloo+Bhaijaan+2:wght@500;700&family=Bitter&family=Lobster&family=Sacramento&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- BOOTSTRAP CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>
    <?php
        include('databaseConnect.php');

        function showAlert($error_succ, $main, $cause){
            echo '<div class="alert alert-'.$error_succ.' allAlerts" role="alert">
            <strong>'.$main.'!!</strong> '.$cause.'
          </div>';
        }
        function validatePassword($pass){
            if(strlen($pass) >= 5){
                return true;
            }
            else{
                return false;
            }
        }
        function userExist($email, $pass){
            include('databaseConnect.php');

            $usersql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass'";
            $userRes = mysqli_query($con, $usersql);

            if(mysqli_num_rows($userRes) == 1){
                return true;
            }
            else{
                return false;
            }
        }
    ?>
    <?php
        // SIGN IN
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registerEmail']) && isset($_POST['registerPassword']) && isset($_POST['confirmPassword'])){
            $email = $_POST['registerEmail'];
            $pass = $_POST['registerPassword'];
            $encrypted = md5($pass);

            include('databaseConnect.php');

            if(validatePassword($pass)){
                if($_POST['registerPassword'] == $_POST['confirmPassword']){

                    if(userExist($email, $encrypted) == false){

                        $sql = "INSERT INTO `users` (`s.no`, `email`, `password`) VALUES (NULL, '$email', '$encrypted');";

                        $res = mysqli_query($con, $sql);
                        if($res){
                            showAlert('success', 'SUCESS!!', 'Account has been registered!');
                        }
                        else{
                            showAlert('danger', 'OOPS!!', 'Some error has occurred!');
                        }
                    }
                    else{
                        showAlert('danger', 'OOPS!!', 'User with these credentials already exits!');
                    }
                }
                else{
                    showAlert('danger', 'OOPS!!', 'Passwords do not match!');
                }
            }
            else{
                showAlert('danger', 'OOPS!!', 'Password is invalid! The length must be atleast 5 characters!');
            }

        }

        // LOG IN
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logEmail']) && isset($_POST['logPassword'])){
            $logemail = $_POST['logEmail'];
            $logpassword = $_POST['logPassword'];
            $encryptedPass = md5($logpassword);

            if(userExist($logemail, $encryptedPass)){
                session_start();
                $_SESSION['logged'] = 'true';
                // $_SESSION['email'] = $logemail;
                $_SESSION['email'] = $logemail;
                header('location: home.php');
            }
            else{
                showAlert('danger', 'OOPS!!', 'User does not exist!');
            }
        }

        // CHANGE PASSWORD
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeEmail']) && isset($_POST['changePassword']) && isset($_POST['changeNewPassword']) && isset($_POST['confirmNewPassword'])){

            $logemailChange = $_POST['changeEmail'];
            $logpasswordChange = $_POST['changePassword'];
            $encryptedPass2 = md5($logpasswordChange);

            // echo $logemailChange .' and '. $encryptedPass2 .' and '.$logpasswordChange;

            if(userExist($logemailChange, $encryptedPass2)){

                if($_POST['changeNewPassword'] == $_POST['confirmNewPassword']){

                    $newPass = md5($_POST['changeNewPassword']);
                    
                    include('databaseConnect.php');
                    $changeSql = "UPDATE `users` SET `password` = '$newPass' WHERE `users`.`email` = '$logemailChange'";
                    
                    $res = mysqli_query($con, $changeSql);
                    if($res){
                        showAlert('success', 'SUCESS!!', 'Password has been changed!');
                    }
                    else{
                        showAlert('danger', 'OOPS!!', 'Some error has occured!');
                    }
                }
                else{
                    showAlert('danger', 'OOPS!!', 'Passwords do not match!');
                }
            }
            else{
                showAlert('danger', 'OOPS!!', 'User does not exit! Cannot change password!');
            }
        }

    ?>

    <!-- MODAL -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color: rgb(242, 242, 242);">
                    <form action="" id="changePass" method="post">
                        <label for="changeEmail">Email: </label><br>
                        <input style = "border: 1px solid black;" type="email" placeholder="Enter email" name="changeEmail">
                        <br><label for="changePassword">Current Password: </label><br>
                        <input style = "border: 1px solid black;" type="password" placeholder="Enter password" name="changePassword">
                        <br><label for="changeNewPassword">New Password: </label><br>
                        <input style = "border: 1px solid black;" type="password" placeholder="Enter password" name="changeNewPassword">
                        <br><label for="confirmNewPassword">Confirm Password: </label><br>
                        <input style = "border: 1px solid black;" type="password" placeholder="Enter password" name="confirmNewPassword">
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
                            <button class="btn btn-warning" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

    <div class="mainContainer">
        <div class="title" style=" width: 50%; min-width: 300px; display:flex; justify-content: center; align-items: center;">
            <h1 style="font-family: 'Baloo Bhaijaan 2', cursive; color: white; font-size: 70px; text-align:center;">Lets Go Shopping!!</h1>
        </div>

        <div class="accountform" style="width: 50%; min-width: 300px; height:100%;">

            <div class="twoform">
                <div class="chooseRegister">
                    <button class="btn-blue" id="loginForm">Login</button>
                    <button class="btn-blue" id="signinForm">Signin</button>
                </div>

                <form action="" id="sign" method="post">
                    <label for="registerEmail">Email: </label><br>
                    <div class="iconDiv">
                        <div class="icon">
                            <img src="images/icons/email.png" alt="">
                        </div>
                        <input type="email" placeholder="Enter your email" name="registerEmail">
                    </div>

                    <br><label for="registerPassword">Password: </label><br>
                    <div class="iconDiv">
                        <div class="icon">
                            <img src="images/icons/pass.png" alt="">
                        </div>
                        <input type="password" placeholder="Enter password" name="registerPassword">
                    </div>
                    
                    <br><label for="confirmPassword">Confirm Password: </label><br>
                    <div class="iconDiv">
                        <div class="icon">
                            <img src="images/icons/pass.png" alt="">
                        </div>
                        <input type="password" placeholder="Confirm password" name="confirmPassword">
                    </div>
                    <br><br><button class="btn-green" type="submit">Sign In</button>
                </form>

                <form action="" id="log" method="post">
                    <label for="logEmail">Email: </label><br>
                    <div class="iconDiv">
                        <div class="icon">
                            <img src="images/icons/email.png" alt="">
                        </div>
                        <input type="email" placeholder="Enter email" name="logEmail">
                    </div>
                    <br><label for="logPassword">Password: </label><br>
                    <div class="iconDiv">
                        <div class="icon">
                            <img src="images/icons/key.png" alt="">                            
                            </div>
                        <input type="password" placeholder="Enter password" name="logPassword">
                    </div>
                    <br><br><button class="btn-green" type="submit">Log In</button>
                    <br><br><button class="btn-secondary" style="padding:5px; width: 200px;" type="button" data-toggle="modal" data-target="#exampleModal">Change Password</button>
                </form> 

            </div>
        </div>
    </div>
</body>
<script src="allJs/index.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>