<?php session_start();
include "connect.php";
if(isset($_POST['login'])) {
    if($_POST["username"] == "" or $_POST["password"] == "") {
        echo "<center><h1>Username and Password are required</h1></center>";
    } 
    else {
      $username = strip_tags(trim($_POST['username']));  
      $password = strip_tags(trim($_POST['password']));
      $hash = MD5($password);
      $query=$db->prepare("SELECT * FROM users WHERE Username=?");
      $query->execute(array($username));
      $control=$query->fetch(PDO::FETCH_ASSOC);
      if($control>0 && ($hash == $control['Password'])) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location:films.php");
      }
      else {
            echo "<center><h1>Incorrect User or Pass</h1></center>";
      }
    }

}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Projection Room</title>
</head>
<body>
    <div>
        <form method="POST" action="index.php">
            <p>
                <label>Username</label>
                <input name="username" type="text">
            </p>
            <p>
                <label>Password</label>
                <input name="password" type="password">
            </p>
            <button type="submit" name="login">Login</button>
        </form>
        <br><a href="register.php">Register Here</a>
    </div>  

</body>
</html>


