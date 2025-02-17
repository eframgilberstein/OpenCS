<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location:index.php");
}
else {
    include "connect.php";
    $username = $_SESSION['username'];
    $query = $db->prepare("SELECT * FROM users WHERE Username=?");
    $query->execute(array($username));
    $control=$query->fetch(PDO::FETCH_ASSOC);
    if($control['Admin'] != 1) {
        header("Location:films.php");
    }

    $Name = $Description = "";
    $errors = array('name'=>'', 'description'=>'');
    $errorflag = 0;

    if(isset($_POST['submit'])){

        if(empty($_POST['Name'])) {
            $errors['name'] = "Name is empty.<br>";
            $errorflag = 1;
        } else {
            $Name = $_POST['Name'];
        }
        if(empty($_POST['Description'])) {
            $errors['description'] = "Description is empty.<br>";
            $errorflag = 1;
        } else {
            $Description = $_POST['Description'];
        }

        if($errorflag == 1){
            echo "Errors in Form";
        } else {
           $Name = mysqli_real_escape_string($conn, $_POST['Name']);
           $Description = mysqli_real_escape_string($conn, $_POST['Description']);
           $sql = "INSERT into films (name, description) VALUES ('$Name', '$Description')";
            if(mysqli_query($conn, $sql)) {
                header("Location:admin.php");
            } else {
                echo 'Query Error'.mysqli_error($conn);
            }
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
        <h4>
        Welcome <?php echo $_SESSION['username']; ?><br>
        Add a New Film<br>
        <a href="logout.php">Logout Here</a><br></h4>
</div>
<div>
<form action="add.php" method="POST">

<label>Film Name</label>
<input type="text" name="Name" value="<?php echo htmlspecialchars($Name); ?>"><br>
<?php echo $errors['name']; ?><br>

<label>Description</label>
<input type="text" name="Description" value="<?php echo htmlspecialchars($Description); ?>"><br>
<?php echo $errors['description']; ?><br>

<input type="submit" value="submit" name="submit">
</form>
</div>
</body>
</html>