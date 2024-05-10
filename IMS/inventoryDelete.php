<?php
if (count($_COOKIE) == 0) {
    header("location:login.php");
}
require "config/database.php";
$id = $_GET["id"];
$sql = "DELETE FROM inventory
        WHERE itemID = $id";
mysqli_query($conn,$sql);
header("location:inventory.php");
?>