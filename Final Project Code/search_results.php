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
    $searchCategory = $_POST["categoryChoice"];

    if($searchCategory == "Title"){
      $query = "SELECT * " .
               "FROM Book b " .
               "ORDER BY b.book_title"; 
    } 
    else if($searchCategory == "Author"){
        $query = "SELECT * " .
                 "FROM Book b " .
                 "ORDER BY b.author"; 
    }       

    else if($searchCategory == "Genre"){
        $query = "SELECT * " .
                 "FROM Book b " .
                 "ORDER BY b.genre"; 
    } 
    else if($searchCategory == "Publisher"){
        $query = "SELECT * " .
                 "FROM Book b " .
                 "ORDER BY b.publisher"; 
    } 
    
    else{
        $query = "SELECT * " .
                 "FROM Book b " .
                 "ORDER BY b.year_published"; 
    } 

    $result = mysqli_query($conn, $query);

    echo "<h2>Books by " . $searchCategory ."</h2>";

    if(mysqli_num_rows($result) > 0){
        echo "<table>
        <tr>  
        <th> Book ID </th>
        <th> Title </th> 
        <th> Author </th>  
        <th> Genre </th>
        <th> Publisher </th>
        <th> Year Published </th>
        </tr>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>" . $row["book_id"] . "</td>";
            echo "<td>" . $row["book_title"] . "</td>";
            echo "<td>" . $row["author"] . "</td>";
            echo "<td>" . $row["genre"] . "</td>";
            echo "<td>" . $row["publisher"] . "</td>";
            echo "<td>" . $row["year_published"] . "</td>";
            echo "<td> <form action=book_info.php method=POST> <input type= submit value= View  name=" . $row["book_id"] . " /> </form> </td>";
            echo "</tr>"; 
        }
        echo "</table>";
    }
  $conn -> close();
?>
<body>
</html>