<?php include 'inc/header.php' ?>

<div class="feedback">
    <div class="row">
        <div class="col-12">
            <a href="feedback.php?id=-1">Add Feedback</a>
        </div>
    </div>
    <div class="row">
        <div class="col-8"><strong>Feedback</strong></div>
        <div class="col-2"><strong>Rating</strong></div>
        <div class="col-2"></div>
    </div>
    <?php 
        require 'classes/feedback.php';


        $feedback = new Feedback();

        $rows = $feedback->GetFeedbackByUserID($data[0]['userId']);

        if ($rows)
        {
            foreach ($rows as $row)
            {
                echo "<div class='row'>
                        <div class='col-8'>" .
                            $row["feedback"]   
                    .   "</div>
                        <div class='col-2'>" .
                            $row["rating"] . " / 10"
                    .   "</div>
                        <div class='col-2'>
                            <a href='feedback.php?id=" . $row['feedbackId'] . "'>Update</a>
                            <a href='deleteFeedback.php?id=" . $row['feedbackId'] . "'>Delete</a>
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