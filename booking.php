<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location:login.php");
}
else {
    include "connect.php";
    $username = $_SESSION['username'];
    $query=$db->prepare("SELECT * FROM users WHERE Username=?");
    $query->execute(array($username));
    $control=$query->fetch(PDO::FETCH_ASSOC);
    $userid = $control['ID'];
    echo $userid;

    $ID = $_GET['ID'];
    $query=$db->prepare("SELECT * FROM films WHERE ID=?");
    $query->execute(array($ID));
    $film=$query->fetch(PDO::FETCH_ASSOC);
    $filmid = $film['ID']; 
    echo $filmid;   
    
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
    border-spacing: 2px;
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
        <?php
        echo "<table>";
        echo "<tr><td>";
        echo $film['name'];
        echo "</td><td>";
        echo $film['description'];
        echo "</td><td>
        <form action=\"booking2.php\" action = \"POST\">";
        echo "No. Of Tickets:";
        echo "<select name=\"tickets\" id=\"tickets\">
        <option value=1>1</option>
        <option value=2>2</option>
        <option value=3>3</option>
        <option value=4>4</option>
        <option value=5>5</option>
        </select>";
        echo "<input type=\"hidden\" id=\"userid\" name=\"userid\" value=\"".$userid."\">";
        echo "<input type=\"hidden\" id=\"filmid\" name=\"filmid\" value=\"".$filmid."\">";
        echo "<br><br>";
        echo "<input type=\"submit\" value=\"submit\" name=\"submit\">";
        echo "</td></tr>";
        echo "</table>";
        echo "</form>";
        ?>
        <a href="admin.php">Admin Page</a>


    </div>

</body>
</html>