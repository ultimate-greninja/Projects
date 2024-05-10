<?php
    require "config/database.php";

    if (count($_COOKIE) == 0) {
        header("location:index.php");
    }

    $id="";$title="";$content="";

    if($_GET["id"]=="-1")
    {
        //add
        $id ="-1";
    }
    else
    {
        //edit
        $id = $_GET["id"];
        $sql = "SELECT * FROM blogs WHERE blogID = $id";
        
        $result = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($result)){
            $title = $row["BlogTitle"];
            $content = $row["BlogContent"];
            $image_link = $row["ImageLink"];
        }
    }

    // when page loads
    if(ISSET($_POST["btnSave"]))
    {
        $blogTitle = $_POST["txtBlogTitle"];
        $blogContent = $_POST["txtBlogContent"];
        $userID = 1;
        $releaseDate = date("Y-m-d");
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
            $sql="INSERT INTO blogs(BlogTitle,BlogContent,ReleaseDate,ImageLink,UserID)
                VALUES ('$blogTitle','$blogContent','$releaseDate','$image_link',$userID)";
            $result = mysqli_query($conn,$sql);
            header("location:blogs.php");
        }
        else
        {
            //edit

            $sql= "UPDATE blogs
            SET BlogTitle = '$blogTitle',
            BlogContent = '$blogContent',
            ImageLink = '$image_link'
            WHERE BlogID = $id";
            $result = mysqli_query($conn,$sql);
            header("location:blogs.php");
        }
    }
?>

<?php include "inc/header.php"?>

<form action = "" method="POST" enctype="multipart/form-data">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Blog ID</span>
        <input type="text" class="form-control" placeholder="BlogID" aria-label="blogID" aria-describedby="basic-addon1" name = "BlogID" required disabled value="<?php echo $id;?>">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Blog Title</span>
        <input type="text" class="form-control" placeholder="BlogTitle" aria-label="blogTitle" aria-describedby="basic-addon1" name = "txtBlogTitle" required value="<?php echo $title;?>" >
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Blog Content</span>
        <textarea class="form-control" name= "txtBlogContent" style="height:500px; width:100%;" ><?php echo $content;?></textarea>
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Image</span>
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
    </div>

    <div>
    <input type = "submit" class = "btn btn-primary" value = "Save" name = "btnSave"/>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</form>

<?php include "inc/footer.php"?>