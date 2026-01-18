<?php
session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SecureLearn | Demo Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .hero {
            background: white;
            border-radius: 16px;
            padding: 50px;
            box-shadow: 0 20px 40px rgba(0,0,0,.2);
        }
        .badge-custom {
            background: #f1f3f5;
            color: #212529;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <div class="hero">

                <span class="badge badge-custom mb-3">Project Keamanan Web</span>

                <h1 class="fw-bold mb-3">
                    Website PHP dengan <span class="text-primary">Celah Keamanan</span>
                </h1>

                <p class="text-muted mb-4">
                    Website ini dibuat untuk keperluan pembelajaran analisis celah keamanan
                    pada aplikasi web berbasis PHP, MySQL, dan Bootstrap.
                </p>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            🔓 Mass Assignment
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            ⚡ Race Condition
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            🔁 Password Reset
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            🐞 Information Leak
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="login.php" class="btn btn-primary btn-lg px-4">
                        Login
                    </a>
                    <a href="debug.php" class="btn btn-outline-secondary btn-lg px-4">
                        Debug Page
                    </a>
                </div>

                <hr class="my-4">

            </div>
        </div>
    </div>
</div>

</body>
</html>
