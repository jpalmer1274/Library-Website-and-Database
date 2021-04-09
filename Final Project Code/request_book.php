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

  <h1 style ="background-color:silver; font-size:75px;"> Request a Book </h1>
  <form action="https://barney.gonzaga.edu/~alewis8/Project/home.php" class ="myButton">
    <input type="submit" value="HOME" />
  </form>

  <form action="confirm_request.php" method="POST">
    <label for="Title">Title......................................: </label>
    <input type="text" id="Title" name="Title" required><br><br>
    <label for="Author">Author..................................: </label>
    <input type="text" id="Author" name="Author" required><br><br>
    <label for="UserID">User ID................................: </label>
    <input type="text" id="UserID" name="UserID" required><br><br>
    <label for="Date">Today's Date (yyyy-mm-dd): </label>
    <input type="text" id="Date" name="Date" required><br><br>
    <input type="submit" value="Request">
  </form>

</body>
</html>