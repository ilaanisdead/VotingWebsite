<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Admins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="show.css">
</head>
<body class="showpref_bg ">
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
                    <a class="nav-link" href="AddAdmin.php">AddAdmin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="ShowAdmins.php">ShowAdmins</a>
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

    if(isset($_GET['Uid'])){
        $id = $_GET['Uid'];
        
        // $Db_Command = "SELECT * FROM tbl_users";
        $Db_Command = $conn->prepare("DELETE FROM admin WHERE id='$id'");
        $result = $Db_Command->execute();
        if($result){
            header("Location:ShowAdmins.php?status=Deleted");
        }
        else{
            header("Location:ShowAdmins.php?status=Error");
        }
      
    }
    ?>
    <div class="container-fluid">
    <?php 

        if(isset($_GET['status'])){
            $St = $_GET['status'];
            if($St == 'Inserted'){
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">Admin Account Successfully Created
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            elseif($St =='Error'){
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">Admin Account Not Created
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            elseif($St =='Deleted'){
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">Admin Account Deleted
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            elseif($St =='Edited'){
                // echo "User Account Edit";
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">Prefect Account Editted
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
        }
                
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
        $Db_Command = $conn->prepare("SELECT * FROM admin");
        
        $Db_Command->execute();
        
        $result = $Db_Command->setFetchMode(PDO::FETCH_ASSOC);

        ?>
        <div style = "margin:15px" align="right">
            <form method="POST" action="SearchAdmin.php">
                <input type="text" name="SearchValue" placeholder="Search UserID or Name">
                <button type="submit" name="SearchBtn">Search</button>
            </form>
        </div>
        

        <table class="table table-striped" width="100%" border="1">
            <tr class="table-dark">
                <th>id</th>
                <th>UserName</th>
                <th>Email</th>
                <th colspan="2">Operations</th>
            </tr>
        <?php
        while($row = $Db_Command->fetch()){
            $id = $row['id'];

        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo "<a href='EditAdmin.php?Uid=$id'>Edit</a>" ?></td>
                <td onclick="return confirm('Are you sure you want to delete this record');"><?php echo "<a href='ShowAdmins.php?Uid=$id'>Delete</a>" ?></td>
            </tr>

        <?php
            // echo $row['PhoneNumber'];
            // echo "<br/>";
            // echo $row['email'];
            // echo "<br/>";
            // echo $row['FirstName'];
            // echo "<hr>";
        }
        ?>
        </table>
        <?php

        // Step 4: Execute the SQL Command
        // $result = $conn->exec($Db_Command);
        // if($result){
        //     echo "User Account Successfully Created";
        // }


        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
    ?>
    </div>
    <?php
    }
    ?>
</body>
</html>
