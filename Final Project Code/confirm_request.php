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


<form action="https://barney.gonzaga.edu/~alewis8/Project/home.php" class ="myButton">
      <input type="submit" value="HOME" />
</form>

<body>
  <h1 style ="background-color:silver; font-size: 75px;"> Request a Book </h1>
    <?php
      $config = parse_ini_file("../../private/config.ini");
      $server = $config["servername"];
      $username = $config["username"];
      $password = $config["password"];
      $database = "alewis8_DB";
      
      $conn = mysqli_connect($server, $username, $password, $database);
      

      if(!$conn){
        die("Connection failed:" . mysqli_connect_error());
      }
      
      $addTitle = $_POST["Title"];
      $addAuthor = $_POST["Author"];
      $addID = $_POST["UserID"];
      $date = $_POST["Date"];

      $checkQuery = "SELECT * FROM BookRequest " . 
                    "WHERE title = ? AND author = ? AND us_id = ?";
    
      $stmt = $conn -> stmt_init();
      $stmt -> prepare($checkQuery);
      $stmt -> bind_param("ssi", $addTitle, $addAuthor, $addID);
      $stmt -> execute();
      $stmt -> bind_result($title, $author, $ID);
                
      if($stmt -> fetch()){
          echo "You already requested this book!";
      }
      else{
        $insertQuery = "INSERT INTO BookRequest VALUES(DEFAULT,?,?,?,?)";
        $stmt2 = $conn -> stmt_init();
        $stmt2 -> prepare($insertQuery);
        $stmt2 -> bind_param("ssis", $addTitle, $addAuthor, $addID, $date);
        if($stmt2 -> execute()){
          echo "Book successfully requested!";
        }
      }
      $stmt -> close();
      $stmt2 -> close();
      $conn -> close();
      
    ?>


</body>
</html