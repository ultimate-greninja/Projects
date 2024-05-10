<?php
    require "config/database.php";

    if (count($_COOKIE) == 0) {
        header("location:index.php");
    }

    $id="";$name="";$amount="";$type="";$locationcode="";$price="";$image_link="";

    if($_GET["id"]=="-1")
    {
        //add
        $id ="-1";
    }
    else
    {
        //edit
        $id = $_GET["id"];
        $sql = "SELECT * FROM inventory WHERE itemID = $id";
        
        $result = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($result)){
            $name = $row["itemName"];
            $amount = $row["itemAmount"];
            $type = $row["itemType"];
            $locationcode = $row["locationCode"];
            $price = $row["itemPrice"];
            $image_link = $row["ImageLink"];
        }
    }

    // when page loads
    if(ISSET($_POST["btnSave"]))
    {
        $nametxt = $_POST["itemNametxt"];
        $amounttxt = $_POST["itemAmounttxt"];
        $typetxt = $_POST["itemTypetxt"];
        $locationcodetxt = $_POST["locationCodetxt"];
        $pricetxt = $_POST["itemPricetxt"];
        $userID = 1;
        // img
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        echo $target_file;
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

            $image_link = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }
// img
        if($_GET["id"]=="-1")
        {
            //add
            $id ="-1";
            $sql="INSERT INTO inventory(itemName,itemAmount,itemType,locationCode,itemPrice,ImageLink,UserID)
                VALUES ('$nametxt','$amounttxt','$typetxt','$locationcodetxt','$pricetxt','$image_link',$userID)";
            $result = mysqli_query($conn,$sql);
            header("location:inventory.php");
        }
        else
        {
            //edit

            $sql= "UPDATE inventory
            SET itemName = '$nametxt',
            itemAmount = '$amounttxt',
            itemType = '$typetxt',
            locationCode = '$locationcodetxt',
            itemPrice = '$pricetxt',
            ImageLink = '$image_link'
            WHERE itemID = $id";
            $result = mysqli_query($conn,$sql);
            header("location:inventory.php");
        }
    }
?>

<?php include "inc/header.php"?>

<form action = "" method="POST" enctype="multipart/form-data">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">User ID</span>
        <input type="text" class="form-control" placeholder="UserID" aria-label="userID" aria-describedby="basic-addon1" name = "UserID" required disabled value="<?php echo $id;?>">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Item Name</span>
        <input type="text" class="form-control" placeholder="Item Name" aria-label="itemName" aria-describedby="basic-addon1" name = "itemNametxt" required value="<?php echo $name;?>" >
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Amount</span>
        <input type="text" class="form-control" placeholder="Item Amount" aria-label="itemAmount" aria-describedby="basic-addon1" name = "itemAmounttxt" required value="<?php echo $amount;?>" >
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Type</span>
        <input type="text" class="form-control" placeholder="Item Type" aria-label="itemType" aria-describedby="basic-addon1" name = "itemTypetxt" required value="<?php echo $type;?>" >
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Location Code</span>
        <input type="text" class="form-control" placeholder="Location Code" aria-label="LocationCode" aria-describedby="basic-addon1" name = "locationCodetxt" required value="<?php echo $locationcode;?>" >
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Price</span>
        <input type="text" class="form-control" placeholder="Item Price" aria-label="itemPrice" aria-describedby="basic-addon1" name = "itemPricetxt" required value="<?php echo $price;?>" >
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Image</span>
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
    </div>

    <div>
    <input type = "submit" class = "btn btn-primary" value = "Save" name = "btnSave"/>
    </div>
</form>

<?php include "inc/footer.php"?>




<!-- 
$type = $row["itemType"];
            $locationcode = $row["locationCode"];
            $price = $row["itemPrice"]; -->