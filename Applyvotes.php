<?php 
    include("dBconfig.php");

    session_start();

    // $email_sesh = $_SESSION["email_sesh"];

    // $status_sql = "SELECT stat FROM `student` WHERE stemail = '$email_sesh'"; // checking if current user has already voted
    // $status_query = mysqli_query($status,$status_sql);
    // $status_row = mysqli_fetch_array($status_query);

    // if($status_row[0]!="voted"){

    //     $sql = "UPDATE `student` SET stat='voted' WHERE stemail = '$email_sesh'";
    //     mysqli_query($status,$sql);


    // }

    if(isset($_POST['arrArray'])){
        $values = $_POST['arrArray'];
        
        for ($i=0; $i <sizeof($values) ; $i++) { 

            $curr_value = $values[$i];

            $Db_Command = $conn->prepare("SELECT * FROM prefect WHERE id='$curr_value'");
            $Db_Command->execute();

            $res = $Db_Command->fetchAll(PDO::FETCH_ASSOC);
            // $sql1 = "SELECT count FROM `prefect` WHERE pid = $curr_value";
            // $query1 = mysqli_query($status,$sql1);
            // $query1_row = mysqli_fetch_array($query1);

            if($res>0){
                
                $voted_student = $_SESSION["Uid"];

                $num = $res['count']; // storing the current number of votes under this candidate
                $num +=1; // adding one vote on the candidate

                $Db_Command2 = $conn->prepare("UPDATE prefect SET count='$num' WHERE id='$curr_value'");
                $Db_Command2->execute();

                $Db_Command3 = $conn->prepare("SELECT * FROM prefect WHERE id='$curr_value'");
                $Db_Command3->execute();
                $res1 = $Db_Command3->fetch(PDO::FETCH_ASSOC);
                $numofvotes = $res1["count"];   // the number of votes to be inserted in voting_details table
                $prefectName = $res1["FirstName"]." ".$res1["LastName"];// name to be inserted in voting_details table

                $Db_Command3 = $conn->prepare("UPDATE student SET Status='Voted' WHERE id='$voted_student'");
                $Db_Command3->execute();

                $Db_Command4 = $conn->prepare("INSERT INTO voting_details(DateTime,name,num) values(NOW(),'$prefectName','$numofvotes')");
                $Db_Command4->execute();

                $_SESSION["Status"]="Voted";
            


            }
        }
    }
?>