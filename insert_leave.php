<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/constants.php';
/*
if (!is_authenticated()) {
    redirect('login.php');
}
*/
if ($_POST) {
    $employee_name = $_POST['employee_name'] ?? '';
    $leave_type= $_POST['leave_type'] ?? '';
    $applied_date=$_POST['applied_date']?? '';
    $hod_status = $_POST['hod_status'] ?? '';
    $registered_status = $_POST['registered_status'] ?? null;
    $registered_date = $_POST['registered_date'] ?? null;


    if ($employee_name && $leave_type) {

        $query = 'INSERT INTO leaves (employee_name, leave_type,applied_date,hod_status,registered_status,registered_date,id )
            VALUES (?, ?, ?, ?, ?,?,?)';

        

        $start_leave_date = date('Y-m-d '); // 2022-08-31 14:01:00

        $stmt = $mysqli->prepare($query); // mysqli_stmt

        $stmt->bind_param('sissssi', $employee_name,$leave_type,$applied_date,$hod_status,$registered_status,$registered_date,$id);

        $stmt->execute();

        // Redirect
        header('Location: index_leaves.php');
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
    <title>Leave Managment System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
<?php
    include "../LeaveManagmentSystem/header/header.html"
?>
    <div class="container">
        <h1>Add Leaves </h1>
        <hr>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="employee_name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="applied_date" class="col-sm-2 col-form-label">Applied Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="applied_date" name="applied_date"/>
                </div>
            </div>
            <div class="row mb-3">
                <label for="hod_status" class="col-sm-2 col-form-label">Hod Status</label>
                <div class="col-sm-10">
                <select class="form-select" id="hod_status" name="hod_status">
                        <option> select</option>
                        <option value="registered"> registered</option>
                        <option value="pinding"> pinding</option>
                </select>
                    
                </div>
            </div>
            <div class="row mb-3">
                <label for="registered_status" class="col-sm-2 col-form-label">Registered Status</label>
                <div class="col-sm-10">
                <select class="form-select" id="registered_status" name="registered_status">
                        <option> select</option>
                        <option value="registered"> registered</option>
                        <option value="pinding"> pinding</option>
                </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="registered_date" class="col-sm-2 col-form-label">Registered Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="registered_date" name="registered_date"/>
                </div>
            </div>
            <div class="row mb-3">
                <label for="leave_type" class="col-sm-2 col-form-label">Leave Type</label>
                <div class="col-sm-10">
                    <select class="form-select" id="leave_type" name="leave_type">
                        <option></option>
                        <?php foreach ($types as $key => $value) : ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            

            <button type="submit" class="btn btn-secondary">Apply</button>
         
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>