<?php include 'inc/header.php' ?>

<?php
if (!isset($_GET['id'])) {
    header("Location:feedbackData.php");
}
require 'classes/feedback.php';
$id = "";
$rating = "";
$feedbackText = "";
$userId = $data[0]['userId'];


if($_GET['id'] == -1) {
    $id = -1;
} else {
    $id = $_GET['id'];

    $feedback = new Feedback();

    $rows = $feedback->GetFeedbackById($id);

    foreach($rows as $row) {
        $rating = $row['rating'];
        $feedbackText = $row['feedback'];
    }
}

if(isset($_POST['btnSave'])) 
{
    if($_GET['id'] == -1) {
        

        $feedback = new Feedback();

        $feedback->SetFeedback($_POST['txtFeedback']);
        $feedback->SetRating($_POST['txtRating']);
        $feedback->SetUserId($_POST['txtUserId']);

        try {
            $primaryKey = $feedback->Add();
        } catch (Exception $ex) {
            echo "Error Occurred. Failed to Add Feedback";
        }

    } else {
        $feedback = new Feedback();

        $feedback->SetFeedback($_POST['txtFeedback']);
        $feedback->SetRating($_POST['txtRating']);
        $feedback->SetUserId($_POST['txtUserId']);

        try {
            $feedback->Update();
        } catch (Exception $ex) {
            echo "Error Occurred. Failed to Update Feedback";
        }
    }
}

?>



<form action="" method="POST" enctype="multipart/form-data" class="w-50 mx-auto">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">ID</span>
        <input type="text" class="form-control" placeholder="ID" aria-label="Id" aria-describedby="basic-addon1" name="txtId" required disabled value="<?php echo $id; ?>">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Rating</span>
        <input type="text" class="form-control" placeholder="Rating (0-10)" aria-label="rating" aria-describedby="basic-addon1" name="txtRating" required value="<?php echo $rating; ?>">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Feedback</span>
        <textarea type="text" class="form-control" name="txtFeedback" id="txtFeedback" style="height:200px;"><?php echo $feedbackText ?></textarea>
    </div>

    <div class="input-group mb-3 hidden">
        <span class="input-group-text" id="basic-addon1">UserId</span>
        <input type="text" class="form-control" placeholder="UserId" aria-label="userIUd" aria-describedby="basic-addon1" name="txtUserId" required value="<?php echo $userId ?>">
    </div>

    <div>
        <input type="submit" class="btn btn-primary" value="Save" name="btnSave"/>
    </div>
</form>

<?php include 'inc/footer.php' ?>