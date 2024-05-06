<?php 
    if(isset($_POST["register"])){

        $fn = $_POST["fn"];
        $ln = $_POST["ln"];
        $mn = $_POST["mn"];
        $course = $_POST["course"];
        $post = $_POST["post"];

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

        $Db_Command = "INSERT INTO prefect(FirstName,LastName,Manifesto,cid,post_id) VALUES('$fn','$ln','$mn','$course','$post')";
        // Step 4: Execute the SQL Command
        $result = $conn->exec($Db_Command);
        if($result){
            echo "Prefect Successfully Created";
        }


        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
    }   


?>