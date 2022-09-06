<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/functions.php';
$error="";

if (isset($_POST['submit'])) {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
  
    echo $password;
      if(  $email &&  $password)   {  
        $query = 'UPDATE users SET
        password= ?
        WHERE user = ?
    ';

    $stmt = $mysqli->prepare($query); 

    $stmt->bind_param('ss', $password,$email);

    $stmt->execute();
    $error="";
    header('Location: index.php');
   
        exit;
    }
}
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>Leave Managment System</title>
</head>
<body class="text-center d-flex h-100 text-bg-dark  " style="display: flex;">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>
    <div class="container vh-100" >
    <?php if ($error) : ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
        <?php endif ?>
        <div class="row justify-content-center h-100">
            <div class="card w-25 my-auto">
                
                
                <div class="card-header text-center">
                    <i class="bi bi-person-circle text-bg-dark">change password </i>
                </div>
                <div class="card-body">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) .  "?email={$email}" ?>" method="post" > 
                <span style="color:red"><?php echo $error?></span>
                    <div class="form-group">
              
                        <label for="email" >email</label>
                        <input type="text" name="email" class="form-control" placeholder=" email" autocomplete="FALSE">
                       
                    </div>
                    <div class="form-group">
                        <label for="password" >password</label>
                        <input type="password" name="password" class="form-control" placeholder=" new password">
                       
                    </div>

                    
                    <button type="submit" class="w-100 btn btn-primary">Change</button>
                </form>   
                </div>
            </div>

        </div>
    </div>
        
</body>
</html>