<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location:index.php");
}
?>

<DOCTYPE html>
<html>
<head>
<title>Projection Room</title>
</head>
<body>
    <div>
        <h1>
            Welcome <?php echo $_SESSION['username']; ?><br>
            Login Success!<br>
            <a href="logout.php">Logout Here</a><br>
            <a href="films.php">List Films</a>
    </div>

</body>
</html>





