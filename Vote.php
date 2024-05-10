<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
    </script>
    <script>

        let prevbtn = $("");
        let arrmap = new Map();
        let runonce = true;
        $(document).ready(function() {

            $(".btns").on("click",function(e){
                e.preventDefault();
                
                let btn = $(this);

                if(prevbtn.closest("div").attr("value")==btn.closest("div").attr("value")){
                // checking if previous btn and current button are in the same category b4 changing it 
                    
                    prevbtn.html("Vote");
                    prevbtn.removeClass("btn-success");

                    if(arrmap!=null){
                    // setting the value of the category to whatever value the button holds so as to update the person
                    // voted
                        arrmap.set(btn.closest("div").attr("value"),btn.val()
                        );
                        
                    }
                    
                }

                else{ // checks if the category id is already in list so that if we go back
                    // to vote another person, it doesn't add two voted buttons
                    
                    if(arrmap!=null){
                        console.log("else block has run");
                        $("button").each(function(x,y){ // looping through each button in html
                            // console.log($(y).val());

                            var currval = $(y).val(); // getting its value i.e., prefect id to use for comparison later
                            var parentval = $(y).closest("div").attr("value");// getting the parent's value i.e, post id to use for comparison later
                            // console.log(parentval);

                            arrmap.forEach((k,v)=>{ // looping through each element currently in the dictionary
                                if(btn.closest("div").attr("value")==parentval){ // checking the value of the current button pressed is
                                    // the same as that of the current iteration of the buttons
                                    
                                        $(y).removeClass("btn-success");
                                        $(y).html("Vote");
                                        console.log(5);
                                }
                                // console.log(k,v);
                            }); 
                        });

                        arrmap.set(btn.closest("div").attr("value"),btn.val()
                                ); // post is key, prefect is value
                        
                        
                    }
                    
                }


                prevbtn = btn;
                // console.log(btn.val());
                // console.log(btn.closest("div").attr("value"));
                btn.html("Voted");
                btn.addClass("btn-success");
                // arrmap.forEach((k,v)=>{
                //     console.log(k,v)
                // });

            });
            $("#sub").click(function(){
                var result = confirm("Do you want to Submit. You cannot change your vote after submission");
                if(result){

                    let arr = [];
                    arrmap.forEach((k,v)=>{
                        arr.push(k);
                        // console.log(k,v);
                    });

                    $.ajax({
                        type:'POST',
                        url:'http://localhost:80/Voting/Applyvotes.php',
                        data:{arrArray:arr},
                        success: function (result){
                            // $("#resp").html("Congratulations");
                            console.log(arr);
                            alert("Thank you for voting. You'll not be able to access this page now");
                            window.location.href = "Vote.php";

                        },
                        error: function(exception){
                            // $("#resp").html("Failed");
                            console.log(exception);
                            alert(exception);
                        }
                    });
                }
            });
            
        });
    </script>
</head>
<body class="post_bg">
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="Dashboard_Student.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="EditStudentFromStudent.php?Uid=<?php echo $_SESSION['Uid'] ?>">Edit Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="Vote.php">Vote</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="return confirm('Are you sure you want to Logout');" href="Logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

<div class="container-fluid">
    <?php
        include("dBconfig.php");
        // session_start();
        
        // checking if student has already voted and also if the student has logged in first
        // this prevents access to this site through the url search bar
        if($_SESSION["Status"]!="Voted"){

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
            <th>Action</th>
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
            <div value="<?php print($var1['id']); ?>">
                <button type="submit" name="vote" value="<?php print($var2['id']) ?>" class="btn btn-primary btns">Vote</button>
            </div>
        </td> 
    </tr>
    <?php 
        }
    }
    ?> 
    </table>
        
    <?php
    }?>
    
    <div class="text-center py-3"><button type="submit" id="sub" class="btn btn-success" style="margin:auto; width: 10rem;">Submit</button></div>
    
    <?php
    }
    else{
    ?>

    <div class="content pt-5">
        <div class="container-fluid">
            
            <h4 class="mb-4 text-center py-2"
    style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    border-radius: 10px 10px 10px 10px;
    background: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.8));
    color: #00ff0d;
    "
        > You have already voted. You cannot access the voting page anymore
        
    </h4>    

        </div>
    </div>
    
    <?php 
    
    }
    
    ?>
</div>
</body>
</html>