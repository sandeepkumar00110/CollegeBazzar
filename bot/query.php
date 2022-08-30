<?php

/* Establishes a connection with database. First argument is the server name, second is the username for database, third is password (blank for me) and final is the database name 
*/
include '../Auth/partials/_dbconnect.php';

// If connection is established succesfully

// Get users message from request object and escape characters

// print_r($_POST);
// foreach ($_POST as $nms) {
//     print_r($nms);
// }
$user_messages = $_POST['messageValue'];
// create SQL query for retrieving corresponding reply
//
$message_from = $_POST['message_from'];
$message_for = $_POST['message_for'];
$prod_id = $_POST['prod_id'];

// $query = "Meassage sent Successfully";

$insert = "INSERT INTO `chatbot`(`message_from`, `message_for`, `messages`,`prod_id`) VALUES ('$message_from','$message_for','$user_messages','$prod_id')";
$makeQuery = mysqli_query($conn, $insert);



$query = "SELECT * FROM chatbot WHERE message_for='$message_for' and message_from='$message_from'";
// if (isset($_POST['']))
// Execute query on connected database using the SQL query
$makeQuery = mysqli_query($conn, $query);

if (mysqli_num_rows($makeQuery) > 0) {

    // Get result
    $result = mysqli_fetch_assoc($makeQuery);
    // print_r($result['is_response']);
    if ($result['is_response'] == 1) {
        echo $result['response'];
    } else {
        echo "sent successfully";
    }
    // Echo only the response column
} else {

    // Otherwise, echo this message
    echo "Sorry, I can't understand you.";
}
