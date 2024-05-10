<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">

</head>
<body style="background-image: url('./imgs/vote.jpg'); background-size: cover;min-height:100vh; display:flex; flex-direction:column; ">
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Dashboard_Student.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="EditStudentFromStudent.php?Uid=<?php echo $_SESSION['Uid'] ?>">Edit Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Vote.php">Vote</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="return confirm('Are you sure you want to Logout');" href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>


    <h3 class="course_lead_title m-3 text-white" style="flex:1"><span class="text-dark">Welcome</span> <?php echo $_SESSION["UName"]; ?></h3>
    <footer class="bg-black" style="margin-bottom: 0px !important">
        <h4 class="pt-3 mb-3 text-center text-white"
        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
        >Contact us via email for any inquiries @ab88356@students.cavendish.ac.ug</h4>
        <hr class="bg-light ms-auto me-auto" style="width: 70rem; height: 0.2rem;">
        <nav class="pb-4" style="font-size: 30px; margin-left: 50%;">
            <a href="https://mail.google.com"><i class="bi-envelope-at-fill"></i></a>
        </nav>
    </footer>
</body>
</html>