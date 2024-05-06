<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "voting_db";

    $status = mysqli_connect($servername,$username,$password);

    mysqli_select_db($status,$db);
?>
    <!-- // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $db = "ecommerce_db";

    // try {
    //     $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    //     // set the PDO error mode to exception
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     // echo "Connected successfully";
    //     // Step 3 : Writhe the SQL Command
    // }catch(PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // } -->