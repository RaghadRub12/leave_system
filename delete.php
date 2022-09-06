<?php
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/functions.php';
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

if  (isset($_POST['confirmed']) && $_POST['confirmed'] == 'yes'){
    $query = 'DELETE FROM employee WHERE id = ?';

    $stmt = $mysqli->prepare($query); // mysqli_stmt

    $stmt->bind_param('i', $id);

    $stmt->execute();

    // Redirect
    header('Location: index.php');
    exit;
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
        <h2 class="mb-4">Delete employee</h2>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$id}" ?>" method="post">
            <h3>Are you sure you want to delete this employee (#<?= $id ?>)?</h3>
            <button type="submit" class="btn btn-danger" name="confirmed" value="yes">Yes! Delete</button>
            <a href="index.php" class="btn btn-dark">No</a>
        </form>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>