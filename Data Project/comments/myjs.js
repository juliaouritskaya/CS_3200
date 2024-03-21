function showmodal(id){

 

  $ ('#modalfooter').empty ();


    var htmform =' <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="submitcomment('+id+')">Save</button>';

    $ ('#modalfooter').append (htmform);
 
}


function submitcomment (id) {
  
   var comment= $ ('#commentcontent').val();
   var postid=$ ('#postid'+id+'').val ();
   var userid=$ ('#userid'+id+'').val ();

   console.log(postid)
 
    $.ajax ({
      url: 'submitquery.php?postid='+postid+'',
      type: 'POST',
      data: {
        // fname:fname,
        // lname:lname,
        // email:email,
        // mobile_number:mobile_number,
        // location:location,
        type:"submitcomment",
        comment:comment,
        postid:postid,
        userid:userid
      },
      success: function (response) {
        console.log (response);
        if(response=="true")
        {
          window.location.reload();
        }
  
       
      },
      error: function (response) {
        console.log (response);
      },
    });
  }


  function deletepost(id)
  {
    $ ('#deletefooter').empty ();


    var htmform =' <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="submitdelete('+id+')">Delete</button>';

    $ ('#deletefooter').append (htmform);


  }

  function submitdelete(id){

   
  
  
     $.ajax ({
       url: 'submitquery.php',
       type: 'POST',
       data: {
         // fname:fname,
         // lname:lname,
         // email:email,
         // mobile_number:mobile_number,
         // location:location,
         type:"deletepost",
        
         id:id
       },
       success: function (response) {
         console.log (response);
         if(response=="true")
         {
           window.location.reload();
         }
   
        
       },
       error: function (response) {
         console.log (response);
       },
     });

  }



  function editpost(id)
  {
    $ ('#editfooter').empty ();


    var htmform =' <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="submitedit('+id+')">Edit</button>';

    $ ('#editfooter').append (htmform);


  }

  function submitedit(id){

    var comment= $ ('#commentcontentedit').val();
    
  
  
     $.ajax ({
       url: 'submitquery.php',
       type: 'POST',
       data: {
         // fname:fname,
         // lname:lname,
         // email:email,
         // mobile_number:mobile_number,
         // location:location,
         type:"editpost",
         comment:comment,
         id:id
       },
       success: function (response) {
         console.log (response);
         if(response=="true")
         {
           window.location.reload();
         }
   
        
       },
       error: function (response) {
         console.log (response);
       },
     });

  }


  function deletecomment(id){

   console.log(id)
    
  
  
     $.ajax ({
       url: 'submitquery.php',
       type: 'POST',
       data: {
        
         type:"deletecomment",
        
         id:id
       },
       success: function (response) {
         console.log (response);
         if(response=="true")
         {
           window.location.reload();
         }
   
        
       },
       error: function (response) {
         console.log (response);
       },
     });

  }


  function likepost(id,userid){

    console.log(id)
     
   
   
      $.ajax ({
        url: 'submitquery.php',
        type: 'POST',
        data: {
         
          type:"likepost",
         
          id:id,
          userid:userid
        },
        success: function (response) {
          console.log (response);
          if(response=="true")
          {
            window.location.reload();
          }
    
         
        },
        error: function (response) {
          console.log (response);
        },
      });
 
   }


   function submitnews(userid){

    var news= $('#newsposts').val();
     
   
   
      $.ajax ({
        url: 'submitquery.php',
        type: 'POST',
        data: {
         
          type:"supmitnews",
          userid:userid,
          news:news
        },
        success: function (response) {
          console.log (response);
          if(response=="true")
          {
            window.location.reload();
          }
    
         
        },
        error: function (response) {
          console.log (response);
        },
      });
 
   }
 

   


   function deletenews(id)
  {
    $ ('#deletenewsfooter').empty ();


    var htmform =' <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="submitdeletenews('+id+')">Delete</button>';

    $ ('#deletenewsfooter').append (htmform);


  }

  function submitdeletenews(id){

   
  
  
     $.ajax ({
       url: 'submitquery.php',
       type: 'POST',
       data: {
         // fname:fname,
         // lname:lname,
         // email:email,
         // mobile_number:mobile_number,
         // location:location,
         type:"deletenews",
        
         id:id
       },
       success: function (response) {
         console.log (response);
         if(response=="true")
         {
           window.location.reload();
         }
   
        
       },
       error: function (response) {
         console.log (response);
       },
     });

  }



  function editnews(id)
  {
    $ ('#editnewsfooter').empty ();


    var htmform =' <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="button" class="btn btn-primary" onclick="submiteditnews('+id+')">Edit</button>';

    $ ('#editnewsfooter').append (htmform);


  }

  function submiteditnews(id){

    var news= $ ('#commentcontentedit').val();
    
  
  
     $.ajax ({
       url: 'submitquery.php',
       type: 'POST',
       data: {
         // fname:fname,
         // lname:lname,
         // email:email,
         // mobile_number:mobile_number,
         // location:location,
         type:"editnews",
         news:news,
         id:id
       },
       success: function (response) {
         console.log (response);
         if(response=="true")
         {
           window.location.reload();
         }
   
        
       },
       error: function (response) {
         console.log (response);
       },
     });

  }



  

  


