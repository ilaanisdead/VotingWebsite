<?php 
    if(isset($_POST["register"])){

        $cn = $_POST["cn"];
        $dp = $_POST["dept"];

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

        $Db_Command = "INSERT INTO course(Course_Name,Department) VALUES('$cn','$dp')";
        // Step 4: Execute the SQL Command
        $result = $conn->exec($Db_Command);
        if($result){
            echo "Course Successfully Created";
        }


        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
    }   


?>