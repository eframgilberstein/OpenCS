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
}

?>

<DOCTYPE html>
<html>
<head>
<title>Projection Room</title>
<style>
table, th, td {
    margin: auto;
    border: 1px solid black;
    border-spacing: 5px;
}
</style>
</head>
<body>
    <div>
        <h4>
            Welcome <?php echo $_SESSION['username']; ?><br>
            Login Success!<br>
            <a href="logout.php">Logout Here</a><br></h4>
    </div>
    <div>
        <?php include 'connect.php';
        $query = $db->query("SELECT * FROM films");
        echo "<table>";
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>";
            echo $row['name'];
            echo "</td><td>";
            echo $row['description'];
            echo "</td><td>";
            echo "<a href=\"delete.php?ID=".$row['ID']."\">Delete</a>";
            echo "</td><td>";
            echo "<a href=\"update.php?ID=".$row['ID']."\">Update</a>";
            echo "</td></tr>";
        }
        echo "</table>";

        ?>

        <a href="add.php">Add new film</a>
        <a href="view_bookings.php">View Bookings</a>
        


    </div>

</body>
</html>

