<?php
   
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $myusername = $_POST['username'];
    $mypassword = $_POST['password1'];
    $mypassword2 = $_POST['password2'];
    $contact = $_POST['contact'];
    print($fname);
    $sql = "SELECT username FROM users WHERE username = '$myusername'";
    $result = mysqli_query($db,$sql);
  
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    $count = mysqli_num_rows($result);
  
    
   
    if($count == 1) {
    
      $error1 = "User already Exists";
    }
    elseif($mypassword !== $mypassword2){
      $error1 = "Password Did not match.";
    }
    elseif(!is_numeric($contact) || strlen($contact) != 10){
      $error1 = "Invalid Contact";
    }
    else{
    $sql = "insert into users(fname,lname,username,mail,contact,password)
              values ('$fname','$lname ','$myusername','$mail','$contact','$mypassword')";
          
    $result = mysqli_query($db,$sql);

    $target_dir = "profiles/";
    $target_file = $target_dir . $myusername . '.jpg';
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    

    if ($result) {
      $_SESSION['login_user'] = $myusername;
      header("location: index.php");
    } else {
      header("location: register.php");
    }
    }

    
      
    
   
    $db->close();
  }    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <title>
        Register
    </title>
    <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <style>
      div {
        border-style: rounded;
        border-color: coral;
        border-width: 7px;
      }
    </style>
    <script>
            function submitForm() {
            document.contact-form.submit();
      
            }
        </script>

    <body style = 'background-color:#f0f1f5;'>
        <div class = "container-fluid" >
          <!--<h4 style = "color : white">ERP Management</h4>-->
          <br> <br> <br> 
          <div class = "col-md-12" >
            <div class ="col-md-4">
            </div>
            <div class = "col-md-4" style = "padding-bottom : 25px; padding-top : 10px;  background-color : white">
            <h3><b><center>Register</center></b></h3><br>
            
            <form action = '' method = 'POST' enctype="multipart/form-data">
             
              <div class = 'col-md-12' style = 'padding-left : 0px; padding-right : 0px;'>
                  <div class = 'col-md-6'>
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" name = 'fname' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First name" required>
                     
                      </div>
                  </div>
                  <div class = 'col-md-6'>
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name = 'lname' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Last name" required>
                    
                      </div>
                  </div>
              </div>
              <div class = 'col-md-12' >
              <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" name='username' aria-describedby="emailHelp" placeholder="Select Username" required>
           
              </div>
             </div>
             <div class = 'col-md-12'>
             <div class="form-group">
              <label for="exampleFormControlFile1">Upload Profile photo</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" accept="image/*">
            </div>
          </div>

             <div class = 'col-md-12' style = 'padding-left : 0px; padding-right : 0px'>
                <div class = 'col-md-6'>
                  <div class="form-group">
                      <label for="">Mail Id</label>
                      <input type="email" class="form-control" name='mail' id="" aria-describedby="emailHelp" placeholder="Enter email" required>
                    </div>
                </div>
                <div class = 'col-md-6'>
                  <div class="form-group">
                      <label for="">Contact Number</label>
                      <input type="tel" class="form-control" name='contact' id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter 10-digit contact number" required>
                      
                    </div>
                </div>
            <div class = 'col-md-12' style = 'padding-left : 0px; padding-right : 0px'>
                <div class = 'col-md-6'>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name='password1' id="exampleInputPassword1" placeholder="Enter Password" required>
                     
                      </div>
                </div>
                <div class = 'col-md-6'>
                    <div class="form-group" style = 'padding-bottom : 15px'>
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" name='password2' id="exampleInputPassword1" placeholder="Confirm Password" required>
                      </div>
                </div>
            </div>
            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error1; ?></div>
            </div>
              <!--<div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>-->
              <!--<div class = 'col-md-12' style = 'padding-bottom : 15px;'>
                <a href="#" class="nav navbar-nav navbar-right">Forgot Password?</a><br>
              </div>-->
              <!--<div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div>-->
              <button type="submit" class="btn btn-primary" style = 'width:100%'>Register</button>
              
              <br>
            </form>
            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
            <div class = 'col-md-12'>
              <p><center><br>or Register using</center><p>
            </div>
            <div class = 'col-md-12' >
              <div class = 'col-md-2'>
                
              </div>
              <div class = 'col-md-8'>
               <center> <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                  <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                  <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                </svg></center>
              </div>
              <div class = 'col-md-2' >
                
              </div>
            </div>
           <!-- <div class = 'col-md-12'><br><br>
              <center>Don't have an account? <a href="register" class="">Create</a></center>
            </div>-->
            </div>
          </div>
        </div>

    </body>
</html>