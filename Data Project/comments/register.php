<!DOCTYPE html>
<html>
  <head>
    <title> registration</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="mycss.css" >
   
  </head>
  <body>
    <div class="main-block">
      <h1>Registration</h1>
      <form action="submitquery.php" method="POST">
        <hr>
        
        <hr>
        <label id="icon" for="name"><i class="fas fa-envelope"></i></label>
        <input type="text" name="email" id="name" placeholder="Email" required/>
        <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="name" id="name" placeholder="Name" required/>
        <label id="icon" for="name"><i class="fas fa-phone"></i></label>
        <input type="text" name="phone" id="phone" placeholder="Phone" required/>
        <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" name="password" id="name" placeholder="Password" required/>
        <input type="text" name="type"  value="submituser" hidden/>
        <hr>
        
        <hr>
        <div class="btn-block">
           <button type="submit" href="/">Submit</button>
        </div>

        <a href="login.php">Login</a>
      </form>

     
    </div>
  </body>
</html>