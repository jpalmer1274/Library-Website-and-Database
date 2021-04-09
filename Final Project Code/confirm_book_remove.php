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
  <h1 style ="background-color:silver; font-size: 75px"> Remove a Book </h1>

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

      $bookID = $_POST["ID"];
      $libPassword = $_POST["password"];
      

    if($libPassword == "OhBrother49"){  
      $deleteQuery = "DELETE FROM Book WHERE book_id = ?;";
      $stmt = $conn -> stmt_init();
      $stmt -> prepare($deleteQuery);
      $stmt -> bind_param("i", $bookID);
     
      if($stmt -> execute()){
        header("Location: https://barney.gonzaga.edu/~alewis8/Project/home.php");
        exit;
      }
          
      $stmt -> close(); 
    }
    else{
      echo "Incorrect Password";
    }
      $conn -> close();
      
    ?>


</body>
</html