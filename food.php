<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location:index.php");
}

if(isset($_POST['submit'])) {
    include 'connect.php';
    $foodid = mysqli_real_escape_string($conn, $_POST['foodid']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $sql = "INSERT into basket (foodid, quantity) VALUES ('$foodid', '$quantity')";


    //enter the data
    if(mysqli_query($conn, $sql)) {
            header("Location:basket.php");
        } else {
            echo 'Query Error'.mysqli_error($conn);
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
        $query = $db->query("SELECT * FROM food");
        echo "<table>";
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>";
            echo $row['Name'];
            echo "</td><td>";
            echo $row['Description'];
            echo "</td><td>";
            echo $row['Price'];
            echo "</td><td>";
            echo "<form action=\"food.php\" method=\"POST\">";
            echo "Select Quantity:<br>"; 
            echo "<select name=\"quantity\" id=\"quantity\">
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
        </select>";
        echo "<input type=\"hidden\" name=\"foodid\" value=\"".$row['ID']."\">";
        echo "</td><td>";
        echo "<input type=\"submit\" value=\"Add\" name=\"submit\">";
        echo "</form>";
        }
          ?>
        </table>
        <a href="admin.php">Admin Page</a><br>
        <a href="basket.php">View Basket</a><br>

    </div>

</body>
</html>