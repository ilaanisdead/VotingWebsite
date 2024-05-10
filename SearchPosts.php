<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="show.css">
</head>
<body class="showpref_bg">

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

    <div class="container-fluid">
    <?php
        if(isset($_POST["SearchValue"])) {
    
            $search = $_POST["SearchValue"];
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

                $Db_Command = $conn->prepare("SELECT * FROM post WHERE id LIKE '%$search%' OR title LIKE
                '%$search%' OR Description LIKE '%$search%'
                
                ");
                $Db_Command->execute();

                $Db_Command2 = $conn->prepare("SELECT COUNT(*) FROM post WHERE id LIKE '%$search%' OR title LIKE
                '%$search%' OR Description LIKE '%$search%'
                
                ");
                $Db_Command2->execute();
                $result = $Db_Command2->fetch();
                $row_count = $Db_Command2->fetch();

                if($result>0){
                ?>
                
                <div class="alert alert-warning alert-dismissible fade show" role="alert"><?php echo $row_count ?> matching result(s) found
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <?php } 
                else{
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">No matching results found
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
                </div>
                <?php 
                }
                ?>

                    <table class="table table-striped mt-5" width="100%" border="1">
                <tr class= "table-dark">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th colspan="2">Operations</th>
                </tr>
            <?php
                while($row = $Db_Command->fetch()){
                    $id = $row['id'];
                   
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['Description']; ?></td>
                        <td><?php echo "<a href='EditPost.php?Uid=$id'>Edit</a>" ?></td>
                        <td onclick="return confirm('Are you sure you want to delete this record');"><?php echo "<a href='ShowCourses.php?Uid=$id'>Delete</a>" ?></td>
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
                

                // if($result){


                //     header("Location:SearchUser.php?id=''&status=Result");
                // }
                // else{
                //     header("Location:SearchUser.php?status=Error");
                // }

            }
            catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                }
        }
    ?>
    </div>
</body>
</html>