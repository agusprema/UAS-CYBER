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
<title>Purchase Item</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5" style="max-width:480px">
<div class="card bg-black border-secondary shadow-lg">
<div class="card-body text-center">

<h4 class="text-info mb-3">🛒 Buy Premium Item</h4>
<p>Harga: <b>Rp 50.000</b></p>

<form method="POST">
    <button class="btn btn-info w-100">Buy Now</button>
</form>

<?php
if ($_POST) {
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=1"));
    if ($user['balance'] >= 50000) {
        // ❌ Race Condition
        mysqli_query($conn, "UPDATE users SET balance = balance - 50000 WHERE id=1");
        echo "<div class='alert alert-success mt-3'>Purchase success</div>";
    }
}
?>

<p class="text-secondary mt-2">
<small>Hint: coba multi request</small>
</p>

</div>
</div>
</div>
</body>
</html>
