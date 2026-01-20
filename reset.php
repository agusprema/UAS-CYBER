<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password - SecureLearn</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 2rem 1rem;
        position: relative;
        overflow: hidden;
    }

    /* Animated background particles */
    body::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        animation: float 15s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .reset-container {
        max-width: 520px;
        width: 100%;
        position: relative;
        z-index: 1;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .reset-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 24px;
        padding: 3rem 2.5rem;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
    }

    .reset-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .reset-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .reset-title {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .reset-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: #667eea;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 1.1rem;
        z-index: 2;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-control-custom::placeholder {
        color: #adb5bd;
    }

    .btn-reset {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 700;
        font-size: 1.05rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-reset:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .btn-reset:active {
        transform: translateY(0);
    }

    .alert-custom {
        padding: 1.25rem;
        border-radius: 12px;
        border: none;
        margin-top: 1.5rem;
        animation: slideDown 0.5s ease-out;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success-custom {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-success-custom i {
        font-size: 1.5rem;
    }

    .divider {
        margin: 2rem 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e9ecef, transparent);
    }

    .back-link {
        text-align: center;
        margin-top: 1.5rem;
    }

    .back-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-link a:hover {
        color: #764ba2;
        gap: 0.75rem;
    }

    .hint-box {
        background: linear-gradient(135deg, #fff3cd 0%, #ffe8a1 100%);
        border-left: 4px solid #ffc107;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-top: 1.5rem;
        display: flex;
        align-items: start;
        gap: 0.75rem;
    }

    .hint-box i {
        color: #856404;
        font-size: 1.2rem;
        margin-top: 0.2rem;
    }

    .hint-text {
        color: #856404;
        font-size: 0.85rem;
        line-height: 1.5;
        margin: 0;
    }

    @media (max-width: 576px) {
        .reset-card {
            padding: 2rem 1.5rem;
        }

        .reset-title {
            font-size: 1.6rem;
        }
    }
</style>
</head>
<body>

<div class="reset-container">
    <div class="reset-card">
        
        <div class="reset-header">
            <div class="reset-icon">
                <i class="fas fa-key"></i>
            </div>
            <h1 class="reset-title">Reset Password</h1>
            <p class="reset-subtitle">
                Masukkan username dan password baru Anda untuk mereset akun
            </p>
        </div>

        <form method="POST">
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-user"></i>
                    Username
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input 
                        type="text" 
                        name="username" 
                        class="form-control-custom" 
                        placeholder="Masukkan username"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-lock"></i>
                    Password Baru
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input 
                        type="password" 
                        name="newpass" 
                        class="form-control-custom" 
                        placeholder="Masukkan password baru"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn-reset">
                <i class="fas fa-sync-alt"></i>
                Reset Password
            </button>
        </form>

        <?php
        if ($_POST) {
            // ❌ No verification - Siapa saja bisa reset password user lain
            mysqli_query($conn,
                "UPDATE users SET password='{$_POST['newpass']}' WHERE username='{$_POST['username']}'"
            );
            echo '<div class="alert-custom alert-success-custom">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Reset Password Berhasil!</strong><br>
                        Password untuk username <strong>' . htmlspecialchars($_POST['username']) . '</strong> telah diubah.
                    </div>
                  </div>';
        }
        ?>

        <div class="divider"></div>

        <div class="back-link">
            <a href="login.php">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Login
            </a>
        </div>

        <div class="hint-box">
            <i class="fas fa-bug"></i>
            <div>
                <p class="hint-text">
                    <strong>Vulnerability - Insecure Password Reset:</strong><br>
                    Halaman ini tidak memverifikasi kepemilikan akun. Siapa saja bisa mereset password user lain tanpa verifikasi email, token, atau pertanyaan keamanan. Coba reset password akun admin!
                </p>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>