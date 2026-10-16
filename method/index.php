<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post" >
        <label>username:</label>
        <input type="text" name="username"><br>
        <label>password:</label><br>
        <input type="password" name="password"><br>
        <input type="submit"  value="Log in">
    </form>
</body>
</html>
<?php
   echo "{$_POST["username"]} <br>";
   echo "{$_POST["password"]}";

  // $_GET = Data is appended to the url
  //         NO SECURE
  //         char limit 
  //         Bookmark is possible w/ values
  //         GET requests can be cached
  //         beter for search page 

  // $_POST = Data is package inside the body of HTTP request
  //            More SECURE 
  //            No data limit 
  //            Cannot bookmark
  //            GET requests are not cahed
  //            Better for submitting credentials

?>