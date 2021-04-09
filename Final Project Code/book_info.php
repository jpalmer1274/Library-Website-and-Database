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
<h1 style ="background-color:silver; font-size: 75px;"> Results </h1>

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
 "FROM Book b " .
 "WHERE book_id = " . $bookID;

 $result = mysqli_query($conn, $query);

 while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
        echo "<td> ID: " . $row["book_id"] . "</td><br>";
        echo "<td> Title: " . $row["book_title"] . "</td><br>";
        echo "<td> Author: " . $row["author"] . "</td><br>";
        echo "<td> Genre: " . $row["genre"] . "</td><br>";
        echo "<td> Publisher: " . $row["publisher"] . "</td><br>";
        echo "<td> Year Published: " . $row["year_published"] . "</td><br>";
        $getRatingQuery = "SELECT rating FROM BookRatings WHERE book_title = ? AND book_author = ?";
        $stmt = $conn -> stmt_init();
        $stmt -> prepare($getRatingQuery);
        $stmt -> bind_param("ss", $row["book_title"], $row["author"]);
        $stmt -> execute();
        $stmt -> bind_result($rating);
                
        if($stmt -> fetch()){
          echo "<td> Rating: " . $rating . "</td><br><br>";
        }
        $stmt -> close();
    echo "</tr>";
    echo "<td> <form action=rate_book.php method=POST> <input type= submit value= Rate  name=" . $bookID . " /> </form> </td>";
    //echo "<td> <form action=book_checkout.php method=POST> <input type= submit value= Checkout  name=" . $bookID . " /> </form> </td>";
}

mysqli_close($conn);

?>
</body>
</html>