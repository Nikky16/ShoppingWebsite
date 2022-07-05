<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Website - About</title>
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
    ?>
    
    <div class="catcontainer">
        <div class="newCon aboutNew"> 
            <!-- <div class="smallCon" style="width=100%;"> -->
                <div class="mainHeading">
                    <h1 id="mainHeading_h1" style="text-align: center;"><strong>Shopping Website!!</strong></h1>
                </div>
                <div><p>
                In this project, I have tried to create a shopping website clone.
                I have used my <strong> WEB DEVELOPMENT </strong> skills including <strong>HTML</strong>,<strong> CSS </strong> (for designing), <strong>JS</strong> (for some dynamic behaviours, including some events),<strong> PHP </strong>(for backend) and <strong>MYSQLI </strong>(for databasse management) to make this project!</p>
                </div><br>
                <div>
                    <h1 id="subHeading" style="color: red; text-align: center;"><strong>Differnt pages of my Website</strong></h1>
                    <div class="allPages">
                        <div class="eachPage">
                            <h3><strong>Login</strong></h3>
                            <p>In this login system, the user will be able to login to this website by filling the correct details. I have created this login system by using <em>SESSIONS</em> in <em>PHP</em>. We firstly, stored the details of the user in our database while signing-in and then created this login system by using the regitered details and <em>SESSIONS</em>.</p>
                            <div class="pageImage">
                                <img src="images/about/login.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>Signin</strong></h3>
                            <p>In this sign-in form, user can sign-in by entering some of its information such as, email and creating password. After clicking on sign-in button, the user will get registered in the database and will be able to login anytime.</p>
                            <div class="pageImage">
                                <img src="images/about/signin.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>Home</strong></h3>
                            <p>This is the home page of our website which shows up in front of users after login. This page just enhances the beauty of the website.</p>
                            <div class="pageImage">
                                <img src="images/about/home.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>About</strong></h3>
                            <p>This is about page in our website which clearly describes our whole website in just one page. It shows all the structure or design of our website. It also gives the representation of our database which we have used to store the data.</p>
                            <div class="pageImage">
                                <img src="images/about/about.PNG" alt="">
                            </div>
                        </div>                        
                        <div class="eachPage">
                            <h3><strong>Categories</strong></h3>
                            <p>This category section shows all the categories we have in our shopping website beautifully. By choosing a particular category, user can check all the product of that selected category.</p>
                            <div class="pageImage">
                                <img src="images/about/category.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>Each Category</strong></h3>
                            <p>This section of our website shows all the product of a particular category. We will pass a particular category name as <em>cat</em> with the help of PHP and then it will display all the products of that selected category from the database with some information of each product (such as price and ratings).</p>
                            <div class="pageImage">
                                <img src="images/about/eachCat.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>Each Product</strong></h3>
                            <p>This page shows all information of a selected product. You can also wishlist the product if you want and can place order for that product too by filling some reqired details <em>(such as size, quantity and method of payment)</em>. This also shows customer reviews so that you can read and choose whether to buy the product or not.</p>
                            <div class="pageImage">                            
                                <img src="images/about/eachItem.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>Account </strong>(When Exits)</h3>
                            <p>Account page shows your registered account<em>(if exits)</em> with your entered details. This also contains <em>YOUR ORDERS</em> and <em>YOUR WISHLIST</em> sections which shows all your placed orders and products of your wishlist repectively. It also provides you the link to check out your <em>YOUR ORDERS</em> page and <em>YOUR WISHLIST</em> page. </p>
                            <div class="pageImage">
                                <img src="images/about/account.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>Account </strong>(When Does Not Exit)</h3>
                            <p>Account page shows a form<em>(if account does not exit)</em> and will ask you to enter some information of yours to register your account to the database. User will not be able to <em>order</em> or <em>wishlist</em> any product without having an account. So, if you try to order any product, the system will redirect you to the account page. If your <em>YOUR ORDERS</em> and <em>YOUR WISHLIST</em> list is empty then it will provide you the link to check out the products.</p>
                            <div class="pageImage">
                                <img src="images/about/account2.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>Your Orders</strong></h3>
                            <p>This is <em>YOUR ORDERS</em> page and shows all your order and information related to that order and ask you to leave a review related to that product. After you submit your review, it will get stored in the database and then the review section will show your registered review instead. It will also ask you to order that product again if you want it and provides you the link to visit the product.</p>
                            <div class="pageImage">
                                <img src="images/about/yourOrders.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>Your WishList</strong></h3>
                            <p>This is <em>YOUR WISHLIST</em> page and shows all your wishlisted products adn information related to that product. It will also ask you to buy the product and provides a link to you in case you want to visit the product. You can also remove any product from the wishlist.</p>
                            <div class="pageImage">
                                <img src="images/about/wishList.PNG" alt="">
                            </div>
                        </div>
                        <div class="eachPage">
                            <h3><strong>Customer Reviews</strong></h3>
                            <p>This <em>CUSTOMER REVIEWS</em> page will show all the reviews by customers of selected product which we will get as <em>itemId with the help of PHP. By this itemId will be able to grab all the customer reviews from the database. After showing all the reviews of that product, it will give you a link to visit the product in case you want to buy the product after reading the reviews.</em></p>
                            <div class="pageImage">
                                <img src="images/about/reviews.PNG" alt="">
                            </div>
                        </div>                       
                    </div>                   
                </div>
            <!-- </div> -->
        </div>
    </div>

</body>
<script src="allJs/js2.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>