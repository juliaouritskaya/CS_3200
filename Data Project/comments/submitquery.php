<?php

session_start();

include "conn.php";

if (isset($_POST["type"])) {
$type=$_POST["type"];


if($type=="submituser")
{
   $name= $_POST['name'];
   $email=$_POST['email'];
  $userpassword= $_POST['password'];
  $phone= $_POST['phone'];
  

$sql=" INSERT INTO users (`username`, `email`,`phone`, `password`) VALUES ('".$name."', '".$email."','".$phone."','".$userpassword."' )";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
else if($type=="loginpage"){
    $email =$_POST['email'];
    $mypassword =$_POST['password']; 
    
    $sql = "SELECT id FROM users WHERE email = '$email' and password = '$mypassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    
    $count = mysqli_num_rows($result);
    
    // If result matched $myusername and $mypassword, table row must be 1 row
      
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
   
    header("location: home.php?id=".$row['id']."");
  }
} else {
       $error = "Your Login Name or Password is invalid";
       echo $error;
       $_SESSION['error'] = $error;
       
       header("location: login.php");
    }

}

else if($type=="submitpost"){
    $post =$_POST['post'];
   $id=$_POST['userid'] ;
 
     
    $sql="INSERT INTO posts (`description`, `userid`) VALUES ('".$post."', '".$id."' )";

if ($conn->query($sql) === TRUE) {
    header("Location: home.php?id=".$id."");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
   

}

else if($type=="submitcomment"){
    $comment =$_POST["comment"];
   $postid=$_POST["postid"] ;
   $userid=$_POST["userid"] ;
 
     
    $sql="INSERT INTO comments (`description`, `userid`,`post_id`) VALUES ('".$comment."', '".$userid."','".$postid."');";

if ($conn->query($sql) === TRUE) {
  
   echo "true";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
   

}

else if($type=="deletepost"){
  $id =$_POST["id"];

   
  $sql="delete from posts where id=".$id."";

if ($conn->query($sql) === TRUE) {

 echo "true";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
 

}


else if($type=="editpost"){
  $id =$_POST["id"];
  $comment =$_POST["comment"];

   
  $sql="update  posts set description='".$comment."' where id=".$id."";

if ($conn->query($sql) === TRUE) {

 echo "true";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
 

}
else if($type=="deletecomment"){


  $id =$_POST["id"];

   
  $sql="delete from comments where id=".$id."";

if ($conn->query($sql) === TRUE) {

 echo "true";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
 


}

else if($type=="likepost"){


  $id =$_POST["id"];
  $userid =$_POST["userid"];
   
  $sql="insert  into  likes (post_id,user_id) values('".$id."','".$userid."') ";

if ($conn->query($sql) === TRUE) {

 echo "true";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
 


}

else if($type=="supmitnews"){


  $news =$_POST["news"];
  $userid =$_POST["userid"];
   
  $sql="insert  into  news (description,user_id) values('".$news."','".$userid."') ";

if ($conn->query($sql) === TRUE) {

 echo "true";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
 


}


else if($type=="deletenews"){


  $id =$_POST["id"];

   
  $sql="delete from news where id=".$id."";

if ($conn->query($sql) === TRUE) {

 echo "true";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
 
 


}



else if($type=="editnews"){
  $id =$_POST["id"];
  $news =$_POST["news"];

   
  $sql="update  news set description='".$news."' where id=".$id."";

if ($conn->query($sql) === TRUE) {

 echo "true";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
 

}





















}

?>