<html>
<body>
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
            
           
            
<form action="login.html" class ="myButton">
  <input type="submit" value="Login" />
  </form>
  <h1 style ="background-color:silver; font-size: 75px; "> Create Account </h1>
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
     
      $userID = $_POST["ID"];
      $userName = $_POST["name"];

      $checkQuery = "SELECT us_id FROM Users " . 
                    "WHERE us_id = ?;";
    
      $stmt = $conn -> stmt_init();
      $stmt -> prepare($checkQuery);
      $stmt -> bind_param("i", $userID);
      $stmt -> execute();
      $stmt -> bind_result($foundID);
                
      if($stmt -> fetch()){    
          header("Location: https://barney.gonzaga.edu/~alewis8/Project/login.html");
          exit;
      }
     else{
       $insertQuery = "INSERT INTO Users VALUES (?,?);";
       $stmt2 = $conn -> stmt_init();
       $stmt2 -> prepare($insertQuery);
       $stmt2 -> bind_param("is", $userID, $userName);
          if($stmt2 -> execute()){
            header("Location: https://barney.gonzaga.edu/~alewis8/Project/login.html");
            exit;
          }
      } 
      $conn -> close();
      $stmt -> close();
      $stmt2 -> close();
?>
</body>
</html>