<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    $login = false;
    header('location: ../../Auth/login.php');
} else if ($_SESSION['loggedin'] != true) {
    $login = false;
} else {
    $login = true;
    $username = $_SESSION['username'];
    $admin = $_SESSION['admin'];
    $checkbox = "product";
    include '_parts/_dbconnect.php';
    if (isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD'] == 'POST') {
        $is_approved = $_POST['is_approved'];
        $prod_id = $_POST['prod_id'];
        if (!isset($_POST['is_delete'])) {
            // here is delete false aaya hai
            $sql = "UPDATE `products` SET `is_approved`='$is_approved' WHERE prod_id='$prod_id'";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "DELETE FROM `products` WHERE prod_id='$prod_id'";
            $result = mysqli_query($conn, $sql);
        }

        // print_r($_POST);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Products</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include './_parts/_sidebar.php' ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include './_parts/_header.php' ?>
            <!-- Navbar End -->


            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">



                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Products List</h6>
                            <div class="table-responsive table-hover">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <?php  ?>
                                            <th scope="col">#</th>
                                            <th scope="col">username</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col"> Months Used</th>
                                            <th scope="col"> Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Registerd On</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Approved</th>
                                            <th scope="col">
                                                Delete
                                            </th>
                                            <th>Save Change</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = "Select * from products ORDER BY prod_id LIMIT 10";
                                        $result = mysqli_query($conn, $sql);
                                        // print_r(($result));
                                        $num = mysqli_num_rows($result);
                                        $counter = 1;
                                        while ($num != 0) {
                                            $row = mysqli_fetch_assoc($result);
                                            echo ' <tr>
                                              <th scope="">' . $counter . '</th>
                                             <td>' . $row["username"] . '</td>
                                             <td>' . $row["prod_name"] . '</td>
                                             <td>' . $row["months_used"] . '</td>
                                             <td>' . $row["quantity"] . '</td>
                                             <td>' . $row["price"] . '</td>
                                             <td>' . $row["registered_on"] . '</td>
                                             <td>' . $row["description"] . '</td>
                                             <td>' . $row["type_id"] . '</td>
                                             <td>' . $row["category_id"] . '</td>
                                             <form method="POST">
                                             <td><input oninput="javascript: if (this.value > 1 || this.value < 0) this.value = 0;"  maxlength="1" required class="form-control" type="number" name="is_approved" value="' . $row["is_approved"] . '" id="is_approved"></td>
                                             <input hidden type="number" value="' . $row['prod_id'] . '" name="prod_id" id="prod_id">
                                             <td><div class="form-check">
                                             <input oninput="javascript: this.value = this.checked;" class="form-check-input" type="checkbox" value="false" id="is_delete" name="is_delete" >
                                             <label class="form-check-label" for="flexCheckChecked">
                                                 Delete
                                             </label>
                                            </div></td>
                                            <td> <button type="submit" class="btn btn-primary">Save</button></td>
                                            </form>
                                           </tr>';
                                            $counter = $counter + 1;
                                            $num = $num - 1;
                                        }


                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Table End -->


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