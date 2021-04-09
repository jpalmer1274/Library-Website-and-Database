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
<h1 style ="background-color:silver; font-size:75px;"> Requests</h1>
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

      $query = "SELECT * FROM BookRequest;";

      $result = mysqli_query($conn, $query);
  
      if(mysqli_num_rows($result) > 0){
          echo "<table>
          <tr>  
          <th> Request # </th>
          <th> Title </th> 
          <th> Author </th>  
          <th> User ID </th>
          <th> Date Requested </th>
          </tr>";
          while($row = mysqli_fetch_assoc($result)){
              echo "<tr>";
              echo "<td>" . $row["request_id"] . "</td>";
              echo "<td>" . $row["title"] . "</td>";
              echo "<td>" . $row["author"] . "</td>";
              echo "<td>" . $row["us_id"] . "</td>";
              echo "<td>" . $row["request_date"] . "</td>";
              echo "</tr>"; 
          }
          echo "<tr><td> <form action=\"confirm_req_remove.html\" method=POST> <input type= \"submit\" value= \"Remove a Request\"> </form> </td>";
          echo "</table>";
      }
    $conn -> close();


      ?>
</html>