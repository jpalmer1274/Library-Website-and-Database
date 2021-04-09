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

<h1 style ="background-color:silver; font-size:75px;"> Meeting Room Available Times</h1>

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

  $query = "SELECT start_time, end_time FROM AllTimes WHERE start_time NOT IN (SELECT reserve_time FROM MeetingRoomStatus);";

  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) > 0){
      echo "<table>
           <th> Start Time </th>
           <th> End Time </th>
           <th> Reserve </th>
           </tr>"; 
      while($row = mysqli_fetch_assoc($result)){
         echo "<tr>";
         echo "<td>" . $row["start_time"] . "</td>";
         echo "<td>" . $row["end_time"] . "</td>";
         echo "<td> <form action=confirm_meeting.php method=POST> <input type= \"submit\" value= \"Reserve\"  name=" . $row["start_time"] . " /> </form> </td>";
      }
      echo "</table>";
  }
  mysqli_close($conn);

?>


</body>
</html>