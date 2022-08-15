<?php
    include("config.php");
    include('forms.php');
    $sql = "SELECT heading,content,username,name,pubdate from blogs";
    $result = mysqli_query($db,$sql);         
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(!empty($_POST['topic'])){
        // Loop to store and display values of individual checked checkbox.
        $topic = $_POST['topic'];
        $topic = join(', ', $topic);
        $sql = "SELECT heading,content,username,name,pubdate from blogs where type in($topic)";
        $result = mysqli_query($db,$sql);         
        }
      
    }

    $db->close();
    session_start();
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Blogger</title>
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

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
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
                  style="padding-right:4%;" >
          <!--Php Goes Here-->
          <?php
             while($row = $result->fetch_assoc()) {
               echo '<div class="col-12 shadow rounded-3 p-5" 
               style="margin: 20px;
               background-color:white ">
               <div class="row mb-4">
                   <div class="col-auto">
                     <img
                       src="profiles/'.$row["username"].'.jpg"'.'
                       class="rounded-circle ratio-1x1 overflow-hidden"
                       width="64"
                       height="64"
                       alt = "no"
                     />
                   </div>
                   <div class="col row g-0">
                     <div class="col-12 fs-4">'.$row["name"].'</div>
                     <div class="col-12 fs-6 text-secondary">'.'@'.$row["username"].'</div>
                   </div>
                 </div>
                 <div class="row px-4 g-3">
                   <div class="col-12 justify" style="text-align: justify">
                     <h4><b>'.$row["heading"].'</b><h4>
                   </div>
                   <div class="col-12 justify" style="text-align: justify">
                     <small>'.$row["pubdate"].'</small>
                   </div>
               
                   <div class="col-12 justify" style="text-align: justify">'
                   .$row["content"].
                   '</div>
                   <div class="col-12 mb-3"></div>
                   
                 </div>
                 
           </div>';
            }
          ?>
        </div><!--blog container closed-->
        <div class="col-4">
                <div class = "col-12 shadow rounded-3 p-5"
                    style="background-color: white;
                    margin: 20px;
                    padding:50px">
                    <div class="col row g-0">
                      <div class="col-12 fs-6">Filter Blogs</div>
                    </div>
                    <form method = "POST">
                      <div class="form-check mb-2 mr-sm-2">
                        <input class="form-check-input" type="checkbox" id="inlineFormCheck" name = "topic[]" value = 0>
                        <label class="form-check-label" for="inlineFormCheck">
                          Travel
                        </label>
                      </div> 
                      <div class="form-check mb-2 mr-sm-2">
                        <input class="form-check-input" type="checkbox" id="inlineFormCheck" name = "topic[]" value = 1>
                        <label class="form-check-label" for="inlineFormCheck">
                          kitchen
                        </label>
                      </div>
                      <div class="form-check mb-2 mr-sm-2">
                        <input class="form-check-input" type="checkbox" id="inlineFormCheck" name = "topic[]" value = 2>
                        <label class="form-check-label" for="inlineFormCheck">
                          Education
                        </label>
                      </div>
                      <div class="form-check mb-2 mr-sm-2">
                        <input class="form-check-input" type="checkbox" id="inlineFormCheck" name = "topic[]" value = 3>
                        <label class="form-check-label" for="inlineFormCheck">
                          Other
                        </label>
                      </div>
                      <button type="submit" class="btn btn-primary">Apply</button>
                    </form>
                </div>
            </div><!--side Div closed-->
      </div><!--row div closes-->
      <form>
     
    </body>
</html>