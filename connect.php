<?php

$conn = mysqli_connect('localhost', 'admin', 'admin123', 'cinema');

//prepared data objects
try {
    $db = new PDO("mysql:host=localhost;dbname=cinema;charset=utf8","admin", "admin123");

} catch (PDOException $e){
        echo $e->getMessage();
}
?>