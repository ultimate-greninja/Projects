<?php 

class Feedback {

    private $feedbackId;
    private $rating;
    private $feedback;
    private $userId;

    public function GetFeedbackId() {
        return $this->feedbackId;
    } 

    public function SetFeedbackId($feedbackId) {
        $this->feedbackId = $feedbackId;
    }

    public function GetRating() {
        return $this->rating;
    } 

    public function SetRating($rating) {
        $this->rating = $rating;
    }

    public function GetFeedback() {
        return $this->feedback;
    } 

    public function SetFeedback($feedback) {
        $this->feedback = $feedback;
    }

    public function GetUserId() {
        return $this->userId;
    } 

    public function SetUserId($userId) {
        $this->userId = $userId;
    }

    public function Add() 
    {
        // use the connection
        $pdo = require $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';

        // create the query
        $sql = "INSERT INTO Feedback 
                (feedback, rating, userId) 
                VALUES
                (:feedback, :rating, :userId)";

        // get pdo to prepare the statement for adding the parameters
        $stmt = $pdo->prepare($sql);

        // bind the parameters with the values
        $stmt->bindparam(':rating', $this->rating);
        $stmt->bindparam(':feedback', $this->feedback);
        $stmt->bindparam(':userId', $this->userId);

        // execute the query
        $stmt->execute();

        // return the generated id
        return $pdo->lastInsertId();
    }

    public function Update() 
    {
        // use the connection
        $pdo = require $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';

        // create the query
        $sql = "UPDATE feedback 
                SET rating = :rating,
                    feedback = :feedback
                WHERE userId = :userId";

        // get pdo to prepare the statement for adding the parameters
        $stmt = $pdo->prepare($sql);

        // bind the parameters with the values
        $stmt->bindparam(':rating', $this->rating);
        $stmt->bindparam(':feedback', $this->feedback);
        $stmt->bindparam(':userId', $this->userId);

        // execute the query
        $stmt->execute();
    }

    public function GetAll() 
    {
        // use the connection
        $pdo = require $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';

        // create the query
        $sql = "SELECT feedback.rating, feedback.feedback, users.firstName, users.lastName FROM feedback, users WHERE feedback.userId = users.userId";

        // run the query
        $stmt = $pdo->query($sql);

        // Get all feedback
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetFeedbackByUserId($userId) 
    {
        // use the connection
        $pdo = require $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';

        // create the query
        $sql = "SELECT * FROM feedback WHERE userId = :userId";

        // run the query
        $stmt = $pdo->prepare($sql);

        $stmt->bindparam(":userId", $userId);

        $stmt->execute();

        // Get all feedback
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetFeedbackById($id) 
    {
        // use the connection
        $pdo = require $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';

        // create the query
        $sql = "SELECT * FROM feedback WHERE feedbackId = :id" ;

        // run the query
        $stmt = $pdo->prepare($sql);

        $stmt->bindparam(":id", $id);

        $stmt->execute();

        // Get all feedback
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>