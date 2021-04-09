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
  <h1 style ="background-color:silver; font-size: 75px;"> Add a Book </h1>
  
  <form action="https://barney.gonzaga.edu/~alewis8/Project/home.php" class ="myButton">
      <input type="submit" value="HOME" />
  </form>

  <form action="confirm_add.php" method="POST">
    <label for="Title">Title......................................: </label>
    <input type="text" id="Title" name="Title" required><br><br>
    <label for="Author">Author..................................: </label>
    <input type="text" id="Author" name="Author" required><br><br>
    <label for="Genre">Genre...................................: </label>
    <input type="text" id="Genre" name="Genre" required><br><br>
    <label for="Publisher">Publisher..............................: </label>
    <input type="text" id="Publisher" name="Publisher" required><br><br>
    <label for="yearPublished">Year Published.....................: </label>
    <input type="text" id="yearPublished" name="yearPublished" required><br><br>
    <label for="Date">Today's Date (yyyy-mm-dd): </label>
    <input type="text" id="Date" name="Date" required><br><br>
    <label for="libID">Librarian ID.........................: </label>
    <input type="text" id="libID" name="libID" required><br><br>
    <label for="libPassword">Librarian Password..............: </label>
    <input type="text" id="libPassword" name="libPassword" required><br><br>
    <input type="submit" value="Add">
  </form>

</body>
</html>