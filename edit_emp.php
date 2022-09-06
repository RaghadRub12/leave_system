<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/constants.php';
/*
if (!is_authenticated()) {
    redirect('login.php');
}

*/
$id = (int) $_GET['id'] ?? 0;
if (!$id) {
    header('Location: index.php');
    exit;
}

$clean_id = $mysqli->real_escape_string($id);
$query = "SELECT * FROM employee WHERE id = '$clean_id'"; // safe
$result = $mysqli->query($query);
$data = $result->fetch_assoc();

if (!$data) {
    header('Location: index.php');
    exit;
}

if ($_POST) {
    $name = $_POST['name'] ?? '';
    $email= $_POST['email'] ?? '';
    $end_leave_date=$_POST['end_leave_date']?? '';
    $reason_for_leave = $_POST['reason_for_leave'] ?? '';
    $type_id = $_POST['type_id'] ?? null;

    if ($name && $email && $id) {
        
        $query = 'UPDATE employee SET
            name = ?,
            email= ?,
            type_id = ?,
            end_leave_date =?,
            reason_for_leave = ?
            WHERE id = ?
        ';

        $stmt = $mysqli->prepare($query); 

        $stmt->bind_param('ssissi', $name, $email, $type_id, $end_leave_date,$reason_for_leave,$id);

        $stmt->execute();

        // Redirect
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
    <title>Leave Managment System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
<?php
    include "../LeaveManagmentSystem/header/header.html"
?>
    <div class="container">
        <h1> Employee</h1>
        <hr>
        <h2 class="mb-4">Edit Employee</h2>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$id}" ?>" method="post">
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($data['name']) ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= htmlspecialchars($data['email']) ?>"/>
                </div>
            </div>
           
            <div class="row mb-3">
                <label for="type_id" class="col-sm-2 col-form-label">leave Type </label>
                <div class="col-sm-10">
                    <select class="form-select" id="type_id" name="type_id">
                        <option></option>
                        <?php foreach ($types as $key => $value) : ?>
                        <option value="<?= $key ?>" <?= $key == $data['type_id'] ? 'selected' : '' ?> ><?= $value ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="end_leave_date" class="col-sm-2 col-form-label">End leave date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control"  id="end_leave_date" name="end_leave_date"  value="<?= htmlspecialchars($data['end_leave_date']) ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <label for="reason_for_leave" class="col-sm-2 col-form-label">Reason for leave</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  id="reason_for_leave" name="reason_for_leave"  value="<?= htmlspecialchars($data['reason_for_leave']) ?>"/>
                </div>
            </div>

            <button type="submit" class="btn btn-secondary">Update Data</button>
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>