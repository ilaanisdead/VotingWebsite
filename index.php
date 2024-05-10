<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>
<body class="prefect_bg" style="height:100vh">
    <div style="margin: 2rem 0;">
        <div class="header">
            <h3 class="post_lead_title text-center ">Welcome to Cavendish Voting Portal</h3>
        </div>
        <div class="container-fluid">
            <div class="form_css container-fluid">
                <form action="index.php" class="py-3" method="post">
                    <p>
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email" required placeholder="Enter Your Email">
                    </p>
                    <p>
                        <label class="form-label" for="pass">Password</label>
                        <input class="form-control mb-3" type="password" name="pass" required placeholder="Enter Your password">
                    </p>
                    <button class="btn btn-primary mb-2" type="submit" name="LoginBtn">Login</button>
                    <span class="ms-5 text-primary">don't have an account? SignUp here: </span><a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="RegisterStudent.php">SignUp</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php 

    session_start();
    
    if(isset($_GET['status'])){
        $St = $_GET['status'];
        
        if($St =='Error'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">User Account Not Edited. Ensure all Details are valid 
                and email is a Cavendish email
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        elseif($St =='Inserted'){
            // echo "User Account Edit";
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">User Account Created
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
    }

    
//     if(isset($_POST["LoginBtn"])){
//         $email= $_POST['email'];
//         $pass= $_POST['pass'];
//         // $Pass1 = md5($pass);
//         // $Pass2 = sha1($Pass1);
//         // $Pass3 = md5($Pass2);
//         // $Pass4 = sha1($Pass3);
//         // $Pass5 = crypt($Pass4,'@%!'); // salt is what to add to password to make it as difficult
//         // // as possible to crack the password
//         $pass1 = md5($pass);
//         $pass2 = sha1($pass1);
//         $pass3 = md5($pass2);
//         $pass4 = sha1($pass3);
//         $pass5= crypt($pass4,"@%1`");
        

//         $servername = "localhost";
//         $username = "root";
//         $password = "";
//         $db = "voting_db";

//         try {
//             $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
//             // set the PDO error mode to exception
//             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             // echo "Connected successfully";
//             // Step 3 : Writhe the SQL Command

//         // $Db_Command = "SELECT * FROM tbl_users";
//         // Pattern Mach => S% -- starts with S,  %S-- ends with S, %S% -- contains S
//         $Db_Command = $conn->prepare("SELECT COUNT(*) FROM student WHERE email='$email' AND Password='$pass5'");
//         $Db_Command->execute();
        
//         // for admin
//         $Db_Command3 = $conn->prepare("SELECT COUNT(*) FROM  admin WHERE email='$email' AND password='$pass5'");
//         $Db_Command3->execute();

//         $Db_Command2 = $conn->prepare("SELECT * FROM student WHERE email='$email' AND Password='$pass5'");
//         $Db_Command2->execute();

//         // for admin
//         $Db_Command4 = $conn->prepare("SELECT * FROM admin WHERE email='$email' AND password='$pass5'");
//         $Db_Command4->execute();
        
        
//         $result = $Db_Command2->fetch(PDO::FETCH_ASSOC);
        
//         // for admin
//         $result2 = $Db_Command4->fetch(PDO::FETCH_ASSOC);
        
//         $row = $Db_Command->fetch(PDO::FETCH_ASSOC);

//         // for admin
//         $row2 = $Db_Command3->fetch(PDO::FETCH_ASSOC);

//         // var_dump($row);
//         $NumofIDs= $row['COUNT(*)'];
//         $NumofIDsAdmin= $row2['COUNT(*)'];


//         // var_dump($row);
//         echo $result["FirstName"];

//         if($NumofIDs>0)
//         {
//             // Set session variables
//             $_SESSION["Uid"]=$result["id"];
//             $_SESSION["UName"]=$result["FirstName"]." ".$result["LastName"];
//             $_SESSION["Role"]=$result["Role"];
//             $_SESSION["Status"]=$result["Status"];


//             // if($result['Role']=='Admin'){
//             //     header("Location:Dashboard_Admin.php");
//             // }
//             // if($result['Role']=='Student'){
//             header("Location:Dashboard_Student.php");
//             exit();
//             // }
//         }
//         elseif($NumofIDsAdmin>0){
//             $_SESSION["Uid"] = $result2["id"];
//             $_SESSION["email"] =$result2["email"];;
//             $_SESSION["UName"] =$result2["username"];;

//             header("Location:Dashboard_Admin.php");

//         }
//         else{
        
//     }
//     }

//     catch(PDOException $e) {
//         echo "Connection failed: " . $e->getMessage();
//     }
// }
// if(isset($_POST["LoginBtn"])){
//     $email = $_POST['email'];
//     $pass = $_POST['pass'];

//     // Hashing the password securely
//     $passHashed = crypt(sha1(md5($pass)), "@%1`");

//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $db = "voting_db";

//     try {
//         $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         // Prepared statement for student login
//         $Db_Command = $conn->prepare("SELECT COUNT(*) AS count FROM student WHERE email=:email AND Password=:pass");
//         $Db_Command->bindParam(':email', $email);
//         $Db_Command->bindParam(':pass', $passHashed);
//         $Db_Command->execute();
//         $row = $Db_Command->fetch(PDO::FETCH_ASSOC);
//         $numOfIDs = $row['count'];

//         // Prepared statement for admin login
//         $Db_Command2 = $conn->prepare("SELECT COUNT(*) AS count FROM admin WHERE email=:email AND password=:pass");
//         $Db_Command2->bindParam(':email', $email);
//         $Db_Command2->bindParam(':pass', $passHashed);
//         $Db_Command2->execute();
//         $row2 = $Db_Command2->fetch(PDO::FETCH_ASSOC);
//         $numOfIDsAdmin = $row2['count'];

//         if($numOfIDs > 0) {
//             // Student login successful
//             $Db_Command3 = $conn->prepare("SELECT * FROM student WHERE email=:email AND Password=:pass");
//             $Db_Command3->bindParam(':email', $email);
//             $Db_Command3->bindParam(':pass', $passHashed);
//             $Db_Command3->execute();
//             $result = $Db_Command3->fetch(PDO::FETCH_ASSOC);

//             $_SESSION["Uid"]=$result["id"];
//             $_SESSION["UName"]=$result["FirstName"]." ".$result["LastName"];
//             $_SESSION["Role"]=$result["Role"];
//             $_SESSION["Status"]=$result["Status"];

//             header("Location:Dashboard_Student.php");

//         } elseif($numOfIDsAdmin > 0) {
//             // Admin login successful
//             $Db_Command4 = $conn->prepare("SELECT * FROM admin WHERE email=:email AND password=:pass");
//             $Db_Command4->bindParam(':email', $email);
//             $Db_Command4->bindParam(':pass', $passHashed);
//             $Db_Command4->execute();
//             $result2 = $Db_Command4->fetch(PDO::FETCH_ASSOC);

//             $_SESSION["Uid"] = $result2["id"];
//             $_SESSION["email"] =$result2["email"];;
//             $_SESSION["UName"] =$result2["username"];;

//             header("Location:Dashboard_Admin.php");
            
//         } else {
//             <script>
//                 alert("Unable to Login");

//             </script>
//             <?php 
// //             echo "Unsuccessful";
//             // Login failed
//         }
//     } catch(PDOException $e) {
//         echo "Connection failed: " . $e->getMessage();
//     }
// }
if(isset($_POST["LoginBtn"])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "voting_db";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepared statement for student login
        $Db_Command = $conn->prepare("SELECT * FROM student WHERE email=:email");
        $Db_Command->bindParam(':email', $email);
        $Db_Command->execute();
        $result = $Db_Command->fetch(PDO::FETCH_ASSOC);

        // Prepared statement for admin login
        $Db_Command2 = $conn->prepare("SELECT * FROM admin WHERE email=:email");
        $Db_Command2->bindParam(':email', $email);
        $Db_Command2->execute();
        $result2 = $Db_Command2->fetch(PDO::FETCH_ASSOC);

        if($result && password_verify($pass, $result['Password'])) {
            // Student login successful
            $_SESSION["Uid"] = $result["id"];
            $_SESSION["UName"] = $result["FirstName"] . " " . $result["LastName"];
            $_SESSION["Role"] = $result["Role"];
            $_SESSION["Status"] = $result["Status"];
            header("Location: Dashboard_Student.php");
        } elseif($result2 && password_verify($pass, $result2['password'])) {
            // Admin login successful
            $_SESSION["Uid"] = $result2["id"];
            $_SESSION["email"] = $result2["email"];
            $_SESSION["UName"] = $result2["username"];
            header("Location: Dashboard_Admin.php");
        } else {
            ?>
            <script>
                alert("Unable to Login");
            </script>
            <?php 
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}



?>