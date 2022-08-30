<?php
session_start();
$name = 'none';
if (!isset($_SESSION['loggedin'])) {
    $login = false;
    header('location: ../../Auth/login.php');
} else if ($_SESSION['loggedin'] != true) {
    $login = false;
} else {
    $login = true;
    $name = $_SESSION['username'];
    // echo ''
    $admin = $_SESSION['admin'];
    $checkbox = "admin";
    include '_parts/_dbconnect.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php include './_parts/_sidebar.php' ?>

        </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <?php include './_parts/_header.php' ?>
        <!-- Navbar End -->
        <?php
        $sql =  "Select username from users";
        $result = mysqli_query($conn, $sql);
        $totalusers = mysqli_num_rows($result);
        $sql = "Select prod_id from products";
        $result = mysqli_query($conn, $sql);
        // print_r($result);
        $totalproducts = mysqli_num_rows($result);


        ?>

        <!-- user registrated related data -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-line fa-3x text-primary"></i>
                        <div class="ms-3">
                            <a href="./users.php">
                                <p class="mb-2">Total User Registered</p>
                            </a>
                            <h6 class="mb-0"><?php echo $totalusers  ?></h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-bar fa-3x text-primary"></i>
                        <div class="ms-3">
                            <a href="./product.php">
                                <p class="mb-2">Products</p>
                            </a>
                            <h6 class="mb-0"><?php echo $totalproducts ?></h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-bar fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Exchange value</p>
                            <h6 class="mb-0">0</h6>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-area fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today Revenue</p>
                            <h6 class="mb-0">0</h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Sale & Revenue End -->

        <!-- Sales Chart Start -->

        <!-- Sales Chart End -->

        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Recent Listing</h6>
                    <!-- <a href="">Show All</a> -->
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white">

                                <th scope="col">Date</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * from products ORDER BY registered_on DESC";
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            while ($num != 0) {
                                $row = mysqli_fetch_assoc($result);
                                echo '  <tr>
                                <td>' . $row['registered_on'] . '</td>
                                <td>' . $row['prod_name'] . '</td>
                                <td>' . $row['username'] . '</td>
                                <td>' . $row['price'] . '</td>
                                <td>' . $row['quantity'] . '</td>
                            </tr>';
                                $num -= 1;
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->

        <!-- Widgets Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-secondary rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0">Messages</h6>
                            <!-- <a href="">Show All</a> -->
                        </div>
                        <?php
                        $sql = "SELECT * from chatbot where message_for='$name' and is_response=0";
                        $result = mysqli_query($conn, $sql);
                        // print_r($result);
                        $num = mysqli_num_rows($result);
                        while ($num != 0) {
                            $row = mysqli_fetch_assoc($result);
                            echo '<div class="d-flex align-items-center border-bottom py-3">
                            <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px" />
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">' . $row['message_from'] . '</h6>
                                    <small>15 minutes ago</small>
                                </div>
                                <span>' . $row['messages'] . '</span>
                            </div>
                        </div>';

                            $num -= 1;
                        }
                        ?>

                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-secondary rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Calender</h6>
                            <a href="">Show All</a>
                        </div>
                        <div id="calender"></div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Widgets End -->

        <!-- Footer Start -->
        <?php include './_parts/_footer.php' ?>
        <!-- Footer End -->
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>