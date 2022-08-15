<?php
    include("config.php");
    include("session.php");
    $topic = 3;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // username and password sent from form 
        
        $heading = mysqli_real_escape_string($db,$_POST['heading']);
        $topic = 3;
        $topic = $_POST['type'];
        $content = mysqli_real_escape_string($db,$_POST['content']); 
       
        $myusername = $_SESSION['login_user'];
        $sql = "SELECT fname,lname from users WHERE username = '$myusername'";
        $result = mysqli_query($db,$sql);
        $row = $result->fetch_assoc();
        $name = $row['fname']." ".$row['lname'];

        $date = date("Y/m/d");
        $sql = "insert into blogs(heading,content,username,name,pubdate,type)
              values ('$heading','$content','$myusername','$name','$date','$topic')";
        $result = mysqli_query($db,$sql);
        
        header("location: AddBlog.php");  
    }
    $db->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous"
      />
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
      />
      <script 
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
      crossorigin="anonymous">
    </script>
        <title>Add Blogs</title>
    </head>
    <body  class= 'container' style="background-color: #f4f4ef ;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                      <a class="navbar-brand" href="#">Blogger</a>
                      <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbar"
                        aria-controls="navbar"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                      >
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="AddBlog.php">Add Blogs</a>
                          </li>
                          <?php
                             if(!isset($_SESSION['login_user'])){
                              echo '<li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="login.php">Sign In</a>
                          </li>';
                             }
                              else{
                                echo '<li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="logout.php">logout</a>
                          </li>';
                              }
                             
                           
                          ?>
                         
                        </ul>
                      </div>
                    </div>
                  </nav>
    <div class="row">
    <div class="col-8 " 
          style="padding-right:4%; margin-top :1%;" >
          <form method = 'POST' >
          <div class="form-group ">
            <label for="exampleInputEmail1">Enter Blog Headings</label>
            <input type="text" class="form-control" id="heading" name = "heading" aria-describedby="" placeholder="" required>
          </div>
          <br>
          <div class="form-group col-md-4">
            <label for="inputState">type</label>
            <select id="inputState" class="form-control" name = "type" >
              <option name = "type" value = 3 selected>Choose...</option>
              <option name = "type" value = 0>Travel</option>
              <option name = "type" value = 1>Kitchen</option>
              <option name = "type" value = 2>Education</option>
              <option name = "type" value = 3>Other</option>
            </select>
          </div>
         <!-- <div class="form-group">
              <label for="exampleFormControlFile1">Enter Blog Image</label>
              <input type="file" class="form-control-file" id="image" accept=".png, .jpg, .jpeg">
          </div>-->
          

          <div class="form-group">
              <label for="exampleFormControlTextarea1">Enter Blog Content</label>
              <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
            </div>
          <br>
          <button type="submit" class="btn btn-primary" >Post Blog</button>
       </form>
  </div><br>
 
    <!-- <div class="col-4">
        <div class = "col-12 shadow rounded-3 p-5"
            style="background-color: white;
            margin: 20px;
            padding:50px">
            <div class="col-auto">
                <center>
                <img src="images/profile.jpeg" class="rounded-circle ratio-1x1 overflow-hidden" width="100" height="100" />
            </div></center>
            <div class="col row g-0"><center>
                <div class="col-12 fs-6">Gaurav Gadkari</div>
                <div class="col-12 fs-6 text-secondary">@gaurav_gg1908</div>
            </div></center>
            <hr>
            <div class="col row g-0">
                <div class="col-12 fs-6">
                   <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                </div>
            </div> -->
        </div>
    </div><!--side Div closed-->
    </div><!--main Div closed--> 
           
    </body>
</html>