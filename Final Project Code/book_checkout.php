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
<h1 style ="background-color:silver; font-size: 75px;"> Checkout Book </h1>

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

  foreach($_POST as $name => $content) {
    $bookID = $name;
 }

 $query = "SELECT * " .
 "FROM BookCheckout " .
 "WHERE book_id = " . $bookID;

 $result = mysqli_query($conn, $query);

 if(mysqli_num_rows($result) == 0){
    echo "<tr>";
        echo "<td> Book you are checking out: </td><br><br>";
        echo "<td> Title: " . $row["book_title"] . "</td><br>";
        echo "<td> Author: " . $row["author"] . "</td><br><br>";
    echo "</tr>";
    echo "<form method=POST>
   <label for=UserID>UserID: </label>
   <input type=text id=UserID name=UserID required><br>
   <input type=submit value=Checkout ><br>
 </form>";

}



mysqli_close($conn);

?>
</body>
</html>