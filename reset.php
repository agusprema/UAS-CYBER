<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Password Reset</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5" style="max-width:500px">
<div class="card bg-black border-secondary shadow-lg">
<div class="card-body">

<h4 class="text-info text-center mb-4">🔑 Reset Password</h4>

<form method="POST">
    <input name="username" class="form-control mb-3 bg-dark text-light border-secondary" placeholder="Username">
    <input name="newpass" class="form-control mb-3 bg-dark text-light border-secondary" placeholder="New Password">
    <button class="btn btn-info w-100">Reset Password</button>
</form>

<?php
if ($_POST) {
    mysqli_query($conn,
        "UPDATE users SET password='{$_POST['newpass']}' WHERE username='{$_POST['username']}'"
    );
    echo "<div class='alert alert-success mt-3'>Password reset success</div>";
}
?>

</div>
</div>
</div>
</body>
</html>
