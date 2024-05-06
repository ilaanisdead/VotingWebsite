<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
</head>
<body>
    
    <?php 
        if(isset($_GET['Uid'])){
            $id = $_GET['Uid'];
            // Step 2: connect to the DB Server
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

            // $Db_Command = "SELECT * FROM tbl_users";
            $Db_Command = $conn->prepare("DELETE FROM student WHERE id='$id'");
            $result = $Db_Command->execute();
            if($result){
                header("Location:ShowUsers.php?status=Deleted");
            }
            else{
                header("Location:ShowUsers.php?status=Delete-failed");
            }
            }  
            catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    ?>
</body>
</html>