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

                <li> <a href="#" class="navbar-link">Home</a> </li>
                <li> <a href="#category" class="navbar-link">Category</a> </li>
                <li> <a href="management/form.php" class="navbar-link">Add Product</a> </li>


            </ul>
        </nav>

        <!--
          - search and sign-in
        -->

        <div class="navbar-actions">

            <form action="search.php" method='GET' class="navbar-form">
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



            <a style="margin: 0 5px;" href="#" class="navbar-signin">
                <span>Sandeep</span>

            </a>
            <a href="auth/logout.php" class="navbar-signin">
                <span>Logout</span>
                <ion-icon name="log-in-outline"></ion-icon>
            </a>

        </div>

    </div>
</header>