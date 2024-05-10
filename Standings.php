<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standings</title>
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
                <a class="nav-link active" href="Standings.php">CurrentStandings</a>
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
    <p>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link bg-primary text-white " href="Votingdetails.php">View Details</a>
            </li>
        </ul>
    </p>
    <?php
        include("dBconfig.php");
        // session_start();
        
        // checking if student has already voted and also if the student has logged in first
        // this prevents access to this site through the url search bar

        // selecting all the candidates to show them on the voter's interface
        $Db_Command = $conn->prepare("SELECT * FROM prefect");
        $Db_Command->execute();

        // selecting all the posts to show them on the voter's interface
        $Db_Command2 = $conn->prepare("SELECT * FROM post");
        $Db_Command2->execute();

        // selecting all the courses to print out the course name instead of the course id later
        // $Db_Command3 = $conn->prepare("SELECT * FROM course");
        // $Db_Command3->execute();

        // looping through all posts available
        $res1 = $Db_Command2->fetchAll(PDO::FETCH_ASSOC);

        // looping through all prefects available
        $res2 = $Db_Command->fetchAll(PDO::FETCH_ASSOC);

        // looping through all the courses available to print out course name on the interface instead of course id
        // $res3 = $Db_Command->fetchAll(PDO::FETCH_ASSOC);


        
        foreach($res1 as $var1){
    ?>

<!-- 
    <h4 class="text-dark text-center"
        style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"
        > 
        
    </h4> -->
    <table class="table table-striped mt-5">
        <tr class="table-primary">
            <th colspan="4" class="text-dark text-center"
        style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                <?php echo $var1["title"]; ?>
            </th>
        </tr>
        <tr class="table-dark">
            <th>Candidate</th>
            <th>Post</th>
            <th>Course</th>
            <th>Current Votes</th>
        </tr>
    <?php 
    
    foreach ($res2 as $var2 ) { // looping through available candidates
        if($var2["post_id"]==$var1["id"]){ // checking if prefect post id matches with the id in the post table
        // they must all have the same position id since it is a category
    ?>
    <tr>
        <td><?php echo $var2["FirstName"]." ".$var2["LastName"] ?></td>
        <td><?php print($var1["title"]) ?></td>
        <td><?php 

        // course id current student in this loop is taking. To be used in selecting the name of the courses
        $cid = $var2['cid'];
        
        // selecting all the courses to print out the course name instead of the course id later
        $Db_Command3 = $conn->prepare("SELECT * FROM course WHERE id=$cid");
        $Db_Command3->execute();

        // looping through all the courses available to print out course name on the interface instead of course id
        $res3 = $Db_Command3->fetch(PDO::FETCH_ASSOC);
        echo $res3['Course_Name'];
        
        ?></td>
        
        <td >
            <?php echo $var2["count"]; ?>
        </td> 
    </tr>
    <?php 
        }
    }
    ?> 
    </table>
   
    <?php
    }
    ?>
  
    
   
</div>
    <?php
    }
    ?>
</body>
</html>