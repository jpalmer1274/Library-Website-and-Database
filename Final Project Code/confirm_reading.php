<html>
<style>
.myButton{
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: silver;
    color: black;
    padding: 30px 32px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;

}
h1 {
  text-align: center;
}
</style>  
<body>
  <h1 style ="background-color:silver; font-size: 75px"> Confirm Reservation</h1>

  <form action="https://barney.gonzaga.edu/~alewis8/Project/home.php" class ="myButton">
      <input type="submit" value="HOME" />
  </form>

  <?php
      $config = parse_ini_file("../../private/config.ini");
      $server = $config["servername"];
      $username = $config["username"];
      $password = $config["password"];
      $database = $confif["database"];
      
      $conn = mysqli_connect($server, $username, $password, $database);

      if(!$conn){
        die("Connection failed:" . mysqli_connect_error());
      }

    foreach($_POST as $name => $content) {
      $reserveTime = $name;
    }

      echo "<h2>";
      echo "Reservation Time: " . $reserveTime . "<br><br>";
      echo "</h2>";

    ?>

    <form action="confirm_readroom_success.php" method="POST">
    <label for="userID">Enter User ID: </label>
    <input type="text" id="userID" name="userID" required><br><br>
    <label for="reserveTime">Enter Reservation Time (HH:MM): </label>
    <input type="text" id="reserveTime" name="reserveTime" required><br><br>
    <input type="submit" value="Reserve">
    </form>
  </body>