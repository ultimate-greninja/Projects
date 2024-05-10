<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/mystyles.css">
  </head>
  <body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
    <a class="navbar-brand" href="#">Feedback</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
        </ul>
       
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (isset($_COOKIE['is_logged_in'])) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">


                    <?php
                        require 'classes/users.php';

                        $users = new Users();

                        $data = $users->FilterByEmail($_COOKIE['email']);
                        
                        echo ucfirst($data[0]["firstName"]) . " " . ucfirst($data[0]["lastName"]);
                    ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="feedbackData.php">Feedback</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="register.php">Register</a>
            </li>
        <?php } ?>
        </ul>
        
            
    </div>
</div>
</nav>

<div class="container mt-3">