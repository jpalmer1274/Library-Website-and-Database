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
<h1 style ="background-color:silver; font-size: 75px;"> Rate </h1>

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
        echo "<td> Book you are rating: </td><br><br>";
        echo "<td> Title: " . $row["book_title"] . "</td><br>";
        echo "<td> Author: " . $row["author"] . "</td><br><br>";
    echo "</tr>";
    echo "<form method=POST>
    <label for=ratingChoice>Choose a Rating:</label>
    <select name=ratingChoice>
        <option value=1>1</option>
        <option value=2>2</option>
        <option value=3>3</option>
        <option value=4>4</option>
        <option value=5>5</option>
   </select>
   <label for=UserID>UserID: </label>
   <input type=text id=UserID name=UserID required><br>
   <input type=submit value=Rate ><br>
   <label for=BookID> Book ID: </label>
   <input type=text id=BookID name=BookID value=" . $bookID . " disabled><br>
   <input type=hidden id=myBookID name=myBookID value=" . $bookID . ">
 </form>";

}

function addRating (int $rating, int $userID) {
    $sql = "INSERT INTO Ratings
    VALUES (" . $userID . ", " . $bookID . ", " . $rating . ")";

    if ($conn->query($sql) === TRUE) {
        echo "Thank you for rating!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

 // select * from rating where userID =, title = , author = ,

$ratings = array('1', '2', '3', '4', '5');
$selected_key = $_POST['ratingChoice'];
$selected_val = $ratings[$_POST['ratingChoice']];
$BookID = $_POST['myBookID'];
$userID = $_POST['UserID'];

if ($_POST['ratingChoice'] && $_POST['UserID']) {

    $query = "SELECT * " .
    "FROM Book b " .
    "WHERE book_id = " . $BookID;

    $result = mysqli_query($conn, $query);

 while($row = mysqli_fetch_assoc($result)){
    $title = $row["book_title"];
    $author = $row["author"];
}

    $checkQuery = "SELECT * FROM Ratings " . 
                    "WHERE book_title = ? AND book_author = ? AND us_id = ?";
    
      $stmt = $conn -> stmt_init();
      $stmt -> prepare($checkQuery);
      $stmt -> bind_param("ssi", $title, $author, $userID);
      $stmt -> execute();
      $stmt -> bind_result($title, $author, $ID);
                
      if($stmt -> fetch()){
          echo "You already rated this book!";
      } else {
        $insertQuery = "INSERT INTO Ratings VALUES(?,?,?,?)";
        $stmt2 = $conn -> stmt_init();
        $stmt2 -> prepare($insertQuery);
        $stmt2 -> bind_param("issi",$userID, $title, $author, $selected_key);
        if($stmt2 -> execute()){
          echo "Book successfully rated!";
        }
        else{
            echo "Rating failed.";
        }
      }

      $stmt -> close();
      $stmt2 -> close();

}

mysqli_close($conn);

?>
</body>
</html>