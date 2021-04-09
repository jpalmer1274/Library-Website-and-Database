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
  <h1 style ="background-color:silver; font-size: 75px; "> Check Login </h1>

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
     

      $checkQuery = "SELECT us_id FROM Users WHERE us_id = ? UNION SELECT librarian_id FROM Librarian WHERE librarian_id = ?;";
    
      $stmt = $conn -> stmt_init();
      $stmt -> prepare($checkQuery);
      $stmt -> bind_param("ii", $userID, $userID);
      $stmt -> execute();
      $stmt -> bind_result($foundID);
                
      if($stmt -> fetch()){

          header("Location: https://barney.gonzaga.edu/~alewis8/Project/home.php");
          exit;
      }
     else{
          echo "No account with that ID!"; 
          ?>
          <p>
            <form action="create_account.html" method="POST">
              <input type="submit" value="Create Account">
            </form>
          </p>
          <?php
      } 
      $conn -> close();
?>
</body>
</html>