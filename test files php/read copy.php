<?php
$idea = readfile("ideas.txt");
echo $idea;
$myfile = fopen("transferText.txt", "w");
fwrite($myfile, $idea);
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
    <script  src="scripts/transferidea.js">
        let transfer = <?php $idea?>
    </script>
</body>
</html>