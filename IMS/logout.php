<?php
    setcookie("is_logged_in",false,time()-3600);
    setcookie("email","",time()-3600);

    header("location:index.php");
?>