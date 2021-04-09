<html>
<head>
<style>

* {
  box-sizing: border-box;
}

.row {
  display: flex;
  margin-left:-5px;
  margin-right:-5px;
}

.column {
  flex: 50%;
  padding: 5px;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

ul { 
  text-align: center; 
} 

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


.topList {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  text-align: center;
}


.listEntry{
  float: left;
}

.liHeader{
  font-weight: normal;
}

h1 {
  text-align: center;
}

.floatLeft { 
  width: 50%; 
  float: left; 
}
.floatRight {
  width: 50%; 
  float: right; 
  }
.container { 
  overflow: hidden; 
}

</style>
</head>

<body>

<h1 style ="background-color:silver; font-size:75px;"> Library Home</h1>

<form action="https://barney.gonzaga.edu/~alewis8/Project/login.html" class ="myButton">
    <input type="submit" value="Logout" />
  </form>

<ul class= "topList">
  <li class="listEntry">
  <form action="https://barney.gonzaga.edu/~alewis8/Project/search.php">
      <input type="submit" value="Search" />
  </form>
  </li>

  <li class="listEntry">
  <form action="request_book.php">
      <input type="submit" value="Request Book" />
  </form>
  </li>

  <li class="listEntry">
  <form action="https://barney.gonzaga.edu/~alewis8/Project/add_info.php">
      <input type="submit" value="Add Book" />
  </form>
  </li>

  <li class="listEntry">
  <form action="https://barney.gonzaga.edu/~alewis8/Project/reading_room.php">
      <input type="submit" value="Reading Room" />
  </form>
  </li>

  <li class="listEntry">
  <form action="https://barney.gonzaga.edu/~alewis8/Project/meeting_room.php">
      <input type="submit" value="Meeting Room" />
  </form>
  </li>

  <li class="listEntry">
  <form action="https://barney.gonzaga.edu/~alewis8/Project/view_requests.php">
      <input type="submit" value="Book Requests" />
  </form>
  </li>

  <li class="listEntry">
  <form action="https://barney.gonzaga.edu/~alewis8/Project/view_reading.php">
      <input type="submit" value="Reading Room Reservations" />
  </form>
  </li>

  <li class="listEntry">
  <form action="https://barney.gonzaga.edu/~alewis8/Project/view_meeting.php">
      <input type="submit" value="Meeting Room Reservations" />
  </form>
  </li>

  <li class="listEntry">
  <form action="remove_book.html">
      <input type="submit" value="Delete Book" />
  </form>
  </li>

</ul>


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

$recentlyAdded = "SELECT b.book_id, b.book_title FROM Book b JOIN BookAddition ba USING(book_id) ORDER BY ba.add_date DESC LIMIT 5;";

$result = mysqli_query($conn, $recentlyAdded);

if(mysqli_num_rows($result) > 0){
?>
<div class="container">
<div class="floatLeft">
  <p style="font-size:30px">Recent Arrivals</p>
  <table>
<?php
  while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>" . $row["book_title"] . "</td>";
    echo "<td> <form action=book_info.php method=POST> <input type= submit value= View  name=" . $row["book_id"] . " /> </form> </td>";
    echo "</tr>";
  }
}
?>
</table>

<?php


  $conn -> close();
  
?>
</div>
</body>
</html>