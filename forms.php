<?php
    include("config.php");
    session_start();
    function login(){
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form 
            
            $myusername = mysqli_real_escape_string($db,$_POST['username']);
            $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
            
            $sql = "SELECT username FROM users WHERE username = '$myusername' and password = '$mypassword'";
            $result = mysqli_query($db,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $active = $row['active'];
            $count = mysqli_num_rows($result);
            
            // If result matched $myusername and $mypassword, table row must be 1 row
            echo $count;
            if($count == 1) {
               //session_is_registered("myusername");
               $_SESSION['login_user'] = $myusername;
               
               header("location: AddBlog.php");
            }else {
               $error = "Your Login Name or Password is invalid";
            }
         }
    }
?>