<?php
session_start();
echo $_session["myid"];
$userid= $_GET['id'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comments</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="myjs.js"></script>
    <style>
    .fa-thumbs-up:hover,.fa-edit:hover {
        color: teal;
    }
    .fa-trash-alt:hover{
        color:red;
    }


    </style>


</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php?id=<?php echo $userid;
?>"> Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addpost.php?id=<?php echo $userid;
?>">Add Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="myposts.php?id=<?php echo $userid;
?>">My Posts</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link"  href="news.php?id=<?php echo $userid;
?>">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    
  <tbody>
    <tr>
     
      
    </tr>




    <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-lg-10">
            <div class="card shadow-0 border" style="background-color: ;">
                <div class="card-body p-4">


                    <table class="table table-hover">
                    <thead>
                    <td>Description</td>
      <td>Date</td>
      <td>Edit</td>
      <td>Delete</td>
  </thead>
                    <?php
                    include "conn.php";

                    $sql = "SELECT * FROM socialapp.posts where userid=".$userid."";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    
    $count = mysqli_num_rows($result);
    
    // If result matched $myusername and $mypassword, table row must be 1 row
      
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo'<tr>
    
    <th scope="col">'.$row["description"].'</th>
    <th scope="col">'.$row["created_at"].'</th>
    <th scope="col"><i class="fas fa-edit" onclick="editpost('.$row["id"].')" data-bs-toggle="modal" data-bs-target="#editmodal" ></i></th>
    <th scope="col"><i class="fas fa-trash-alt" onclick="deletepost('.$row["id"].')" data-bs-toggle="modal" data-bs-target="#deletemodal"></i></th>
  </tr>';


  }

}
?>
                    </table>



                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Edit Comment</span>
                        <input type="text" class="form-control" aria-label="Sizing example input" id="commentcontentedit"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="modal-footer" id="editfooter">
                   
                </div>
            </div>
        </div>
    </div>
    



    <!-- Modal -->
    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer" id="deletefooter">

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>