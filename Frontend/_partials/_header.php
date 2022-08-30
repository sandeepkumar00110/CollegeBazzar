<?php

$adminPath = "none";
$loginPath = "none";
$signPath = "none";
$homePath = "none";
$logOutPath = "none";
$addproPath = "none";
$searchPath = "none";
if ($where == "home") {
    $homePath = "./index.php";
    $adminPath = "./Frontend/Admin/index.php";
    $loginPath = "./Auth/login.php";
    $signPath = "./Auth/sign.php";
    $logOutPath = "./Auth/logout.php";
    $addproPath = "./Frontend/addProduct.php";
    $searchPath = "./Frontend/search.php";
} else if ($where == "prod_desc" or $where == "search") {
    $homePath = "../index.php";
    $adminPath = "./Admin/index.php";
    $loginPath = "../Auth/login.php";
    $signPath = "../Auth/sign.php";
    $logOutPath = "../Auth/logout.php";
    $addproPath = "./addProduct.php";
    $searchPath = "./search.php";
} else if ($where == "addproduct") {
    $homePath = "../index.php";
    $adminPath = "./Admin/index.php";
    $addproPath = "./addProduct.php";
    $logOutPath = "../Auth/logout.php";
    $searchPath = "./search.php";
}

?>

<header class="">
    <div class="navbar">

        <!--
          - menu button for small screen
        -->
        <button class="navbar-menu-btn">
            <span class="one"></span>
            <span class="two"></span>
            <span class="three"></span>
        </button>


        <a href="#" class="navbar-brand">
            <span>Collegebazzar</span>
        </a>

        <!--
          - navbar navigation
        -->

        <nav class="">
            <ul class="navbar-nav">

                <li> <a href="<?php echo $homePath; ?>" class="navbar-link">Home</a> </li>
                <!-- <li> <a href="#category" class="navbar-link">Category</a> </li> -->
                <li> <a href="<?php echo $addproPath; ?>" class="navbar-link">Add Product</a> </li>


            </ul>
        </nav>

        <!--
          - search and sign-in
        -->

        <div class="navbar-actions">

            <form style="border-radius: 5px;
    padding: 8px;" action="<?php echo $searchPath; ?>" method='GET' class="navbar-form">
                <input type="text" name="search" id="search" placeholder="I'm looking for..." class="navbar-form-search">

                <button class="navbar-form-btn">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
                <span class="navbar-form-close">
                    <ion-icon name="close-circle-outline"></ion-icon>
                </span>
            </form>



            <!--
            - search button for small screen
          -->

            <button class="navbar-search-btn">
                <ion-icon name="search-outline"></ion-icon>
            </button>
            <?php
            if ($login == true) {
                echo ' <a style="margin: 0 5px;" href="#" class="navbar-signin">
                <span id="username" value=" ' . $_SESSION['username'] . '">' . $_SESSION['username'] . '</span>
                         </a>';

                if ($_SESSION['admin'] == 1) {
                    echo ' <a style="margin: 0 5px;" href="' . $adminPath . '" class="navbar-signin">
                <span>Admin</span>
                         </a>';
                }
                echo ' <a href="' . $logOutPath . '" class="navbar-signin">
                                 <span>Logout</span>
                                 <ion-icon name="log-in-outline"></ion-icon>
                      </a>';
            } else {
                echo ' <a style="margin: 0 5px;" href="' . $loginPath . '" class="navbar-signin">
                <span>Login</span>

            </a>
            <a href="' . $signPath . '" class="navbar-signin">
                <span>Sigin</span>
         
            </a>';
            }
            ?>



        </div>

    </div>
</header>