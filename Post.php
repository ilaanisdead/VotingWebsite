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
<body class="post_bg py-4">

    <h1 class="text-center post_lead_title text-white">Enter Post Details: </h1>

    <form class="container-fluid py-4 form_css" action="InsertPost.php" method="post">
        <p>
            <label class="form-label" for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </p>
        <p class="form-floating">
            <textarea class="form-control" name="desc" id="desc" cols="30" rows="10" required></textarea>
            <label for="desc">Description</label>
            <!-- <input type="text" class="form-control" name="desc" id="desc" required> -->
        </p>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" name="register">Enter Course</button>
        </div>
    </form>
</body>
</html>