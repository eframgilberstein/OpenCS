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
	    echo "<a href=\"booking.php?ID=".$row['ID']."\">Book Here</a>";
            echo "</td></tr>";
        }
        echo "</table>";
        ?>
        <a href="admin.php">Admin Page</a><br>
	<a href="food.php">Food Page</a>


    </div>

</body>
</html>