<!DOCTYPE html>
<html>
  <head>
    <title>login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="mycss.css" >
   
  </head>
  <body>
<?php
  session_start();

    if (isset($_SESSION['error'])) {
       echo"  <label ><Wrong credentials try again!</i></label>";

  
    }
    ?>
    <div class="main-block">
      <h1>login</h1>
      <form   method="POST"action="submitquery.php">
        <hr>
        
        <hr>
        <label id="icon" for="name"><i class="fas fa-envelope"></i></label>
        <input type="text" name="email" id="name" placeholder="Email" required/>
        <label id="icon" for="name"><i class="fas fa-user"></i></label>
       
        <input type="password" name="password" id="name" placeholder="Password" required/>

        <input type="text" name="type" id="name" value="loginpage" hidden/>
       
        <div class="btn-block">
           <button type="submit" >Submit</button>
        </div>

        <a href="register.php">Register</a>
      </form>
    </div>
  </body>
</html>