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
    $checkbox = "users";
    include '_parts/_dbconnect.php';
    if (isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD'] == 'POST') {
        $is_blocked = $_POST['is_blocked'];
        $name = $_POST['user'];
        $sql = "UPDATE `users` SET `is_blocked`='$is_blocked' WHERE username='$name'";
        // print_r($sql);
        $result = mysqli_query($conn, $sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
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
                            <h6 class="mb-4">Registered Users</h6>
                            <div class="table-responsive table-hover">
                                <!-- annoucemnt -->
                                <div class="border rounded p-4 pb-0 mb-4">
                                    <figure>
                                        <blockquote class="blockquote">
                                            <p> <mark>One means Blocked and Zero means Unblocked</mark></p>

                                        </blockquote>
                                        <br>
                                    </figure>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Block</th>
                                            <th scope="col">Save Change</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php

                                        $sql = "SELECT username,email,is_admin,is_blocked from users ORDER BY id LIMIT 10";
                                        $result = mysqli_query($conn, $sql);
                                        $num = mysqli_num_rows($result);
                                        $counter = 1;
                                        while ($num != 0) {
                                            $row = mysqli_fetch_assoc($result);
                                            echo ' <tr>
                                                 <th scope="">' . $counter . '</th>
                                                <td>' . $row["username"] . '</td>
                                                <td>' . $row["email"] . '</td>
                                                <form method="POST">
                                                <input type="hidden" name="user" id="user" value="' . $row['username'] . '">
                                                <td>  <input oninput="javascript: if (this.value > 1 || this.value < 0) this.value = 0;"  maxlength="1" required class="form-control" type="number" name="is_blocked" value="' . $row["is_blocked"] . '" id="is_blocked"></td>
                                                <td>          <button type="submit" class="btn btn-primary">Save</button></td></form>
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