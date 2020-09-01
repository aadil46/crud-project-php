<?php
SESSION_START();
if (isset($_REQUEST['login'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $conn = mysqli_connect("localhost", "root", "", "Practice");
    
    if (mysqli_connect_error($conn)===True){
        echo "Connection falied";
    } else {
        $sql = "Select * from login where email='$email' and password='$password'";
        $result = mysqli_query($conn, $sql);
        if($result===false){
            echo "login failed";
        }
        else{
            $_SESSION["email"]="welcome";
            header("location:admin.php"); 
           
            echo '<script>alert("login success")</script>';
        }    
    }
    mysqli_close($conn);
}
if(isset($_SESSION["email"])===true){
  header("location:admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html,body{
            width:100%;
            height:100%;
        }
        body{
            background-image: url("image/office.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;

        }
        .form{
            position:relative;
            width:45%;
            height:50%;
            top:40%;
            left:25%;
            border:2px solid red;
            box-sizing: border-box;
            background-color:red;
        }
        .form form{
            display:flex;
            flex-direction:column;
            justify-content:space-around;
        }
        .form form h1{
            margin-left:240px;
            margin-bottom:20px;
        }
        .form form label{
            display:inline-block;
            float:left;
            margin-left:165px;
            color:white;
            font-size:20px;
            font-weight:bold;
        }
        .form form input[type="email"]
        {
            width:40%;
            margin-left:165px;
            margin-bottom:10px;
            line-height:1.5;
            padding:5px 10px 5px 10px;
        }
        .form form input[type="password"]
        {
            width:40%;
            margin-left:165px;
            margin-bottom:10px;
            line-height:1.5;
            padding:5px 10px 5px 10px;
        }
        .form form input[type="submit"]{
            width:30%;
            margin-left:195px;
            margin-top:20px;
            padding:5px 10px 5px 10px;
            font-weight:bold;

        }
     </style>
</head>
<body>
    <div class="form">
       <form method="post" action="">
           <h1> Login </h1>
           <label>Email:</label>
           <input type="email" name="email" placeholder="email" required="required">
           <label>Password:</label>
           <input type="password" name="password" placeholder="password" required="required">
           <input type="submit" value="login" name="login">

        </form>
    </div>
</body>
</html>
