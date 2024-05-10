
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddPost</title>
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
                    <a class="nav-link" href="AddAdmin.php">AddAdmin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ShowAdmins.php">ShowAdmins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="AddPost.php">AddPost</a>
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
            <div class="alert alert-warning alert-dismissible fade show" role="alert">Post Not Created
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if($St =='Inserted'){
            // echo "User Account Edit";
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">Post Created
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
    }
    ?>

    <h3 class="post_lead_title text-center">Add Post</h3>
    <form class="form_css container-fluid py-4" action="AddPost.php" method="post">
        <p>
            <label class="form-label" for="post">Title</label>
            <input name="post" class="form-control" id="post" type="text" required>
        </p>
        <p>
            <label class="form-label" for="desc">Description</label>
            <input name="desc" class="form-control" id="desc" type="text" required>
        </p>
        <button name="submit" class="btn btn-primary">Submit</button>
    </form>
    
    <?php
    if(isset($_POST["submit"])){
        $post = $_POST["post"];
        $desc = $_POST["desc"];

        $Db_Command = $conn->prepare("INSERT INTO post(title,Description) values('$post','$desc')");
        // $Db_Command->execute();

        $res = $Db_Command->execute();

        if($res){
            header("Location:AddPost.php?status=Inserted");
        }else{
            header("Location:AddPost.php?status=Error");

        }

    }
    }
?>    
</body>
</html>