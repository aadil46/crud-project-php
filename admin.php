<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
    <?php
    SESSION_START();
if (isset($_REQUEST['Add'])) {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $qualification = $_REQUEST['qual'];
    $mobile = $_REQUEST['num'];
    $conn = mysqli_connect("localhost", "root", "", "Practice");
    if (!$conn) {
        die("connect failed");
    }
    {
        $sql = "Insert into teacher (name,email,qualification,mobile)values('$name','$email','$qualification','$mobile')";
        if (mysqli_query($conn, $sql) === true) {
            echo "values inserted";
        }else
        {
            echo "values not inserted";
        }
    }
    mysqli_close($conn);
}
if(isset($_REQUEST['update']))
{
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $qualification = $_REQUEST['qual'];
  $mobile = $_REQUEST['num'];
  $id = $_REQUEST['id'];
  $conn=mysqli_connect("localhost", "root", "", "Practice");
  if(!$conn){
    die("connection failed");
  }
  else{
    $sql="update Teacher set name='$name',email='$email',qualification='$qualification',mobile='$mobile' where id='$id'";
    $result=mysqli_query($conn,$sql);
    if(!$result) {
      die("Connection failed");
    } 
    else{
      echo'<script> alert("value updated");</script>';
    }
  }
}
if(isset($_REQUEST['Delete']))
{
  $id = $_REQUEST['id'];
  $conn=mysqli_connect("localhost", "root", "", "Practice");
  if(!$conn){
    die("connection failed");
  }
  else{
    $sql="delete from Teacher where id='$id'";
    $result=mysqli_query($conn,$sql);
    if(!$result) {
      die("Connection failed");
    } 
    else{
      echo'<script> alert("value deleted");</script>';
    }
  }
}
if(isset($_SESSION['email']))
{
  echo "<script> alert('welcome'); </script>";
}
else{
  header('location:Login.php');
}
if(isset($_REQUEST['logout'])){
  session_unset();
  session_destroy();
  header('location:Login.php');
}
?>
    <style>
     *{margin:0; padding:0;}
      .Add{
          position:relative;
          float:left;
          width:30%;
          height:45%;
          left:30px;
      }
      .edit{
          float:right;
          width:40%;
          position:relative;
          height:45%;
          right:90px;
      }
    </style>
</head>
<body>
    <form> <input type="submit" name="logout" value="LogOut"></form>
    <div class="Add">
    <form action="" method="post">
     <fieldset>
     <legend>Add Teacher </legend>
  <div class="form-group">
    <label for="Name">Teacher Name:</label>
    <input type="text" class="form-control" id="Name" name="name">
  </div>
  <div class="form-group">
    <label for="email">Teacher Email:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="Qual">Teacher Qualification:</label>
    <input type="text" class="form-control" id="Qual" name="qual">
  </div>
  <div class="form-group">
    <label for="num">Teacher Mobile:</label>
    <input type="text" class="form-control" id="num" name="num">
  </div>

  <button type="submit" class="btn btn-primary " name="Add">Add</button>
  </fieldset>
</form>
</div>
<?php
       if(isset($_REQUEST['Edit']))
       {
        $id = $_REQUEST['id'];
        $conn=mysqli_connect("localhost", "root", "", "Practice");
         if(!$conn){
           die("connection failed");
         }
         else{
           $sql="select * from Teacher  where id='$id'"; 
           $result=mysqli_query($conn,$sql); 
           if(!$result)
           {
              die("failed") ;  
           }
           else{
             while($res=mysqli_fetch_assoc($result)){          
?>
 
    <div class="edit">
    <form action="" method="post">
     <fieldset>
     <legend>Edit Teacher info </legend>
  <div class="form-group">
    <label for="Name">Teacher Name:</label>
    <input type="text" class="form-control" id="Name" name="name" value="<?php echo $res['name']; ?>">
  </div>
  <div class="form-group">
    <label for="email">Teacher Email:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $res['email']; ?>">
  </div>
  <div class="form-group">
    <label for="Qual">Teacher Qualification:</label>
    <input type="text" class="form-control" id="Qual" name="qual" value="<?php echo $res['qualification']; ?>">
  </div>
  <div class="form-group">
    <label for="num">Teacher Mobile:</label>
    <input type="text" class="form-control" id="num" name="num" value="<?php echo $res['mobile']; ?>">
  </div>
  <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
  <button type="submit" class="btn btn-success" name="update">Update</button>
  </fieldset>
</form>
            
    </div>
    <?php }}}} ?>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Qualification</th>
        <th>Mobile</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $conn=mysqli_connect("localhost","root","","Practice");
        if(!$conn){
          die("connection failed");
        }
        else{
        $sql="Select * from Teacher";
        $result=mysqli_query($conn,$sql);
        if(!$result){
          die("records not displayed ");
        }
        else{
             while($res=mysqli_fetch_assoc($result)){
        ?>
      <tr>
         <td><?php echo $res['id']; ?></td>
         <td><?php echo $res['name']; ?></td>
         <td><?php echo $res['email']; ?></td>
         <td><?php echo $res['qualification']; ?></td>
         <td><?php echo $res['mobile']; ?></td>
         <td><form method="post" action="" class="form-group"><input type="hidden" name="id" value="<?php echo $res['id']; ?>" >
          <button type="submit" class="btn btn-primary " name="Edit">Edit</button></form></td>
         <td><form method="post" action=""  class="form-group"><input type="hidden" name="id" value="<?php echo $res['id']; ?>">
         <input type="submit" name="Delete" class="btn btn-success " value="Delete"></form></td>
      </tr>
             <?php } 
            } 
            } ?>  
    </tbody>
  </table>

</body>
</html>
