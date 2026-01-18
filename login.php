<?php
include "config.php";

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ❌ Sengaja tidak hash (untuk pembelajaran)
    $q = mysqli_query($conn,
        "SELECT * FROM users WHERE username='$username' AND password='$password'"
    );

    if (mysqli_num_rows($q) == 1) {
        $_SESSION['user'] = mysqli_fetch_assoc($q);
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Login gagal";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5" style="max-width:400px">
<div class="card bg-black border-secondary shadow">
<div class="card-body">

<h4 class="text-info text-center mb-4">🔐 Login</h4>

<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="POST">
    <input name="username" class="form-control mb-3 bg-dark text-light border-secondary" placeholder="Username">
    <input name="password" type="password" class="form-control mb-3 bg-dark text-light border-secondary" placeholder="Password">
    <button class="btn btn-info w-100">Login</button>
</form>

</div>
</div>
</div>
</body>
</html>
