<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/constants.php';
/*
if (!is_authenticated()) {
    redirect('login.php');
}
*/
$err_name =  $err_email= $err_leave_date = $err_reason = $err_type = "";
if ($_POST) {
    $name = $_POST['name'] ?? '';
    $email= $_POST['email'] ?? '';
    $end_leave_date=$_POST['end_leave_date']?? '';
    $reason_for_leave = $_POST['reason_for_leave'] ?? '';
    $type_id = $_POST['type_id'] ?? null;
    $department_name = $_POST['department_name'] ?? null;
       
   

    if ($name && $email ) {

        $query = 'INSERT INTO employee (name, email,type_id,start_leave_date, end_leave_date, reason_for_leave,department_name,id )
            VALUES (?, ?, ?, ?, ?,?,?,?)';

        $start_leave_date = date('Y-m-d '); 

        $stmt = $mysqli->prepare($query); 

        $stmt->bind_param('ssissssi',  $name, $email,$type_id,$start_leave_date, $end_leave_date, $reason_for_leave,$department_name,$id );

        $stmt->execute();

        // Redirect
        header('Location: index.php');
        exit;

    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $err_name = "Only letters and white space allowed";
      }
     if($name == ""){
        $err_name="Name is required";
    }
     if($email == ""){
        $err_email="email is required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_email = "Invalid email format";
      }
     if($end_leave_date == ""){
        $err_leave_date="Date is required";
    } if($reason_for_leave == ""){
        $err_reason="Reason is required";
    }
     if($type_id == ""){
        $err_type="Leave Type is required";
    }
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
       
        <hr>
        <h2 class="mb-4">Insert Employee</h2>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name">
                    <span style="color: red;"> <?php echo $err_name ?></span>
                </div>
                
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="email" name="email"></textarea>
                    <span style="color: red;"> <?php echo $err_email ?></span>
                </div>

            </div>
            <div class="row mb-3">
                <label for="type_id" class="col-sm-2 col-form-label">Leave Type</label>
                <div class="col-sm-10">
                    <select class="form-select" id="type_id" name="type_id">
                        <option></option>
                        <?php foreach ($types as $key => $value) : ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                    <span style="color: red;"> <?php echo $err_type ?></span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="end_leave_date" class="col-sm-2 col-form-label">End leave date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control"  id="end_leave_date" name="end_leave_date"/>
                    <span style="color: red;"> <?php echo $err_leave_date ?></span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="reason_for_leave" class="col-sm-2 col-form-label">Reason for leave</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="reason_for_leave" name="reason_for_leave"></textarea>
                    <span style="color: red;"> <?php echo $err_reason ?></span>
                </div>
            </div>
            
                <div class="row mb-3">
                <label for="department_name" class="col-sm-2 col-form-label">Department Name</label>
                <div class="col-sm-10">

                    <select class="form-select" id="department_name" name="department_name">
                    <?php
                        $query = 'select department_name from department ';
                        $result = $mysqli->query($query); 
                        while ( $row = $result->fetch_assoc() ) :
                        var_dump( $row['department_name']);
                    ?>
                        <option></option>
                       
                        <option value="<?=  $row['department_name']?>"><?=  $row['department_name'] ?></option>
                        <?php
                endwhile
                ?>
                    </select>
                    
                    <span style="color: red;"> <?php echo '' ?></span>
                </div>
            </div>   
           

            <button type="submit" class="btn btn-secondary">Add Employee</button>
         
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>