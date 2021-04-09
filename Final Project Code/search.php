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
  <h1 style ="background-color:silver; font-size:75px;"> Search Library</h1>  

  <form action="search_results.php" method="POST">
    <label for="categoryChoice">Choose a Category:</label>
    <select name="categoryChoice">
        <option value="Title">Title</option>
        <option value="Author">Author</option>
        <option value="Genre">Genre</option>
        <option value="Publisher">Publisher</option>
        <option value="Year Published">Year Published</option>
      </select>
      <input type="submit" value="Search"/>
    </form>

</body>
</html>