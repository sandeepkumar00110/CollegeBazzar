<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    $login = false;
} else if ($_SESSION['loggedin'] != true) {
    $login = false;
} else {
    $login = true;
    $username = $_SESSION['username'];
    $admin = $_SESSION['admin'];
}


// header('location: index.php');
// $login = false;
// exit;
// } else 
// if ($_SESSION['is_blocked'] == 0) {
//     header('location: ../free/welcome.php');
//     exit;
// } else {
//$login = $_SESSION['loggedin'];
//  $username = $_SESSION['username'];
//}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900"
        rel="stylesheet" />
    <link rel="stylesheet" href="./Assets/css/main.css">
    <link rel="stylesheet" href="./Assets/css/media_query.css">
    <style>
    .product-card {
        border-radius: 10px;
        background: linear-gradient(54deg, #ff1f1f, #ffb103fc);
    }

    #card-image {
        height: 200px;
        max-height: 200px;
        border-radius: 10px 10px 0px 0px;
    }

    .product-card:hover {
        transform: scale(1.1);
        cursor: pointer;
    }

    .filter-bar {
        background: linear-gradient(45deg, #b80c14, #dbaa31f5);
    }

    .navbar-signin {
        font-weight: 900;
        text-shadow: 0px 2px 3px rgba(77, 206, 137, 1);
    }

    .filter-radios {
        background: linear-gradient(45deg, black, transparent);
    }

    .card-head {
        max-width: 220px;
    }
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
                    <img class="slideImage"
                        src="https://s3.birthmoviesdeath.com/images/made/john-wick-still_1050_591_81_s_c1.jpg"
                        style="width:100%">
                    <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img class="slideImage"
                        src="https://s3.birthmoviesdeath.com/images/made/john-wick-still_1050_591_81_s_c1.jpg"
                        style="width:100%">
                    <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img class="slideImage"
                        src="https://s3.birthmoviesdeath.com/images/made/john-wick-still_1050_591_81_s_c1.jpg"
                        style="width:100%">
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
                    <?php
                    include 'Auth/partials/_dbconnect.php';
                    $sql = "Select prod_id,prod_name,price,type_id,category_id,thumbnail from products ORDER BY prod_id LIMIT 10";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    while ($num != 0) {
                        $row = mysqli_fetch_assoc($result);
                        $cat_id = $row["category_id"];
                        $type_id = $row["type_id"];
                        $sql1 = "Select type_name from types where category_id='$cat_id' and type_id='$type_id'";
                        $sql2 = "Select category_name from category where category_id='$cat_id'";
                        $resultcat1 = mysqli_query($conn, $sql2);
                        $catype = mysqli_fetch_assoc($resultcat1);
                        $resultcat = mysqli_query($conn, $sql1);
                        $rowtype = mysqli_fetch_assoc($resultcat);
                        // print_r($rowtype);
                        $thumbnail = $row["thumbnail"];
                        echo ' <div class="product-card">
                        <div class="card-head">
                            <!-- <span class="back-text"> FAS </span> -->
                            <img id="card-image" src="' . $thumbnail . '" alt="">
                            <div class="product-detail">
                                <!-- name -->
                                <div class="product-name">
                                    <h3><span>' . $row["prod_name"] . '</span></h3>
                                    <span style="font-size:22px; color:red">&#9733;</span> ' . $rowtype["type_name"] . ' | ' . $catype["category_name"] . '
      
                                </div>
                                <!-- line  -->
                                <hr>
                                <!-- price and add to card -->
                                <div class="product-price">
                                    <!-- price -->
                                    <div class="product-pricec1"> <span>&#8377; ' . $row["price"] . '</span> </div>';

                        echo ' <form action="./Frontend/prodDesc.php"  type="submit" method="GET">
                                          <input type="text" style="display: none;" id="prod_id" name="prod_id" value="' . $row["prod_id"] . '">
                                      <div class="product-pricec2"><button class="addtocart">More Info</button></div>
                                     </div>
                               </form>
                            </div>
                        </div>
                    </div>';
                        $num -= 1;
                    }
                    ?>




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