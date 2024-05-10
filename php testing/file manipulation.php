<?php
$myfile = fopen("ideas.txt", "r") or die("Unable to open file!");

$data = fread($myfile,filesize("ideas.txt"));

fclose($myfile);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id = "data" hidden><?php echo $data?></div>
</body>
</html>

<!-- prints line by line PHP below-->
<?php
    // $myfile = fopen("ideas.txt", "r") or die("Unable to open file!");
    // while (!feof($myfile)) {
    //     echo fgets($myfile) . "<br>"; 
    // }
    // fclose($myfile);
    ?>
    <!-- prints line by line  PHP above-->