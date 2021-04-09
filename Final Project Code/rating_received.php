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

<form action="https://barney.gonzaga.edu/~alewis8/Project/home.php" class ="myButton">
      <input type="submit" value="HOME" />
</form>
<h1 style ="background-color:silver; font-size: 75px;"> Rating Successful </h1>

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

  $rating = $_POST["ratingChoice"];
  $bookID = $_POST["bookID"];

  echo "Thank you for giving a rating of " . $rating . "!";
  echo $bookID;

mysqli_close($conn);

?>
</body>
</html>