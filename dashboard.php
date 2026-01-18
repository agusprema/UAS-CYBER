<?php
include "config.php";
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
<div class="card bg-black border-secondary shadow">
<div class="card-body">

<h3 class="text-info">👋 Selamat datang, <?= $user['username']; ?></h3>
<p>Role: <b><?= $user['role']; ?></b></p>
<p>Saldo: <b>Rp <?= number_format($user['balance']); ?></b></p>

<hr>

<a href="profile.php" class="btn btn-outline-info">Edit Profil</a>
<a href="purchase.php" class="btn btn-outline-info">Beli Item</a>
<a href="logout.php" class="btn btn-outline-danger float-end">Logout</a>

</div>
</div>
</div>

</body>
</html>
