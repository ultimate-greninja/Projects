<?php include "inc/header.php"?>
<?php
if (count($_COOKIE) == 0) {
        header("location:index.php");
    }
?>
<div class="blogs">

    <div class="row">
        <div class="col-12">
            <a href="blog.php?id=-1">Add Blog</a>
        </div>
    </div>

    <div class="row">
        <div class="col-2">Author</div>
        <div class="col-8">Title</div>
        <div class="col-2"></div>
    </div>
    <?php
        require "config/database.php";

        $sql = "SELECT * FROM blogs ORDER BY ReleaseDate DESC LIMIT 10";

        $result = mysqli_query($conn,$sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='row'>
                <div class='col-2'>".
                $row["UserID"]
                ."</div>
                <div class='col-8'>".
                $row["BlogTitle"]
                ."</div>
                <div class='col-2'>
                    <a href='blog.php?id=".$row['BlogID']."'>Update</a>
                    <a href='deleteblog.php?id=".$row['BlogID']."'>Delete</a>
                </div>
            </div>";
          }  
        }
    ?>
</div>

<?php include "inc/footer.php"?>