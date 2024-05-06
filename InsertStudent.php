<?php 
    $email = $_POST["email"];
    
    if(isset($_POST["register"])&& preg_match("[@students.cavendish.ac.ug]",$email)){

        $fn = $_POST["fname"];
        $ln = $_POST["lname"];
        $course = $_POST["course"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "voting_db";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
            // Step 3 : Writhe the SQL Command

        $Db_Command = "INSERT INTO student(FirstName,LastName,email,cid,PhoneNumber,Address) VALUES('$fn','$ln','$email','$course','$phone','$address')";
        // Step 4: Execute the SQL Command
        $result = $conn->exec($Db_Command);
        if($result){
            echo "User Account Successfully Created";
        }


        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
    }   
    else{
        echo "Unable to register. Make sure your email is a Cavendish email";
    }


?>