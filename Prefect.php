<?php 

include("connection.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prefect</title>
    <!-- <link rel="stylesheet" href="https://classless.de/classless.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>
<body class="prefect_bg">

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
                    <a class="nav-link active" href="Prefect.php">AddPrefect</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="return confirm('Are you sure you want to Logout');" href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <h3 class="text-center prefect_lead_title ">Enter Prefect Details: </h3>

    <form class="container-fluid py-4 form_css" action="Prefect.php" method="post">
        <p>
            <label class="form-label" for="fn">First Name</label>
            <input type="text" class="form-control" name="fn" id="fn" required>
        </p>
        <p>
            <label class="form-label" for="ln">Last Name</label>
            <input type="text" class="form-control" name="ln" id="ln" required>
        </p>
        <p class="form-floating">
            <textarea class="form-control" name="mn" id="mn" cols="30" rows="10" required></textarea>
            <label for="mn">Manifesto</label>
            <!-- <input type="text" class="form-control" name="desc" id="desc" required> -->
        </p>
        <p>
            <label class="form-label" for="course">Course</label>
            <!-- <input type="text" class="form-control" name="course" id="course" required> -->
            <select name="course" class="form-select" id="course">
                <?php
                
                // set the resulting array to associative

                $sql = "SELECT * FROM `course`";
                $query = mysqli_query($status,$sql);
                $array_res = mysqli_fetch_all($query);
                
                foreach($array_res as $x){
                ?>
                <option value="<?php print($x[0])?>"><?php print($x[1])?></option>
                <?php 
                                
                }
                
                ?> 
            </select>
        </p>
        <p>
            <label class="form-label" for="post">Post</label>
            <!-- <input type="text" class="form-control" name="post" id="post" required> -->
            <select name="post" class="form-select" id="post" required>
                <?php
                
                // set the resulting array to associative

                $sql = "SELECT * FROM `post`";
                $query = mysqli_query($status,$sql);
                $array_res = mysqli_fetch_all($query);
                
                foreach($array_res as $x){
                ?>
                <option value="<?php print($x[0])?>"><?php print($x[1])?></option>
                <?php 
                                
                }
                
                ?> 
            </select>
        </p>
        <div>
            <button type="submit" class="btn btn-primary" name="register">Enter Prefect</button>
        </div>
    </form>
</body>
</html>

<?php 
    if(isset($_POST["register"])){

        $fn = $_POST["fn"];
        $ln = $_POST["ln"];
        $mn = $_POST["mn"];
        $course = $_POST["course"];
        $post = $_POST["post"];

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

        $Db_Command = "INSERT INTO prefect(FirstName,LastName,Manifesto,cid,post_id) VALUES('$fn','$ln','$mn','$course','$post')";
        // Step 4: Execute the SQL Command
        $result = $conn->exec($Db_Command);
        if($result){
            header("Location:ShowPrefects.php?status=Inserted");
        }
        else{
            header("Location:ShowPrefects.php?status=Error");
        }


        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
    }   


?>