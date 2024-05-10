<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="show.css">
</head>
<body class="showusers_bg">
    
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="Dashboard_Admin.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ShowPrefects.php">ShowPrefects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ShowUsers.php">ShowStudents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">CurrentStandings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Prefect.php">AddPrefect</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AddAdmin.php">AddAdmin</a>
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

    <h3 class="lead_title text-center">Edit Post</h3>
    <?php 
    session_start();

        if(isset($_GET['Uid'])){
            
            $_SESSION['SUid'] = $_GET['Uid'];

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

            $Db_Command = $conn->prepare("SELECT * FROM course WHERE id='$id'");

            $Db_Command->execute();

            $row = $Db_Command->fetch();
            // echo $row['email'];
    ?>
    
        <form class="form_css container-fluid py-4" action="EditCourse.php" method="post">
            <input type="hidden" class="form-control" name= "id2" value="<?php echo $row['id']; ?>">
            
            <p>
                <label class="form-label" for="course">CourseName</label>
                <input name="course" value="<?php echo $row["Course_Name"] ?>" class="form-control" id="course" type="text" required>
            </p>

            <p>
                <label class="form-label" for="dept">Department</label>
                <input name="dept" value="<?php echo $row["Department"] ?>" class="form-control" id="dept" type="text" required>
            </p>
            
            
            <button name="Update" class="btn btn-primary">Submit</button>
        </form>


            <?php
            }  
            catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    ?>





</body>
</html>

<?php

    if(isset($_POST['Update'])){
            $course = $_POST["course"];
            // echo "You have submitted";
            $dept=$_POST['dept'];
            $id2 = $_POST['id2'];
            // echo $F." ".$R;

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

            $DBb_Command = "UPDATE course SET Course_Name='$course',Department='$dept' WHERE id='$id2'";

            $result3 = $conn->exec($DBb_Command);
            if($result3){
                header("Location:ShowCourses.php?status=Edited&Msg=Success");
            }
            else{
                echo "failed to Update :(. Please try again";
                ?>
                <a href="EditCourse.php?Uid=<?php echo $_SESSION['SUid'] ?>">Back</a>
                <?php
            }


            } catch(PDOException $e) {
            echo "Connection failed:".$e->getMessage();
            }
        }
     
?>