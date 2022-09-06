<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/constants.php';

if (!is_authenticated()) {
    redirect('login.php');
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
        <div class="d-flex justify-content-between mb-4">
            <h2>Employees</h2>
            
        </div>
        
        <table class="table ">
            <thead class="table table-dark table-striped" >
                <tr >
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Type Id</th>
                    <th>Start Leave Date</th>
                    <th>End Leave Date</th>
                    <th>Reason for leave</th>
                    <th>Department Name</th>
                    <th> <div>
                <a href="insert_employee.php" class="btn btn-sm btn-outline-primary">Add Employee</a>
        </div></th>
                </tr>
                
            </thead>
            <tbody class="table-secondary" >
                <?php
                $query = 'SELECT * FROM employee ORDER BY start_leave_date DESC';
                $result = $mysqli->query($query); 
                
                while ( $row = $result->fetch_assoc() ) :
                ?>
                <tr >
                    <td><?php echo $row['id'] ?></td>
                    
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['type_id'] ?? '-' ?></td>
                    <td><?= $row['start_leave_date'] ?></td>
                    <td><?= $row['end_leave_date'] ?></td>
                    <td><?= $row['reason_for_leave'] ?></td>
                    <td><?= $row['department_name'] ?></td>
                    <td><a href="edit_emp.php?id=<?= $row['id'] ?>" class="btn btn-secondary">Edit</a></td>
                    <td><a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a></td>
                    
                </tr>
                <?php
                endwhile
                ?>
            </tbody>
        </table>
       
        
       
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>