<?php
include "config.php";
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5" style="max-width:520px">
<div class="card bg-black border-secondary shadow-lg">
<div class="card-body">

<h4 class="text-info text-center mb-4">👤 Edit Profile</h4>

<form method="POST">
    <input name="username" class="form-control mb-3 bg-dark text-light border-secondary" placeholder="Username">
    <input name="role" class="form-control mb-3 bg-dark text-light border-secondary" placeholder="Role">
    <button class="btn btn-info w-100">Save Changes</button>
</form>

<?php
if ($_POST) {
    $set = [];
    foreach ($_POST as $key => $value) {
        $set[] = "$key='$value'"; // ❌ Mass Assignment
    }
    mysqli_query($conn, "UPDATE users SET ".implode(",", $set)." WHERE id=1");
    echo "<div class='alert alert-success mt-3'>Profile updated</div>";
}
?>

<p class="text-secondary mt-3 text-center">
<small>Hint: field bisa ditambah manual</small>
</p>

</div>
</div>
</div>
</body>
</html>
