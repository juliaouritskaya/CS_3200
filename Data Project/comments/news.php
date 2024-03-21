<?php

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
                        <a class="nav-link" href="news.php?id=<?php echo $userid;
?>">News</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Logout</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>


    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: #f0f2f5;">

                <div class="card-body p-4">

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">News</label>
                        <textarea class="form-control" name="post" id="newsposts" rows="3"></textarea>
                    </div>





                    <button type="button" class="btn btn-primary" onclick="submitnews(<?php echo $userid
?>)">Submit</button>

                </div>
            </div>

        </div>
    </div>





    <?php
                    include "conn.php";

                    $sql = "SELECT news.id,news.description,users.username,users.id as userid FROM socialapp.news inner join users on users.id=news.user_id;";
   
                   
                   
   
                    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    
    $count = mysqli_num_rows($result);
    
    // If result matched $myusername and $mypassword, table row must be 1 row
      
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {





    echo     ' <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                <div class="card-body p-4"><div class="card mb-4">
    <div class="card-body">
        <p>'.$row["description"].'</p>

        <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
                <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8REBIQEBIVDxAQEBAQEBAPDw8QERAQFRUYFhUSFRUYHSggGBomGxMVIjEhJSkrLi4vFx8zODUsNygtMCsBCgoKDg0OGhAQGi0lHyUtLSstLS4tLS0rLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSstLf/AABEIAMsA+AMBEQACEQEDEQH/xAAbAAEAAgMBAQAAAAAAAAAAAAAAAQcCBQYDBP/EAEcQAAIBAgIFBwcICAUFAAAAAAABAgMRBCEFBhIxURMiQWFxkaEyQlJygbHBBxQjYoKS0fAzQ1OTorLS8YOzwuHiFRYkNDX/xAAaAQEAAwEBAQAAAAAAAAAAAAAAAwQFAQIG/8QALBEBAAICAQQCAAYCAgMAAAAAAAECAxEEEiExQRNRIjIzYXGRobFSgQUUQv/aAAwDAQACEQMRAD8AvEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAARcBdHNubhJ10AAAAAAAAAAAAAAAAAAAAAAAAAAABjOaSbbSSzbbskutnJnTkzry0mK1noq6pJ19nKU01CjF/WqSy7rle3Jr/89/8AX9qt+ZSO1e/+v7aLGa6JX+lS+rh6e212znzX2ogtyrff9K1uZafev47/AOWlxOuU2+bGb66ledn9hZEM57T9q9uTafb4Kms1dvKNJf4MG+9o8fLZH813n/3HifqfuaP9Jz5b/Z81/t6UtaMTHdsr1YqH8lh8t/s+bJ9tjhdeMRHfn9pyX8d34okjk5I9pK8vLHtvtH6+05ZVYW+tDL+Fv4k9Ob/yhZp/5GPF4/p1OA0jRrrapTU10pPNdqeaLlMlbxusr+PLTJG6y+s9pAAAAAAAAAAAAAAAAAAAAAADS6f1jo4VWf0lVq8aUXnbjJ+aiDNnrj/n6Vs/Jri7eZ+ldaY1jrV3eo9tXvGmrqlH7PnPrZm5Mtsk7mf+mRlzXyz+Kf8Ar002JxVSpbbk2l5K3RiuCSyXsPEzKOZmXicAOBwAAAAmB9WDx1SnJShJxkt0otpoRMxO4diZrO6zpYGreuinanibRk7JVVlF+uujt3Ghg5e+1/7aXH5u/wAOT+3Zpl5pJAAAAAAAAAAAAAAAAAAADl9btaFhk6VJp12s3vVJPc3xlwXtfXU5HI6Pw18/6UuVy/j/AA1/N/pWGJxMpycm3Jyd5Sbu5Pi2Zvee8sfvM7ny8DgAAAA6AA4AAOgGUJtO6A7jUzWlwaoVpXpvKMm/0f8Ax93YXePyNfht4XuLyZrPTbwsQ0WsAAAAAAAAAAAAAAAAAGk1r04sJRurOtUvGlF8emb6l+CIM+b46/v6VuVn+Km/c+FRYmvKcnKTcpSblKT3yk97ZkzO53LD7zO58vE4AA6IlJLNux7ikvcUmXpSw9WecYO3GfNXjn4E9cFp9LVOLafT66WhcTLcl9mM5+4mjiynjhT9sp6CxMc2kvWp1I+I/wDVn7dnhT9vjqYWtHfC64wal4byK3GtHpBfi3j08lJPd0b10r2FeaTCtbHMJI0YAAypTcXdAWnqLprlqXIzd50ktlvfKnu8Ml2NGpxsvVHTPmGvw83XXpnzDqS0ugAAAAAAAAAAAAAAGNSainJuySbbe5Jb2J7EzpTOsul5YqvOrns+TST82mt2XF732mNlyfJfqfP58vy3m39NSRog4B0TTpynLYgry3u+6K4ssY8W50tYcM2l2mrWpbmlUqZJ58pJXk/Uj0Lr95fpiirUx4K0dxgtC4el5NNOXpT58u273ewmTtgkBIHx4zRdCr+kpxk/StaX3lmBxWsupNk6lK80s8rcrFccvKX5zI744siyYa38uEq05Qlsz3+bJbpIzcuGaz3ZWbBNZYldVAAG01e0nLD14VFujLnLjB5SXd8CXDkmltpcOScd4ldFOaklJO6aTTXSnuZsx3b8TtkAAAAAAAAAAAAAAByvyh6T5LC8lF2niHsdfJqzn8F9oq8u/TTX2p83J04+n3Kq5My2MAACi20oq8m7JdZNip1Snw45tKw9SdWoqKqVFeKfT+tmt8n9VcPy9THSKx2bWPHFK6d2SJAAAAAAOE171ei4utBWTfPt5k3umupvJ/7keSkWjUosuOL11Ku1fc8pJ2kutGVkrqWJkrNZ1KSJGDQmLzPUVl6ikyuLUurOWBouas9lqN+mCk1F9yRr4d9EbbnH38cbbslTAAAAAAAAAAAAAAKo+ULHcpjZQT5tCEaa9Zrak/4kvsmXy7bvr6Y3Ov1ZNfTmCqpgA67Db6r4B1qqt0yVOL4N+VL2I0eNT21eJj7bXHh6MYRjCKtGKUUupFxfegAAAAAAPLFYeNSEqcs4zi4vsYFOac0JiKVWT5KcuiShByd1ukkt6aKXIxTM7hncrjza3VDLAar46tnHDyin01bUvCVn4ENeNM+kNOJafTosD8nVR5166jxjSi5P7ztbuLMcaPa1Xhx7dDgdSsDTs3B1mumtJyX3VZeBLXFWPSeMFI9OijFJJJWSySWSS4EqZIAAAAAAAAAAAAAIbAorSGJ5WrUq/tKk5/ek2vAxL26rTL53JbqvM/u+c8PABEme6x3e6R3WB8nODzU35tNy+1N5fw3NfFGqtzDGqRDvyRMAAAAAAAAAAAAAAAAAAAAAAAAAAAA+HTtfk8LiKnTChVku1QbR4vOqzLxlt00mf2UelkuwxXzocADCpw4kuOO6XFH4luaj0UqVRr04w9kYr+o16t6vh0p6egAAAAAAAAAAAAAAAAAAAAAAAAAAAGk10nbAYnrp7P3mo/Eiz/pyg5P6Vv4U4zHYIcABTV5wX14+8mw/mhPg/NC4dTl/4766s34JfA14btfDenXQAAAAAAAAAAAAAAAAAAAAAAAAAAAGg17/APn4jsp/5kSHP+nKDlfpWVAZDBAAE0V9JT9ePvJsP5oWOP8AmhcOp/8A63+JP4GtDbjw3h16AAAAAAAAAAAAAAAAAAAAAAAAAAAAaTXWN8BiPUT7pJ/Aiz/pyh5H6Vv4U4jHYCQACD50HwlH3kuL80J8E/ihbupU70JLhVl/LE14blXQHXoAAAAAAAAAAAAAAAAAAAAAAAAAAABr9YKO3hMRDplQqpduw7eJ4vG6zDxkjdJj9lIoxpjT56UnHADCpx6z3TykxzqVqaiVrqrHjsTXin8DYrPZvV8OsPT2AAAAAAAAAAAAAAAAAAAAAAAAAAAAiSurPc8gKKxuH5OrUpv9XUnD7smvgY2SNWmHz+WvTeYeJ4RpAwqLI7DsO31ExuzVpXeVSDpPt6PGK7zVw23WG3gtusSscmWAAAAAAAESdld5JZtgVjjNaKssQ5bc7Tm1Rpwk4rZvaPTZdF2Vc2XolSz5uidttgNdM9mbV07NVEvCUcjzTl199nnHzaz57Ojwmn6M1nzetc6PeixGSsrdctbeGzpVYyV4tSXFNMkSMwAAAAAAAAAAAAAAAFUfKBguTxspJc2tGNRdvky8Y39pm8qurbZPNpq+3NFVRkuBDDsNnoKu1eKdnFqcXw/LsXuNftpo8TJ6W9onHKvSjUW9q0l6M1vX54ouw0Ynb7DroAAAAAHPa6aUVHDumn9JXvBcVDz5dzt7TzadQ8WnUKirz26rfRHmL2b33mXnt1WY3Iv1X/hksiFX09qOJnB3i2uxiO3gjceG90VrVXpSTyn0O+V1wdianJyV/dYx8vJSftZmh9IwxNGNaGSldNPNxknZo08d+usS2MWSMlYtD7T2kAAAAAAAAAAAAAAcp8oujeUwyqxV5UJbWW/k5ZS+D9jK/Ip1U/hV5WPqpuPSr7GWxpAAE0KjhNSXQ/7okpbpnaTHea23DtNXtMuhLaXOpTttx6e1da8TRpk9tbHlie8LBwuJhUipwkpRe5r3PgyaJ2sRMT4ep10AAAPj0ppKlh6bqVXZLcl5U5ejFdLOTOnmbRHlUmsWmKlapKrLypc2Eb5Qj0JdnHiU8uXUKOfPqN+2ooQsigzHpYO6LA0WPUR3diNyuXVjR/zfCUqbyls7U/XlzmvZe3sNbHXprEN3FTopENqSJAAAAAAAAAAAAAAGFWmpRcZK8ZJxae5p5NCXJ7qa1g0VLC4idJ+T5VOT86m9z+HamZWfH0WYvIxdF2tsQq5Y47pDR0fXgsa4ZPPiuPWuskpkmqXHlmjo9FaVnTe3Rna/lR3p9UolumXfeq9jzb71l1GE1tg8qsHB+lDnR7t68SaMse08Z49tjDWHCP8AWpetGcfej38lftJ8tPtFXWLBx31U/VU5e5D5K/ZOWke2n0jrrBJqhByfRKpzYrr2Vm/A8Tmj0jtnj04nTGlKlWW3Wk5y82PBcIroRWyZojyqZc8R3lpWnJ3e/wAEuBTtabTuVC1ptO5eiiBNgIsBv9StFfOMVFtXp0bVJ8G0+bH2tdyZZ42Pqttc4mPqtv6W0aTWAAAAAAAAAAAAAAAAGh1u0CsXR5tlWp3lTfHjB9T99iLLj64Q58XyVVLUg4txknGUW1KLyaa3pmXaupYt6zWdSg8vJYA4gIVJRd02utfFHPE7hzvE7h99DSr3S2X15r8SSM1o8pYz3jz3fbDEbW5L95S+LPcZf2SRn/ZLhN7ortdWkl37R35J9QfNPqHzYlKPl1qcPq0pcvUfZs81e1o82tb7iP8ALza9/uI/y1c7N5XS4yzk/wACHSDSUrHXUgAJhByajFOUpNKKW9t5JI9VrMzp6pXqnS3NVtELCUFB2dSXPqyXTJ9CfBbv7mrjp0V028OOKV03FyRKASAAkAAAAAAAAAAAQAA5LXPVb5wnXoJKulzo7lWS/wBXX07ivnw9cbjyq8jjxkjceVbNNNppxkm04tWaa3proM21Zhk2rNZ1IceQABDig4jYQ07pHJoaNMlEaEnQAAQ2diNvURMrB1K1b5K2Jrr6Vr6Km/1afnP63V0du7QwYenvLV43H6I3Pl2N0WVtkmBkgJAASAAAAAEAAAABcDFyAxcwMJ11xA5bWjQ+GxN53VKut1RW53VNdPbvXgRZMUXQZcFckfur7G4SpRls1EuqUXtRl2P8sz8mG1WZl49qPFMhQJDgAAHdgAAATRpynJRgtqT6F72+hdbPdMc2nslx4rX8O01c0FSotVa0o1KyzirpwpvivSfX/cv4sEV7z5aeDjRTvPl1UMSn0lhae8KgHvCQHvEDICQAAAAAAQAAAQBhIDym2B81XaA+GvCTA0+N0fOV7Ac9j9DYjOy2lw3nJjZrbQ4jR2Ig/wBHLuZBfj1srZOLS3js+Z15R8qMl2xZXtxbelS3CvHhKxsOK70veQThvHmFe2C8eYZfOY8fceeiXjot9HzmPH3Dpk6LfSPnceN/aj3GK0+nqMN58QzhOUvJT7mSV4158pq8O8vuw2jJyfOUn1JMsU4tY8rdOHWPzS3mD0dUStGm0uqLLMViPC1WsV8NpQ0bW9Fo69NnhtG1enL2gbbDYNrewPvp0kgPRICQJAAAAAABDAAAAEAQ4gY7AGLprgBHJLgu4COQjwXcBHzePoruQGLwkHvhF9sUB5y0bRe+lB9sIv4AYf8AR8N+wpfuofgAWh8N+wpfuofgB6R0bQW6lTXZTj+AHpHB01uhFfZQGaoR9FdwGXJLgu4CVTQEqKAy2QJAASAAAAAAAAAgAAAAAAACAAAAAAAAJAALALAAAACQAAAAAAAAAAAAgAAAAAAAAAAAAAAAAAASAAAAAAAAAAAAH//Z"
                    alt="avatar" width="25" height="25" />
                <p class="small mb-0 ms-2">'.$row["username"].'</p>

            </div>
            <div class="d-flex flex-row align-items-center">';
            if($row["userid"]==$userid){
            echo'

            <i class="fas fa-edit" onclick="editnews('.$row["id"].')" data-bs-toggle="modal" data-bs-target="#editmodal" ></i> &nbsp &nbsp &nbsp &nbsp
            <i class="fas fa-trash-alt" onclick="deletenews('.$row["id"].')" data-bs-toggle="modal" data-bs-target="#deletemodal"></i>   
           
           ';  
            }

           echo ' <br>
             
          
                
            </div>
        </div> 
        </div>
        </div> 
        </div>
        </div> 
        </div>
        </div> 
        <br>
        ';
  }}
  ?>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Comment</span>
                        <input type="text" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>



     <!-- Modal -->
     <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">News</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">News</span>
                        <input type="text" class="form-control" aria-label="Sizing example input" id="commentcontentedit"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="modal-footer" id="editnewsfooter">
                   
                </div>
            </div>
        </div>
    </div>
    



    <!-- Modal -->
    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer" id="deletenewsfooter">

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>