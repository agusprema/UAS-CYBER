<?php
include "config.php";
error_reporting(E_ALL);
ini_set('display_errors', 1); // ❌ debug mode
?>
<!DOCTYPE html>
<html>
<head>
<title>System Debug</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5" style="max-width:600px">
<div class="card bg-black border-secondary shadow-lg">
<div class="card-body">

<h4 class="text-info text-center mb-4">🛠️ System Status</h4>

<form method="GET">
    <input name="id" class="form-control mb-3 bg-dark text-light border-secondary" placeholder="User ID">
    <button class="btn btn-info w-100">Check</button>
</form>

<?php
if (isset($_GET['id'])) {
    // ❌ error & info leak
    $query = "SELECT * FROM user WHERE id=" . $_GET['id'];
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    echo "<pre class='text-warning'>";
    print_r($data);
    echo "</pre>";
}
?>

<p class="text-secondary text-center">
<small>Hint: input salah</small>
</p>

</div>
</div>
</div>
</body>
</html>
