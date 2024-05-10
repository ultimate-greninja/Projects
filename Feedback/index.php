<?php include 'inc/header.php' ?>

    <?php
        require 'classes/feedback.php';


        $feedback = new Feedback();

        $rows = $feedback->GetAll();

        if ($rows)
        {
            foreach ($rows as $row)
            {
                echo "<div class='card' style='width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title'>".ucfirst($row['firstName']). " " . ucfirst($row['lastName']) ."</h5>
                        <h6 class='card-subtitle mb-2 text-muted'> Rating: ".$row["rating"]." / 10 </h6>
                        <p class='card-text'>".$row["feedback"]."</p>
                    </div>
                </div>";

            }
        }
        else 
        {
            echo "No data Found";
        }
    ?>

<?php include 'inc/footer.php' ?>