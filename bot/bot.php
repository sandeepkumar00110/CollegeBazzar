<link rel="stylesheet" href="bot.css">
<?php
include '../Auth/partials/_dbconnect.php';
$name = $_SESSION['username'];

?>
<div id="bot">
  <div id="container">
    <div id="header">Online Chatbot App</div>

    <div id="body">
      <!-- This section will be dynamically inserted from JavaScript -->
      <?php
      $sql = "Select * from chatbot where message_from='$name' and prod_id='$prod_id'";
      $result = mysqli_query($conn, $sql);
      // print_r($result);
      $num = mysqli_num_rows($result);
      while ($num != 0) {
        $row = mysqli_fetch_assoc($result);
        print_r($row['is_response']);

        echo '      <div class="userSection">
            <div class="messages user-message">
               ' . $row['messages'] . '
            </div>';
        echo '<div class="seperator"></div>
          </div> <div class="botSection">';
        if ($row['is_response'] == 1) {
          echo '
          <div class="messages bot-reply">
             ' . $row['response'] . '
            </div>
            <div class="seperator"></div>
          </div>';
        }

        echo '</div>';
        $num -= 1;
      }
      ?>


      <div id="inputArea">
        <input type="number" name="prod_id" id="prod_id" hidden value="<?php echo $prod_id; ?>">
        <input type="text" name="messages" id="userInput" placeholder="Please enter your message here" required />
        <input type="submit" id="send" value="Send" />
      </div>
    </div>
  </div>

  <script type="text/javascript">
    // When send button gets clicked
    document.querySelector("#send").addEventListener("click", async () => {

      // create new request object. get user message
      let xhr = new XMLHttpRequest();
      var userMessage = document.querySelector("#userInput").value
      var prod_id = document.querySelector("#prod_id").value;
      var message_from = document.querySelector("#username").textContent;
      var message_for = document.querySelector('#capital').textContent;


      // create html to hold user message. 
      let userHtml = '<div class="userSection">' + '<div class="messages user-message">' + userMessage + '</div>' +
        '<div class="seperator"></div>' + '</div>'


      // insert user message into the page
      document.querySelector('#body').innerHTML += userHtml;

      // open a post request to server script. pass user message as parameter 
      xhr.open("POST", "../bot/query.php");
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var data = 'messageValue=' + userMessage + "&prod_id=" + prod_id + "&message_for=" + message_for + "&message_from=" + message_from;
      // var data = 'prod_id=' + prod_id;
      // const data = {
      //   "messageValue": userMessage,
      //   "prod_id": prod_id,
      //   "message_from": message_from,
      //   "message_for": message_for
      // };

      xhr.send(data);
      // var data = 'prod_id=' + prod_id;
      // xhr.send(data);
      // var data = "message_from=" + message_from;
      // xhr.send(data);
      // var data = "message_for=" + message_for;
      // xhr.send(data);




      // When response is returned, get reply text into HTML and insert in page
      xhr.onload = function() {
        let botHtml = '<div class="botSection">' + '<div class="messages bot-reply">' + this.responseText + '</div>' +
          '<div class="seperator"></div>' + '</div>'

        document.querySelector('#body').innerHTML += botHtml;
      }

    })
  </script>