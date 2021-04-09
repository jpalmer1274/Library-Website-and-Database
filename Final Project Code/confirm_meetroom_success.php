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

<h1 style ="background-color:silver; font-size: 75px;"> Reservation </h1>


<form action="https://barney.gonzaga.edu/~alewis8/Project/home.php" class ="myButton">
      <input type="submit" value="HOME" />
</form>

<?php
$config = parse_ini_file("../../private/config.ini");
$server = $config["servername"];
$username = $config["username"];
$password = $config["password"];
$database = $config["database"];

$conn = mysqli_connect($server, $username, $password, $database);


    if(!$conn){
      die("Connection failed:" . mysqli_connect_error());
    }
    $userID = $_POST["userID"];
    $reserveTime = $_POST["reserveTime"];

    $query = "SELECT us_id FROM MeetingRoomStatus WHERE us_id = ?";

    $stmt = $conn -> stmt_init();
    $stmt -> prepare($query);
    $stmt -> bind_param("i", $userID);
    $stmt -> execute();
    $stmt -> bind_result($foundID);

    if($stmt -> fetch()){
        echo "You already have a reservation!";
    }
    


    
    else{
      $insertQuery = "INSERT INTO MeetingRoomStatus VALUES (?,?)";
      $stmt2 = $conn -> stmt_init();
      $stmt2 -> prepare($insertQuery);
      $stmt2 -> bind_param("is", $userID, $reserveTime);

      if($stmt2 -> execute()){
          echo "Reserved!";
      }
      else{
          echo "Failed to make reservation";
      }
    }
  $conn -> close();
?>
<body>
</html>