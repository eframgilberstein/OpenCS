<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location:login.php");
} else {
    include "connect.php";
   
    if(isset($_GET['submit'])) {
        //do stuff
        $filmid = $_GET['filmid'];
        $userid = $_GET['userid'];
        $tickets = $_GET['tickets'];

        $sql = "INSERT into bookings (filmid, userid, tickets) VALUES ('$filmid', '$userid', '$tickets')";

        if(mysqli_query($conn, $sql)) {
                echo "Booking Success<br>";
                $query=$db->prepare("SELECT * from films WHERE ID=?");
                $query->execute(array($filmid));
                $bookfilm=$query->fetch(PDO::FETCH_ASSOC);
                $filmname = $bookfilm['name'];
                echo "You have booked ".$tickets." tickets for ".$filmname.".<br>";
                $cost = $tickets * 4.99;
                echo "The cost is £".$cost;
            } else {
            echo 'Query Error'.mysqli_error($conn);
        }

    } else {
        header("location:films.php");
    }
}   
?>


<!DOCTYPE html>
<html>
<head>
<title>Projection Room</title>
</head>
<body>
<div><h4>Hello <?php echo $_SESSION['username']; ?><br>
        <a href="logout.php">Logout Here</a></h4>
</div>
</body>
</html>