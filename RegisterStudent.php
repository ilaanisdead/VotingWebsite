<?php 

include("connection.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Registration</title>
    <!-- <link rel="stylesheet" href="https://classless.de/classless.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>
<body class="bg py-4">

    <h1 class="text-center lead_title">Enter Student Details: </h1>

    <form class="container-fluid py-4 form_css" action="RegisterStudent.php" method="post">
        <p>
            <label class="form-label" for="fn">First Name</label>
            <input type="text" class="form-control" name="fname" id="fn" required>
        </p>
        <p>
            <label class="form-label" for="ln">Last Name</label>
            <input type="text" class="form-control" name="lname" id="ln" required>
        </p>
        <p>
            <label class="form-label" for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" required>
        </p>
        <p>
            <label class="form-label" for="pass">Password</label>
            <input type="text" class="form-control" name="pass" id="pass" required>
        </p>
        <p>
            
            <label class="form-label me-4" for="course">Course</label>
            <select name="course" class="form-select" id="course" required>
                <?php
                
                // set the resulting array to associative

                $sql = "SELECT * FROM `course`";
                $query = mysqli_query($status,$sql);
                $array_res = mysqli_fetch_all($query);
                
                foreach($array_res as $x){
                ?>
                <option value="<?php print($x[0])?>"><?php print($x[1])?></option>
                <?php 
                                
                }
                
                ?> 
            </select>
        </p>
        <p>
            <label class="form-label" for="phone">Phone Number</label>
            <input type="text" class="form-control" name="phone" id="phone" required>
        </p>
        <p>
            <label class="form-label" for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address" required>
        </p>

        <button type="submit" class="btn btn-primary" name="register">Register</button>
        
        <a class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover d-inline-block ms-5" href="index.php">Back</a>
    </form>
</body>
</html>

<?php 
    
    if(isset($_POST["register"])) {
        $email = $_POST["email"];
        if(preg_match("[@students.cavendish.ac.ug]",$email)){

            $fn = $_POST["fname"];
            $ln = $_POST["lname"];
            $course = $_POST["course"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            $Pass1 = md5($pass);
            $Pass2 = sha1($Pass1);
            $Pass3 = md5($Pass2);
            $Pass4 = sha1($Pass3);
            $Pass5 = crypt($Pass4,'@%!');
           

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

            $Db_Command = "INSERT INTO student(FirstName,LastName,email,cid,PhoneNumber,Address,Password) VALUES('$fn','$ln','$email','$course','$phone','$address','$Pass5')";
            // Step 4: Execute the SQL Command
            $result = $conn->exec($Db_Command);
            if($result){
                // header("Location:ShowUsers.php?status=Inserted");
                header("Location:index.php?status=Inserted");

            }
            else{
                // header("Location:ShowUsers.php?status=Error");
                header("Location:ShowUsers.php?status=Error");

            }

            } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            }
        }   
        else{
            echo "Unable to register. Make sure your email is a Cavendish email";
        }
    }

?>