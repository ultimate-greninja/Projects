<?php include "inc/header.php"?>

<?php
    require "config/database.php";

    $start = 0;
    $page = 1;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $start = $page-1 * 10;
    }

    $sql = "SELECT * FROM blogs ORDER BY RealeaseDate DESC LIMIT 10 offset $start";

    $result = mysqli_query($conn,$sql);

    while ($row = mysqli_fetch_assoc($result)){
        var_dump($row);
    }
?>

<?php include "inc/footer.php"?>