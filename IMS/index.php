<?php include "inc/header.php"?>

<?php
    require "config/database.php";

    $start = 0;
    $page = 1;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $start = $page-1 * 10;
    }?>
<div class="row">
    <div class="col-1">ID</div>
    <div class="col-2">Item Name</div>
    <div class="col-2">Amount</div>
    <div class="col-2">Type</div>
    <div class="col-2">find code</div>
    <div class="col-2">Price</div>
    <div class="col-1">Image</div>
</div>
    <?php
    $sql = "SELECT * FROM inventory ORDER BY itemName LIMIT 10 offset $start";

    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){
            echo "<div class='row'>
                <div class='col-1'>".
                $row["itemID"]
                ."</div>
                <div class='col-2'>".
                $row["itemName"]
                ."</div>
                <div class='col-2'>".
                $row["itemAmount"]
                ."</div>
                <div class='col-2'>".
                $row["itemType"]
                ."</div>
                <div class='col-2'>".
                $row["locationCode"]
                ."</div>
                <div class='col-2'>£".
                number_format($row["itemPrice"],2)
                ."</div>
                <div class='col-1'>
                    <img width = 80 height = 80 src = ".$row["ImageLink"].">    
                </div>
                </div>";
            }
        }
?>

<?php include "inc/footer.php"?>