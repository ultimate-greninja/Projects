<?php include "inc/header.php"?>
<?php
if (count($_COOKIE) == 0) {
        header("location:index.php");
    }
?>
<div class="inventory">

<div class="row">
    <div class="col-12">
        <a href="inventoryAddAlter.php?id=-1">Add Item</a>
    </div>
</div>

<div class="row">
    <div class="col-1">ID</div>
    <div class="col-2">Item Name</div>
    <div class="col-2">Amount</div>
    <div class="col-2">Type</div>
    <div class="col-2">find code</div>
    <div class="col-2">Price</div>
    <div class="col-1"></div>
</div>
<?php
    require "config/database.php";

    $sql = "SELECT * FROM inventory ORDER BY itemName LIMIT 10";

    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
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
                <a href='inventoryAddAlter.php?id=".$row['itemID']."'>Update</a>
                <a href='inventoryDelete.php?id=".$row['itemID']."'>Delete</a>
            </div>
        </div>";
      }  
    }
?>
</div>
<?php include "inc/footer.php"?>