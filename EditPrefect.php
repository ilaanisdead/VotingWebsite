<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    <a class="nav-link" href="Prefect.php">AddPrefect</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="return confirm('Are you sure you want to Logout');" href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<h3 class="lead_title text-center ">Edit Prefect</h3>
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

            $Db_Command = $conn->prepare("SELECT * FROM prefect WHERE id='$id'");
            $Db_Command_Course = $conn->prepare("SELECT * FROM course");
            $Db_Command_Post = $conn->prepare("SELECT * FROM post");

            $Db_Command->execute();
            $Db_Command_Course->execute();
            $Db_Command_Post->execute();

            $result = $Db_Command->setFetchMode(PDO::FETCH_ASSOC);
            $result2 = $Db_Command_Course->fetchAll(PDO::FETCH_ASSOC);
            $result4 = $Db_Command_Post->fetchAll(PDO::FETCH_ASSOC);

            $row = $Db_Command->fetch();
            // echo $row['email'];
    ?>
    
            <form class="container-fluid py-4 form_css" action="EditPrefect.php" method="post">
            <input type="hidden" class="form-control" name= "id2" value="<?php echo $row['id']; ?>">
        <p>
            <label class="form-label" for="">FirstName :</label>
            <input type="text" class="form-control" name="First" required value="<?php echo $row['FirstName']; ?>">
        </p>
        <p>
            <label class="form-label" for="">LastName :</label>
            <input type="text" class="form-control" name="Last" required value="<?php echo $row['LastName']; ?>">
        </p>
        <p>
            <label class="form-label" for="">Manifesto:</label>
            <input type="text" class="form-control" name="mn" required value="<?php echo $row['Manifesto']; ?>">
        </p>
        <p>
            <label class="form-label" for="course">Course :</label>
            <select name="course" class="form-select" id="course">
                <?php
                
                    foreach($result2 as $x){
                ?>
                        <option value="<?php echo($x['id'])?>"><?php echo($x['Course_Name'])?></option>
                <?php 
                    }
                
                ?> 
            </select>
        </p>
        <p>
            <label class="form-label" for="post">Course :</label>
            <select name="post" class="form-select" id="post">
                <?php
                
                    foreach($result4 as $y){
                ?>
                        <option value="<?php echo($y['id'])?>"><?php echo($y['title'])?></option>
                <?php 
                    }
                
                ?> 
            </select>
        </p>
        <p>
            <button class="btn btn-primary" type="submit" name="Update">Update User Account</button>
        </p>
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
        // echo "You have submitted";
        $F=$_POST['First'];
        $L=$_POST['Last'];
        $M=$_POST['mn'];
        $C=$_POST['course'];
        $P=$_POST['post'];
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

        $DBb_Command = "UPDATE prefect SET FirstName='$F',LastName='$L',Manifesto='$M', cid='$C',post_id='$P' WHERE id='$id2'";

        $result3 = $conn->exec($DBb_Command);
        if($result3){
            header("Location:ShowPrefects.php?status=Edited&Msg=Success");
        }
        else{
            echo "failed to Update. Please try again. Make sure you're using a Cavendish email";
            ?>
            <a href="EditPrefect.php?Uid=<?php echo $_SESSION['SUid'] ?>">Back</a>
            <?php
        }


        } catch(PDOException $e) {
        echo "Connection failed:".$e->getMessage();
        }
    }
    
?>