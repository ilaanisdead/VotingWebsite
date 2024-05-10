<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="show.css">

</head>
<body class="showusers_bg" style="min-height:100vh; display:flex; flex-direction:column;">
<?php 
    session_start();

    if(isset($_SESSION["Uid"])){
    ?>
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Dashboard_Admin.php">Home</a>
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
    
    <h3 class="lead_title m-3 text-primary" style="flex:1">Welcome <span class="text-white"><?php echo $_SESSION["UName"]?></span> </h3>
    <footer class="bg-black" style="margin-bottom: 0px !important">
        <h4 class="pt-3 mb-3 text-center text-white"
        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
        >Contact us via email for any inquiries @ab88356@students.cavendish.ac.ug</h4>
        <hr class="bg-light ms-auto me-auto" style="width: 70rem; height: 0.2rem;">
        <nav class="pb-4" style="font-size: 30px; margin-left: 50%;">
            <a href="https://mail.google.com"><i class="bi-envelope-at-fill"></i></a>
        </nav>
    </footer>
    <?php 
    }
    
    ?>
</body>
</html>