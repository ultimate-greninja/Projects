<?php
class Users 
{
    // private properties
    private $userId;
    private $firstName;
    private $lastName;
    private $email;
    private $pass;

    // public methods

    // User Id GETTER
    public function getUserId() 
    {
        return $this->userId;
    }
    
    // User Id SETTER
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    // First Name GETTER
    public function getFirstName() 
    {
        return $this->firstName;
    }
    // First Name SETTER
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    // Last Name GETTER
    public function getLastName() 
    {
        return $this->lastName;
    }
    // Last Name SETTER
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    // Email GETTER
    public function getEmail() 
    {
        return $this->email;
    }
    // Email SETTER
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Password GETTER
    public function getPass() 
    {
        return $this->pass;
    }
    // Password SETTER
    public function setPass($pass)
    {
        $this->pass = password_hash($pass, CRYPT_BLOWFISH);
    }

    public function Add() 
    {
        // use the connection
        $pdo = require $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';

        // create the query
        $sql = "INSERT INTO Users 
                (firstName, lastName, email, passwordText) 
                VALUES
                (:firstName, :lastName, :email, :passwordText)";

        // get pdo to prepare the statement for adding the parameters
        $stmt = $pdo->prepare($sql);

        // bind the parameters with the values
        $stmt->bindparam(':firstName', $this->firstName);
        $stmt->bindparam(':lastName', $this->lastName);
        $stmt->bindparam(':email', $this->email);
        $stmt->bindparam(':passwordText', $this->pass);


        try {
            // execute the query
            $stmt->execute();

            // return the generated id
            return $pdo->lastInsertId();
        } catch (Exception $ex) {
            echo "Error Occurred." . $ex;
        }
        
    }

    public function Update() 
    {
        // use the connection
        $pdo = require $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';
        
        // create the query
        $sql = "UPDATE Users 
                SET firstName = :firstName,
                    lastName = :lastName,
                    email = :email,
                    passwordText = :passwordText
                WHERE userId = :userId";

        // get pdo to prepare the statement for adding the parameters
        $stmt = $pdo->prepare($sql);

        // bind the parameters with the values
        $stmt->bindparam(':firstName', $this->firstName);
        $stmt->bindparam(':lastName', $this->lastName);
        $stmt->bindparam(':email', $this->email);
        $stmt->bindparam(':passwordText', $this->pass);
        $stmt->bindparam(':userId', $this->userId);
        
        // execute the query
        $stmt->execute();
    }

    public function Delete($id) 
    {
        // use the connection
        $pdo = require $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';
        
        // create the query
        $sql = "DELETE * FROM Users WHERE UserId = :userId";

        // get pdo to prepare the statement for adding the parameters
        $stmt = $pdo->prepare($sql);

        // bind the parameters with the values 
        $stmt->bindparam(':userId', $id);
        
        // execute the query
        $stmt->execute();
    }

    public function FilterByEmail($email) 
    {
        // connect to the database
        $pdo = require $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php';

        // creates the query
        $sql = 'SELECT * 
                FROM Users
                WHERE email = :email';

        // get pdo to prepare the statement for adding the parameters
        $stmt = $pdo->prepare($sql);

        // bind the parameters with the values 
        $stmt->bindparam(':email', $email);

        // execute the query
        $stmt->execute();

        // returns all the users as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function CheckLogin($email, $pass) 
    {
        $rows = $this->FilterByEmail($email);

        if (count($rows) == 1) {
            if(password_verify($pass, $rows[0]["passwordText"])){
                return $rows[0];
            }
        }
    }

    // function to validate first name
    public function ValidateFirstName($firstName) 
    {
        $error = "";
        if ((strlen($firstName) < 3) || (strlen($firstName) > 50))
        {
            $error = "First name should be between 3 and 50 characters";
        }
        else
        {
            for ($i = 0; $i < strlen($firstName); $i++)
            {
                // check for numbers
                if (ctype_digit($firstName[$i]))
                {
                    $error = "First name cannot not contain numbers";
                    break;
                }

                // check for punctuation
                if (ctype_punct($firstName[$i]))
                {
                    $error = "First name cannot not contain punctuation";
                    break;
                }
            }
        }


        return $error;
    }

    // function to validate last name
    public function ValidateLastName($lastName) 
    {
        $error = "";
        if ((strlen($lastName) < 3) || (strlen($lastName) > 75))
        {
            $error = "Last name should be between 3 and 75 characters";
        }
        else
        {
            for ($i = 0; $i < strlen($lastName); $i++)
            {
                // check for numbers
                if (ctype_digit($lastName[$i]))
                {
                    $error = "Last name cannot not contain numbers";
                    break;
                }

                // check for punctuation
                if (ctype_punct($lastName[$i]))
                {
                    $error = "Last name cannot not contain punctuation";
                    break;
                }
            }
        }

        return $error;
    }

    // function to validate email
    public function ValidateEmail($email) 
    {
        $error = "";
        if ($this->FilterByEmail($email))
        {
            $error = "Email already exist";
        }

        return $error;
    }

    // function to validate password
    public function ValidatePassword($pass) 
    {

    }
}
?>