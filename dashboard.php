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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .dashboard-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    .welcome-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        margin-bottom: 2rem;
        border: none;
    }
    
    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1.5rem;
    }
    
    .user-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }
    
    .info-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 1.5rem;
        border-radius: 15px;
        color: white;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .info-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }
    
    .info-box i {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        opacity: 0.9;
    }
    
    .info-label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .info-value {
        font-size: 1.5rem;
        font-weight: 700;
    }
    
    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .btn-custom {
        padding: 1rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-danger-custom {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .btn-danger-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(245, 87, 108, 0.4);
        color: white;
    }
    
    .wave-emoji {
        display: inline-block;
        animation: wave 1s ease-in-out infinite;
    }
    
    @keyframes wave {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(20deg); }
        75% { transform: rotate(-15deg); }
    }
</style>
</head>
<body>

<div class="dashboard-container">
    <div class="welcome-card">
        <h1 class="welcome-title">
            <span class="wave-emoji">👋</span> Selamat Datang, <?= htmlspecialchars($user['username']); ?>!
        </h1>
        
        <div class="user-info">
            <div class="info-box">
                <i class="fas fa-user-circle"></i>
                <div class="info-label">Role</div>
                <div class="info-value"><?= htmlspecialchars($user['role']); ?></div>
            </div>
            
            <div class="info-box">
                <i class="fas fa-wallet"></i>
                <div class="info-label">Saldo</div>
                <div class="info-value">Rp <?= number_format($user['balance'], 0, ',', '.'); ?></div>
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="profile.php" class="btn btn-custom btn-primary-custom">
                <i class="fas fa-user-edit"></i>
                Edit Profil
            </a>
            <a href="user-info.php?id=<?= $user['id'] ?>" class="btn btn-custom btn-primary-custom">
                <i class="fas fa-user"></i>
                Profil Informatioon
            </a>
            <a href="purchase.php" class="btn btn-custom btn-primary-custom">
                <i class="fas fa-shopping-cart"></i>
                Beli Item
            </a>
            <a href="logout.php" class="btn btn-custom btn-danger-custom">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>