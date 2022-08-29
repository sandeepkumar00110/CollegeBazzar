<?php
session_start();
$admin = $_SESSION["admin"];
$login = true;
$prod_id = 0;
// $username = 'sandeep';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include './_partials/_dbconnect.php';
    $prod_id = $_GET['prod_id'];
    // echo $prod_id;
} else {
    header('location: ../index.php');
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Product-Detail</title>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" /> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" />
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" /> -->
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../Assets/css/main.css">
    <link rel="stylesheet" href="../Assets/css/media_query.css">
    <link rel="stylesheet" href="productinfo.css" class="css" />
    <style>
        @media screen and (max-width: 850px) {
            .wrapper {
                flex-direction: column;
            }

            .preview-pic {
                justify-content: flex-start;
            }



            .preview {
                width: 49rem;
            }
        }

        .preview {
            width: fit-content;
        }

        #capital {
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include './_partials/_header.php'; ?>

        <div class="card">
            <div class="container-fliud">
                <div style="gap: 1rem;" class="wrapper row">
                    <?php
                    if ($prod_id >= 1)
                        $sql = "Select * from products where prod_id='$prod_id'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    while ($num != 0) {
                        $row = mysqli_fetch_assoc($result);
                        $prod_image = explode(",", $row['prod_image']);

                        echo '<div class="preview col-md-6">
                        <div class="main-pic active" id="pic-1">
                            <img src="' . $prod_image[0] . '" />
                        </div>
                        <div class="preview-pic tab-content">';
                        foreach ($prod_image as $image) {

                            echo '<div class="tab-pane" id="pic-2">
                                    <img src="' . $image . '" />
                                </div>';
                        }

                        echo '</div>
                        <!-- <ul class="preview-thumbnail nav nav-tabs">
                            <li class="active">
                                <a data-target="#pic-1" data-toggle="tab"><img src="/Airdrop.jpg" /></a>
                            </li>
                            <li>
                                <a data-target="#pic-2" data-toggle="tab"><img src="/Airdrop.jpg" /></a>
                            </li>
                            <li>
                                <a data-target="#pic-3" data-toggle="tab"><img src="/Airdrop.jpg" /></a>
                            </li>
                            <li>
                                <a data-target="#pic-4" data-toggle="tab"><img src="/Airdrop.jpg" /></a>
                            </li>
                            <li>
                                <a data-target="#pic-5" data-toggle="tab"><img src="/Airdrop.jpg" /></a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title">' . $row['prod_name'] . '</h3>
                        <div class="rating">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <span class="review-no">Sold By:-<strong id="capital" style="color:black">' . $row['username'] . '</strong></span>
                        </div>
                        <p class="product-description">
                            ' . $row['description'] . '
                        </p>
                        <h4 class="price">current price: <span style="color:black;">&#8377 ' . $row['price'] . '</span></h4>
                    <!--   <p class="vote">
                            <strong>91%</strong> of buyers enjoyed this product!
                            <strong>(87 votes)</strong>
                        </p> -->
                        <h5 class="sizes">
                            Quantity:
                            <span class="size" data-toggle="tooltip" title="small">' . $row['quantity'] . '</span>
                           
                        </h5>
                     <!--   <h5 class="colors">
                            colors:
                            <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                            <span class="color green"></span>
                            <span class="color blue"></span>
                        </h5> -->
                        <div class="action">
                            <button class="add-to-cart btn btn-default" type="button">
                                Buy Now
                            </button>
                        <!--    <button class="like btn btn-default" type="button">
                                <span class="fa fa-heart"></span>
                            </button> -->
                        </div>
                    </div>';

                        $num -= 1;
                    }


                    ?>

                </div>
            </div>
        </div>
    </div>
    <script src="../Assets/js/main.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>