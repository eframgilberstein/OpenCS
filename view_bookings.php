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
        
        echo "<table>";
        echo "<tr><td>";
        echo "Booking ID";
        echo "</td><td>";
        echo "Film Name";
        echo "</td><td>";
        echo "Customer Name";
        echo "</td><td>";
        echo "No. of Tickets";
        echo "</td></tr>";
        
        $query = $db->query("SELECT * FROM bookings");
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $query2 = $db->prepare("SELECT * FROM users WHERE ID=?");
            $query2->execute(array($row['userid']));
            $user=$query2->fetch(PDO::FETCH_ASSOC);

            $query3 = $db->prepare("SELECT * FROM films WHERE ID=?");
            $query3->execute(array($row['filmid']));
            $film=$query3->fetch(PDO::FETCH_ASSOC);
            
            echo "<tr><td>";
            echo $row['ID'];
            echo "</td><td>";
            echo $film['name'];
            echo "</td><td>";
            echo $user['Username'];
            echo "</td><td>";
            echo $row['tickets'];
            echo "</td></tr>";
        }
        echo "</table>";

        ?>

        <a href="add.php">Add new film</a><br>
        <a href="view_bookings.php">View Bookings</a>
        


    </div>

</body>
</html>

