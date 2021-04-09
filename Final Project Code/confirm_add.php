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
  <h1 style ="background-color:silver; font-size: 75px"> Add a Book </h1>

  <form action="https://barney.gonzaga.edu/~alewis8/Project/home.php" class ="myButton">
      <input type="submit" value="HOME" />
  </form>

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
      $addGenre = $_POST["Genre"];
      $addPublisher = $_POST["Publisher"];
      $addPYear = $_POST["yearPublished"];
      $dateAdded = $_POST["Date"];
      $librarian = $_POST["libID"];
      $libPassword = $_POST["libPassword"];
      

    if($libPassword == "OhBrother49"){  
      $insertQuery = "INSERT INTO BookAddition VALUES (DEFAULT, ?, ?)";
    
      $stmt = $conn -> stmt_init();
      $stmt -> prepare($insertQuery);
      $stmt -> bind_param("is", $librarian, $dateAdded);
      
      
      $insertQuery2 = "INSERT INTO Book VALUES (DEFAULT, ?, ?, ?, ?, ?)";
      $stmt2 = $conn -> stmt_init();
      $stmt2 -> prepare($insertQuery2);
      $stmt2 -> bind_param("sssss", $addTitle, $addAuthor, $addGenre, $addPublisher, $addPYear);
     
      if($stmt -> execute()){
        if($stmt2 -> execute()){
          echo "Successfully Added Book!";
        }
      }
          
      $stmt -> close();
      $stmt2 -> close(); 
    }
    else{
      echo "Incorrect Password";
    }
      $conn -> close();
      
    ?>


</body>
</html