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
    $errors = array('Name'=>'', 'Description'=>'');
    $errorflag = 0;

    if((!isset($_GET['ID'])) && (!isset($_POST['ID']))) {
        header("location:admin.php");
    } else if (isset($_GET['ID'])) {
        $ID = $_GET['ID'];
        $query=$db->prepare("SELECT * FROM films WHERE ID=?");
        $query->execute(array($ID));
        $control=$query->fetch(PDO::FETCH_ASSOC);
        $Name = $control['name'];
        $Description = $control['description'];
    }

    if(isset($_POST['submit'])) {

        $ID = $_POST['ID'];

        if(empty($_POST['Name'])) {
            $errors['Name'] = "Name is empty.<br>";
            $errorflag = 1;
        }

        if(empty($_POST['Description'])) {
            $errors['Description'] = "Description is empty.<br>";
            $errorflag = 1;
        }

        if($errorflag == 1) {
            echo "Errors in Form";
        } else {
            $Name = mysqli_real_escape_string($conn, $_POST['Name']);
            $Description = mysqli_real_escape_string($conn, $_POST['Description']);
            $sql = "UPDATE films SET Name = '$Name', Description = '$Description' WHERE ID = '$ID'";

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
            Update Record Here<br>
            <a href="logout.php">Logout Here</a><br></h4>
</div>
<div>
        <form action = "update.php" method = "POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <label>Film Name:</label>
            <input type="text" name="Name" value="<?php echo htmlspecialchars($Name);?>"><br>
            <div><?php echo $errors['Name']; ?></div>
            <label>Film Description:</label>
            <input type="text" name="Description" value="<?php echo htmlspecialchars($Description);?>"><br>
            <div><?php echo $errors['Description']; ?></div>
            <input type="submit" name="submit" value="Submit">
        </form>

</div>
</body>
</html>