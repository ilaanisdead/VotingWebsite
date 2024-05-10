<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>
<body class="post_bg">
<?php 
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
    <p><h3 class="text-center lead_title">Voting Details</h3></p>
    <?php
        include("dBconfig.php");

        // selecting all the candidates to show them on the voter's interface
        $Db_Command = $conn->prepare("SELECT * FROM voting_details");
        $Db_Command->execute();

    
    ?>
    <table class="table table-striped" width="100%" border="1">
            <tr class="table-dark">
                <th>Date/Time</th>
                <th>Name</th>
                <th>Vote Count</th>
            </tr>
        <?php
        while($row = $Db_Command->fetch()){
            
        ?>
            <tr>
                <td><?php echo $row['DateTime']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['num']; ?></td>
            </tr>

        <?php
        }
        ?>
        </table>
    </div>
    <?php 
    } 
    ?>
</body>
</html>