<?php
session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header('location: ../auth/login.php');
//     exit;
// } else 
if ($_SESSION['is_blocked'] == 0) {
    header('location: ../free/welcome.php');
    exit;
}
$login = $_SESSION['loggedin'];
$username = $_SESSION['username'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="./Assets/css/main.css">
    <link rel="stylesheet" href="./Assets/css/media_query.css">
    <style>

    </style>

</head>

<body>
    <div class="container">


        <!-- header of the website -->
        <?php include 'Frontend/_partials/_header.php' ?>



        <!--
        - #BANNER SECTION
      -->
        <section class="banner">
            <!-- Slideshow container -->
            <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img class="slideImage" src="https://s3.birthmoviesdeath.com/images/made/john-wick-still_1050_591_81_s_c1.jpg" style="width:100%">
                    <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img class="slideImage" src="https://s3.birthmoviesdeath.com/images/made/john-wick-still_1050_591_81_s_c1.jpg" style="width:100%">
                    <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img class="slideImage" src="https://s3.birthmoviesdeath.com/images/made/john-wick-still_1050_591_81_s_c1.jpg" style="width:100%">
                    <div class="text">Caption Three</div>
                </div>

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>

            <!-- The dots/circles -->
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </section>



        <!-- PRODUCT SECTION -->
        <section class="movies">

            <!-- filter bar -->
            <div class="filter-bar">

                <div class="filter-dropdowns">

                    <select name="genre" id="genre" class="genre">
                        <option value="all genres">All genres</option>
                        <option value="action">Action</option>
                        <option value="adventure">Adventure</option>
                        <option value="animal">Animal</option>
                        <option value="animation">Animation</option>
                        <option value="biography">Biography</option>
                    </select>

                    <select name="year" class="year">
                        <option value="all years">All the years</option>
                        <option value="2022">2022</option>
                        <option value="2020-2021">2020-2021</option>
                        <option value="2010-2019">2010-2019</option>
                        <option value="2000-2009">2000-2009</option>
                        <option value="1980-1999">1980-1999</option>
                    </select>

                </div>

                <div class="filter-radios">

                    <input type="radio" name="grade" id="featured" checked>
                    <label onclick="getinfo(this)" for="featured">Featured</label>

                    <input type="radio" name="grade" id="popular">
                    <label onclick="getinfo(this)" for="popular">Popular</label>

                    <input type="radio" name="grade" id="newest">
                    <label onclick="getinfo(this)" for="newest">Newest</label>


                    <div class="checked-radio-bg"></div>

                </div>

            </div>



            <!-- PRODUCT CARD SECTION -->
            <div class="product-container">
                <div>
                    <h1 class=".product-container-heading">Latest Products</h1>
                </div>
                <div class="product-container-child">
                    <div class="product-card">
                        <div class="card-head">
                            <span class="back-text"> FAS </span>
                            <div class="product-detail">
                                <!-- name -->
                                <div class="product-name">
                                    <h3><span>boAt Airdrop 141</span></h3>
                                    <span style='font-size:22px; color:red'>&#9733;</span> 4.5/5 | 4,111 Reviews
                                    <!-- <p>&#9733;4111 Reviews</p> -->
                                </div>
                                <!-- line  -->
                                <hr>
                                <!-- price and add to card -->
                                <div class="product-price">
                                    <!-- price -->
                                    <div class="product-pricec1"> <span>&#8377; 1399</span> </div>
                                    <!-- add to card -->
                                    <div class="product-pricec2"> <button class="addtocart">Add to cart</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="card-head">
                            <span class="back-text"> FAS </span>
                            <div class="product-detail">
                                <!-- name -->
                                <div class="product-name">
                                    <h3><span>boAt Airdrop 141</span></h3>
                                    <span style='font-size:22px; color:red'>&#9733;</span> 4.5/5 | 4,111 Reviews
                                    <!-- <p>&#9733;4111 Reviews</p> -->
                                </div>
                                <!-- line  -->
                                <hr>
                                <!-- price and add to card -->
                                <div class="product-price">
                                    <!-- price -->
                                    <div class="product-pricec1"> <span>&#8377; 1399</span> </div>
                                    <!-- add to card -->
                                    <div class="product-pricec2"> <button class="addtocart">Add to cart</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="card-head">
                            <span class="back-text"> FAS </span>
                            <div class="product-detail">
                                <!-- name -->
                                <div class="product-name">
                                    <h3><span>boAt Airdrop 141</span></h3>
                                    <span style='font-size:22px; color:red'>&#9733;</span> 4.5/5 | 4,111 Reviews
                                    <!-- <p>&#9733;4111 Reviews</p> -->
                                </div>
                                <!-- line  -->
                                <hr>
                                <!-- price and add to card -->
                                <div class="product-price">
                                    <!-- price -->
                                    <div class="product-pricec1"> <span>&#8377; 1399</span> </div>
                                    <!-- add to card -->
                                    <div class="product-pricec2"> <button class="addtocart">Add to cart</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="card-head">
                            <span class="back-text"> FAS </span>
                            <div class="product-detail">
                                <!-- name -->
                                <div class="product-name">
                                    <h3><span>boAt Airdrop 141</span></h3>
                                    <span style='font-size:22px; color:red'>&#9733;</span> 4.5/5 | 4,111 Reviews
                                    <!-- <p>&#9733;4111 Reviews</p> -->
                                </div>
                                <!-- line  -->
                                <hr>
                                <!-- price and add to card -->
                                <div class="product-price">
                                    <!-- price -->
                                    <div class="product-pricec1"> <span>&#8377; 1399</span> </div>
                                    <!-- add to card -->
                                    <div class="product-pricec2"> <button class="addtocart">Add to cart</button></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>

    <button class="load-more">Use Search For Particular Product</button>

    </section>




    <!-- Custome js link -->
    <script src="./Assets/js/main.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
</body>

</html>