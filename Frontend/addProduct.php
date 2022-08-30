<?php
session_start();
$showAlert  = false;
$showError = false;
$where = "addproduct";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header('location: ../Auth/login.php');
  $login = false;
} else {
  include '_partials/_dbconnect.php';
  $login = $_SESSION['loggedin'];
  $username = $_SESSION['username'];
  $sql = "Select email from users where username='$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $contact =  $_POST["contact"];
    $address = $_POST["address"];
    $product_name = $_POST["product_name"];
    $prod_desc = $_POST["prod_desc"];
    $product_thumbnail = $_POST["product_thumbnail"];
    $product_image = $_POST["product_image"];
    $category = $_POST["category"];
    $bookstype = $_POST["bookstype"];
    $electronictype = $_POST["electronictype"];
    $month_used = $_POST["month_used"];
    $price = $_POST["price"];
    $payid = $_POST["payid"];
    $quantity = $_POST["quantity"];
    $type_id = $electronictype;
    if ($bookstype != "none") {
      $type_id = $bookstype;
    }
    if ($bookstype == "none" and $electronictype == "none") {
      $showError = "Please select type";
      header('location: addProduct.php');
    }
    // print_r($username);
    // print_r($type_id);
    $sql1 = "INSERT INTO `seller`(`username`, `contact`, `address`, `online_payment`) VALUES ('$username','$contact','$address','$payid')";
    $sql2 = "INSERT INTO `products`(`username`, `prod_name`, `thumbnail`, `prod_image`, `months_used`, `quantity`, `price`,`description`, `type_id`, `category_id`) VALUES ('$username','$product_name','$product_thumbnail','$product_image','$month_used','$quantity','$price','$prod_desc','$type_id','$category')";
    $result1 = mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);
    // print_r($result2);
    if ($result1 and $result2) {
      $showAlert = true;
    } else if ($result1) {
      $sql = "ROLLBACK";
      $result1 = mysqli_query($conn, $sql);
    } else if ($result2) {
      $sql = "ROLLBACK";
      $result1 = mysqli_query($conn, $sql);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="formstyle.css" />
  <link rel="stylesheet" href="../Assets/css/main.css">
  <link rel="stylesheet" href="../Assets/css/media_query.css">
</head>

<style>
  input,
  select {
    color: white !important;
    background: black;
  }

  .books,
  .electronic {
    display: none;
  }

  textarea {
    background: url(images/benice.png) center center no-repeat;
    /* This ruins default border */
    border: 1px solid #888;
    color: white;
    font-size: large;
  }
</style>

<body>
  <?php include "_partials/_header.php" ?>
  <?php
  if ($showAlert) {
    echo '<div style="font-family: ui-sans-serif;
       background: linear-gradient(54deg, #113e15, #ffb103fc);
       color:white;
        font-size: xx-large;
        padding: 15px;
        margin-top: 51px;
        border-radius: 50px;" class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>Success</strong> Your Product has been listed successfully
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
  }
  if ($showError) {
    echo '<div style="font-family: fantasy;
    background: linear-gradient(54deg, #ff1f1f, #ffb103fc);
     font-size: xx-large;
     padding: 15px;
     margin-top: 51px;
     border-radius: 5px; class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error</strong> ' . $showError . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>

  <h3>Product Registration</h3>

  <div class="sellerform">
    <form method="POST">
      <label for="fname">User Name</label>
      <input type="text" id="fname" name="firstname" readonly value="<?php echo $username ?>" required />


      <label for="fname">Email</label>
      <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly required />

      <label for="Contact">Contact</label>
      <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" id="contact" name="contact" maxlength="10" required placeholder="Mobile Number.." />

      <label for="Address">Address</label>
      <input required type="text" id="address" name="address" placeholder="Your Address.." />

      <label for="product_name">Product Name</label>
      <input required type="text" id="product_name" name="product_name" placeholder="Boat Stone" />

      <label for="Address">Product Description</label>
      <div>
        <textarea required rows="4" cols="50" id="prod_desc" name="prod_desc"></textarea>
      </div>
      <br>
      <div>
        <p style="color:red">Use any free image hosting website(https://postimages.org/) and proveide the src link</p>
      </div>

      <label for="product_thumbnail">Product Thumbnail</label>
      <input type="text" id="product_thumbnail" name="product_thumbnail" placeholder="https:/image-host/pro.jpeg" />


      <label for="product_image">Product Image Link(You can provide three image Link(1.png|2.png|3.png))</label>
      <input required type="text" id="product_image" name="product_image" placeholder="1.png|2.png|3.png" />

      <label for="Category">Category</label>
      <select onchange="fun(this.value)" id="category" name="category">
        <option selected disabled>Please select Category</option>
        <option value="11000">Books</option>
        <option value="12000">Electronic</option>
      </select>

      <div class="books">
        <label>Books</label>
        <select required id="bookstype" name="bookstype">
          <option value="none" selected>
            Select an Option
          </option>
          <option value="11001">Anime</option>
          <option value="11002">College Books</option>
          <option value="11003">AutoBiography</option>

        </select>
      </div>
      <div class="electronic">
        <label for="Electronic">Electronic</label>
        <select required id="electronictype" name="electronictype">
          <option value="none" selected>
            Select an Option
          </option>
          <option value="12001">Mobile</option>
          <option value="12002">Laptop</option>
          <option value="12003">Monitor</option>
          <option value="12004">Charger and Cables</option>
        </select>
      </div>

      <label for="monthsUsed">Months Used</label>
      <input required type="number" id="month_used" name="month_used" placeholder="How many months used" />

      <label for="Quantity">Quantity</label>
      <input required type="number" id="quantity" name="quantity" placeholder="Quantity.." />

      <label for="price">Price &#8377;</label>
      <input required type="number" id="price" name="price" placeholder="&#8377;.." />
      <label for="Phone Pay">Online Payment id</label>
      <input required type="text" id="payid" name="payid" placeholder="Any One" />
      <input type="submit" value="Submit" />
    </form>
  </div>


  <script>
    function fun(props) {
      if (props == 11000) {
        document.getElementsByClassName('books')[0].style.display = 'block';
        document.getElementsByClassName('electronic')[0].style.display = 'none';
      } else if (props == 12000) {
        document.getElementsByClassName('books')[0].style.display = 'none';
        document.getElementsByClassName('electronic')[0].style.display = 'block';
      }
    }
  </script>
  <script src="../Assets/js/main.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>