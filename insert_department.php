<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/constants.php';
$err="";
/*
if (!is_authenticated()) {
    redirect('login.php');
}
*/
if ($_POST) {
    $department_name = $_POST['department_name'] ?? '';
   


    if ($department_name) {
        
        $query = 'INSERT INTO department (department_name,id )
            VALUES (?, ?)';

        $stmt = $mysqli->prepare($query); 

        $stmt->bind_param('si', $department_name,$id);

        $stmt->execute();

        header('Location: index_department.php');
        exit;

    }

    $err="Department Name Is Required";
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Managment System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
<?php
    include "../LeaveManagmentSystem/header/header.html"
?>
    <div class="container">
        <h1>Add Department</h1>
        <hr>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="row mb-3">
               
                <label for="department_name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="department_name" name="department_name">
                    <span style="color: red;"> <?php echo $err ?></span>
                </div>
               
            </div>
            

            <button type="submit" class="btn btn-secondary">Add Department</button>
         
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>