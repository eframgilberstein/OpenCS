<?php

session_start();

if(isset($_SESSION["username"])) {
    header("Location:films.php");
}
include('connect.php');
$usename = $password = $email = '';
$admin = 0;
$errors = array('usename'=>'', 'password'=>'', 'email'=>'');

if (isset($_POST['submit'])) {
    //echo htmlspecialchars($_POST['usename']);
    //echo htmlspecialchars($_POST['password']);
    //echo htmlspecialchars($_POST['email']);

    if(empty($_POST['email'])) {
        $errors['email'] = "Email is Empty<br>";
    } else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email is not valid.<br>";
        }
    }

    if(empty($_POST['usename'])) {
        $errors['usename'] = "Username is Empty<br>";
    }
    if(empty($_POST['password'])) {
        $errors['password'] = "Password is Empty<br>";
    }

    if(array_filter($errors)) {
        echo "ERRORS in FORM";
    } else {
        $usename = mysqli_real_escape_string($conn, $_POST['usename']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashed_password = MD5($password);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $sql = "INSERT into users (Username, Password, Email, Admin) VALUES ('$usename', '$hashed_password', '$email', '$admin')";
        //put in database
        if(mysqli_query($conn, $sql)) {
            session_start();
            $_SESSION['username'] = $usename;
            header('Location: films.php');
        } else {
            echo 'Error'.mysqli_error($conn);
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
<h3>Register Here</h3>
<form action="register.php" method="POST">
<label>Username:</label>
<input type="text" name="usename"><br>
<label>Password:</label>
<input type="password" name="password"><br>
<label>Email:</label>
<input type="text" name="email"><br>
<input type="submit" name="submit" value="submit">
</form>
</body>
</html>