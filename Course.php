<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Registration</title>
    <!-- <link rel="stylesheet" href="https://classless.de/classless.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>
<body class="course_bg py-4">

    <h1 class="text-center course_lead_title">Enter Course Details: </h1>

    <form class="container-fluid py-4 form_css" action="InsertCourse.php" method="post">
        <p>
            <label class="form-label" for="cn">Course Name</label>
            <input type="text" class="form-control" name="cn" id="cn" required>
        </p>
        <p>
            <label class="form-label" for="dept">Department</label>
            <input type="text" class="form-control" name="dept" id="dept" required>
        </p>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" name="register">Enter Course</button>
        </div>
    </form>
</body>
</html>