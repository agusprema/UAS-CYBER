<?php
include "config.php";
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profile</title>
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
    }

    .profile-container {
        max-width: 550px;
        width: 100%;
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

    .profile-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
    }

    .profile-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .profile-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 2.5rem;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .profile-title {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .profile-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
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

    .form-control-custom {
        width: 100%;
        padding: 0.875rem 1rem;
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

    .btn-submit {
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

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .alert-custom {
        padding: 1rem 1.25rem;
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
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        gap: 0.75rem;
        color: #764ba2;
    }

    @media (max-width: 576px) {
        .profile-card {
            padding: 2rem 1.5rem;
        }

        .profile-title {
            font-size: 1.5rem;
        }
    }
</style>
</head>
<body>

<div class="profile-container">
    <div class="profile-card">
        
        <a href="dashboard.php" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>

        <div class="profile-header">
            <div class="profile-icon">
                <i class="fas fa-user-edit"></i>
            </div>
            <h1 class="profile-title">Edit Profile</h1>
            <p class="profile-subtitle">Perbarui informasi profil Anda</p>
        </div>

        <form method="POST">
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-user"></i>
                    Username
                </label>
                <input 
                    type="text" 
                    name="username" 
                    class="form-control-custom" 
                    placeholder="Masukkan username baru"
                    required
                >
            </div>

            <!-- <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-user-tag"></i>
                    Role
                </label>
                <input 
                    type="text" 
                    name="role" 
                    class="form-control-custom" 
                    placeholder="Masukkan role baru"
                    required
                >
            </div> -->

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i>
                Simpan Perubahan
            </button>
        </form>

        <?php
        if ($_POST) {
            $set = [];
            foreach ($_POST as $key => $value) {
                $set[] = "$key='$value'"; // ❌ Mass Assignment
            }
            mysqli_query($conn, "UPDATE users SET ".implode(",", $set)." WHERE id=1");
            echo '<div class="alert-custom alert-success-custom">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Berhasil!</strong><br>
                        Profil Anda telah diperbarui.
                    </div>
                  </div>';
        }
        ?>

        <div class="hint-box">
            <i class="fas fa-lightbulb"></i>
            <div>
                <p class="hint-text">
                    <strong>Hint untuk Testing:</strong><br>
                    Field form dapat ditambahkan secara manual untuk eksploitasi Mass Assignment vulnerability.
                </p>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>