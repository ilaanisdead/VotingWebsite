
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddAdmin</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="show.css">
</head>
<body class="showusers_bg">
<?php 
    session_start();

    if(isset($_SESSION["Uid"])){
    ?>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="Dashboard_Admin.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ShowPrefects.php">ShowPrefects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ShowUsers.php">ShowStudents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Standings.php">CurrentStandings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Prefect.php">AddPrefect</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="AddAdmin.php">AddAdmin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ShowAdmins.php">ShowAdmins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AddPost.php">AddPost</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ShowPosts.php">ShowPosts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AddCourse.php">AddCourse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ShowCourses.php">ShowCourses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="return confirm('Are you sure you want to Logout');" href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <?php
    include("dBconfig.php");

    if(isset($_GET['status'])){
        $St = $_GET['status'];
        
        if($St =='Error'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">Admin Not Created
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if($St =='Inserted'){
            // echo "User Account Edit";
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">Admin Created
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
    }
    ?>

    <h3 class="post_lead_title text-center">Add Admin</h3>
    <form class="form_css container-fluid py-4" action="AddAdmin.php" method="post">
        <p>
            <label class="form-label" for="email">Email</label>
            <input name="email" class="form-control" id="email" type="email" required>
        </p>
        <p>
            <label class="form-label" for="name">UserName</label>
            <input name="name" class="form-control" id="name" type="text" required>
        </p>
        <p>
            <label class="form-label" for="pass">Password</label>
            <input name="pass" class="form-control" id="pass" type="password" required>
        </p>
        <button name="submit" class="btn btn-primary">Submit</button>
    </form>
    
    <?php
    // if(isset($_POST["submit"])){
    //     $email = $_POST["email"];
    //     $pass = $_POST["pass"];
    //     $name = $_POST["name"];

    //     $pass1 = md5($pass);
    //     $pass2 = sha1($pass1);
    //     $pass3 = md5($pass2);
    //     $pass4 = sha1($pass3);
    //     $pass5= crypt($pass4,"@%1`");


    //     $Db_Command = $conn->prepare("INSERT INTO admin(username,email,password) values('$name','$email','$pass5')");
    //     // $Db_Command->execute();

    //     $res = $Db_Command->execute();

    //     if($res){
    //         header("Location:AddAdmin.php?status=Inserted");
    //     }else{
    //         header("Location:AddAdmin.php?status=Error");

    //     }

    // }
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $name = $_POST["name"];
    
        // Hashing the password securely
        // $passHashed = crypt(sha1(md5($pass)), "@%1`");
        
        // Generate a salt (cost parameter)
        $options = ['cost' => 12]; // Adjust the cost parameter as needed
        $salt = password_hash($pass, PASSWORD_DEFAULT, $options);

        // Hash the password using bcrypt
        $passHashed = password_hash($pass, PASSWORD_BCRYPT, $options);

        

        try {
            $Db_Command = $conn->prepare("INSERT INTO admin(username, email, password) VALUES (:name, :email, :pass)");
            $Db_Command->bindParam(':name', $name);
            $Db_Command->bindParam(':email', $email);
            $Db_Command->bindParam(':pass', $passHashed);
            $res = $Db_Command->execute();
    
            if($res){
                header("Location: AddAdmin.php?status=Inserted");
                exit(); // It's good practice to stop script execution after redirect
            } else {
                header("Location: AddAdmin.php?status=Error");
                exit();
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    }
?>    
</body>
</html>