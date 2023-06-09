<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizza Order | Home</title>
    <meta name="description" content="This week we will be using OOP PHP to create and read with our CRUD application">
    <meta name="robots" content="noindex, nofollow">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="./css/style.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-dark bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Pizza Order</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Order Here</a></li>
                    <li class="nav-item"><a class="nav-link" href="view.php">Check Your Order Info</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container">

    <section class="form-row row justify-content-center">
        <!-- validate the inputs -->
        <?php
        if($_SERVER[REQUEST_METHOD] == "POST"){
            // Create variables
            $fname    = trim($_POST['fname']);
            $lname    = trim($_POST['lname']);
            $phonenum = trim($_POST['phonenum']);
            $email    = trim($_POST['email']);
            $address  = trim($_POST['address']);

            // add error variable
            $error = '';

            // validation
            if(empty($fname)){
                $error = "<p>first name needed</p>";
            }else if(empty($lname)){
                $error = "<p>last name needed</p>";
            }else if(empty($phonenum)){
                $error = "<p>Phone number needed</p>";
            }else if(!is_numeric($phonenum)){
                $error = "<p>Please use numbers only</p>";
            }else if(strlen($phonenum) != 10){
                $error = "<p>Number should be 10 numbers long</p>";
            }else if(empty($email)){
                $error = "<p>email needed</p>";
            }else if(!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email)){
                $error = "<p>Not a valid email</p>";
            }else if(empty($address)){
                $error = "<p>address needed</p>";
            }
            else{
                require_once ('database.php');
                if (isset($_POST)& !empty($_POST)){
                    $pizza = $database->sanitize($_POST['pizza']);
                    $fname = $database->sanitize($_POST['fname']);
                    $lname = $database->sanitize($_POST['lname']);
                    $phonenum = $database->sanitize($_POST['phonenum']);
                    $email = $database->sanitize($_POST['email']);
                    $address = $database->sanitize($_POST['address']);
                    $result = $database->create($pizza,$fname,$lname,$phonenum,$email,$address);
                    if($result){
                        echo "<p>Thank You For Your Order!!</p>";
                    }else{
                        echo "<p>Please Try Again</p>";
                    }
                }
            }
        }
        ?>

        <!-- pizza order form -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal col-md-6 col-md-offset-3">
            <h2>Order Info</h2>

            <div class="form-group">
                <label for="input1" class="col-md control-label">Select Your Pizza!</label>
                <div>
                    <select name="pizza" class="form-control">
                        <option>Select Pizza</option>
                        <option value="Chicago">Chicago Pizza</option>
                        <option value="Cheese">Cheese Pizza</option>
                        <option value="Hawaiian">Hawaiian Pizza</option>
                        <option value="Pepperoni">Pepperoni Pizza</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="input2" class="col-md control-label">First Name:</label>
                <div>
                    <input type="text" name="fname" class="form-control" id="input2">
                </div>
            </div>

            <div class="form-group">
                <label for="input3" class="col-md control-label">Last Name:</label>
                <div>
                    <input type="text" name="lname" class="form-control" id="input3">
                </div>
            </div>

            <div class="form-group">
                <label for="input4" class="col-md control-label">Your Phone Number:</label>
                <div>
                    <input type="text" name="phonenum" class="form-control" id="input4">
                </div>
            </div>

            <div class="form-group">
                <label for="input5" class="col-md control-label">Your Email:</label>
                <div>
                    <input type="email" name="email" class="form-control" id="input5">
                </div>
            </div>

            <div class="form-group">
                <label for="input6" class="col-md control-label">Your Address:</label>
                <div>
                    <input type="text" name="address" class="form-control" id="input6">
                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-danger col-md-3 col-md-offset-10">
            </div>
            <?php echo "<p class='error'>$error</p>"; ?>

        </form>
        <div class="form-group submit-message">

        </div>
    </section>

</main>
</body>
</html>