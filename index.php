<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="header">
        <h1>Welcome to Cavendish Voting Portal</h1>
    </div>
    <div>
        <div>
            <form action="index.php" method="post">
                <div class="inputbox">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required placeholder="Enter Your Email">
                </div>
                <div class="inputbox">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" required placeholder="Enter Your password">
                </div>
                <div class="inputbox">
                    <button type="submit" name="LoginBtn">Login</button>
                </div>
                <a href="RegisterStudent.php">SignUp</a>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
    session_start();
    if(isset($_POST["LoginBtn"])){
        $email= $_POST['email'];
        $pass= $_POST['pass'];
        $Pass1 = md5($pass);
        $Pass2 = sha1($Pass1);
        $Pass3 = md5($Pass2);
        $Pass4 = sha1($Pass3);
        $Pass5 = crypt($Pass4,'@%!'); // salt is what to add to password to make it as difficult
        // as possible to crack the password

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
        // Pattern Mach => S% -- starts with S,  %S-- ends with S, %S% -- contains S
        $Db_Command = $conn->prepare("SELECT COUNT(*) FROM student WHERE email='$email' AND Password='$Pass5'");
        $Db_Command->execute();
        
        $Db_Command2 = $conn->prepare("SELECT * FROM student WHERE email='$email' AND Password='$Pass5'");
        $Db_Command2->execute();
        
        
        $result = $Db_Command2->fetch(PDO::FETCH_ASSOC);
        $row = $Db_Command->fetch();

        // var_dump($row);
        $NumofIDs= $row;

        if($NumofIDs>0)
        {
            // Set session variables
            $_SESSION["Uid"]=$result["id"];
            $_SESSION["UName"]=$result["FirstName"]." ".$result["LastName"];
            $_SESSION["Role"]=$result["Role"];
            $_SESSION["Status"]=$result["Status"];


            if($result['Role']=='Admin'){
                header("Location:Dashboard_Admin.php");
            }
            if($result['Role']=='Student'){
                header("Location:Dashboard_Student.php");
            }
        }else{?>
            <script>
                alert("Unable to Login");

            </script>
            echo "Unsuccessful";
        <?php 
        
    }
    }

    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

?>