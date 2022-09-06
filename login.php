<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/functions.php';

$error = $emailErr ='';

if ($_POST) {
    $user = $_POST['user'] ?? '';
    $password = $_POST['password'] ?? '';
    if (filter_var($user, FILTER_VALIDATE_EMAIL)) {

        if ($user && $password) {

            $query = 'SELECT * FROM users  ';
            $result = $mysqli->query($query);
            $row = $result->fetch_assoc();
            
            if ($row) {
                login($row);
                header('Location: index.php');
                exit;
            }
        }

    }
        $emailErr = "Invalid email format";
        $error = 'Invalid email and password !';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Leave Managment System</title>
</head>
<body class="text-center d-flex h-100 text-bg-dark  " style="display: flex;">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <div class="container vh-100" >
    <?php if ($error) : ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
        <?php endif ?>
        <div class="row justify-content-center h-100">
            <div class="card w-25 my-auto">
                
                <div class="mb-4 " style="padding-top: 40px;">
                   
                    <svg xmlns="http://www.w3.org/2000/svg" width="95" height="95"  class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                </div>
                <div class="card-header text-center">
                    <i class="bi bi-person-circle text-bg-dark">Leave Managment System</i>
                </div>
                <div class="card-body">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" > 
                    <div class="form-group">
                        <label for="" >Email address</label>
                        <input type="text" name="user" class="form-control" placeholder="enter your username">
                       <span style="color: red;"> <?php  echo $emailErr ?></span>
                    </div>

                    <div class="form-group" style="padding-bottom: 40px;">
                        <label for="" >password</label>
                        <input type="password" name="password" class="form-control" placeholder="enter your password">
                    </div>

                   
                    <button type="submit" class="w-100 btn btn-primary">Login</button>
                    <a href="change_password.php" >change password</a>
                </form>   
                </div>
            </div>

        </div>
    </div>
        
</body>
</html>