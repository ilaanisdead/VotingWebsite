<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Prefects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="show.css">
</head>
<body class="showpref_bg ">
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="Dashboard_Admin.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="ShowPrefects.php">ShowPrefects</a>
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
                    <a class="nav-link" onclick="return confirm('Are you sure you want to Logout');" href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
    <?php 

        if(isset($_GET['status'])){
            $St = $_GET['status'];
            if($St == 'Inserted'){
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">Prefect Account Successfully Created
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            elseif($St =='Error'){
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">Prefect Account Not Created
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            elseif($St =='Deleted'){
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">Prefect Account Deleted
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
        $Db_Command = $conn->prepare("SELECT * FROM prefect");
        $Db_Command_Post = $conn->prepare("SELECT * FROM post");
        $Db_Command_Course = $conn->prepare("SELECT * FROM course");
        
        $Db_Command->execute();
        $Db_Command_Post->execute();
        $Db_Command_Course->execute();
        
        $result = $Db_Command->setFetchMode(PDO::FETCH_ASSOC);
        $result2 = $Db_Command_Post->fetchAll(PDO::FETCH_ASSOC);
        $result3 = $Db_Command_Course->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <div style = "margin:15px" align="right">
            <form method="POST" action="SearchPrefect.php">
                <input type="text" name="SearchValue" placeholder="Search UserID or Name">
                <button type="submit" name="SearchBtn">Search</button>
            </form>
        </div>
        

        <table class="table table-striped" width="100%" border="1">
            <tr class="table-dark">
                <th>UserID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Manifesto</th>
                <th>CourseID</th>
                <th>Post</th>
                <th colspan="2">Operations</th>
            </tr>
        <?php
        while($row = $Db_Command->fetch()){
            $id = $row['id'];
            foreach($result2 as $x){
                if($row['post_id']==$x['id']){
                    $pid = $x['title'];
                }
            }
            foreach($result3 as $y){
                if($row['cid']==$y['id']){
                    $cid = $y['Course_Name'];
                }
            }
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['FirstName']; ?></td>
                <td><?php echo $row['LastName']; ?></td>
                <td><?php echo $row['Manifesto']; ?></td>
                <td><?php echo $cid; ?></td>
                <td><?php echo $pid; ?></td>
                <td><?php echo "<a href='EditPrefect.php?Uid=$id'>Edit</a>" ?></td>
                <td onclick="return confirm('Are you sure you want to delete this record');"><?php echo "<a href='DeletePrefect.php?Uid=$id'>Delete</a>" ?></td>
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
</body>
</html>